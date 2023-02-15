$(document).ready(function() {
    
    $('.sub_category_list_div_html').each(function(){
        var sub_category_list_data = $(this).parent().parent().find('.sub_category_list_div').children().first().html();
        $(this).val('<div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3" data-select2-id="select2-data-133-fmy1">'+sub_category_list_data+'</div>');
    });
    
    $('#add_main_category_btn').on('click',function(){
       $('#all_main_cat_list_div').append($('#main_category_list_div_html').val()); 
    });
    
    $(document).on('click','.add_sub_category_btn',function(){
        //var sub_category_list_data = $(this).parent().find('.sub_category_list_div').find(">:first-child");
        //var sub_category_list_data = $(this).parent().parent().find('.sub_category_list_div_html').val();
        var sub_category_list_data = $(this).parent().parent().find('.sub_category_list_div').children().first().html();
        sub_category_list_data = '<div data-repeater-list="kt_ecommerce_add_product_options" class="d-flex flex-column gap-3" data-select2-id="select2-data-133-fmy1">'+sub_category_list_data+'</div>';
        $(this).parent().parent().find('.sub_category_list_div').append(sub_category_list_data);
        $(this).parent().parent().find('.sub_category_list_div').children().last().find('.sub_category_budget_keyup').val('');
        $(this).parent().parent().find('.sub_category_list_div').children().last().find('.select_sub_cat_dropdown_list').val('');
        //$('.form-select-solid').select2();
        calculate_allocated_balance();
    });
    
    //$('.form-select-solid').select2();
    
    $(document).on('click','.delete_main_category_btn',function(){
        $(this).parent().parent().remove();
        calculate_allocated_balance();
    });
    
    $(document).on('change','.select_main_cat_dropdown_list',function(){
        var main_cat_id = $(this).val();
        var selected_main_cat_this = $(this);
        $.get(site_url+"/budgeting/get_budget_sub_cat_div_by_main_cat_id/"+main_cat_id, function(data, status){
    		selected_main_cat_this.parent().parent().parent().parent().parent().parent().find('.sub_category_listing_div').html(data);
    			selected_main_cat_this.parent().parent().parent().parent().parent().parent().find('.sub_category_list_div_html').each(function(){
                var sub_category_list_data = $(this).parent().parent().find('.sub_category_list_div').html();
                $(this).val(sub_category_list_data);
            });
    	});
    });
    
    $(document).on('keyup','.main_category_budget_keyup',function(){
       calculate_allocated_balance();
    });
    
    function addCommas(nStr)
    {
        nStr += '';
        x = nStr.split('.');
        x1 = x[0];
        x2 = x.length > 1 ? '.' + x[1] : '';
        var rgx = /(\d+)(\d{3})/;
        while (rgx.test(x1)) {
            x1 = x1.replace(rgx, '$1' + ',' + '$2');
        }
        return x1 + x2;
    }
    
    $('#budget_name').on('keyup',function(){
        $('#budget_display_name').html($(this).val());
    });
    
    function generate_budget_description(){
        var budget_start_date = $('#budget_start_date').val();
        var budget_end_date   = $('#budget_end_date').val();
        $('#budget_display_description').html(budget_start_date+' - '+budget_end_date);
    }
    
    $('.datepicker').change(function(){
        generate_budget_description();
    });
    
    
    $(document).on( "click", ".group_add_main_cat_btn", function() {
        $(this).parent().parent().parent().parent().find('.group_add_main_cat_div').show();
        $(this).parent().parent().parent().parent().find('.group_add_main_cat_btn').hide();
        $(this).parent().parent().parent().parent().find('.show_cat_add_btn_main_head').show();
        $(this).parent().parent().parent().parent().find('.group_add_main_cat_val').focus();
    });
    
    $(document).on( "click", ".group_main_cat_close_btn", function() {
        $(this).parent().parent().parent().parent().parent().parent().find('.group_add_main_cat_div').hide();
        $(this).parent().parent().parent().parent().parent().parent().find('.group_add_main_cat_btn').show();
        $(this).parent().parent().parent().parent().parent().parent().find('.show_cat_add_btn_main_head').hide();
    });
    
    $(document).on( "click", ".group_add_main_cat_sub_btn", function() {
        var add_btn_clicked_this = $(this);
        var group_val = $(this).parent().parent().find('.group_add_main_cat_val').val();
        if(group_val==='')
        {
            Swal.fire({
                text: 'Type Category Name',
                icon: "error",
            });
        }
        else
        {
            
            var group_name = group_val;
            $.ajax({
    			type: "POST",
    			url: site_url+'/settings/add_budget_main_category/',
    			data: { name:group_name, is_ajax:'1', type:'add_budget_main_category'},
    			cache: false,
    			success: function (JSON) {
    				if (JSON.error != '') {
    					Swal.fire({
                            text: JSON.error,
                            icon: "error",
                        });
    				} else {
    					Swal.fire({
                            text: JSON.result,
                            icon: "success",
                        });
    					add_btn_clicked_this.parent().parent().parent().parent().parent().parent().find('.group_add_main_cat_val').val('');
    					add_btn_clicked_this.parent().parent().parent().parent().parent().parent().find('.group_add_main_cat_div').hide();
                        add_btn_clicked_this.parent().parent().parent().parent().parent().parent().find('.group_add_main_cat_btn').show();
                        add_btn_clicked_this.parent().parent().parent().parent().parent().parent().find('.show_cat_add_btn_main_head').hide();
                        
                        load_main_category(add_btn_clicked_this);
                        
    				}
    			}
    		});
               
        }
    });
    
    function load_main_category(selected_this){
        $.get(site_url+"/settings/budget_category_list/", function(data, status){
            selected_this.parent().parent().parent().parent().parent().parent().find('.select_main_cat_dropdown_list').html(data);
    	});
    }
    
    function load_sub_category(selected_this,category_id){
        $.get(site_url+"/settings/budget_sub_category_list/"+category_id, function(data, status){
            selected_this.parent().parent().parent().parent().find('.select_sub_cat_dropdown_list').each(function(){
                var selected_id = $(this).val();
                console.log(selected_id);
                $(this).html(data);
                $(this).val(selected_id);
            });
            //selected_this.parent().parent().parent().parent().find('.select_sub_cat_dropdown_list').html(data);
    	});
    }
    
    
    $(document).on( "click", ".group_add_sub_cat_btn", function() {
        $(this).parent().parent().parent().parent().find('.group_add_sub_cat_div').show();
        $(this).parent().parent().parent().parent().find('.group_add_sub_cat_btn').hide();
        $(this).parent().parent().parent().parent().find('.show_sub_cat_add_btn_main_head').show();
        $(this).parent().parent().parent().parent().find('.group_add_sub_cat_val').focus();
    });
    
    $(document).on( "click", ".group_sub_cat_close_btn", function() {
        $(this).parent().parent().parent().parent().parent().parent().find('.group_add_sub_cat_div').hide();
        $(this).parent().parent().parent().parent().parent().parent().find('.group_add_sub_cat_btn').show();
        $(this).parent().parent().parent().parent().parent().parent().find('.show_sub_cat_add_btn_main_head').hide();
    });
    
    $(document).on( "click", ".group_add_sub_cat_sub_btn", function() {
        var add_btn_clicked_this = $(this);
        var group_val = $(this).parent().parent().find('.group_add_sub_cat_val').val();
        var main_cat_id = $(this).parent().parent().find('.group_add_sub_cat_main_cat_id').val();
        if(group_val==='')
        {
            Swal.fire({
                text: 'Type Sub Category Name',
                icon: "error",
            });
        }
        else
        {
            
            var group_name = group_val;
            $.ajax({
    			type: "POST",
    			url: site_url+'/settings/add_budget_sub_category/'+main_cat_id,
    			data: { name:group_name, is_ajax:'1', type:'add_budget_sub_category'},
    			cache: false,
    			success: function (JSON) {
    				if (JSON.error != '') {
    					Swal.fire({
                            text: JSON.error,
                            icon: "error",
                        });
    				} else {
    					Swal.fire({
                            text: JSON.result,
                            icon: "success",
                        });
    					add_btn_clicked_this.parent().parent().parent().parent().parent().parent().find('.group_add_sub_cat_val').val('');
    					add_btn_clicked_this.parent().parent().parent().parent().parent().parent().find('.group_add_sub_cat_div').hide();
                        add_btn_clicked_this.parent().parent().parent().parent().parent().parent().find('.group_add_sub_cat_btn').show();
                        add_btn_clicked_this.parent().parent().parent().parent().parent().parent().find('.show_sub_cat_add_btn_main_head').hide();
                        
                        load_sub_category(add_btn_clicked_this,main_cat_id);
                        
    				}
    			}
    		});
               
        }
    });
    
    $(document).on('keyup','.sub_category_budget_keyup',function(){
       calculate_total_budget_by_sub_cat($(this)); 
    });
    
    $(document).on('click','.delete_sub_category_btn',function(){
        $(this).parent().parent().remove();
        //calculate_total_budget_by_sub_cat($(this));
        calculate_allocated_balance();
    });
    
    function calculate_total_budget_by_sub_cat(selected_this){
        var category_total = 0;
        selected_this.parent().parent().parent().find('.sub_category_budget_keyup').each(function(){
            var amount = $(this).val();
            if(!$.isNumeric(amount)){
                amount = 0;
            }
            category_total = parseFloat(category_total)+parseFloat(amount);
            selected_this.parent().parent().parent().parent().parent().parent().find('.category_div_main_total_span').html(addCommas(category_total));
            selected_this.parent().parent().parent().parent().parent().parent().find('.main_assigned_budget').val(category_total);
            
        });
        calculate_allocated_balance(2);
    }
    
    function calculate_allocated_balance(sub_calc = 1){
        if(sub_calc===1){
            $('.sub_category_budget_keyup').each(function(){
               $(this).keyup(); 
            });
        }
        var g_total_budget = 0;
        $('.sub_category_budget_keyup').each(function(){
            var amount = $(this).val();
            if(!$.isNumeric(amount)){
                amount = 0;
            }
            g_total_budget = parseFloat(g_total_budget)+parseFloat(amount);
        });
        $('#g_total_budget_amount').html(addCommas(g_total_budget));
        $('#g_total_budget_amount_val').val(g_total_budget);
        $('#budget_cat_list_table_total').html(addCommas(g_total_budget));
        
        $('#category_approved_butget_list_table_body').html('');
        $('.select_main_cat_dropdown_list').each(function(){
            var selected_cat_name = $(this).text();
            var selected_cat_name = $("option:selected", this).text();
            var cat_tot_amount = $(this).parent().parent().parent().find('.main_assigned_budget').val();
            $('#category_approved_butget_list_table_body').append('<tr><td>'+selected_cat_name+'</td><td class="text-end">'+addCommas(cat_tot_amount)+'</td></tr>');
        });
    }
    
    $('.sub_category_budget_keyup').keyup();
    
});