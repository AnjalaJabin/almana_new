<?php 
$result  = $this->Xin_model->get_sub_categories_by_main_cat($main_cat_id);
?>
<option value=""><?php echo $this->lang->line('xin_select_one');?></option>
<?php foreach($result->result() as $ctype) {?>
<option value="<?php echo $ctype->id;?>"> <?php echo $ctype->name;?></option>
<?php } ?>