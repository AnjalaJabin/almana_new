var budgetcount;
$(document).ready( function () {
    $('.print').hide();
    $('#print_one_budget').hide();
    $('.rep_title').hide();
    $('#print_budget_pdf').hide();


    var budget_table = $('#budget_table').DataTable({
        "bDestroy": true,
        "bProcessing": true,
        dom: 'lfrtiBp',
        buttons: [
            {
                text: '<i class="fas fa-file-pdf"></i>Export',
                extend: 'pdf',
                className: "btn btn-sm",
                split: ['excel', 'csv', 'copy', 'print'],
            }
        ],
    });
    $('#budget_table_filter').hide();

    $('#filter_bud').keyup(function () {

        budget_table.search($(this).val()).draw();
    });
    budget_table.buttons().container().appendTo("#export_budget");


    $('#print_pdf').on('click', function () {
            $('.print').toggle();

        }
    );
    $('.print_check').on('click', function () {
        budgetcount = $("[type='checkbox']:checked").length;
        if(budgetcount===1){
            $('#print_one_budget').show();
            $('.rep_title').hide();
            $('#print_budget_pdf').hide();



        }else{
            $('#print_one_budget').hide();

            $('.rep_title').show();
            $('#print_budget_pdf').show();

        }
    });
    $('#check_all').on('click', function () {
        var isCheckedAll = $("#check_all").is(":checked");
        get = document.getElementsByClassName('print_check');

        if (isCheckedAll == true) {

            for (var i = 0; i < get.length; i++) {
                if(get[i].disabled!=true)
                    get[i].checked = true;
            }


        }
        else
        {

            for(var i= 0; i<get.length; i++){

                get[i].checked= false;}

        }
    });
    $('.submit_print').on('click', function () {

            let budgets = [];
            var isChecked = $(".print_check").is(":checked");
            var title= $('#report_title').val();
            var aj=1;
        if(budgetcount===1){
                var urltopdf=site_url + "/budgeting/print_budget_pdf";
            }else{
                var urltopdf=site_url + "/budgeting/print_selected_budgets";
                if(title===''){
                    aj = 0;
            Swal.fire({
                text: 'Report Title Required!',
                icon: "error",
            });
                }
            }
            if (isChecked != true) {
                Swal.fire({
                    text: 'Select any Budget',
                    icon: "error",
                });
            } else {
                var markedCheckbox = document.getElementsByClassName('print_check');
                for (var checkbox of markedCheckbox) {
                    if (checkbox.checked)
                        budgets.push(checkbox.value);
                }
                if(aj==1) {
                    $.ajax({
                        type: "POST",
                        url: urltopdf,
                        data: 'is_ajax=2&budgets=' + JSON.stringify(budgets) + '&title=' + title,
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
                                $('.print').toggle();
                                $('.rep_title').hide();
                                $('#print_budget_pdf').hide();

                                window.open(JSON.data, '_blank');
                            }
                        },
                    });
                }


            }
        }
    );

    $('input[type=checkbox]').on('change',function(e) {
        var backgroundColor = $(this).is(":checked") ? "lightgrey;" : "";
        $(this).closest('tr').attr('style', 'background-color: '+ backgroundColor +'');


    });

} );
