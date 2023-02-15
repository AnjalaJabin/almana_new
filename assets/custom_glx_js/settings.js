$(document).ready(function(){

    var xin_table_departments = $('#xin_table_departments').DataTable({
		"bDestroy": true,
		dom: 'lfrtipB',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf"></i>Export',
				extend: 'pdf',
				//class :
				split: [ 'excel', 'csv','copy','print'],
			}
		],
		"ajax": {
            url : site_url+"settings/department_list/",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}			
	});

	var xin_table_companies = $('#xin_table_companies').DataTable({
		"bDestroy": true,
		dom: 'lfrtipB',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf"></i>Export',
				extend: 'pdf',
				//class :
				split: [ 'excel', 'csv','copy','print'],
			}
		],
		"ajax": {
			url : site_url+"settings/company_list/",
			type : 'GET'
		},
		"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();
		}
	});

	var xin_table_category = $('#xin_table_category').DataTable({
		"bDestroy": true,
		dom: 'lfrtipB',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf"></i>Export',
				extend: 'pdf',
				split: [ 'excel', 'csv','copy','print'],
			}
		],
		"ajax": {
            url : site_url+"settings/category_list/",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}			
	});

	var xin_table_currency = $('#xin_table_currency').DataTable({
		"bDestroy": true,
		dom: 'lfrtipB',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf"></i>Export',
				extend: 'pdf',
				split: [ 'excel', 'csv','copy','print'],
			}
		],
		"ajax": {
			url : site_url+"settings/currency_list/",
			type : 'GET'
		},
		"fnDrawCallback": function(settings){
			$('[data-toggle="tooltip"]').tooltip();
		}
	});

	var xin_table_sub_category = $('#xin_table_sub_category').DataTable({
		"bDestroy": true,
		dom: 'lfrtipB',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf"></i>Export',
				extend: 'pdf',
				split: [ 'excel', 'csv','copy','print'],
			}
		],
		"ajax": {
            url : site_url+"settings/sub_category_list/",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}			
	});


	var xin_table_cost_center = $('#xin_table_cost_center').DataTable({
		"bDestroy": true,
		dom: 'lfrtipB',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf"></i>Export',
				extend: 'pdf',
				split: [ 'excel', 'csv','copy','print'],
			}
		],
		"ajax": {
            url : site_url+"settings/cost_center_list/",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}			
	});
	xin_table_cost_center.buttons().container().appendTo("#export_cost");
	xin_table_companies.buttons().container().appendTo("#export_company");

	
	var xin_table_supplier = $('#xin_table_supplier').DataTable({
		"bDestroy": true,
		dom: 'lfrtipB',
		buttons: [
			{
				text: '<i class="fas fa-file-pdf"></i>Export',
				extend: 'pdf',
				split: [ 'excel', 'csv','copy','print'],
			}
		],
		"ajax": {
            url : site_url+"settings/supplier_list/",
            type : 'GET'
        },
		"fnDrawCallback": function(settings){
		$('[data-toggle="tooltip"]').tooltip();          
		}			
	});



	jQuery("#add_departments").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = jQuery(this), action = obj.attr('name');
		jQuery('.save').prop('disabled', true);
		jQuery.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=28&data=add_departments&type=add_departments&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					jQuery('.save').prop('disabled', false);
				} else {
					xin_table_departments.ajax.reload(function(){
						toastr.success(JSON.result);
					}, true);
					jQuery('#add_departments')[0].reset(); // To reset form fields
					jQuery('.save').prop('disabled', false);
				}
			}
		});
	});
	
	
	jQuery("#add_budget_sub_category").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = jQuery(this), action = obj.attr('name');
		jQuery('.save').prop('disabled', true);
		jQuery.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=28&data=add_budget_sub_category&type=add_budget_sub_category&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					jQuery('.save').prop('disabled', false);
				} else {
					xin_table_sub_category.ajax.reload(function(){
						toastr.success(JSON.result);
					}, true);
					jQuery('#add_budget_sub_category')[0].reset(); // To reset form fields
					jQuery('.save').prop('disabled', false);
				}
			}
		});
	});
	jQuery("#add_currency").submit(function(e){
		/*Form Submit*/
		e.preventDefault();
		var obj = jQuery(this), action = obj.attr('name');
		jQuery('.save').prop('disabled', true);
		jQuery.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=28&data=add_currency&type=add_currency&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					jQuery('.save').prop('disabled', false);
				} else {
					xin_table_currency.ajax.reload(function(){
						toastr.success(JSON.result);
					}, true);
					jQuery('#add_currency')[0].reset(); // To reset form fields
					jQuery('.save').prop('disabled', false);
				}
			}
		});
	});
	
	jQuery("#add_category").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = jQuery(this), action = obj.attr('name');
		jQuery('.save').prop('disabled', true);
		jQuery.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=28&data=add_budget_main_category&type=add_budget_main_category&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					jQuery('.save').prop('disabled', false);
				} else {
					xin_table_category.ajax.reload(function(){
						toastr.success(JSON.result);
					}, true);
					jQuery('#add_category')[0].reset(); // To reset form fields
					jQuery('.save').prop('disabled', false);
				}
			}
		});
	});
	
	
	jQuery("#add_cost_center").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = jQuery(this), action = obj.attr('name');
		jQuery('.save').prop('disabled', true);
		jQuery.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=28&data=add_cost_center&type=add_cost_center&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					jQuery('.save').prop('disabled', false);
				} else {
					xin_table_cost_center.ajax.reload(function(){
						toastr.success(JSON.result);
					}, true);
					jQuery('#add_cost_center')[0].reset(); // To reset form fields
					jQuery('.save').prop('disabled', false);
				}
			}
		});
	});
	jQuery("#add_company").submit(function(e){
		/*Form Submit*/
		e.preventDefault();
		var obj = jQuery(this), action = obj.attr('name');
		jQuery('.save').prop('disabled', true);
		jQuery.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=28&data=add_company&type=add_company&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					jQuery('.save').prop('disabled', false);
				} else {
					xin_table_companies.ajax.reload(function(){
						toastr.success(JSON.result);
					}, true);
					jQuery('#add_company')[0].reset(); // To reset form fields
					jQuery('.save').prop('disabled', false);
				}
			}
		});
	});

	$( document ).on( "click", "#sync_vendor", function() {
		jQuery.getJSON(site_url+"sap_api/get_vendor_api", function(data1, status) {
			if(data1.result=="true"){
				xin_table_supplier.ajax.reload(function(){
					toastr.success('Synchronization Completed!');
				}, true);
			}
		});
	});
	$( document ).on( "click", "#sync_company", function() {
		jQuery.getJSON(site_url+"sap_api/get_companies_list_api", function(data1, status) {
			if(data1.result=="true"){
				xin_table_companies.ajax.reload(function(){
					toastr.success('Synchronization Completed!');
				}, true);
			}
		});
	});
	$( document ).on( "click", "#sync_costcenter", function() {
		jQuery.getJSON(site_url+"sap_api/get_cost_center_api", function(data1, status) {
			if(data1.result=="true"){
				xin_table_cost_center.ajax.reload(function(){
					toastr.success('Synchronization Completed!');
				}, true);
			}
		});
	});
	jQuery("#add_supplier").submit(function(e){
	/*Form Submit*/
	e.preventDefault();
		var obj = jQuery(this), action = obj.attr('name');
		jQuery('.save').prop('disabled', true);
		jQuery.ajax({
			type: "POST",
			url: e.target.action,
			data: obj.serialize()+"&is_ajax=28&data=add_supplier&type=add_supplier&form="+action,
			cache: false,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					jQuery('.save').prop('disabled', false);
				} else {
					xin_table_supplier.ajax.reload(function(){
						toastr.success(JSON.result);
					}, true);
					jQuery('#add_supplier')[0].reset(); // To reset form fields
					jQuery('.save').prop('disabled', false);
				}
			}
		});
	});
	
    
    $('#edit_setting_datail').on('show.bs.modal', function (event) {
    		var button = $(event.relatedTarget);
    		var field_id = button.data('field_id');
    		var field_type = button.data('field_type');
    		$('.icon-spinner3').show();
    		if(field_type == 'category'){
    			var field_add = '&data=category&type=category&';
    		}else if(field_type == 'sub_category'){
    			var field_add = '&data=sub_category&type=sub_category&';
    		}else if(field_type == 'departments'){
    			var field_add = '&data=departments&type=departments&';
    		}else if(field_type == 'currency'){
				var field_add = '&data=currency&type=currency&';
			}else if(field_type == 'cost_center'){
    			var field_add = '&data=cost_center&type=cost_center&';
    		}else if(field_type == 'supplier'){
    			var field_add = '&data=supplier&type=supplier&';
    		}
    		
    		
    		var modal = $(this);
    		$.ajax({
    			url: site_url+'settings/constants_read/',
    			type: "GET",
    			data: 'jd=1'+field_add+'field_id='+field_id,
    			success: function (response) {
    				if(response) {
    					$('.icon-spinner3').hide();
    					$("#ajax_setting_info").html(response);
    				}
    			}
		});
    });
	xin_table_currency.buttons().container().appendTo("#export_currency");
	xin_table_sub_category.buttons().container().appendTo("#export_subcat");
	xin_table_category.buttons().container().appendTo("#export_cat");
	xin_table_departments.buttons().container().appendTo("#export_dep");
	xin_table_supplier.buttons().container().appendTo("#export_supplier");


});

    $( document ).on( "click", ".delete", function() {
    	$('input[name=_token]').val($(this).data('record-id'));
    	$('input[name=token_type]').val($(this).data('token_type'));
    	$('#delete_record').attr('action',site_url+'settings/delete_'+$(this).data('token_type')+'/'+$(this).data('record-id'))+'/';
    });
    

/* Delete data */
	$("#delete_record").submit(function(e){
	var tk_type = $('#token_type').val();
	$('.icon-spinner3').show();
	if(tk_type == 'category'){
		var field_add = '&is_ajax=9&data=category&type=delete_record&';
		var tb_name = 'xin_table_'+tk_type;
	}else if(tk_type == 'sub_category'){
		var field_add = '&is_ajax=9&data=sub_category&type=delete_record&';
		var tb_name = 'xin_table_'+tk_type;
	}else if(tk_type == 'departments'){
		var field_add = '&is_ajax=9&data=departments&type=delete_record&';
		var tb_name = 'xin_table_'+tk_type;
	}else if(tk_type == 'cost_center'){
		var field_add = '&is_ajax=9&data=cost_center&type=delete_record&';
		var tb_name = 'xin_table_'+tk_type;
	}else if(tk_type == 'supplier'){
		var field_add = '&is_ajax=9&data=supplier&type=delete_record&';
		var tb_name = 'xin_table_'+tk_type;
	}else if(tk_type == 'currency'){
		var field_add = '&is_ajax=9&data=currency&type=delete_record&';
		var tb_name = 'xin_table_'+tk_type;
	}else if(tk_type == 'company'){
		var field_add = '&is_ajax=9&data=company&type=delete_record&';
		var tb_name = 'xin_table_companies';
	}
	
	/*Form Submit*/
	e.preventDefault();
		var obj = $(this), action = obj.attr('name');
		$.ajax({
			url: e.target.action,
			type: "post",
			data: '?'+obj.serialize()+field_add+"form="+action,
			success: function (JSON) {
				if (JSON.error != '') {
					toastr.error(JSON.error);
					$('.delete-modal').modal('toggle');
				} else {
					$('.delete-modal').modal('toggle');
					$('#'+tb_name).dataTable().ajax.reload(function(){
						toastr.success(JSON.result);
					}, true);
					
				}
			}
		});
	});
