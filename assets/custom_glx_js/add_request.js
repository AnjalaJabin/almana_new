$(document).ready(function() {

    $('#sub_category_change').on('change', function () {
        var sub_category_id = $('#sub_category_change').val();
        var budget_id = $('#budget_id').val();

        jQuery.getJSON(site_url + "budgeting/get_main_cat_name_by_sub_cat_id/" + sub_category_id, function (data, status) {
            $('#budget_line_text').val(addCommas(data.name));
            $('#selected_main_cat_id').val(addCommas(data.id));


        });

        jQuery.getJSON(site_url+"request/get_budget_total_by_sub_cat/"+budget_id+"/"+sub_category_id, function(data1, status) {
            $('#category_total').val(addCommas(data1.cat_total));
            var sub_cat_balance =parseInt(data1.cat_total)-parseInt(data1.total_used);
            $('#sub_cat_balance').val(sub_cat_balance);
            $('#total_spent_subcat').val(addCommas(data1.total_used));
            $('#amount_used').val(addCommas(data1.total_by_user));

        });

        });
    var no_sub_data = $('#no_data').val();
    if(no_sub_data==1)
    {
        Swal.fire({
            text: "No subcategories available!!",
            icon: "error",
        });
    }
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

    $('#current_request_amount').on('keyup',function(){
        check_request_amount();
    });
    $('#currency').on('change',function() {
        check_request_amount();

    });

    function check_request_amount()
    {
        var request_amount = ($('#current_request_amount').val());
        var budget_currency = $('#budget_currency').val();
        var currency    =  $('#currency').val();

        var sub_cat_bal = parseInt($('#sub_cat_balance').val());
        if((currency!='')&&(budget_currency!='') &&(request_amount!='')){
            $.ajax({
                url: site_url + "budgeting/convert_to_current_currency/" + request_amount + "/" + currency + "/" + budget_currency + "/" + 1,
                type: "GET",
                data:  "is_ajax=1&type=1",
                contentType: false,
                cache: false,
                processData:false,
                dataType: "json",
                success: function(JSON)
                {
                    var amount =JSON.amount;
                    if(amount > sub_cat_bal)
                    {
                        Swal.fire({
                            text: "'Requseted Amount Exceeds Limit!!'",
                            icon: "error",
                        });


                    }

                }
            });


        }else{
            var amount = request_amount;
            $('#exp_amount').val(request_amount);
            if(amount > sub_cat_bal)
            {
                Swal.fire({
                    text: "'Requseted Amount Exceeds Limit!!'",
                    icon: "error",
                });


            }

        }

    }



    $("#add_request_form").submit(function(e){
        check_request_amount();
        var fd = new FormData(this);
        var obj = $(this), action = obj.attr('name');
        fd.append("is_ajax", 1);
        fd.append("add_type", 'add_new_budget_request');
        fd.append("form", action);
        e.preventDefault();

        $.ajax({
            url: site_url+'/request/add_new_budget_request/',
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