<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url()?>skin/js/css_extra/themify-icons.css"> -->
<!-- <link rel="stylesheet" type="application/font-woff" href="<?php //echo base_url()?>skin/js/css_extra/themify.woff">
 --><!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url()?>skin/js/css_extra/radial.css" type="text/css" media="all"> -->
 <!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url()?>skin/js/css_extra/style.css"> -->

<!--<link rel="stylesheet" type="text/css" href="<?php //echo base_url()?>skin/js/css_extra/bootstrap.min.css">-->
<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>skin/css/highcharts.css">
<link rel="stylesheet" href="<?php echo base_url();?>skin/css/core.css">
<link rel="stylesheet" href="<?php echo base_url();?>skin/css/daterangepicker-bs3.css"></script>

<?php
$session = $this->session->userdata('username');
$quotation = $this->Reports_model->get_first_last($session['user_id']);
$first_date=date_create($quotation[0]->first);
$last_date=date_create(date("Y-m-d"));
$diff=date_diff($first_date,$last_date);

$setting = $this->Xin_model->read_setting_info(1);
$default_currency_symbol = explode('-',$setting[0]->default_currency_symbol);
$default_currency_symbol = $default_currency_symbol[1];
?>
<!--
<div class="theme-loader">
<div class="loader-track">
<div class="loader-bar"></div>
</div>
</div>
-->

<div class="main-body">
 <div class="page-wrapper">
   <div class="page-body">
      <div class="row">
              
        <div class="search-box">
          <div class="col-md-6 col-xl-7">
            <form method="get" action="<?php echo site_url('search'); ?>" id="xmain_search_form" name="main_search_form">
              <div class="input-group">
                <input type="text" class="form-control keywordsautocomplete" placeholder="Search here..." name="q" autocomplete="off">
                <div class="input-group-btn">
                  <button type="submit" class="btn btn-primary">Go</button>
                </div>
              </div>
            </form>
          </div>

          <div class="col-md-6 col-xl-5">
             <div class="reportrange-m">
                <div id="reportrange" class="rr-left">
                  <i class="fa fa-calendar"></i>&nbsp;</input><i class="fa fa-caret-down"></i><span></span>
                  <input type="hidden" id="pickdate"><input type="hidden" name="employee" id="employee" value="<?php echo$session['user_id']; ?>"/>
                </div>
                <div class="rr-right"><button class="btn btn-primary" onclick="search()">Search</button></div>
            </div>
          </div>
        </div>

      </div>
        
        <div class="row">
          <div class="top-card-buttons"> 
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
              <div class="card">
                  <div class="card-block card-1">
                      <i class="ti-layers-alt card-large-icon"></i>
                      <h5 class="m-t-10"><span class="text-c-blue"></span>SALES QUOTATIONS</h5>
                      <p class="m-b-5"><span id="quote"></span></p>
                      <a href="<?php echo site_url('quote/create_quote')?>"><button class="btn btn-sm"><i class="fa fa-plus icon"></i>Add New</button></a>
                      <a><button id="qoutation_btn" class="btn btn-sm">View List</button></a>
                  </div>
              </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                <div class="card">
                    <div class="card-block card-1">
                        <i class="ti-shopping-cart card-large-icon"></i>
                        <h5 class="m-t-10"><span></span>SALES INVOICES</h5>
                        <p class="m-b-5"><span id="invoice"></span></p>
                        <a href="<?php echo site_url('invoices/create_invoice')?>"><button class="btn btn-sm"><i class="fa fa-plus icon"></i>Add New</button></a>
                        <a><button id="invoice_btn" class="btn btn-sm">View List</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                <div class="card">
                    <div class="card-block card-1">
                        <i class="fa fa-users card-large-icon"></i>
                        <h5 class="m-t-10"><span></span>CUSTOMERS</h5>
                        <p class="m-b-5"><span id="customer2"></span></p>
                        <a href="<?php echo site_url('customers')?>"><button class="btn btn-sm"><i class="fa fa-plus icon"></i>Add New</button></a>
                        <a><button id="customer_btn" class="btn btn-sm">View List</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                <div class="card">
                    <div class="card-block card-1">
                        <i class="ti-credit-card card-large-icon"></i>
                        <h5 class="m-t-10"><span></span>PROFORMA INVOICES</h5>
                        <p class="m-b-5"><span id="proforma"></span></p>
                        <a href="<?php echo site_url('proforma_invoices/create_invoice')?>"><button class="btn btn-sm"><i class="fa fa-plus icon"></i>Add New</button></a>
                        <a><button id="proformainvoice_btn" class="btn btn-sm">View List</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                <div class="card">
                    <div class="card-block card-1">
                        <i class="fa fa-cubes card-large-icon"></i>
                        <h5 class="m-t-10"><span ></span>PURCHASE ORDERS</h5>
                        <p class="m-b-5"><span id="purchase"></span></p>
                        <a href="<?php echo site_url('purchase_order/create_purchase_order')?>"><button class="btn btn-sm"><i class="fa fa-plus icon"></i>Add New</button></a>
                        <a><button id="purchase_btn" class="btn btn-sm">View List</button></a>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-2">
                <div class="card">
                    <div class="card-block card-1">
                        <i class="fa fa-map-o card-large-icon"></i>
                        <h5 class="m-t-10"><span></span>DELIVERY NOTE</h5>
                        <p class="m-b-5"><span id="delivery2"></span></p>
                        <a href="<?php echo site_url('delivery_note/create_delivery_note')?>"><button class="btn btn-sm"><i class="fa fa-plus icon"></i>Add New</button></a>
                        <a><button id="delivery_btn" class="btn btn-sm">View List</button></a>
                    </div>
                </div>
            </div>        
          </div>
    <div class="col-lg-12 col-md-12" id="report_table" style="display:none">   
           <div class="box box-block bg-white">
              <h2 id="table_heading"></h2>
              <div class="table-responsive" data-pattern="priority-columns">
                <table class="table table-striped table-bordered dataTable" id="xin_table_reports" style="width:100%;">
                  <thead>
                    <tr>
                      <th id="th_heading"></th>
                      <th id="th_heading2">Amount</th>
                      <th id="th_heading3">Customer</th>
                      <th id="th_heading4">Date</th>
                      <th id="th_heading5">Expiry Date</th>
                      <th id="th_heading6">Reference #</th>
                      <th id="th_heading7">Added By</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                </table>
             </div>
           </div>
        </div>
        
        <div class="col-lg-12 col-md-12" id="report_delivery_table" style="display:none">   
           <div class="box box-block bg-white">
              <h2 id="table_heading" style="color:#3e70c9"><b>List All Delivery Notes</b></h2>
              <div class="table-responsive" data-pattern="priority-columns">
                <table class="table table-striped table-bordered dataTable" id="xin_table_delivery" style="width:100%;">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Customer</th>
                      <th>Date</th>
                      <th>Reference #</th>
                      <th>Added By</th>
                      <th>Status</th>
                    </tr>
                  </thead>
                </table>
             </div>
           </div>
        </div>
        
        <div class="col-lg-12 col-md-12" id="report_customer_table" style="display:none">   
          <div class="box box-block bg-white">
           <h2 id="table_heading" style="color:#3aa25a"><b>List All Customers</b></h2>
           <div class="table-responsive" data-pattern="priority-columns">
            <table class="table table-striped table-bordered dataTable" id="xin_table_customer" style="width:100%;">
              <thead>
                <tr>
                <tr>
                  <th>#</th>
                  <th>Company Name</th>
                  <th>Address</th>
                  <th>Contact Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>TRN</th>
                  <th>Added By</th>
                </tr>
                </tr>
              </thead>
            </table>
           </div>
          </div>
        </div>
        
     </div>     
  
<div class="row">
  <div class="col-lg-12">
    <div class="row">
      <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h5>Total Sales</h5>
          <div class="card-header-right"></div>
        </div>
        <div class="card-block">
          <div id="sales" style="width:100%; height:400px;"></div>
        </div>
      </div>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    var myChart = Highcharts.chart('sales', {

    chart: {
        styledMode: true
    },

    title: {
        text: 'Total Sales Amount<br><strong>AED6,300</strong>'
    },

    xAxis: {
        categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
    },

    series: [{
        type: 'pie',
        allowPointSelect: true,
        keys: ['name', 'y', 'selected', 'sliced'],
        data: [
            ['Apples', 29.9, false],
            ['Pears', 71.5, false],
            ['Oranges', 106.4, false],
            ['Plums', 129.2, false],
            ['Bananas', 144.0, false],
            ['Peaches', 176.0, false],
            ['Prunes', 135.6, true, true],
            ['Avocados', 148.5, false]
        ],
        showInLegend: true
    }]
});
});
</script>
      </div>

      <div class="col-md-4">
      <div class="card">
        <div class="card-header">
          <h5>Total Customers</h5>
          <div class="card-header-right"></div>
        </div>
        <div class="card-block">
          <div id="customers" style="width:100%; height:400px;"></div>
        </div>
      </div>
<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    var myChart = Highcharts.chart('customers', {
        chart: {
            type: 'bar'
        },
        title: {
            text: 'Total Customers'
        },
        xAxis: {
            categories: ['Approved', 'Pending', 'Draft']
        },
        yAxis: {
            title: {
                text: 'Total Sales Amount'
            }
        },
        series: [{
            name: 'SALES',
            data: [1, 2, 4]
        }, {
            name: 'PROFORMA',
            data: [5, 7, 3]
        }]
    });
});
</script>
      </div>

      <div class="col-lg-4">
        <div class="card">
          <div class="card-header">
            <h5>Most Selling Products</h5>
            <div class="card-header-right"></div>
          </div>
          <div class="card-block">
            <div id="m-product" style="min-width: 310px; height: 400px; margin: 0 auto">
              <ul class="list-group">
                <li class="list-group-item">Product-1 <span>AED1400</span></li>
                <li class="list-group-item">Product-2 <span>AED800</span></li>
              </ul>
            </div>
          </div>
        </div>
      </div>

    </div>
  </div>
</div>     
<div class="row">     
  <div class="col-lg-8 col-md-12">
    <div class="card">
      <div class="card-header">
        <h5>Statistics</h5>
        <div class="card-header-right"> </div>
      </div>
      <div class="card-block">
        <div id="container" style="height:210px"></div>
      </div>
    </div>
  </div>
  <div class="col-lg-4 col-md-12">
    <div class="row">
      <div class="col-xl-12 col-lg-12 col-md-12">
        <div class="card statustic-card">
          <div class="card-header">
            <h5>Recent Activities</h5>
          </div>
          <div class="card-block">
            <div class="timeline">
              <div class="timeline-item">
                <div>
                    <figure class="avatar avatar-sm m-r-15 bring-forward">
                        <span class="avatar-title bg-primary-bright text-primary rounded-circle">
                            <i class="fa fa-clock-o"></i>
                        </span>
                    </figure>
                </div>
                <div>
                    <p class="m-b-5"><strong>Louise</strong> added a time entry to the ticket <strong>Sales
                        Revenue</strong></p>
                    <small class="text-muted">
                        <i class="fa fa-clock-o m-r-5"></i> 5 hours ago
                    </small>
                </div>
              </div>
              <div class="timeline-item">
                  <div>
                      <figure class="avatar avatar-sm m-r-15 bring-forward">
                              <span class="avatar-title bg-info-bright text-info rounded-circle">
                                  <i class="fa fa-clock-o"></i>
                              </span>
                      </figure>
                  </div>
                  <div>
                      <p class="m-b-5"><strong>Kevin added</strong> new attachment to the ticket <strong>Software
                          Bug Reporting</strong></p>
                      <small class="text-muted">
                          <i class="fa fa-clock-o m-r-5"></i> 8 hours ago
                      </small>
                  </div>
              </div>
              <div class="timeline-item">
                  <div>
                      <figure class="avatar avatar-sm m-r-15 bring-forward">
                              <span class="avatar-title bg-info-bright text-info rounded-circle">
                                  <i class="fa fa-clock-o"></i>
                              </span>
                      </figure>
                  </div>
                  <div>
                      <p class="m-b-5"><strong>Katherine </strong> changed settings to ticket category <strong>Payment & Invoice</strong></p>
                      <small class="text-muted">
                          <i class="fa fa-clock-o m-r-5"></i> 8 hours ago
                      </small>
                  </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>  
    
    
    
<!--                <div class="col-lg-6 col-md-6"><div class="card" style="border-radius: 10px;">
                    <div class="card-header">
                        <h5>Sales by Staff</h5>
                    </div>
                    <div id="salesbystaff"></div>
                  </div>
                </div>-->
        
 
    <!--    <div class="col-md-12 col-lg-12">
            <div class="card"  style="border-radius: 8px;">
                 <div class="card-header">
                <h5>No of Sales per month</h5>
                 <div class="card-header-right">
                 </div>
               </div>
                <div class="card-block text-center">
                    <div id="container1" style="width: 100%; height: 300px"></div>
                </div>
            </div>
        </div>-->
        
        
        
      
    </div>
  </div>
</div>
<br>


<script type="text/javascript" src="<?php echo base_url()?>skin/js/js_extra/jquery.min.js "></script>

<?php
$query=$this->db->query("select count(*) rowcount from corbuz_effects_view_details where root_id='".$session['root_id']."' and user_id='".$session['user_id']."' and name='fireworks'");
$qresults = $query->result();
$totalData = $qresults[0]->rowcount;
if($totalData==0){
    $this->db->query("INSERT INTO `corbuz_effects_view_details`(`name`, `root_id`, `user_id`, `date`) VALUES ('fireworks','".$session['root_id']."','".$session['user_id']."','".date('Y-m-d H:i:s')."')")
?>
<script type="text/javascript" src="<?php echo base_url()?>skin/js/effects/jquery.fireworks.js"></script>
<script>
$('.main-body').fireworks({ sound: false, opacity: 0.5, width: '100%', height: '100%' });
$(document).ready(function(){
    setTimeout( function(){ 
        $('#fireworksField').remove();
        console.log('dddonnnne');
    },10000 );
});
</script>
<?php
}
?>

<script type="text/javascript" src="<?php echo base_url()?>skin/js/js_extra/script.js "></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/loader.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/highchart.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/exporting.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/daterangepicker.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/Chart.js"></script>
<script>
    var diff=<?php echo $diff->days;?> ;
    var default_currency_symbol='<?php echo $default_currency_symbol;?>';
    var site_url='<?php echo site_url();?>';
    
            //var start = moment().subtract(diff, 'days');
            //var end = moment();
            //var start = moment().startOf('month');
            //var end = moment().endOf('month');
            
            var start = moment().subtract(29, 'days');
            var end = moment();
            
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#pickdate ').val(start.format('DD-MM-Y')+'/'+ end.format('DD-MM-Y'));
            }
            
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                   'All': [moment().subtract(diff, 'days'), moment()],
                   'Today': [moment(), moment()],
                   'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                   'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                   'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                   'This Month': [moment().startOf('month'), moment().endOf('month')],
                   'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')],
                   'This Year': [moment().startOf('year'), moment().endOf('year')],
                   'Last Year': [moment().subtract(1, 'year').startOf('year'), moment().subtract(1, 'year').endOf('year')]
                   
                }
            }, cb);
            
            cb(start, end);
    
</script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_module/reports.js"></script>