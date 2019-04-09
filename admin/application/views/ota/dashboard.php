<style>
.stats h2 { margin:0px }
.stats p { margin:0px }
.stats .well:hover { background:#E0E0E0 }
.stats hr { margin-top: 15px; margin-bottom: 15px; }

@media screen{body div,p,b,ul,li{margin:0;padding:0;border:0;outline:0;font-weight:normal;font-size:100%;letter-spacing:0;vertical-align:baseline;background:transparent}
ul{list-style:none}
b{font-weight:bold}
.serverHeader a{margin:0;padding:0;font-size:100%;vertical-align:baseline;background:transparent;color:inherit;text-decoration:none;line-height:1;margin:0}
.serverHeader a:hover,a:active{outline:0}
.serverHeader a{outline:0}
.bar{background:#3c4249;border-radius:10px;display:inline-block;height:5px;width:100%;overflow:hidden}
.bar__inner{background:#0e69d5;display:inline-block;border-radius:10px;height:5px;width:50%}
.serverHeader{overflow: hidden;background:#3c4249;padding:25px;display:-webkit-box;display:-ms-flexbox;display:flex;color:#fff;position:relative}
.serverHeader__stripe{right:-35px;margin-top:-5px;background:#636363;font-size:10px;font-weight:600;text-transform:uppercase;text-align:center;width:130px;padding:4px 0;-webkit-transform:rotate(45deg);transform:rotate(45deg);position:absolute}
.serverHeader__stripe--live{background-color:#76c83b}
.serverHeader__info{-webkit-box-flex:1;-ms-flex:1 0 auto;flex:1 0 auto;padding:8px}
.serverHeader__stats{background-color:#2b2e32;width:180px;-webkit-box-flex:0;-ms-flex:0 0 auto;flex:0 0 auto;padding:15px;border-radius:4px}
.serverHeader__stats a:hover{text-decoration:underline}
.serverHeader__usage{background:green;width:400px;padding:15px;margin-left:10px;background-color:#2b2e32;-webkit-box-flex:0;-ms-flex:0 0 auto;flex:0 0 auto;border-radius:4px}
.serverHeader__title{font-size:18px;font-weight:700;margin-bottom:10px}
.serverHeader__list{line-height:1.5;font-size:12px}
.serverHeader__list--ok{color:#76c83b}
.serverHeader__statsList{line-height:1.8;font-size:12px}
.serverHeader__statsList li{padding-left:22px;font-weight:300}
.serverHeader__stat-held{background:url(<?php echo base_url(); ?>assets/img/dash/1.svg) no-repeat 0 4px/13px;padding-left:22px}
.serverHeader__stat-queue{background:url(<?php echo base_url(); ?>assets/img/dash/2.svg) no-repeat 0 4px/13px}
.serverHeader__stat-size{background:url(<?php echo base_url(); ?>assets/img/dash/3.svg) no-repeat 0 4px/13px}
.serverHeader__stat-bounces{background:url(<?php echo base_url(); ?>assets/img/dash/4.svg) no-repeat 0 4px/13px}
.serverHeader__usageTitle{color:#566576;font-size:12px;font-weight:600;margin-bottom:5px}
.serverHeader__usageLine{display:-webkit-box;display:-ms-flexbox;display:flex;font-size:12px;-webkit-box-align:center;-ms-flex-align:center;align-items:center}
.serverHeader__usageLine+.serverHeader__usageLine{margin-top:6px}
.serverHeader__usageLineLabel{-webkit-box-flex:1;-ms-flex:1 0 auto;flex:1 0 auto}
.serverHeader__usageLineBar{width:100px;line-height:0}
.serverHeader__usageLineValue{width:100px;text-align:right;font-weight:600}
.serverHeader__usageLineValueLarge{width:300px;text-align:right;color:#909db0}
.serverHeader__usageLineValueLarge b{color:#fff}
}

.loader{position:relative;margin:0 auto;width:100px}
.loader:before{content:'';display:block;padding-top:100%}
.circular{-webkit-animation:rotate 2s linear infinite;animation:rotate 2s linear infinite;height:100%;-webkit-transform-origin:center center;transform-origin:center center;width:100%;position:absolute;top:0;bottom:0;left:0;right:0;margin:auto}
.path{stroke-dasharray:1,200;stroke-dashoffset:0;-webkit-animation:dash 1.5s ease-in-out infinite,color 6s ease-in-out infinite;animation:dash 1.5s ease-in-out infinite,color 6s ease-in-out infinite;stroke-linecap:round}
@-webkit-keyframes rotate{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}
}@keyframes rotate{100%{-webkit-transform:rotate(360deg);transform:rotate(360deg)}
}@-webkit-keyframes dash{0%{stroke-dasharray:1,200;stroke-dashoffset:0}
50%{stroke-dasharray:89,200;stroke-dashoffset:-35px}
100%{stroke-dasharray:89,200;stroke-dashoffset:-124px}
}@keyframes dash{0%{stroke-dasharray:1,200;stroke-dashoffset:0}
50%{stroke-dasharray:89,200;stroke-dashoffset:-35px}
100%{stroke-dasharray:89,200;stroke-dashoffset:-124px}
}@-webkit-keyframes color{100%,0%{stroke:#d62d20}
40%{stroke:#0057e7}
66%{stroke:#008744}
80%,90%{stroke:#ffa700}
}@keyframes color{100%,0%{stroke:#d62d20}
40%{stroke:#0057e7}
66%{stroke:#008744}
80%,90%{stroke:#ffa700}
}

.showbox{position:relative;top:0;bottom:0;left:0;right:0;padding:5%}
</style>
<script src="<?php echo base_url(); ?>assets/js/tour.js"></script>
<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/tour.css" />

<div class="serverHeader">
  <div class="serverHeader__stripe serverHeader__stripe--live">Live</div>
  <div class="serverHeader__info">
    <p class="serverHeader__title">DASHBOARD</p>
    <ul class="serverHeader__list">
      <li class="serverHeader__list--ok">Make sure to submit your sitemap for search crawlers</li>
      <li><a target="_blank" style="color:#ffffff" href="http://bookonboard.com/sitemap.xml">Your sitemap can be found <strong>HERE.</strong></a></li>
    </ul>
  </div>

  <!--<div class="serverHeader__stats">
    <ul class="serverHeader__statsList">
      <li class="serverHeader__stat-held">
        <a class="js-held-count" href="#">0 messages held</a>
      </li>
      <li class="serverHeader__stat-queue">
        <a class="js-queue-size" href="#">0 queued messages</a>
      </li>
      <li class="serverHeader__stat-bounces">
        <a class="js-bounce-rate" href="#">0.0% bounce rate</a>
      </li>
      <li class="serverHeader__stat-size">
        <a class="js-disk-size" href="#">0 Bytes used</a>
      </li>
    </ul>
  </div>-->

  <div class="serverHeader__stats">
    <ul class="serverHeader__statsList">
      <li class="serverHeader__stat-held">
        <a class="js-held-count" href="javascript:void(0)">USD <b>0</b> Flights</a>
      </li>
      <li class="serverHeader__stat-queue">
        <a class="js-queue-size" href="javascript:void(0)">USD <b>0</b> Hotels</a>
      </li>
      <li class="serverHeader__stat-bounces">
        <a class="js-bounce-rate" href="javascript:void(0)">USD <b>0</b> Total</a>
      </li>
      <li class="serverHeader__stat-size">
        <a class="js-disk-size" href="javascript:void(0)">USD <b>0</b> Payout</a>
      </li>
    </ul>
  </div>
  <div class="serverHeader__usage">
    <p class="serverHeader__usageTitle">Your API Endpoint calls</p>
    <div class="serverHeader__usageLine">
      <div class="serverHeader__usageLineLabel">Calls</div>
      <div class="serverHeader__usageLineBar">
        <div class="bar">
          <div class="bar__inner js-outgoing-bar" id="per_month"  style="width:0%;"></div>
        </div>
      </div>
      <div class="serverHeader__usageLineValue js-outgoing-count" title="">
        <span id="month_search">0</span> / <span style="color:#909db0"><?=$otadata->package->calls;?> </span>
      </div>
    </div>
    <hr style="border-top: 1px solid #3f3f3f;">
    <!--<div class="serverHeader__usageLine">
      <div class="serverHeader__usageLineLabel">Bandwidth / Traffic</div>
       <div class="serverHeader__usageLineBar">
        <div class="bar">
          <div class="bar__inner js-outgoing-bar" style="width:60%;"></div>
        </div>
      </div>
      <div class="serverHeader__usageLineValue js-incoming-count"> 7440</div>
    </div>-->
    <div class="serverHeader__usageLine">
      <div class="serverHeader__usageLineLabel">Todays Visits</div>
      <div class="serverHeader__usageLineValueLarge"> <b class="js-message-rate"><span id="today_search">0</span></b> / Last 24:H </div>
    </div>
  </div>
</div>

<div id="statics" class="panel panel-default stats">
 <div class="panel-heading" style="background:white">Statics</div>
  <div class="panel-body">
  <div class="row">
  <div class="col-md-6"><div class="well"><h2><strong><span id="month_user">0</span> <small>This Month</small></strong></h2><p><strong><span id="total_user">0</span></strong> Total Customers</p></div></div>
  <!--<div class="col-md-3"><div class="well"><h2><strong><span id="month_supplier">0</span> <small>This Month</small></strong></h2><p><strong><span id="total_suppliers"></span> </strong> Total Vendors</p></div></div>
  <div class="col-md-3"><div class="well"><h2><strong><span id="agents">0</span> <small>This Month</small></strong></h2><p><strong><span id="agent">0</span></strong> Total Agents</p></div></div>
  --><div class="col-md-6"><div class="well"><h2><strong><span id="month_bookings">0</span> <small>This Month</small></strong></h2><p><strong><span id="total_booking"></span></strong> Total Bookings</p></div></div>
  <div class="clearfix"></div>
  <!--<hr>
  <div class="col-md-3"><label>From Date</label><div class="clearfix"></div><input type="Date" placeholder="Date" class="form-control" /></div>
  <div class="col-md-3"><label>To Date</label><div class="clearfix"></div><input type="Date" placeholder="Date" class="form-control" /></div>
  <div class="col-md-6"><label></label><div class="clearfix"></div><button class="btn btn-primary btn-block">Update</button></div>
--> </div>
 </div>
</div>
 <div class="form-group"></div>
      <?php if(isset($graph)): ?>
      <script src="<?php echo base_url(); ?>assets/js/highcharts.js"></script>
      <script src="<?php echo base_url(); ?>assets/js/exporting.js"></script>
      <div class="panel panel-default">
          <div class="panel-heading">Calls Stats</div>
          <div id="container" style="min-width: 100%; height: 400px; margin: 0 auto"></div>
      </div>

  <script>
      var graph = <?php echo $graph; ?>;
      Highcharts.chart('container', {
          chart: {
              type: 'column'
          },
          title: {
              text: 'Total Usage'
          },
          subtitle: {
              text: 'Total calls : <?php echo $total_hits; ?> Hits'
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
                  text: 'Rainfall (mm)'
              }
          },
          tooltip: {
              headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
              pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' + '<td style="padding:0"><b>{point.y}</b></td></tr>',
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
          series: graph
      });

  </script>
  <?php endif; ?>
      <div id="stats" class="panel panel-default">
          <div class="panel-heading">Visitors and booking stats</div>
          <table class="table table-striped table-hover">
              <thead style="font-weight:bold">
                  <tr>
                      <th></th>
                      <th>Searches</th>
                      <th>Bookings</th>
                      <th>Paid</th>
                      <th>Unpaid</th>
                      <th>Cancelled</th>
                      <th>Pending</th>
                  </tr>
              </thead>
              <tbody id="report_body">

              </tbody>
          </table>
          <hr>
              <?php for ($i = 1; $i <= 12; $i++) { ?>
                  <div class="col-md-2 form-group">
                      <button id="month_<?=$i?>" onclick="get_report(<?=$i?>)" class="month_button btn btn-primary btn-block <?php if(date('F') == date('F', mktime(0, 0, 0, $i, 1))) { echo "btn-success";} ?>" ><?php echo date('F', mktime(0, 0, 0, $i, 1)); echo " ".date('Y') ?> </button>
                  </div>
              <?php } ?>
          <div class="clearfix"></div>
      </div>

<script>



var tour = new Tour({
  steps: [
    {
      element: "#statics",
      title: "Statics",
      content: "This is statics area it helps you to view current months and and all time stats for new customers, Vendors, Agents and Bookings",
      placement: "bottom"
    },
    {
      element: "#stats",
      title: "Stats",
      content: "Here you can see all your basic reports from how many searches made on your site and how many of them got paid cancelled or still pending. it not only helps you to see the basic stats but also you can review about the total stats of this month with revenue calculations.",
      placement: "top"
    },
    {
      element: "#sidebartour",
      title: "Sidebar",
      content: "This is the main sidebar where you can go through to any link you wish to manage he bar helps you to navigate easily to all the links and pages available for management.",
      placement: "right"
    },
    {
      element: ".hideSidebar",
      title: "Hide Sidebar",
      content: "At any point if you wish to hide sidebar you can just click here.",
      placement: "bottom"
    },
    {
      element: "#account",
      title: "Account",
      content: "Click here on account if you like to see your profile and billing details.",
      placement: "bottom"
    },
    {
      element: "#website",
      title: "Your Site",
      content: "If you wish to see your website without having or adding your branded domain name you can click here anytime to view your managed website.",
      placement: "bottom"
    },
    {
      element: "#logout",
      title: "Logout",
      content: "Once you are done with your management you and you are looking to logout just click here.",
      placement: "left"
    }

  ],
  backdrop: true,
  storage: false
});

// tour.init();
// tour.start();
tour.init();
// tour.start();
$("#startTourBtn").click(function() {
  tour.restart();
});

$(document).ready(function () {

    $.ajax({
        url: '<?=base_url('dashboard/clients')?>',
        dataType: 'json',
        beforeSend: function () {

        },
        success: function (data) {
            $("#month_user").html(data['month_user']);
            $("#total_user").html(data['total_user']);
            $("#month_supplier").html(data['month_supplier']);
            $("#total_suppliers").html(data['total_suppliers']);
            $("#month_bookings").html(data['month_bookings']);
            $("#total_booking").html(data['total_booking']);
        },
        error: function () {

        }
    });
    get_report(<?=date('m');?>);
    get_report_current(<?=date('m');?>);
});

function get_report(id) {

    $.ajax({
        url: '<?=base_url('reports/load_dashboard_report')?>',
        data: "month_id="+id,
        type:'post',
        beforeSend: function () {
            $(".month_button").removeClass('btn-success');
            $("#report_body").html("<tr><td colspan='7' style='text-align:center'><div class='showbox'> <div class='loader'> <svg class='circular' viewBox='25 25 50 50'> <circle class='path' cx='50' cy='50' r='20' fill='none' stroke-width='2' stroke-miterlimit='10'/> </svg> </div> </div></td></tr>");
        },
        success: function (data) {
            $("#report_body").html(data);
            $("#month_"+id).addClass('btn-success');
            $('#report_body').focus();
        },
        error: function () {
            $("#report_body").html("<tr><td colspan='7' style='text-align:center'>Failed to Load data</td></tr>");
        }
    });
}
function get_report_current(id) {
    var a = parseFloat("<?=$otadata->package->calls?>");
    $.ajax({
        url: '<?=base_url('reports/load_dashboard_report_current')?>',
        data: "month_id="+id,
        type:'post',
        dataType:'json',
        beforeSend: function () {

        },
        success: function (data) {
           document.getElementById("month_search").innerHTML = data.month_search;
           document.getElementById("per_month").style.width  = (parseFloat(data.month_search)/a) * 100 +"%";

            document.getElementById("today_search").innerHTML = data.today_search;
        },
        error: function () {
        }
    });
}

</script>




<!--
<script type="text/javascript">
  $(document).ready(function () {
      var str = $('#server-time').text();
      var dt = str.split(',');
      var t = dt[1].split(':');
      var m = t[1];
      setInterval(function () {
          m = parseInt(m) + 1;
          if (m === 60) {
              m = 0;
              t[0] = parseInt(t[0]) + 1;
          }
          var newDT = dt[0] + ', ' + t[0] + ':' + (m < 10 ? '0' : '') + m;
          $('#server-time').text(newDT);
      }, 60000);
  })
</script>
-->