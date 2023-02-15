<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Mypdf extends TCPDF
{
    public $xfootertext = '';
    public $footertext2 = '';
    public $headertext = '';
    public $header_for_first = '';
    public $header_for_all = '';
    public $y_from_2 = '';


    public function Header()
    {

        $headerData = $this->getHeaderData();


        $this->SetFont('helvetica', '', 10);
        $image_file = K_PATH_IMAGES . 'logo-dark.jpg';
        if ($this->headertext != '') {
            // $this->writeHTML( $this->headertext,false,true,false,true);

            if (($this->PageNo() == 1) && ($this->header_for_first != '')) {

                $this->writeHTML($this->headertext . $this->header_for_first, false, true, false, true);

            } elseif (($this->PageNo() == 1) && ($this->header_for_first == '')) {

                $this->writeHTML($this->headertext, false, true, false, true);

            }
            if (($this->PageNo() != 1) && ($this->header_for_all != '')) {
                $this->writeHTML($this->headertext . $this->header_for_all, false, true, false, true);

            }
        } else {

            $this->writeHTML($headerData['string'], false, true, false, true);

        }
        // $this->Cell(0, 30, "Expense Report", 0, false, 'C', 0, '', 0, false, 'M', 'M');

        //$this->Image($image_file, 245, 10, 40, '', 'JPG', '', 'T', false, 300, '', false, false, 0, false, false, false);


    }
  
      public function Footer() {

          // Position at 15 mm from bottom
          $this->SetY(-10);
          $this->SetX(10);
          // Set font
          $this->SetFont('helvetica', 'I', 8);
          $year = date('Y');
         // $footertext = sprintf($this->xfootertext, $year);
          $this->writeHTML($this->xfootertext, false, true, false, true);

          // Page number

         // $this->Cell(120, 10, $this->footertext2, 0, false, 'C', 0, '', 0, false, 'T', 'M');
        //  $this->Cell(60, 10, 'Page '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');

      }

}