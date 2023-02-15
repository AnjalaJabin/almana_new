<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Sap_api extends CI_Controller
{

    /*Function to set JSON output*/
    public function output($Return = array())
    {
        /*Set response header*/
        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        /*Final JSON response*/
        exit(json_encode($Return));
    }

    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->helper('html');
        $this->load->database();
        $this->load->library('form_validation');
        $this->load->model("Xin_model");
        $this->load->model("Budgeting_model");

        //load the login model
    }

    public function index()
    {

    }

    public function get_companies_list_api()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'http://3.130.27.224/api/Company');
        $result = curl_exec($ch);
        curl_close($ch);
        $session = $this->session->userdata('username');

        $obj = json_decode($result);
        foreach ($obj as $company) {

            $cost_exist = $this->Xin_model->check_company_exist($company->companyName);

            if (($cost_exist == false) && ($company->companyName)) {
                $data = array(
                    'name' => $company->companyName,
                    'company_code' => $company->companyCode,
                    'created_date' => date('Y-m-d H:i:s'),
                    'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_company($data);
            }
        }


        $user_data = array(
            'page' => '',
            'page_title' => '"Company List',
            'ip' => $_SERVER['REMOTE_ADDR'],
            'date_time' => date('Y-m-d H:i:s'),
            'user_id' => $session['user_id'],
            'activity' => 'Synced Company List'
        );
        $this->Xin_model->add_user_activity_log($user_data);
        $Return = array('result' => 'true', 'error' => '');
        $this->output($Return);
        exit;

    }

    public function get_expense_type_api()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'http://3.130.27.224/api/ExpenseType?companyCode=DUBAI_LIVE');
        $result = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($result);

        echo '<pre>';
        print_r($obj);
    }

    public function get_cost_center_api()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'http://3.130.27.224/api/CostCenter?companyCode=DUBAI_LIVE');
        $result = curl_exec($ch);
        curl_close($ch);
        $session = $this->session->userdata('username');

        $obj = json_decode($result);
        foreach ($obj as $cost_center) {
            $cost_exist = $this->Xin_model->check_cost_center_exist($cost_center->ocrName);


            if (($cost_exist == false) && ($cost_center->ocrName)) {
                $data = array(
                    'name' => $cost_center->ocrName,
                    'cost_center_code' => $cost_center->ocrCode,
                    'date' => date('Y-m-d H:i:s'),
                    'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_cost_center($data);

            }
        }
        $Return = array('result' => 'true', 'error' => '');
        $this->output($Return);
        exit;

//        echo '<pre>';
//        print_r($obj);
    }

    public function get_vendor_api()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'http://3.130.27.224/api/BusinessPartner/Vendor?companyCode=KUWAIT_LIVE');
        $result = curl_exec($ch);
        curl_close($ch);
        $session = $this->session->userdata('username');
        $obj = json_decode($result);
        foreach ($obj as $vendor) {
            $cost_exist = $this->Xin_model->check_supplier_exist($vendor->cardName);

            if (($cost_exist == false) && ($vendor->cardName)) {

                $data = array(
                    'name' => $vendor->cardName,
                    'ref_no' => $vendor->cardCode,
                    'date' => date('Y-m-d H:i:s'),
                    'added_by' => $session['user_id']
                );

                $result = $this->Xin_model->add_supplier($data);

            }
        }
        $Return = array('result' => 'true', 'error' => '');
        $this->output($Return);
        exit;

//        echo '<pre>';
//        print_r($obj);
    }

    public function get_project_type_api()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, 'http://3.130.27.224/api/ProjectType?companyCode=KUWAIT_LIVE');
        $result = curl_exec($ch);
        curl_close($ch);

        $obj = json_decode($result);

        echo '<pre>';
        print_r($obj);
    }
    public function post_purchase_order(){
        $exp_id = $this->input->post()['exp_id'];
        $exp_data= $this->Budgeting_model->get_exp_list($exp_id);
        if($exp_data) {
            $exp_data = $exp_data[0];
            $postfields = array(
                "companyCode" => "DUBAI_LIVE",
                "cardCode" => $exp_data->card_code,
                "cardName" => $exp_data->supplier_name,
                "numAtCard" => $exp_data->supplier_ref,
                "currency" => $exp_data->currency,
                "series" => "2022-CM",
                "postingDate" => new Datetime(),
                "deliveryDate" => $exp_data->date,
                "documentDate" => $exp_data->added_date,
                "remarks" => $exp_data->exp_title,
                "slpCode" => $exp_data->added_by,
                "totWithoutDis" => $exp_data->amount,
                "taxTotal" => isset($exp_data->tax_percent) ? ($exp_data->amount * $exp_data->tax_percent / 100) : 0,
                "total" => $exp_data->amount,
                "lines" => [
                    array(
                        "lineId" => $exp_data->id,
                        "projectType" => "",
                        "expenseType" => "",
                        "description" => $exp_data->description,
                        "costCenter" => $exp_data->cost_center_code,
                        "unitPrice" => $exp_data->amount,
                        "project" => '',//get expense type api to be synced "CommExpOwnedWindowDisplayWinter",
                        "total" => $exp_data->amount,
                        "remarks" => $exp_data->exp_title
                    ),
                ],);
            $postfields = json_encode($postfields);


            $curl = curl_init();

            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://3.130.27.224/api/PurchaseOrder',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $postfields,
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);
            //echo $response;
            $data = array(
                'api_status' => 1,
            );
            $result = $this->Budgeting_model->update_expense($data, $exp_id);

            $Return = array('result' => 'true', 'error' => '');
            $this->output($Return);
            exit;
        }
        else{
            $Return = array('result' => 'true', 'error' => 'Expense Already Synced!');
            $this->output($Return);
            exit;
        }
    }


}