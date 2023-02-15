<?php
$session = $this->session->userdata('username');
defined('BASEPATH') OR exit('No direct script access allowed');
if(isset($_GET['jd']) && $_GET['data']=='products'){
    $item_name_text = 'Product Name';
    $item_type_text = 'Product';
    $item_des_text  = 'Product Description';
    $crm_setting = $this->Xin_model->read_setting_info(1);
    if($crm_setting[0]->crm_products_type==2){
        $item_name_text = 'Item Name';
        $item_des_text  = 'Item Description';
        $item_type_text = 'Item';
    }
    
$user_info = $this->Xin_model->read_user_info($session['user_id']);
$role_user = $this->Xin_model->read_user_role_info($user_info[0]->user_role_id);
$role_resources_ids = explode(',',$role_user[0]->role_resources);
if(in_array('66',$role_resources_ids)) {
?>
<form class="m-b-1" action="<?php echo site_url("products/add_product_with_price"); ?>" method="post" name="add_product_with_price" id="add_product_with_price">
    
<div class="modal-header">
  <button type="button" class="close" data-dismiss="modal" aria-label="Close"> <span aria-hidden="true">×</span> </button>
  <h4 class="modal-title" id="edit-modal-data">Add New <?php echo $item_type_text; ?></h4>
</div>
  <div class="modal-body">
    <div class="row">
        <div class="col-sm-12">
            
          <div class="form-group">
            <label for="name"><?php echo $item_name_text; ?></label>
            <textarea class="form-control" placeholder="<?php echo $item_name_text; ?>" name="product_name"></textarea>
          </div>
          
          <div class="form-group">
            <label for="name"><?php echo $item_des_text; ?></label>
            <textarea class="form-control" placeholder="<?php echo $item_des_text; ?>" name="description"></textarea>
          </div>
          <?php
          if($crm_setting[0]->crm_products_type==1){
              $sku_number  = $this->Xin_model->get_new_product_sku_number();
          ?>
          
            <div class="row">
                <div class="col-sm-6">
                   <div class="form-group">
                    <label for="name">Model Number</label>
                    <input class="form-control" placeholder="Model Number" name="model_number" type="text">
                  </div>
                </div>
                <div class="col-sm-6">
                   <div class="form-group">
                    <label for="name">SKU</label>
                    <input class="form-control" placeholder="SKU" name="sku" type="text" value="<?php echo $sku_number; ?>">
                  </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-sm-6">
                   <a class="btn btn-sm btn-primary pull-right text-white" id="group_add_btn3"><i class="fa fa-plus icon"></i>New brand</a>
                    <div style="background:#ddd; padding:7px; display:none;" id="group_add_div3">
                        <div class="input-group">
                           <input type="text" class="form-control" placeholder="Brand Name" id="group_add_val3">
                           <span class="input-group-btn">
                                <button class="btn btn-success" type="button" id="group_sub_btn3">Add</button>
                           </span>
                           <span class="input-group-btn">
                                <button class="btn" type="button" id="group_close_btn3">X</button>
                           </span>
                        </div>
                    </div>
                  
                  <div class="form-group" id="group_ajax3">
                    <label for="name">Brand</label>
                      <select class="form-control form-select" name="brand_name" data-plugin="select_hrm" data-placeholder="Select Brand">
                        <option value=""><?php echo $this->lang->line('xin_select_one');?></option>
                        <?php foreach($product_brand as $ctype) {?>
                        <option value="<?php echo $ctype->id;?>"> <?php echo $ctype->name;?></option>
                        <?php } ?>
                      </select>
                  </div>
                </div>
                <div class="col-sm-6">
                   <div class="form-group">
                    <label for="name">Barcode</label>
                    <input class="form-control" placeholder="Barcode" name="barcode" type="text">
                  </div>
                </div>
            </div>
          
          <?php
          }
          ?>
          
            <a class="btn btn-sm btn-primary pull-right text-white" id="group_add_btn"><i class="fa fa-plus icon"></i> New Category</a>
            <div style="background:#ddd; padding:7px; display:none;" id="group_add_div">
                <div class="input-group">
                   <input type="text" class="form-control" placeholder="Category Name" id="group_add_val">
                   <span class="input-group-btn">
                        <button class="btn btn-success" type="button" id="group_sub_btn">Add</button>
                   </span>
                   <span class="input-group-btn">
                        <button class="btn" type="button" id="group_close_btn">X</button>
                   </span>
                </div>
            </div>
          
          <div class="form-group" id="group_category">
            <label for="name"><?php echo $item_type_text; ?> Category</label>
              <select class="form-control form-select" name="product_cat" data-plugin="select_hrm" data-placeholder="Select <?php echo $item_type_text; ?> Category">
                <option value=""><?php echo $this->lang->line('xin_select_one');?></option>
                <?php foreach($product_cats as $ctype) {?>
                <option value="<?php echo $ctype->id;?>"> <?php echo $ctype->name;?></option>
                <?php } ?>
              </select>
          </div>
          
          <?php
          if($crm_setting[0]->crm_products_type==1){
          ?>
          
          <a class="btn btn-sm btn-primary pull-right text-white" id="group_add_btn2"><i class="fa fa-plus icon"></i> New Supplier</a>
            <div style="background:#ddd; padding:7px; display:none;" id="group_add_div2">
                <div class="input-group">
                   <input type="text" class="form-control" placeholder="Supplier Name" id="group_add_val2">
                   <span class="input-group-btn">
                        <button class="btn btn-success" type="button" id="group_sub_btn2">Add</button>
                   </span>
                   <span class="input-group-btn">
                        <button class="btn" type="button" id="group_close_btn2">X</button>
                   </span>
                </div>
            </div>
            
           <div class="form-group" id="group_ajax2">
            <label for="name">Supplier</label>
              <select class="form-control form-select" name="supplier" data-plugin="select_hrm" data-placeholder="Select Supplier">
                <option value=""><?php echo $this->lang->line('xin_select_one');?></option>
                <?php foreach($suppliers as $supplier) {?>
                <option value="<?php echo $supplier->id;?>"> <?php echo $supplier->name;?></option>
                <?php } ?>
              </select>
              </div>
              
            <?php
            }else{
            ?>
            <input type="hidden" name="supplier" value=""/>
            <input type="hidden" name="model_number" value=""/>
            <input type="hidden" name="brand_name" value=""/>
            <?php
            }
            ?>
              
               <div class="row">
                <div class="col-sm-6">
                   <div class="form-group">
                    <label for="name">Unit Name</label>
                    <input class="form-control" placeholder="Unit Name" name="unit_name" type="text" value="Unit">
                  </div>
                </div>
                <div class="col-sm-6">
                   <div class="form-group">
                    <label for="name">Price</label>
                    <input class="form-control" placeholder="Price" name="price" type="text">
                  </div>
                </div>
              </div>
            
        </div>
        
        <div class="col-sm-6" style="display:none;">
        </div>
      </div>
    
    <div class="row">
        <div class="col-sm-6">
            
            
          
        </div>
        
        
    </div>
    
  </div>
  
  <div class="modal-footer">
    <button type="submit" class="btn btn-primary saveproduct"><?php echo $this->lang->line('xin_save');?> <?php echo $item_type_text; ?></button>
  </div>
  
  </form>

<script type="text/javascript">
    $('#description').summernote({
      height: 206,
      minHeight: null,
      maxHeight: null,
      focus: false
    });
 $(document).ready(function(){
     
        $('[data-plugin="select_hrm"]').select2($(this).attr('data-options'));
        $('[data-plugin="select_hrm"]').select2({ width:'100%' }); 
					
		// On page load: datatable
		var xin_table = $('#xin_table').dataTable({
			"bDestroy": true,
			"ajax": {
				url : "<?php echo site_url("price/price_list") ?>",
				type : 'GET'
			},
			"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();          
			}
    	});
		
		$('[data-plugin="select_xhrm"]').select2($(this).attr('data-options'));
		$('[data-plugin="select_xhrm"]').select2({ width:'100%' });	 

		/* Edit data */
		$("#edit_product").submit(function(e){
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=1&edit_type=products&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('.save').prop('disabled', false);
					} else {
						xin_table.api().ajax.reload(function(){ 
							toastr.success(JSON.result);
						}, true);
						$('.edit-modal-data').modal('toggle');
						$('.save').prop('disabled', false);
					}
				}
			});
		});
		
		
		$("#add_price").submit(function(e){
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.save').prop('disabled', true);
			
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=1&add_type=price&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('.save').prop('disabled', false);
					} else {
						xin_table.api().ajax.reload(function(){ 
							toastr.success(JSON.result);
						}, true);
						$('.save').prop('disabled', false);
						var product_id = $('#p_p_id').val();
						$('#pricing_table').load('<?php echo site_url("price/price_list") ?>/'+product_id);
						$("#main_search_form").submit();
					}
				}
			});
		});
		
		
		$("#add_product_with_price").submit(function(e){
		e.preventDefault();
			var obj = $(this), action = obj.attr('name');
			$('.saveproduct').prop('disabled', true);
			
			$.ajax({
				type: "POST",
				url: e.target.action,
				data: obj.serialize()+"&is_ajax=1&add_type=products_with_price&form="+action,
				cache: false,
				success: function (JSON) {
					if (JSON.error != '') {
						toastr.error(JSON.error);
						$('.saveproduct').prop('disabled', false);
					} else {
					    $('.add-modal-data').modal('toggle');
						toastr.success(JSON.result);
						load_select_products();
					}
				}
			});
		});
		
		
		
		
	});
	
	$(document).on( "click", "#group_add_btn", function() {
        $('#group_add_div').show();
        $('#group_add_val').focus();
        $('#group_add_btn').hide();
    });
    
    $(document).on( "click", "#group_close_btn", function() {
        $('#group_add_div').hide();
        $('#group_add_btn').show();
    });
	
	$(document).on( "click", "#group_sub_btn", function() {
        var group_val = $('#group_add_val').val();
        if(group_val==='')
        {
            toastr.error('Type Category Name');
        }
        else
        {
            
            var group_name = $('#group_add_val').val();
            $.ajax({
    			type: "POST",
    			url: site_url+'/settings/add_product_cat/',
    			data: { name:group_name, is_ajax:'1', type:'add_product_cat'},
    			cache: false,
    			success: function (JSON) {
    				if (JSON.error != '') {
    					toastr.error(JSON.error);
    				} else {
    					toastr.success(JSON.result);
    					$('#group_add_div').hide();
                        $('#group_add_btn').show();
                        $('#group_add_val').val('');
                        
                        load_product_category();
                        
    				}
    			}
    		});
               
        }
    });
    
    
    
    $(document).on( "click", "#group_add_btn2", function() {
        $('#group_add_div2').show();
        $('#group_add_val2').focus();
        $('#group_add_btn2').hide();
    });
    
    $(document).on( "click", "#group_close_btn2", function() {
        $('#group_add_div2').hide();
        $('#group_add_btn2').show();
    });
	
	$(document).on( "click", "#group_sub_btn2", function() {
        var group_val = $('#group_add_val2').val();
        if(group_val==='')
        {
            toastr.error('Type Category Name');
        }
        else
        {
            
            var group_name = $('#group_add_val2').val();
            $.ajax({
    			type: "POST",
    			url: site_url+'/suppliers/add_supplier_name/',
    			data: { supplier_name:group_name, is_ajax:'1', add_type:'suppliers'},
    			cache: false,
    			success: function (JSON) {
    				if (JSON.error != '') {
    					toastr.error(JSON.error);
    				} else {
    					toastr.success(JSON.result);
    					$('#group_add_div2').hide();
                        $('#group_add_btn2').show();
                        $('#group_add_val2').val('');
                        
                        load_supplier_names();
                        
    				}
    			}
    		});
               
        }
    });
    
    
    
$(document).on( "click", "#group_add_btn3", function() {
    $('#group_add_div3').show();
    $('#group_add_val3').focus();
    $('#group_add_btn3').hide();
});

$(document).on( "click", "#group_close_btn3", function() {
    $('#group_add_div3').hide();
    $('#group_add_btn3').show();
});

$(document).on( "click", "#group_sub_btn3", function() {
    var group_val = $('#group_add_val3').val();
    if(group_val==='')
    {
        toastr.error('Type Category Name');
    }
    else
    {
        
        var group_name = $('#group_add_val3').val();
        $.ajax({
			type: "POST",
			url: site_url+'/settings/add_product_brand/',
			data: { name:group_name, is_ajax:'1', type:'add_product_brand'},
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
				} else {
					toastr.success(JSON.result);
					$('#group_add_div3').hide();
                    $('#group_add_btn3').show();
                    $('#group_add_val3').val('');
                    
                    load_brands();
                    
				}
			}
		});
           
    }
});

function load_brands(){
    $.get(site_url+"/products/product_brand_list/", function(data, status){
		$('#group_ajax3').html(data);
	});
}

function load_supplier_names(){
    $.get(site_url+"/suppliers/suppliers_select_list", function(data, status){
		$('#group_ajax2').html(data);
	});
}

function load_product_category(){
    $.get(site_url+"/products/product_cat_list/", function(data, status){
		$('#group_category').html(data);
	});
}
  </script>
<?php 
    
}else{
    echo "<br/><br/><h5 style='color:red;'>&nbsp;&nbsp;&nbsp;&nbsp;You don't have any permissions to add new products!</h5><br/><br/>";
}

}
?>