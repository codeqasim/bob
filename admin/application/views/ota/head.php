<?php $blog = current(array_filter($ota_modules ,function($item){ return ($item->name == "blog"); })); ?>
<style>
 body{background:#efefef}
.header{display:none}
.footer{display:none}
.gotop{display:none}
.navbar-btn{box-shadow:none;outline:none!important;border:0}
.line{width:100%;height:1px;border-bottom:1px dashed #ddd;margin:40px 0}
.wrapper{display:flex;align-items:stretch}
#sidebar { min-width: 250px; max-width: 250px; background-color: #32363C; box-shadow: 0 0 10px 0 rgba(0,0,0,.2); color: #ffffff; transition: all .3s; position: fixed; height: 100%; z-index: 1100; overflow-y: scroll; height: 100vh; }
#sidebar a,#sidebar a:hover,#sidebar a:focus{color:inherit}
#sidebar.active{margin-left:-300px}
#sidebar .sidebar-header{padding:20px}
#sidebar ul.components{padding:20px 0;border-bottom:1px solid rgba(238, 238, 238, 0.18)}
#sidebar ul p{color:#fff;padding:10px}
#sidebar ul li a{position:relative;-webkit-transition:all .2s ease-in-out;-o-transition:all .2s ease-in-out;transition:all .2s ease-in-out;padding:10px;font-size:13px;display:block;text-transform:uppercase;text-decoration:none;padding-left:60px!important}
#sidebar ul li a:hover{color:#b5b9d2;background:rgba(0,0,0,.04)}
#sidebar ul li.active>a,a[aria-expanded="true"]{color:#666;background:rgba(0,0,0,.04)}
#sidebar a[data-toggle="collapse"]{position:relative}
#sidebar a[aria-expanded="false"]::before,#sidebar a[aria-expanded="true"]::before{content:'\e259';display:block;position:absolute;right:20px;font-family:'Glyphicons Halflings';font-size:.9em}
#sidebar a[aria-expanded="true"]::before{content:'\e260'}
#sidebar ul ul a{font-size:.9em!important;padding-left:60px!important;background:rgba(245,245,245,0.04);font-weight:100}
#sidebar a{font-weight:bold}
#sidebar i{color:rgba(154, 154, 175, 0.7411764705882353);position:absolute;left:20px;font-size:18px}
ul.CTAs{padding:14px}
ul.CTAs a{text-align:center!important;font-size:.9em!important;display:block;border-radius:3px;text-align:center;padding-left:15px!important}
a.download{background:#fff;color:#7386d5}
a.article{background:#0031bc!important;color:#fff!important;border:2px solid #0031bc}
a.article:hover{background:#fff!important;color:#0031bc!important;border:2px solid #0031bc}
#content{padding:20px;min-height:100vh;width:100%;transition:all .3s}
@media(max-width:768px){#sidebar{margin-left:-300px}
#sidebar.active{margin-left:0}
#sidebarCollapse span{display:none}
#content{padding:20px!important}
.navbar .container-fluid{padding:0 15px 15px 0!important}
}.navbar-default{height:64px;color:rgba(0,0,0,.87);box-shadow:0 3px 14px 2px rgba(0,0,0,.12)}
.navbar-brand{background:#eee;color:rgba(0,0,0,.87);height:64px;min-width:64px!important;padding:18px}
.navbar-nav>li>a{padding-top:22px;padding-bottom:22px}
.root{background:#292c30;padding:30px 0px}
.root i{position:absolute;font-size:32px!important;top:88px;background:rgba(0,0,0,0.25882352941176473);padding:17px;border-radius:42px;width:66px;color:#fff!important;text-align:center;margin-left:0}
.root strong{text-transform:uppercase;letter-spacing:1px;position:relative;margin-bottom:0;display:block;font-size:14px}
.root p{margin-left:90px;margin-top:-5px;position:relative;margin-bottom:0;font-weight:100;font-size:10px}
.root a{text-decoration:none}
.root:hover{background:#0031bc;color:#fff}
.go_left{padding:0 15px 15px 0!important;transition:all .3s}
.p15{padding:20px!important}
#content{padding-left:270px}
.liline li{border-bottom:1px solid #e5e5e5}
.dropdown .badge{background-color:#ffae1a}
.dropdown .hides{font-size:9px;letter-spacing:1px}
</style>
</div>
<div class="wrapper">
    <nav id="sidebar">
    <div id="sidebartour">
        <div class="sidebar-header">
            <img style="float: left; margin-right: 10px; max-width: 33px;" src="<?= $otadata->favicon_url ?>" class="hlogo_preview_img img-fluid brand-logos favicon">
            <h5><?= $otadata->business_name ?>
                <small class="muted" style="color:#9d9d9d">Console</small>
            </h5>
        </div>
        <div class="root">
            <a href="<?php echo base_url('account'); ?>">
                <i class="fa fa-user-circle-o pull-left" style="left:5px"></i>
                <p><strong><?= $otadata->name ?></strong> <?= $otadata->email ?></p>
            </a>
        </div>
        <ul class="list-unstyled components">
            <li><a style="color:#F5F8FF" href="<?php echo base_url('/dashboard'); ?>"><i style="color:#F5F8FF" class="fa fa-desktop"></i>  Dashboard</a></li>
            <li><a href="<?php echo base_url('modules'); ?>"><i class="fa fa-cube"></i> Modules</a></li>
            <li class="">
                <a href="#accounts" data-toggle="collapse" aria-expanded="false"><i class="fa fa-user-circle"></i> Accounts </a>
                <ul id="accounts" class="collapse list-unstyled">
                    <li><a href="<?php echo base_url('accounts/admins'); ?>">Admins</a></li>
                    <li><a href="<?php echo base_url('accounts/customers'); ?>">Costumers</a></li>
                    <li><a href="<?php echo base_url('accounts/guest_customers'); ?>">Guest Costumers</a></li>
                </ul>
            </li>
            <li class="">
                <a href="#settings" data-toggle="collapse" aria-expanded="false"><i class="fa fa-cog"></i> Settings </a>
                <ul id="settings" class="collapse list-unstyled">
                    <li><a href="<?php echo base_url('settings'); ?>">General Settings</a></li>
                    <li><a href="<?php echo base_url('gateways'); ?>">Payment Gateways</a></li>
                    <li><a href="<?php echo base_url('pages'); ?>">Meta Tags</a></li>
                    <li><a href="<?php echo base_url('newslatters'); ?>">Newslatters</a></li>
                    <!--<li><a  href="<?php echo base_url('payment_gateways'); ?>">Payment Gateways</a></li>-->
                    <li><a href="<?php echo base_url('social'); ?>">Social Icons</a></li>
                    <li><a href="<?php echo base_url('widgets'); ?>">Widgets</a></li>
                    <li><a href="<?php echo base_url('customizations'); ?>">Customizations</a></li>
                </ul>
            </li>
            <li class="">
                <a href="#cms" data-toggle="collapse" aria-expanded="false"><i class="fa fa-th-large"></i> CMS </a>
                <ul id="cms" class="collapse list-unstyled">
                    <li><a href="<?php echo base_url('cms'); ?>">CMS Management</a></li>
                </ul>
            </li>
            <?php if(($blog->is_child_active) && ($blog->is_super_active)) { ?>
            <li class="">
                <a href="#blog" data-toggle="collapse" aria-expanded="false"><i class="fa fa-file"></i> Blog </a>
                <ul id="blog" class="collapse list-unstyled">
                    <li><a href="<?php echo base_url('blogs'); ?>">Blogs</a></li>
                    <li><a href="<?php echo base_url('blogs/categories'); ?>">Categories</a></li>
                    <li><a href="<?php echo base_url('blogs/settings'); ?>">Settings</a></li>
                </ul>
            </li>
            <?php } ?>
            <li><a href="<?php echo base_url('bookings'); ?>"><i class="fa fa-list"></i> Bookings</a></li>
        </ul>
        <ul class="list-unstyled CTAs">
            <li><a target="_blank" style="position:fixed;bottom:30px;width:210px;" href="http://bookonboard.com/" class="article"><i class="fa fa-chevron-left"></i> Back to Main Site</a></li>
        </ul>
    </div>
    </nav>
    <div id="content">
        <nav class="navbar navbar-default navbar-fixed-top">
            <div class="container-fluid" style="padding-left: 250px;">
                <div id="">
                <a id="sidebarCollapse" class="hideSidebar navbar-brand" href="javascript:void(0)"><i class="fa fa-bars"></i></a>
                </div>
                <div class="collapse navbar-collapse" id="nav">
                    <ul class="nav navbar-nav navbar-right">
                        <li id="account" class=""><a href="<?= base_url("account") ?>"><i class="fa fa-user-circle-o"></i> Account</a></li>
                        <li id="website" class=""><a target="_blank" href="http://www.bookonboard.com/"><i class="fa fa-laptop"></i> Website</a></li>
                        <li id="logout" class="active"><a href="<?php echo base_url(); ?>logout"><strong><i class="fa fa-sign-out"></i> Logout</strong></a></li>
                    </ul>
                </div>
            </div>
        </nav>

        <div style="margin-top:75px"></div>
        <?php if($otadata->package_id == 2){ ?>
        <p class="alert alert-info">Your are currently using package <strong>Agency</strong> your due ammount for this package is $25. please make the payment as early as possible to have continued service.</p>
        <?php } ?>

        <script>
            function pending_accounts() {
                $('li.pending_accounts').hide();
            }
            $(document).ready(function () {
                $("#sidebarCollapse").on("click", function () {
                    $("#sidebar").toggleClass("active");
                    $(".container-fluid").toggleClass("go_left");
                    $("#content").toggleClass("p15");
                    $(this).toggleClass("active");
                });
            });

        </script>