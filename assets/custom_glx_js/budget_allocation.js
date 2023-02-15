$(document).ready(function() {

    var allocation_table = $('#allocation_table').DataTable({
        "bDestroy": true,
        "bProcessing"   :   true,
        dom: 'frtip',

        search: {
            return: true,
        },
        lengthChange: true,

    });


    $('#assign_budget_employee').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var budget_id = button.data('budget_id');
        var sub_cat_id = button.data('sub_cat_id');
        $('.icon-spinner3').show();

        var modal = $(this);
        $.ajax({
            url: site_url+'budgeting/budget_assign_read/',
            type: "GET",
            data: 'jd=1&budget_id='+budget_id+'&sub_cat_id='+sub_cat_id+'&type=budget_assign',
            success: function (response) {
                if(response) {
                    $('.icon-spinner3').hide();
                    $("#ajax_budget_employee").html(response);
                }
            }
        });
    });
    $('#employeewise').on('show.bs.modal', function (event) {
        var button = $(event.relatedTarget);
        var budget_id = button.data('budget_id');
        var sub_cat_id = button.data('sub_cat_id');
        $('.icon-spinner3').show();

        var modal = $(this);
        $.ajax({
            url: site_url+'budgeting/budget_assign_read/',
            type: "GET",
            data: 'jd=1&budget_id='+budget_id+'&sub_cat_id='+sub_cat_id+'&type=budget_assign',
            success: function (response) {
                if(response) {
                    $('.icon-spinner3').hide();
                    $("#ajax_budget_employee").html(response);
                }
            }
        });
    });
});