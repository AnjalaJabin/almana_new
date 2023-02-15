$(document).ready(function() {
    
    $('.sub_category_list_div_html').each(function(){
        var sub_category_list_data = $(this).parent().parent().find('.sub_category_list_div').html();
        $(this).val(sub_category_list_data);
    });
    
    $('.add_sub_category_btn').on('click',function(){
        //var sub_category_list_data = $(this).parent().find('.sub_category_list_div').find(">:first-child");
        var sub_category_list_data = $(this).parent().parent().find('.sub_category_list_div_html').val();
        $(this).parent().parent().find('.sub_category_list_div').append(sub_category_list_data);
        $('.form-select-solid').select2();
    });
    
    $('.form-select-solid').select2();
    
    $(document).on('click','.delete_main_category_btn',function(){
        $(this).parent().parent().remove();
        calculate_allocated_balance();
    })
    
    $(document).on('keyup','.main_category_budget_keyup',function(){
       calculate_allocated_balance($(this));
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
    
    
    function calculate_allocated_balance(selected){
        var budget_allocated_amount = selected.parent().parent().parent().parent().parent().parent().find('.main_assigned_budget').val();
        console.log(budget_allocated_amount);
        var avail_balance = parseInt(budget_allocated_amount);
        selected.parent().parent().parent().find('.main_category_budget_keyup').each(function(){
            var amount = $(this).val();
            avail_balance = parseInt(avail_balance)-parseInt(amount);
            $(this).parent().find('.main_cat_avail_bal').html(addCommas(avail_balance));
        });
    }
    
    $(document).on("submit", "#kt_create_account_form", function (e) {
    e.preventDefault();
    	var obj = $(this), action = obj.attr('name');
    	$.ajax({
    		type: "POST",
    		url: site_url+'/budgeting/save_new_budget_sub_cats/',
    		data: obj.serialize()+"&is_ajax=1&add_type=save_new_budget_sub_cats&form="+action,
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
        			window.location = JSON.redirect_url;
    				window.location.replace(JSON.redirect_url);
    				window.location.href = JSON.redirect_url;
    			}
    		}
    	});
    });
    
});