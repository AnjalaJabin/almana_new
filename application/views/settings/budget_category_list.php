<?php 
$session = $this->session->userdata('username');
$user = $this->Xin_model->read_user_info($session['user_id']);
$result  = $this->Xin_model->get_categories_by_department($user[0]->department_id);
?>
<option value=""><?php echo $this->lang->line('xin_select_one');?></option>
<?php foreach($result->result() as $ctype) {?>
<option value="<?php echo $ctype->id;?>"> <?php echo $ctype->name;?></option>
<?php } ?>
