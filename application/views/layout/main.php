<!DOCTYPE HTML>
<html lang="en">
<head>
    <title>Travelhope</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/img/fav.png">
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/style.css" />
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/jq.js"></script>
    <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/bs.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/fastclick/1.0.6/fastclick.js"></script>
</head>
<nav class="navbar navbar-static-top navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
            <img src="<?php echo base_url(); ?>assets/img/brand.png" alt="TRAVELHOPE" />
            </a>
        </div>
        <div id="navbar" class="navbar-collapse collapse">
            <ul class="nav navbar-nav">
                <li class=""><a href="<?php echo base_url(); ?>">Home</a></li>
                <li class=""><a href="<?php echo base_url('hotels'); ?>">Hotels</a></li>
                <li><a href="#">Flights</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Packages <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="#">Local Tours</a></li>
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">International</li>
                        <li><a href="#">East</a></li>
                        <li><a href="#">West</a></li>
                        <li><a href="#">Asia</a></li>
                        <li><a href="#">Europe</a></li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if($ota_data->login_restrication){ ?>
                <li class="active"><a href="#">Login <span class="sr-only">(current)</span></a></li>
                <?php } ?>
                <?php if($ota_data->signup_restrication){ ?>
                <li><a href="../navbar-static-top/">Sign Up</a></li>
                <?php } ?>

            </ul>
        </div>
    </div>
    <div id="preloader" class="loader-wrapper">
        <div class="progress">
            <div class="indeterminate"></div>
        </div>
    </div>
</nav>
    <body>
        <?php $data = (isset($data)) ? $data : ''; $this->load->view($content, $data); ?>
        <footer class="navbar navbar-static-top navbar-default hidden-xs" style="margin-bottom:0px;">
            <div class="container">
              <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                  <li class="supplier-signup"><a target="_blank" href="javascript:">Supplier Signup</a></li>
                  <li><a href="#">Supplier Login</a></li>
                  <li><a href="#">Agent Signup</a></li>
                  <li><a href="#">Agent Login</a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                  <li class="active"><a href="./">All rights reserved by Travelhope <span class="sr-only">(current)</span></a></li>
                </ul>
                  <form id="supplier-form" target="_blank" action="<?php echo $this->config->item('api_base_url').'supplier/signup/'; ?>" method="POST">
                      <input type="hidden" name="ota" value="<?php echo $this->customConfig['clientId']; ?>" />
                  </form>
              </div>
            </div>
        </footer>
        <script type="text/javascript" src="<?php echo base_url(); ?>assets/js/script.js"></script>
        <script type="text/javascript">
         $(document).ready(function(){
         $('.supplier-signup > a').click(function(){
         $('#supplier-form').submit(); }); });



        </script>
    </body>
</html>