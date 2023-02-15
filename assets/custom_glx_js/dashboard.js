var exp_data,dir_data;
jQuery.getJSON(site_url+"dashboard/get_chart_data", function(json) {
    exp_data =json['budget'];
    dir_data =json['direct'];

    console.log(exp_data);
    console.log(dir_data);

});


$('#prof_change').on('click', function (event) {
    var employee_id = $('#prof_change').data('employee_id');
    var modal = $(this);
    $.ajax({
        url : site_url+"/employees/read_employee/",
        type: "GET",
        data: 'jd=1&is_ajax=1&mode=modal&data=employee&employee_id='+employee_id,
        success: function (response) {
            if(response) {
                $("#ajax_modal").html(response);
            }
        }
    });
});
$(document).ready(function() {


    //$(".select2down").select2();
    Highcharts.chart('container_chart', {
        chart: {
            type: 'column'
        },
        title: {
            text: ''
        },
        subtitle: {
            text: ''
        },
        xAxis: {
            categories: [
                'Jan',
                'Feb',
                'Mar',
                'Apr',
                'May',
                'Jun',
                'Jul',
                'Aug',
                'Sep',
                'Oct',
                'Nov',
                'Dec'
            ],
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Expenses (AED)'
            },
            labels: {
                formatter: function () {
                    return this.value / 1000 + 'k';
                }
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>{point.y:.1f} AED</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Budget Expenses',
            data: [parseFloat(exp_data[1]),parseFloat(exp_data[2]),parseFloat(exp_data[3]),parseFloat(exp_data[4]),parseFloat(exp_data[5]),parseFloat(exp_data[6]),parseFloat(exp_data[7]),parseFloat(exp_data[8]),parseFloat(exp_data[9]),parseFloat(exp_data[10]),parseFloat(exp_data[11]),parseFloat(exp_data[12])]
        }, {
            name: 'Direct Expenses',
            data: [parseFloat(dir_data[1]),parseFloat(dir_data[2]),parseFloat(dir_data[3]),parseFloat(dir_data[4]),parseFloat(dir_data[5]),parseFloat(dir_data[6]),parseFloat(dir_data[7]),parseFloat(dir_data[8]),parseFloat(dir_data[9]),parseFloat(dir_data[10]),parseFloat(dir_data[11]),parseFloat(dir_data[12])]
        }, ]
    });


});