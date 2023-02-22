$(document).ready(function() {
    // $('#employee_select').select2();

    var xin_table_employee = $('#xin_table_employee').DataTable({
        "bDestroy": true,
        "bProcessing"   :   true,
        dom: 'lBfrtip',
        buttons: [
            {
                text: '<i class="fas fa-file-pdf"></i>Export',
                extend: 'pdf',
                split: [ 'excel', 'csv','copy','print'],
            }
        ],
        search: {
            return: false,
        },
        columnDefs: [
            {
                target: 8,
                visible: false,
            },
            ],
        lengthChange: true,
        "ajax": {
            url : site_url+"/allowances/employee_list/",
            type : 'GET'
        },
        "fnDrawCallback": function(settings){
            $('[data-toggle="tooltip"]').tooltip();
        }
    });
    xin_table_employee.buttons().container().appendTo("#export_div");

    $('#allowance_filter').on('change', function () {

        xin_table_employee.column(8).search(this.value).draw();

           } );

    $('#filter_employee').keyup(function(){
        xin_table_employee.search($(this).val()).draw() ;
    });


    /*Form Submit*/
    $(document).on("click", ".delete", function () {
        $('input[name=_token]').val($(this).data('record-id'));
        $('input[name=token_type]').val($(this).data('token_type'));
        $('#delete_record').attr('action', site_url + 'allowances/delete/' + $(this).data('record-id')) + '/';
    });


    /* Delete data */
    $("#delete_record").submit(function (e) {

        e.preventDefault();

        var allowance_id  = $('input[name=_token]').val();

        $.ajax({
            type: "POST",
            url: site_url+"/allowances/delete",
            data: "is_ajax=2&allowance_id="+allowance_id,
            cache: false,
            success: function (JSON) {


                if (JSON.error != '') {
                    toastr.error(JSON.error);
                } else {

                    $('.delete-modal').modal('toggle');

                    xin_table_employee.ajax.reload(function(){
                        toastr.success(JSON.result);
                    }, true);


                }
            }
        });
    });

// edit
    $('.edit-modal-data').on('show.bs.modal', function (event) {

        var button = $(event.relatedTarget);
        var allowance_id = button.data('allowance_id');
        var modal = $(this);
        $.ajax({
            url : site_url+"/allowances/read_allowance/",
            type: "GET",
            data: 'jd=1&is_ajax=1&mode=modal&data=allowance&allowance_id='+allowance_id,
            success: function (response) {
                if(response) {
                    $("#ajax_modal").html(response);
                }
            }
        });
    });



    $("#add_allowance_form").submit(function(e){

        var fd = new FormData(this);
        var obj = $(this), action = obj.attr('name');
        fd.append("is_ajax", 1);
        fd.append("add_type", 'add_allowance');
        fd.append("form", action);
        e.preventDefault();
        $('.save').prop('disabled', true);
        $.ajax({
            url: site_url+'/allowances/add_allowance/',//e.target.action,
            type: "POST",
            data:  fd,
            contentType: false,
            cache: false,
            processData:false,
            success: function(JSON)
            {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('.save').prop('disabled', false);
                } else {
                    $('#kt_modal_add_user').modal('toggle');
                    xin_table_employee.ajax.reload(function(){
                        toastr.success(JSON.result);
                    }, true);
                    $('#add_allowance_form')[0].reset(); // To reset form fields
                    $('.generated').remove();
                    $('.save').prop('disabled', false);
                }
            },
            error: function()
            {
                toastr.error(JSON.error);
                $('.save').prop('disabled', false);
            }
        });
    });
    function generateRow() {
        var html = '<div class="row form-group mb-3 generated">';
        html += '<div class="card-header" id="select_period_div" style="display:block;">';
        html += '<div class="card-title fs-3 fw-bolder">';
        html += '<div class="w-200 w-md-600px" style="background: rgb(221, 221, 221); padding: 7px;">';
        html += '<div class="input-group">';
        html += '<select  name="period[]" class="form-select form-select-solid select_period" data-control="select2" data-placeholder="Allowance Period" data-allow-clear="true">';
        html += '<option value="">Select Allowance Period..</option>';
        $.each(periods, function (i, period) {
            html += '<option value="' + period.id + '">' + formatDate(period.from_date) + ' - ' + formatDate(period.to_date) + '('+period.category+') </option>';
        });
        html += '</select>';
        html += '<input type="text" class="form-control form-control-solid" placeholder="Amount" name="amount[]" />';
        // html += '<span class="input-group-btn">';
        // html += '<button class="btn btn-success group_add_main_cat_sub_btn add_period" type="button"><i class="fa fa-plus"></i></button>';
        // html += '</span>';
        html += '<span class="input-group-btn">';
        html += '<button class="btn btn-danger group_remove_main_cat_sub_btn" type="button"><i class="fa fa-times"></i></button>';
        html += '</span>';
        html += '</div></div></div></div></div>';

        $("#allowance-div").append(html);

        // Initialize select2 for the new row
        $('.select_period').select2();
    }

    function formatDate(dateString) {
        var date = new Date(dateString);
        var day = date.getDate();
        var month = date.toLocaleString('default', { month: 'short' });
        var year = date.getFullYear();
        return day + ' ' + month.toUpperCase() + ' ' + year;
    }
    // Add new row
    $(document).on('click', '.add_period', function() {
        // $(this).hide();
        // $(this).closest('.input-group').find('.remove_period').attr("style", "display:block");
        generateRow();
    });

    // Remove current row
    $(document).on('click', '.group_remove_main_cat_sub_btn', function() {
        $(this).closest('.row.form-group.mb-3').remove();
    });

});


