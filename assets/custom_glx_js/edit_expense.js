$(document).ready(function() {
    
    $('#sub_category_change').on('change',function(){
      var sub_category_id =  $('#sub_category_change').val();
      jQuery.getJSON(site_url+"budgeting/get_main_cat_name_by_sub_cat_id/"+sub_category_id, function(data, status){
        $('#budget_line_text').val(data.name);
        $('#selected_main_cat_id').val(data.id);
      });
    });
    
    $('#sub_category_change').change();
    
    $('#current_expense_amount').on('keyup',function(){
       check_amount();
    });
    $('#currency').on('change',function() {
        check_amount();

    });

    function check_amount()
        {
            var expense_amount = $('#current_expense_amount').val();
            var budget_id = $('#budget_id').val();
            var category_id =  $('#selected_main_cat_id').val();
            var currency    =  $('#currency').val();
            var budget_curr =  $('#budget_currency').val();

            if(currency!='') {
                jQuery.getJSON(site_url + "budgeting/convert_to_current_currency/" + expense_amount + "/" + currency + "/" + budget_curr + "/" + 1, function (data, status) {
                    $('#exp_amount').val(data.amount);

                });

            }else{
                $('#exp_amount').val(expense_amount);

            }
    jQuery.getJSON(site_url+"budgeting/get_budget_total_expense_by_main_cat/"+budget_id+"/"+category_id, function(data, status){
        var exp_amount =  $('#exp_amount').val();
        var cat_total = parseInt(data.cat_total);
        cat_total = parseInt(cat_total)+parseInt(exp_amount);
        $('#total_amount_used_in_this_main_cat').val(addCommas(cat_total));

        var grand_tot = parseInt(data.grand_tot);
        grand_tot = parseInt(grand_tot)+parseInt(exp_amount);
        $('#total_amount_used_in_this_budget').val(addCommas(grand_tot));

        var total_available = parseInt(data.total_available);
        total_available = parseInt(total_available)-parseInt(exp_amount);
        $('#total_available_budget').val(addCommas(total_available));
    });
        }


    $('#current_expense_amount').keyup();
    
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
    
	$("#add_expense_form").submit(function(e){
		var fd = new FormData(this);
		var obj = $(this), action = obj.attr('name');
		fd.append("is_ajax", 1);
		fd.append("add_type", 'update_budget_expense');
		fd.append("form", action);
		e.preventDefault();
		
		$.ajax({
			url: site_url+'/budgeting/update_budget_expense/',
			type: "POST",
			data:  fd,
			contentType: false,
			cache: false,
			processData:false,
			success: function(JSON)
			{
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