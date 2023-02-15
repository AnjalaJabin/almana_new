<link rel="icon" href="<?php echo base_url()?>skin/js/pic/favicon.ico" type="image/x-icon">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>skin/js/css_extra/themify-icons.css">
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>skin/js/css_extra/radial.css" type="text/css" media="all">
<!-- <link rel="stylesheet" type="text/css" href="<?php //echo base_url()?>skin/js/css_extra/style.css"> -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url()?>skin/js/css_extra/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>skin/vendor/bootstrap/css/bootstrap.min.css">
<link rel="stylesheet" href="<?php echo base_url();?>skin/css/core.css">
<link rel="stylesheet" href="<?php echo base_url();?>skin/css/daterangepicker-bs3.css"></script>
<system.webServer>
<staticContent>
  <mimeMap fileExtension=".woff" mimeType="<?php echo base_url()?>skin/js/css_extra/themify.woff"/>
</staticContent>
</system.webServer>
<style>

.nav-tabs .nav-item.open .nav-link, .nav-tabs .nav-item.open .nav-link:focus, .nav-tabs .nav-item.open .nav-link:hover, .nav-tabs .nav-link.active, .nav-tabs .nav-link.active:focus, .nav-tabs .nav-link.active:hover
{
    color: #55595c;
    background-color: whitesmoke;
    border-color: #ddd #ddd transparent;   
}


</style>
<?php
$session = $this->session->userdata('username');
$quotation = $this->Reports_model->get_first_last($session['user_id']);
$first_date=date_create($quotation[0]->first);
$last_date=date_create(date("Y-m-d"));
$diff=date_diff($first_date,$last_date);
$user_id = $session['user_id'];

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

     
    <div class="row">
      <div class="col-md-6 col-xl-3">
       <a href="<?php echo site_url('quote');?>">
        <div class="card bg-c-blue order-card" style="border-radius: 14px;">
          <div class="card-block">
            <h6 class="m-b-20" style="font-size: 14px;">TOTAL QUOTATIONS</h6>
            <h2 class="text-right"><i class="ti-wallet f-left"></i><span><?php echo $this->Dashboard_model->get_all_quotes_count();?></span></h2>
             <b><p class="m-b-0">This Month - <span style="font-size:16px"><?php echo $this->Dashboard_model->get_month_quotes_count();?></span></p></b>
           </div>
        </div>
        </a>
      </div>
         <div class="col-md-6 col-xl-3">
         <a href="<?php echo site_url('invoices');?>">
          <div class="card bg-c-green order-card" style="border-radius: 14px;">
           <div class="card-block">
            <h6 class="m-b-20" style="font-size: 14px;">TOTAL INVOICES</h6>
            <h2 class="text-right"><i class="ti-tag f-left"></i><span><?php echo $this->Dashboard_model->get_all_invoices_count();?></span></h2>
            <b><p class="m-b-0">This Month - <span style="font-size:16px"><?php echo $this->Dashboard_model->get_month_invoices_count();?></span></p></b>
           </div>
          </div>
          </a>
         </div>
         <div class="col-md-6 col-xl-3">
          <a href="<?php echo site_url('products');?>">
          <div class="card bg-c-yellow order-card" style="border-radius: 14px;">
           <div class="card-block">
            <h6 class="m-b-20" style="font-size: 14px;">TOTAL PRODUCTS</h6>
            <h2 class="text-right"><i class="ti-shopping-cart-full f-left"></i><span><?php echo $this->Dashboard_model->get_all_products_count();?></span></h2>
             <b><p class="m-b-0">This Month - <span style="font-size:16px"><?php echo $this->Dashboard_model->get_month_products_count();?></span></p></b>
           </div>
          </div>
          </a>
         </div>
         <div class="col-md-6 col-xl-3">
          <a href="<?php echo site_url('customers');?>">
          <div class="card bg-c-pink order-card" style="border-radius: 14px;">
           <div class="card-block">
            <h6 class="m-b-20" style="font-size: 14px;">TOTAL CUSTOMERS</h6>
            <h2 class="text-right"><i class="ti-user f-left"></i><span><?php echo $this->Dashboard_model->get_all_customers_count();?></span></h2>
             <b><p class="m-b-0">This Month - <span style="font-size:16px"><?php echo $this->Dashboard_model->get_month_customers_count();?></span></p></b>
           </div>
          </div>
          </a>
         </div>
         
        
        
         
         <div class="col-md-12 col-lg-12">
             <div class="box box-block bg-white" align="center">
          
               <a class="pull-center" href="<?php echo site_url('quote/create_quote')?>"><button class="btn btn-info btn-sm btn-round" style="font-size: 16px;font-family: inherit;padding-left:20px;padding-right:20px;"><i class="fa fa-plus icon"></i>Create Quote</button></a>
               <a class="pull-center" href="<?php echo site_url('invoices/create_invoice')?>"><button class="btn btn-warning btn-sm btn-round" style="font-size: 16px;font-family: inherit;padding-left:20px;padding-right:20px;"><i class="fa fa-plus icon"></i>Create Invoice</button></a>
               <a class="pull-center" href="<?php echo site_url('price')?>"><button class="btn btn-success btn-sm btn-round" style="font-size: 16px;font-family: inherit;padding-left:20px;padding-right:20px;"><i class="fa fa-search"></i>Search Price</button></a>
               <a class="pull-center" href="<?php echo site_url('purchase_order/create_purchase_order')?>"><button class="btn btn-primary btn-sm btn-round" style="font-size: 16px;font-family: inherit;padding-left:20px;padding-right:20px;"><i class="fa fa-plus icon"></i>Create Purchase Order</button></a>
               <a class="pull-center" href="<?php echo site_url('delivery_note/create_delivery_note')?>"><button class="btn btn-danger btn-sm btn-round" style="font-size: 16px;font-family: inherit;padding-left:20px;padding-right:20px;"><i class="fa fa-plus icon"></i>Create Delivery Note</button></a>
               
          
         </div>
        </div>
        
        <div class="row col-md-12">
            <div class="col-md-7">
                
                <form method="get" action="<?php echo site_url('search'); ?>" id="xmain_search_form" name="main_search_form">
                  <div class="input-group">
                    <input type="text" class="form-control keywordsautocomplete" placeholder="Search here..." name="q" autocomplete="off">
                    <div class="input-group-btn">
                      <button type="submit" class="btn btn-success">Go</button>
                    </div>
                  </div>
                </form>
                
            </div>
            <div class="col-md-4">
                <div id="reportrange" style="background: #fff; cursor: pointer; padding: 5px 10px; border: 1px solid #ccc; width: 90%;">
                  <i class="fa fa-calendar"></i>&nbsp;</input><i class="fa fa-caret-down"></i>
                  <span ></span>
                  <input type="hidden" id="pickdate">
                </div>
            </div>
            <div class="col-md-1">
                <button class="label label-primary" onclick="search()" style="font-size: 17px;">Search</button>
            </div><br><br>
        </div>
        
        
        <div class="col-md-12" id="main_search_result_area" style="display:none;">
            <div class="box box-block bg-white" id="main_search_result_area_box">
            </div>
        </div>
         
         

         <div class="col-lg-8 col-md-12">
          <div class="card" style="border-radius: 8px;">
           <div class="card-header">
            <h5>Statistics</h5>
             <div class="card-header-right">
             </div>
           </div>
           <div class="card-block">
            <div id="container" style="height:210px"></div>
           </div>
          </div>
         </div>
 
         <div class="col-lg-4 col-md-12"><div class="card" style="border-radius: 8px;">
                <div class="card-header">
                <h5>No of Sales per month</h5>
                 <div class="card-header-right">
                 </div>
               </div>
                <div class="card-block text-center">
                    <div id="containerss" style="width: 100%; height: 210px"></div>
                </div>
            </div>
          </div>

         <div class="col-md-3 col-xl-3">
          <div class="card seo-card" style="border-radius: 8px;">
              <div class="card-header">
              <h5 style="font-size: 16px;">Most Selling Products</h5>
              <span id="products"></span>
             </div>
             <div id="ss2" style="width:250px; height: 300px; margin: 0 auto"></div>
            <!--<div class="card-block seo-statustic">
             <i class="ti-server text-c-green"></i>
             <h5>65%</h5>
             <p>Memory</p>
            </div>
           <div class="seo-chart">
            <canvas id="seo-card1"></canvas>
           </div>-->
          </div>
         </div>
         
        <div class="col-md-3 col-xl-3">
         <div class="card seo-card" style="border-radius: 8px;">
          <div class="card-header">
          <h5 style="font-size: 16px;">Most Selling Brands</h5>
          <span id="brand"></span>
          </div>
          <div id="ss" style="width:250px; height: 300px; margin: 0 auto"></div>
          <!--<div class="card-block seo-statustic">
           <i class="ti-reload text-c-blue"></i>
           <h5>$46,845</h5>
           <p>Revenue</p>
          </div>
          <div class="seo-chart">
          <canvas id="seo-card2"></canvas>
          </div>-->
         </div>
        </div>
        
        
        
        
        <div class="col-xl-3 col-md-3">
         <div class="row">
          <div class="col-xl-12 col-md-6">
           <div class="card statustic-card" style="border-radius: 8px;">
            <div class="card-header" style="margin-top: 5px;">
             <h5 style="margin-left: 60px;">TOTAL SALES</h5>
            </div>
           <div class="card-block text-center" >
            <span class="d-block text-c-green f-36" id="sale" style="font-size:25px"></span>
            <p class="m-b-0" style="margin-top: 13px;"></p>
           <div class="progress">
            <div class="progress-bar bg-c-green" style="width:14%"></div>
           </div>
          </div>
          <div class="card-footer bg-c-green">
           <h6 class="text-white m-b-0" style="margin-top: 6px;">Total sales amount in <?php echo $default_currency_symbol; ?></h6>
          </div>
         </div>
        </div>
        <div class="col-xl-12 col-md-6">
          <div class="card statustic-card" style="border-radius: 8px;">
           <div class="card-header" style="margin-top: 5px;">
            <h5 style="margin-left: 65px;">TOTAL TAX</h5>
           </div>
           <div class="card-block text-center" >
            <span class="d-block text-c-pink f-36" id="tax" style="font-size:25px"></span>
             <p class="m-b-0" style="margin-top: 13px;"></p>
             <div class="progress">
              <div class="progress-bar bg-c-pink" style="width:85%"></div>
             </div>
           </div>
           <div class="card-footer bg-c-pink">
            <h6 class="text-white m-b-0" style="margin-top: 6px;">Total tax amount in <?php echo $default_currency_symbol; ?></h6>
           </div>
           </div>
          </div>
         </div>
        </div>
        
        <div class="col-xl-3 col-md-3">
         <div class="row">
          <div class="col-xl-12 col-md-6">
            <div class="card statustic-card" style="border-radius: 8px;">
                <div class="tab-pane active" id="home3" role="tabpanel">
                    <div class="table-responsive" style="height: 390px;">
                        <table class="table table-bordered dataTable" style="width:100%;font-size: 15px;">
                          <thead>
                            <tr>
                              <td><b>TYPES</b></td>
                              <td class="label label-danger"><b style="font-size: 20px;"><i class="fa fa-braille"></i></b></td>
                            </tr>
                          </thead>
                          <tbody>
                            <tr><td><b><a style="color: inherit; text-decoration: inherit;" href="<?php echo site_url('quote'); ?>">Quotations</a></b></td><td id="quote" class="label label-primary" style="font-size: 18px;font-family: cursive;"></td></tr>
                            <tr><td><b><a style="color: inherit; text-decoration: inherit;" href="<?php echo site_url('invoices'); ?>">Invoices</a></b></td><td id="invoice" class="label label-success" style="font-size: 18px;font-family: cursive;"></td></tr>
                            <tr><td><b><a style="color: inherit; text-decoration: inherit;" href="<?php echo site_url('proforma_invoices'); ?>">Proforma Invoices</a></b></td><td id="proforma" class="label label-danger" style="font-size: 18px;font-family: cursive;"></td></tr>
                            <tr><td><b><a style="color: inherit; text-decoration: inherit;" href="<?php echo site_url('purchase_order'); ?>">Purchase Orders</a></b></td><td id="purchase" class="label label-warning" style="font-size: 18px;font-family: cursive;"></td></tr>
                            <tr><td><b><a style="color: inherit; text-decoration: inherit;" href="<?php echo site_url('delivery_note'); ?>">Delivery Notes</a></b></td><td id="delivery" class="label label-primary" style="font-size: 18px;font-family: cursive;"></td></tr>
                            <tr><td><b><a style="color: inherit; text-decoration: inherit;" href="<?php echo site_url('price/price_history'); ?>">Price Updates</a></b></td><td id="request" class="label label-success" style="font-size: 18px;font-family: cursive;"></td></tr>
                            <tr><td><b><a style="color: inherit; text-decoration: inherit;" href="<?php echo site_url('products'); ?>">Products</a></b></td><td id="product_sale" class="label label-warning" style="font-size: 18px;font-family: cursive;"></td></tr>
                            <tr><td><b><a style="color: inherit; text-decoration: inherit;" href="<?php echo site_url('customers'); ?>">Customers</a></b></td><td id="customer" class="label label-primary" style="font-size: 18px;font-family: cursive;"></td></tr>
                          </tbody>
                        </table>
                    </div>
                </div>
            </div>
          </div>
         </div>
        </div>
        
         <div class="col-md-12 col-lg-4">
            <div class="card" style="border-radius: 10px;">
                <div class="card-block text-center">
                    <i class="fa fa-money text-c-blue d-block f-40"></i>
                    <h4 class="m-t-20"><span class="text-c-blue">+<?php echo $this->Dashboard_model->get_my_price_requests_count();?></span> Price Requests</h4>
                    <p class="m-b-20">This is your all Price Requests</p>
                    <a class="pull-center" href="<?php echo site_url('price/my_price_requests')?>"><button class="btn btn-primary btn-sm btn-round">Manage List</button></a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card" style="border-radius: 10px;">
                <div class="card-block text-center">
                    <i class="ti-layout-sidebar-2 text-c-green d-block f-40"></i>
                    <h4 class="m-t-20"><span class="text-c-green">+<?php echo $this->Dashboard_model->get_all_suppliers_count();?></span> Suppliers</h4>
                    <p class="m-b-20">Your Suppliers list is growing</p>
                    <a class="pull-center" href="<?php echo site_url('suppliers')?>"><button class="btn btn-success btn-sm btn-round">Check them out</button></a>
                </div>
            </div>
        </div>
        <div class="col-md-6 col-lg-4">
            <div class="card" style="border-radius: 10px;">
                <div class="card-block text-center">
                    <i class="ti-panel text-c-pink d-block f-40"></i>
                    <h4 class="m-t-20"><span class="text-c-pink">+<?php  echo $this->Dashboard_model->get_my_given_price_count();?></span> Given Prices</h4>
                    <p class="m-b-20">This is your all price list</p>
                    <a class="pull-center" href="<?php echo site_url('price/given_price_history')?>"><button class="btn btn-danger btn-sm btn-round">Upgrade Prices</button></a>
                </div>
            </div>
        </div>
        
        <div class="col-md-12 col-lg-12">
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
        </div>
        
      </div>
<br><br>






      

<script type="text/javascript" src="<?php echo base_url()?>skin/js/js_extra/jquery.min.js "></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js/js_extra/script.js "></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/loader.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/highchart.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/exporting.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/Chart.min.js"></script>
<script type="text/javascript" src="<?php echo base_url()?>skin/js_reports/Chart.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>skin/js_reports/moment.min.js"></script>
<script type="text/javascript" src="<?php echo base_url();?>skin/js_reports/daterangepicker.js"></script>



        
            

    <script type="text/javascript">
        $(document).ready(function() {
          //first 
            var datepick=$("#pickdate").val();
            var fields = datepick.split('/');
            var fromdate = fields[0];
            var todate = fields[1];
           // var employee=<?php echo $user_id;?>;
           // var employee=$("#userid").val();
            
         $.get(base_url+"/get_count", 
        	  { fromdate: fromdate,todate:todate}, 
        	  function(data){ 
        	      
        	      var x=JSON.parse(data);
        	      var tx=x[0].total_tax1;
        	      var sl=x[0].gtotal1;
        	      
        	      
        	      if(sl==null)
        	      {
        	         var sale=0;
        	      }
        	      else
        	      {
        	          var s = parseFloat(sl).toFixed(2);
        	          var sale = Number(s).toLocaleString('en');
        	      }
        	      if(tx==null)
        	      {   
        	          var tax=0;
        	          
        	      }
        	      else
        	      {
        	          var s = parseFloat(tx).toFixed(2);
        	          var tax = Number(s).toLocaleString('en');
        	      }
        		  $("#quote").text(x[0].total);
        		  $("#invoice").text(x[0].total1);
        		  $("#proforma").text(x[0].total2);
        		  $("#purchase").text(x[0].total3);
        		  $("#delivery").text(x[0].total6);
        		  $("#sale").text("<?php echo $default_currency_symbol; ?> "+sale);
        		  $("#tax").text("<?php echo $default_currency_symbol; ?> "+tax);
        		  $("#request").text(x[0].total7);
        		  $("#product_sale").text(x[0].product_tot);
        		  $("#customer").text(x[0].total8);
        	      }); 
        	
        $.get(base_url+"/product_brand", 
        	  { fromdate: fromdate,todate:todate}, 
        	  function(data){ 
        	      
        	      var x=JSON.parse(data);
        	      if(x=='')
        	      {
        	      var products=0;
        	      var brand=0;
        	      $("#products").text('');
        		  $("#brand").text('');
        	      }
        	      else
        	      {
        	      var products=x[0].item_name;
        	      var brand=x[0].name;
        	      $("#products").text(products+ "( "+x[0].TotalQuantity+" )");
        		  $("#brand").text(brand+ "( "+x[0].TotalQuantity+" )");
        	      }  
        		  
        	  });
        	  
       
        var options = {
                chart: {
                    renderTo: 'container',
                    type: 'areaspline',
                    marginRight: 130,
                    marginBottom: 25
                },
                title: {
                    text: '',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: []
                },
                yAxis: {
                    title: {
                        text: 'No of Sales'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                credits: {
                  enabled: false
                },
                exporting: { enabled: false },
                 plotOptions: {
                    column: {
                        borderRadius: 5
                    },
                    areaspline: {
                        fillOpacity: 0.5
                    }
                },
                tooltip: {
                    formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y ;
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                
                dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{this.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                }
              },
        
                series: []
             }

            //second 

        var options1 = {
                chart: {
                    renderTo: 'container1',
                    type: 'column',
                    marginRight: 130,
                    marginBottom: 25
                },
                title: {
                    text: '',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: []
                },
                yAxis: {
                    title: {
                        text: 'No of Sales'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                credits: {
                  enabled: false
                },
                exporting: { enabled: false },
                plotOptions: {
                column: {
                borderRadius: 5
                    }
                },
                tooltip: {
                    formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y ;
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                
                dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{this.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                  }
                },
        
                series: []
            }

               //folder/controller/method    
               $.getJSON("<?php echo site_url();?>dashboard/reports/"+fromdate+"/"+todate, function(json) {
                options.xAxis.categories = json[0]['data'];
                options.series[0] = json[1];
                options.series[1] = json[2];
                options.series[2] = json[3];
                options.series[3] = json[4];
                chart = new Highcharts.Chart(options);
                });

             $.getJSON("<?php echo site_url();?>dashboard/reports/"+fromdate+"/"+todate, function(json) {
                options1.xAxis.categories = json[0]['data'];
                options1.series[0] = json[1];
                options1.series[1] = json[2];
                options1.series[2] = json[3];
                options1.series[3] = json[4];
                chart = new Highcharts.Chart(options1);
                });

              //third  
          var options2 = {
                  chart: {
                  renderTo: 'containerss',
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false
                  },
                  title: {
                  text: ''
                  },
                  tooltip: {
                  formatter: function() {
                  return '<b>'+ this.point.name +'</b> ('+ this.percentage +') %';
                  }
                  },
                    colors: ['#82E0AA', '#85C1E9', '#F5B041', '#5D6D7E', '#3D96AE','#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
                    plotOptions: {
                    column: {
                    colorByPoint: true
                    }
                   },

                  plotOptions: {
                  pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                  enabled: true,
                  color: '#000000',
                  connectorColor: '#000000',
                  formatter: function() {
                  return '<b>'+ this.point.name;
                  }
                  }
                  }
                  },
                  credits: {
                  enabled: false
                  },
                  exporting: { enabled: false },
                  series: [{
                  type: 'pie',
                  name: 'Browser share',
                  data: []
                  }]
                  }
                  
                   
                 // $.getJSON("dashboard/pie", function(json) {
                 $.getJSON("<?php echo site_url();?>dashboard/dash_pie/"+fromdate+"/"+todate, function(json) {
                  options2.series[0].data = json;
                  chart = new Highcharts.Chart(options2);
                  });
                  
            
            var options3 = {
                  chart: {
                  renderTo: 'ss2',
                  type: 'areaspline',
                  margin: [0, 0, 0, 0],
                  spacingTop: 0,
                  spacingBottom: 0,
                  spacingLeft: 0,
                  spacingRight: 0
                  
                  },
                  title: {
                    text: ''
                },
                  yAxis: {
                  visible: false
                  },
            
                  xAxis: {
                    visible: false,
                    },
                
                tooltip: {
                    shared: true,
                    valueSuffix: ' units'
                },
                exporting: { enabled: false },
                credits: {
                    enabled: false
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 150,
                    y: 0,
                    floating: true,
                    borderWidth: 1
                },
                colors: ['#65EFD4', '#85C1E9', '#F5B041', '#5D6D7E', '#3D96AE','#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.5
                    }
                },
                  series: [{
                  name: 'Browser share',
                  data: []
                  }]
                  }
                
                 $.getJSON("<?php echo site_url();?>dashboard/dash_most_sell_prdt/"+fromdate+"/"+todate, function(json) {
                 options3.xAxis.categories = json[0]['data'];
                 options3.series[0] = json[1];
                 chart = new Highcharts.Chart(options3);
                 });
            
            
            var options4 = {
                  chart: {
                  renderTo: 'ss',
                  type: 'areaspline',
                  margin: [0, 0, 0, 0],
                  spacingTop: 0,
                  spacingBottom: 0,
                  spacingLeft: 0,
                  spacingRight: 0
                  
                  },
                  title: {
                    text: ''
                },
                  yAxis: {
                  visible: false
                  },
            
                  xAxis: {
                    visible: false,
                    },
                
                tooltip: {
                    shared: true,
                    valueSuffix: ' units'
                },
                exporting: { enabled: false },
                credits: {
                    enabled: false
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 150,
                    y: 0,
                    floating: true,
                    borderWidth: 1
                },
                colors: [ '#85C1E9', '#F5B041', '#5D6D7E', '#3D96AE','#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.5
                    }
                },
                  series: [{
                  name: 'Browser share',
                  data: []
                  }]
                  }
                
                 $.getJSON("<?php echo site_url();?>dashboard/dash_most_sell_brand/"+fromdate+"/"+todate, function(json) {
                 options4.xAxis.categories = json[0]['data'];
                 options4.series[0] = json[1];
                 chart = new Highcharts.Chart(options4);
                 });

            
            });
                  
                  
            var diff=<?php echo $diff->days;?> ;
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
           
           
           
        <script type="text/javascript">
        
        function search()
        {
            
            var datepick=$("#pickdate").val();
            var fields = datepick.split('/');
            var fromdate = fields[0];
            var todate = fields[1];
            var employee=<?php echo $user_id;?>;
            
        $.get(base_url+"/get_count", 
        	  { fromdate: fromdate,todate:todate }, 
        	  function(data){ 
        	      
        	      var x=JSON.parse(data);
        	      var tx=x[0].total_tax1;
        	      var sl=x[0].gtotal1;
        	      
        	      
        	      if(sl==null)
        	      {
        	         var sale=0;
        	      }
        	      else
        	      {
        	          var s = parseFloat(sl).toFixed(2);
        	          var sale = Number(s).toLocaleString('en');
        	      }
        	      if(tx==null)
        	      {   
        	          var tax=0;
        	          
        	      }
        	      else
        	      {
        	          var s = parseFloat(tx).toFixed(2);
        	          var tax = Number(s).toLocaleString('en');
        	      }
        	      
        		  $("#quote").text(x[0].total);
        		  $("#invoice").text(x[0].total1);
        		  $("#proforma").text(x[0].total2);
        		  $("#purchase").text(x[0].total3);
        		  $("#delivery").text(x[0].total6);
        		  $("#sale").text("<?php echo $default_currency_symbol; ?> "+sale);
        		  $("#tax").text("<?php echo $default_currency_symbol; ?> "+tax);
        		  $("#request").text(x[0].total7);
        		  $("#product_sale").text(x[0].product_tot);
        		  $("#customer").text(x[0].total8);
        	  } 
        	); 
        	
        $.get(base_url+"/product_brand", 
        	  { fromdate: fromdate,todate:todate}, 
        	  function(data){ 
        	      
        	      var x=JSON.parse(data);
        	      if(x=='')
        	      {
        	      var products=0;
        	      var brand=0;
        	      $("#products").text('');
        		  $("#brand").text('');
        	      }
        	      else
        	      {
        	      var products=x[0].item_name;
        	      var brand=x[0].name;
        	      $("#products").text(products+ "( "+x[0].TotalQuantity+" )");
        		  $("#brand").text(brand+ "( "+x[0].TotalQuantity+" )");
        	      }  
        		  
        	  }); 
            
        var options = {
                chart: {
                    renderTo: 'container',
                    type: 'areaspline',
                    marginRight: 130,
                    marginBottom: 25
                },
                title: {
                    text: '',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: []
                },
                yAxis: {
                    title: {
                        text: 'No of Sales'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                credits: {
                  enabled: false
                },
                exporting: { enabled: false },
                 plotOptions: {
                    column: {
                        borderRadius: 5
                    },
                    areaspline: {
                        fillOpacity: 0.5
                    }
                },
                tooltip: {
                    formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y ;
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                
                dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{this.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                    }
                },
            
                    series: []
            }

        //second 
        var options1 = {
                chart: {
                    renderTo: 'container1',
                    type: 'column',
                    marginRight: 130,
                    marginBottom: 25
                },
                title: {
                    text: '',
                    x: -20 //center
                },
                subtitle: {
                    text: '',
                    x: -20
                },
                xAxis: {
                    categories: []
                },
                yAxis: {
                    title: {
                        text: 'No of Sales'
                    },
                    plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
                },
                credits: {
                  enabled: false
                },
                exporting: { enabled: false },
                 plotOptions: {
                column: {
                borderRadius: 5
                    }
                },
                tooltip: {
                    formatter: function() {
                            return '<b>'+ this.series.name +'</b><br/>'+
                            this.x +': '+ this.y ;
                    }
                },
                legend: {
                    layout: 'vertical',
                    align: 'right',
                    verticalAlign: 'top',
                    x: -10,
                    y: 100,
                    borderWidth: 0
                },
                
                dataLabels: {
                enabled: true,
                rotation: -90,
                color: '#FFFFFF',
                align: 'right',
                format: '{this.y:.1f}', // one decimal
                y: 10, // 10 pixels down from the top
                style: {
                    fontSize: '13px',
                    fontFamily: 'Verdana, sans-serif'
                    }
                   },
            
                    series: []
                   }
    
                   //folder/controller/method    
                $.getJSON("<?php echo site_url();?>dashboard/reports/"+fromdate+"/"+todate, function(json) {
                    options.xAxis.categories = json[0]['data'];
                    options.series[0] = json[1];
                    options.series[1] = json[2];
                    options.series[2] = json[3];
                    options.series[3] = json[4];
                    chart = new Highcharts.Chart(options);
                });
    
                 $.getJSON("<?php echo site_url();?>dashboard/reports/"+fromdate+"/"+todate, function(json) {
                    options1.xAxis.categories = json[0]['data'];
                    options1.series[0] = json[1];
                    options1.series[1] = json[2];
                    options1.series[2] = json[3];
                    options1.series[3] = json[4];
                    chart = new Highcharts.Chart(options1);
                });

              //third  
        var options2 = {
                  chart: {
                  renderTo: 'containerss',
                  plotBackgroundColor: null,
                  plotBorderWidth: null,
                  plotShadow: false
                  },
                  title: {
                  text: ''
                  },
                  tooltip: {
                  formatter: function() {
                  return '<b>'+ this.point.name +'</b> ('+ this.percentage +') %';
                  }
                  },
                    colors: ['#82E0AA', '#85C1E9', '#F5B041', '#5D6D7E', '#3D96AE','#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
                    plotOptions: {
                    column: {
                    colorByPoint: true
                    }
                },

                  plotOptions: {
                  pie: {
                  allowPointSelect: true,
                  cursor: 'pointer',
                  dataLabels: {
                  enabled: true,
                  color: '#000000',
                  connectorColor: '#000000',
                  formatter: function() {
                  return '<b>'+ this.point.name;
                  }
                  }
                  }
                  },
                  credits: {
                  enabled: false
                },
                exporting: { enabled: false },
                  series: [{
                  type: 'pie',
                  name: 'Browser share',
                  data: []
                  }]
                  }
                  
                   
                 // $.getJSON("dashboard/pie", function(json) {
                  $.getJSON("<?php echo site_url();?>dashboard/dash_pie/"+fromdate+"/"+todate, function(json) {
                  options2.series[0].data = json;
                  chart = new Highcharts.Chart(options2);
                  });
                  
        var options3 = {
                  chart: {
                  renderTo: 'ss2',
                  type: 'areaspline',
                  margin: [0, 0, 0, 0],
                  spacingTop: 0,
                  spacingBottom: 0,
                  spacingLeft: 0,
                  spacingRight: 0
                  
                  },
                  title: {
                    text: ''
                },
                  yAxis: {
                  visible: false
                  },
            
                  xAxis: {
                    visible: false,
                    },
                
                tooltip: {
                    shared: true,
                    valueSuffix: ' units'
                },
                exporting: { enabled: false },
                credits: {
                    enabled: false
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 150,
                    y: 0,
                    floating: true,
                    borderWidth: 1
                },
                colors: ['#65EFD4', '#85C1E9', '#F5B041', '#5D6D7E', '#3D96AE','#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.5
                    }
                },
                  series: [{
                  name: 'Browser share',
                  data: []
                  }]
                  }
                
                 $.getJSON("<?php echo site_url();?>dashboard/dash_most_sell_prdt/"+fromdate+"/"+todate, function(json) {
                 options3.xAxis.categories = json[0]['data'];
                 options3.series[0] = json[1];
                 chart = new Highcharts.Chart(options3);
                 });
            
            
            var options4 = {
                  chart: {
                  renderTo: 'ss',
                  type: 'areaspline',
                  margin: [0, 0, 0, 0],
                  spacingTop: 0,
                  spacingBottom: 0,
                  spacingLeft: 0,
                  spacingRight: 0
                  
                  },
                  title: {
                    text: ''
                },
                  yAxis: {
                  visible: false
                  },
            
                  xAxis: {
                    visible: false,
                    },
                
                tooltip: {
                    shared: true,
                    valueSuffix: ' units'
                },
                exporting: { enabled: false },
                credits: {
                    enabled: false
                },
                legend: {
                    layout: 'vertical',
                    align: 'left',
                    verticalAlign: 'top',
                    x: 150,
                    y: 0,
                    floating: true,
                    borderWidth: 1
                },
                colors: [ '#85C1E9', '#F5B041', '#5D6D7E', '#3D96AE','#DB843D', '#92A8CD', '#A47D7C', '#B5CA92'],
                plotOptions: {
                    areaspline: {
                        fillOpacity: 0.5
                    }
                },
                  series: [{
                  name: 'Browser share',
                  data: []
                  }]
                  }
                
                 $.getJSON("<?php echo site_url();?>dashboard/dash_most_sell_brand/"+fromdate+"/"+todate, function(json) {
                 options4.xAxis.categories = json[0]['data'];
                 options4.series[0] = json[1];
                 chart = new Highcharts.Chart(options4);
                 });
                 
                  
            }
        
        
        </script>
           
           
<script>
    $(document).on('click', '.main_search_result_area_close', function(){
        $('#main_search_result_area').hide(200);
        $('#main_search_result_area_box').html('');
    });
    
    $('.xxmain_search_result_area_close').on('click', function(){
        console.log('haai');
        $('#main_search_result_area').hide(200);
        $('#main_search_result_area_box').html('');
    });
    
    $("#main_search_form").submit(function(e){
       $('#main_search_result_area').show();
       $('#main_search_result_area_box').html('<button type="button" class="main_search_result_area_close close"> <span>×</span> </button><div align="center"><img src="'+site_url+'/skin/img/preloader.gif" width="100"/>');
        e.preventDefault();
    	var obj = $(this), action = obj.attr('name');
    	$.ajax({
    		type: "GET",
    		url: site_url+'/search/search_results_data/',
    		data: obj.serialize()+"&is_ajax=1&form="+action,
    		cache: false,
    		success: function (data) {
    		    $('#main_search_result_area_box').html('<button type="button" class="main_search_result_area_close close"> <span>×</span> </button>'+data);
    		}
    	});
    });
</script>


           
