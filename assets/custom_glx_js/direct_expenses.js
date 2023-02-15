





var minDate, maxDate;





$(document).ready(function() {
    function cbDropdown(column) {
        return $('<ul>', {
            'class': 'cb-dropdown'
        }).appendTo($('<div>', {
            'class': 'cb-dropdown-wrap'
        }).appendTo(column));
    }

    var tbl_direct_exp = $('#direct_exp_table').DataTable({
        processing: true,
        searching:true,
        bDestroy: true,
        paging: true,
        serverSide :false,
        bProcessing: true,
        dom: 'lBfrtip',
        buttons: [
            {
                text: '<i class="fas fa-file-pdf"></i>Export',
                extend: 'pdf',
                split: ['excel', 'csv', 'copy', 'print'],
                className:'nav-link btn btn-sm btn-color-muted btn-active btn-active-dark active fw-bolder px-4 me-1'
            }
        ],
        columnDefs: [
            {
                target: 9,
                visible: false,
            },
            {
                target: 8,
                visible: false,
            },
            // {
            //     target: 10,
            //     orderable: false,
            // }
        ],
        lengthChange: true,
        "ajax": {
            url : site_url+"/budgeting/direct_expense_list/",
            type : 'GET'
        },
        //previous function for sorting with select option
        // initComplete: function() {
        //     this.api().columns().every(function() {
        //         var column = this;
        //
        //             var ddmenu = cbDropdown($(column.header()))
        //             .on('change', ':checkbox', function () {
        //                 var active;
        //                 var vals = $(':checked', ddmenu).map(function (index, element) {
        //                     active = true;
        //                     return $.fn.dataTable.util.escapeRegex($(element).val());
        //                 }).toArray().join('|');
        //
        //                 column
        //                     .search(vals.length > 0 ? '^(' + vals + ')$' : '', true, false)
        //                     .draw();
        //
        //                 // Highlight the current item if selected.
        //                 if (this.checked) {
        //                     $(this).closest('li').addClass('active');
        //                 } else {
        //                     $(this).closest('li').removeClass('active');
        //                 }
        //
        //                 // Highlight the current filter if selected.
        //                 var active2 = ddmenu.parent().is('.active');
        //                 if (active && !active2) {
        //                     ddmenu.parent().addClass('active');
        //                 } else if (!active && active2) {
        //                     ddmenu.parent().removeClass('active');
        //                 }
        //             });
        //
        //         column.data().unique().sort().each(function(d, j) {
        //             var // wrapped
        //                 $label = $('<label>'),
        //                 $text = $('<span>', {
        //                     text: d
        //                 }),
        //                 $cb = $('<input>', {
        //                     type: 'checkbox',
        //                     value: d
        //                 });
        //
        //             $text.appendTo($label);
        //             $cb.appendTo($label);
        //
        //             ddmenu.append($('<li>').append($label));
        //         });
        //     });
        // }
        /* dropdown foreach column
        initComplete: function () {
            this.api()
                .columns()
                .every(function () {
                    var column = this;
                    var select = $('<select ><option value=""></option></select>')
                        .appendTo($('#filter_area_'+column.index()))
                        .on('change', function () {
                            var val = $.fn.dataTable.util.escapeRegex($(this).val());

                            column.search(val ? '^' + val + '$' : '', true, false).draw();
                        });

                    column
                        .data()
                        .unique()
                        .sort()
                        .each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                        });
                });
        },*/
    });
    minDate = new Date(moment().startOf('year').format('YYYY-MM-DD'));
    maxDate = new Date(moment().format('YYYY-MM-DD'));
    tbl_direct_exp.draw();
    $(".sorting_disabled:last").hide();

    tbl_direct_exp.buttons().container().appendTo("#export_div");
    $('#clear_filter').on('click',function(){

        tbl_direct_exp.ajax.reload();
    });
    $('#employee_filter').on('change', function () {
        var user_name = $('#user_name').val();
        if (this.value == user_name) {

            tbl_direct_exp.column(9).search('').draw();

            tbl_direct_exp.column(8).search(user_name).draw();
        }if (this.value == "direct") {
            tbl_direct_exp.column(8).search('').draw();

            tbl_direct_exp.column(9).search(1).draw();
        }if (this.value == "budget") {
            tbl_direct_exp.column(8).search('').draw();

            tbl_direct_exp.column(9).search(0).draw();
        } if (this.value == "all") {
            tbl_direct_exp.column(8).search('').draw();

            tbl_direct_exp.column(9).search('').draw();
        }    } );

     $( document ).on( "click", "#edit_exp", function() {

        $('input[name=_token]').val($(this).data('exp_id'));
        var button = $(event.relatedTarget);
        var exp_id = $('input[name=_token]').val();
        var modal = $(this);
    $.ajax({
        url : site_url+"/budgeting/edit_direct_expense/",
        type: "GET",
        data: 'jd=1&is_ajax=1&mode=modal&data=direct_exp&exp_id='+exp_id,
        success: function (response) {
            if(response) {
                $("#ajax_modal_view").html(response);
                $('#view-modal-data').modal('show');
            }
        }
        });

	});


    $("#add_direct_expense_form").submit(function (e) {

        var fd = new FormData(this);
        var obj = $(this), action = obj.attr('name');
        fd.append("is_ajax", 1);
        fd.append("add_type", 'add_direct_expense');
        fd.append("form", action);
        e.preventDefault();
        $('.save').prop('disabled', true);

        $.ajax({
            url: site_url + '/budgeting/add_direct_expense/',//e.target.action,
            type: "POST",
            data: fd,
            contentType: false,
            cache: false,
            processData: false,

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
            },
            error: function () {
                toastr.error(JSON.error);
                $('.save').prop('disabled', false);
            }
        });
    });
    $(document).on("click", "#delete_button", function () {

        $('input[name=_token]').val($(this).data('record-id'));
        $('input[name=token_type]').val($(this).data('token_type'));
        $('#delete_record').attr('action', site_url + 'budgeting/delete_expense/' + $(this).data('record-id')) + '/';
    });


    /* Delete data */
    $("#delete_record").submit(function (e) {

        var expense_id = $('input[name=_token]').val();
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: site_url + "/budgeting/delete_expense/",
            data: "is_ajax=2&expense_id=" + expense_id,
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
            },
            error: function () {
                toastr.error(JSON.error);
                $('.save').prop('disabled', false);
            }
        });

    });

    $(function() {

        var start = moment().startOf('year');
        var end = moment();
        function cb(start, end) {
            $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
        }



        $('#reportrange').daterangepicker({

            startDate: start,
            endDate: end,
            ranges: {
                'Today': [moment(), moment()],
                'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                'This Month': [moment().startOf('month'), moment().endOf('month')],
                'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                'This Year':[moment().startOf('year'), moment().endOf('year')],
            }
        }, cb);


        cb(start, end);

    });
    // Custom filtering function which will search data in column four between two values
    $('#reportrange').on('apply.daterangepicker', function(ev, picker) {
        minDate = new Date(picker.startDate.format('YYYY-MM-DD'));
        maxDate = new Date(picker.endDate.format('YYYY-MM-DD'));
        tbl_direct_exp.draw();

    });

    $(".dataTables_filter").css("display", "none");

    $('#filter_exp').keyup(function(){
        tbl_direct_exp.search($(this).val()).draw() ;
    });
    $.fn.dataTableExt.afnFiltering.push(
        function(oSettings, aData, iDataIndex) {
            if (typeof aData._date == 'undefined') {
                aData._date = new Date(aData[1]).getTime();
            }

            if (minDate && !isNaN(minDate)) {
                if (aData._date < minDate) {
                    return false;
                }
            }

            if (maxDate && !isNaN(maxDate)) {
                if (aData._date > maxDate) {
                    return false;
                }
            }

            return true;
        }
    );
    $(document).on("click", "#add_supplier", function () {
        $('#add_supplier_div').show();
        $('#select_supp_div').hide();

    });
    $(document).on("click", ".supplier_close_btn", function () {
        $('#add_supplier_div').hide();
        $('#select_supp_div').show();

    });
    function load_supplier_data(){
        $.get(site_url+"/budgeting/supplier_list_dropdown/", function(data, status){
           $('#supplier_dropdown').html(data);
        });
    }

    $(document).on("click", "#save_supplier", function () {
        var name = $('#sup_name').val();
        var ref_no = $('#sup_ref_no').val();

        $.ajax({
            type: "POST",
            url: site_url + "/settings/add_supplier/",
            data: "&is_ajax=28&data=add_supplier&type=add_supplier&name=" + name + "&ref_no=" + ref_no,
            cache: false,
            success: function (JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                } else {

                    toastr.success(JSON.result);
                    $('#add_supplier_div').hide();
                    $('#select_supp_div').show();
                    load_supplier_data();

                }
            },
        });
    });
    // $( document ).on( "click", "#sync_expense", function() {
    //     jQuery.getJSON(site_url+"sap_api/post_purchase_order", function(data1, status) {
    //         if(data1.result=="true"){
    //             tbl_direct_exp.ajax.reload(function(){
    //                 toastr.success('Synchronization Completed!');
    //             }, true);
    //         }
    //     });
    // });
    $(document).on("click", "#sync_button", function () {

        $('input[name=_token]').val($(this).data('record-id'));
        $('input[name=token_type]').val($(this).data('token_type'));
        $('#request_action').attr("action", site_url + "sap_api/post_purchase_order" + $(this).data('record-id')) + "/";
    });


    /* Delete data */
    $("#request_action").submit(function (e) {

        var expense_id = $('input[name=_token]').val();
        e.preventDefault();

        $.ajax({
            type: "POST",
            url: site_url + "sap_api/post_purchase_order",
            data: "is_ajax=2&exp_id=" + expense_id,
            cache: false,

            success: function (JSON) {
                if (JSON.error != '') {
                    toastr.error(JSON.error);
                    $('.save').prop('disabled', false);
                } else {
                    tbl_direct_exp.ajax.reload(function(){
                        toastr.success('Synchronization Completed!');
                    }, true);

                }
                $(".approve-modal").modal("toggle");
            },

        });

    });
});
