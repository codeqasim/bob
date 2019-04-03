<?php include $include_path . '/functions.php'; ?>
<?php include $include_path . '/theme.php'; ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
    <title><?php echo $title; ?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="">
    <link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/style.css"/>
    <link rel="stylesheet" href="<?php echo $theme_url; ?>assets/css/mobile.css"/>
    <meta name="theme-color" content=""/>
<!--    --><?php //if ($lang_session->type == "rtl") { ?>
<!--        <link rel="stylesheet" href="--><?php //echo $theme_url; ?><!--assets/css/rtl.css"/>-->
<!--    --><?php //} ?>
    <?php include 'meta.php'; ?>

    <script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/jq2.js"></script>
    <script src="<?php echo $theme_url; ?>assets/js/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/bs.js"></script>
    <script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/select2.min.js"></script>
    <script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/moment.min.js"></script>
    <script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/bootstrap3-typeahead.min.js"></script>
    <script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/caleran.min.js"></script>
    <script type="text/javascript">
        const base_url = "<?php echo base_url(); ?>";
    </script>
    <style>
        .select2-results__option.loading-results {
            background-image: url('<?php echo site_url(); ?>assets/img/loading.gif');
            background-repeat: no-repeat;
            padding-right: 10px;
            background-size: 20px;
            background-position: 98% 50%;
        }

        .select2-container--default .select2-search--dropdown .select2-search__field {
            border: none !important;
            outline: none !important;
        }

        .select2-results__option {
            padding: 10px;
        }

        .select2:focus {
            outline: none;
        }
    </style>
</head>
<?php if (!empty($customization->header_html)) {
    echo $customization->header_html;
} ?>
<div class="top_bar hidden-sm hidden-xs">
    <nav class="navbar navbar-static-top navbar-primary">
        <div class="container">
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav">
                    <li class="active"><a href="#tel:<?php if (!empty($ota_cms->contact->phone)) {
                            echo $ota_cms->contact->phone;
                        } else {
                            echo "123 456 789 ";
                        } ?>"><i class="fa fa-phone"></i> <?php if (!empty($ota_cms->contact->phone)) {
                                echo $ota_cms->contact->phone;
                            } else {
                                echo "123 456 789 ";
                            } ?></a></li>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="dropdown">
                        <a href="mailto:<?php if (!empty($ota_cms->contact->email)) {
                            echo $ota_cms->contact->email;
                        } else {
                            echo "help@travelservice.com";
                        } ?>"><i class="fa fa-envelope"></i> <?php if (!empty($ota_cms->contact->email)) {
                                echo $ota_cms->contact->email;
                            } else {
                                echo "help@travelservice.com";
                            } ?></a>
                    </li>
                </ul>
            </div>
        </div>
        <div id="preloader" class="loader-wrapper">
            <div class="progress">
                <div class="indeterminate"></div>
            </div>
        </div>
    </nav>
</div>
<nav class="navbar navbar-static-top navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="menu-col navbar-toggle collapsed" data-toggle="collapse" data-target="#navbars" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="<?php echo base_url(); ?>">
                <img class="center-block" src="<?php echo $image_path . $logo; ?>" alt="logo"/>
                <span style="background: #ff0200; padding: 3px; font-size: 10px; border-radius: 3px; letter-spacing: 2px; position: absolute; top: 2px; right: 4px; height: 18px; line-height: 13px;">BETA</span>
            </a>
        </div>
        <div id="navbars" class="navbar-collapse collapse">
            <ul class="nav navbar-nav hidden-xs hidden-sm">
                <!--<li class=""><a href="<?php echo base_url(); ?>"><?= lang('01') ?></a></li>-->
                <!--<?php
                if (!empty($ota_modules->hotels->is_active) && !empty($main_model->hotels->is_active)) { ?>
                <li class=""><a href="<?php echo base_url('hotels'); ?>" id="all-hotels"><?= lang('01001') ?></a></li>
                <?php } ?>-->
                <?php include 'menu.php'; ?>
                <?php if (!empty($ota_modules->blog->is_active) && !empty($main_model["blog"]->is_active)) { ?>
                    <li class=""><a href="<?php echo base_url('blog'); ?>"><i class="fa fa-file-text"></i> <?= lang('01008') ?></a></li>
                <?php } ?>
                <!--<li><a href="#">Flights</a></li>-->
                <?php if ($supplier_logged_in) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true"
                           aria-expanded="false">Supplier <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li class=""><a href="<?php echo base_url('supplier/dashboard'); ?>">Bookings</a></li>
                            <li class=""><a href="<?php echo base_url('supplier/hotels'); ?>">Hotels</a></li>
                        </ul>
                    </li>
                <?php } ?>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <?php if (empty($user_session)) { ?>
                        <li><a href="<?php echo base_url('account/login'); ?>"><?= lang('039') ?></a></li>
                        <li><a href="<?php echo base_url('account/signup'); ?>"><?= lang('040') ?></a></li>
                <?php } else { ?>
                    <li><a href="<?php echo base_url('account/bookings'); ?>"><?= lang('056') ?></a></li>
                    <li><a href="<?php echo base_url('account/profile'); ?>"><?= lang('0118') ?></a></li>
                    <li><a href="<?php echo base_url('account/logout'); ?>"><?= lang('041') ?></a></li>
                <?php } ?>
                <?php if ((count($ota_currencies) > 1) || count($ota_languages) > 1) { ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                          <strong>
                          <?php if (count($ota_currencies) > 1) {
                                echo $curr_session->name;
                            } ?>

                            <?php if (count($ota_languages) > 1) { ?>
                                <i class="flag <?= $lang_session->country_code ?>"></i>
                            <?php } ?>
                            <span class="fa fa-angle-down"></span></strong></a>
                        <ul class="dropdown-menu language_currency">
                            <div style="padding:15px 0">
                                <?php if (count($ota_currencies) > 1) { ?>
                                    <div class="col-md-7">
                                        <label><strong><?= lang('019') ?></strong></label>
                                        <ul>
                                            <?php foreach ($ota_currencies as $ota_currency) { ?>
                                                <li><a href="javascript:void(0)" onclick="change_curr('<?= $ota_currency->name ?>','<?= $ota_currency->code ?>','<?= $ota_currency->country_name ?>','<?= $ota_currency->id ?>','<?= $ota_currency->is_default ?>')"><label><?= $ota_currency->name ?></label><?= $ota_currency->country_name ?> </a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                                <?php if (count($ota_languages) > 1) { ?>
                                    <div class="col-md-5">
                                        <label><?= lang('020') ?></label>
                                        <ul class="language_section">
                                            <?php foreach ($ota_languages as $ota_language) { ?>
                                                <li><a href="<?= base_url($ota_language->code) ?>"><i
                                                                class="flag <?= $ota_language->country_code ?>"></i> <?= $ota_language->name ?>
                                                    </a></li>
                                            <?php } ?>
                                        </ul>
                                    </div>
                                <?php } ?>
                            </div>
                        </ul>
                    </li>
                <?php } ?>
                <!--<?php if ($supplier_logged_in) { ?>
                <li class=""><a href="<?php echo base_url('supplier/logout'); ?>">Logout</a></li>
                <?php } else { ?>
                <li class=""><a href="#">Login <span class="sr-only">(current)</span></a></li>
                <li><a href="javascript:void(0)">Sign Up</a></li>
                <?php } ?>-->
            </ul>
        </div>
    </div>
</nav>
<body>

<!--<div class="corner-ribbon top-left sticky red shadow">BETA</div>
<div class="corner-ribbon top-right sticky blue">BETA</div>
<div class="corner-ribbon bottom-left sticky orange">BETA</div>
<div class="corner-ribbon bottom-right sticky green shadow">BETA</div>-->

<script>
function change_curr(name, code, country_name, id, is_default) {
$.ajax({
url: '<?=base_url()?>dashboard/change_curr',
data: {
name: name,
code: code,
country_name: country_name,
id: id,
is_default: is_default,
},
type: 'post',
success: function () {
window.location.reload()
}
});
}
</script>