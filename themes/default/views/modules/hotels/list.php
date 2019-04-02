<script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/jquery.sticky-kit.js"></script>

<style>
    .list:hover .btn {
        top: 14px !important;
        margin-right: 12px
    }

    .select2-container--open .select2-dropdown--below {
        margin-top: -48px !important;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        border: 0px solid #0031bc;
    }

    .select2-container--default .select2-search--dropdown .select2-search__field {
        height: 48px;
    }

    .wrapper, .header, .footer {
        position: relative;
    }

    .wrapper {
        padding: 10px;
    }

    .sidebar {
        position: absolute;
        max-width: 270px;
        float: left;
        margin-bottom: 15px
    }

    .clear {
        clear: both;
        float: none;
    }

    .is_stuck {
        z-index: 99999 !important;
    }
</style>
<style type="text/css">

    @keyframes content-placeholder-animation {
        0% {
            transform: translateX(-50%);
        }

        100% {
            transform: translateX(300%);
        }
    }

    .content-placeholder-background {
        animation: content-placeholder-animation 1s linear infinite;
        background: -moz-linear-gradient(left, rgba(15, 15, 15, 0.3) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
        background: -webkit-linear-gradient(left, rgba(15, 15, 15, 0) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
        background: linear-gradient(to right, rgba(15, 15, 15, 0) 0%, rgba(0, 0, 0, 0.1) 50%, rgba(255, 255, 255, 0) 100%);
        filter: progid:DXImageTransform.Microsoft.gradient(startColorstr='#000f0f0f', endColorstr='#00ffffff', GradientType=1);
        display: block;
        height: inherit;
        left: 0;
        position: absolute;
        top: 0;
        width: 100%;
        will-change: transform;
    }

    .content-placeholder {
        background-color: #f1f1f1;
        display: block;
        margin-bottom: 1em;
        overflow: hidden;
        position: relative;

    }

    @media only screen and (max-width: 600px) {
        .image {
            height: 85px;
            width: 100%;
        }
    }

    @media only screen and (min-width: 600px) {
        .image {
            height: 150px;
            width: 100%;
        }
    }

    .header {
        height: 2em;
        width: 100%;
    }

    .subheading {
        height: 1.5em;
        width: 70%;
    }

    .paragraph {
        height: 1em;
        width: 50%;
    }

    .paragraph-left {
        height: 1em;
        width: 100%;
    }

</style>
<div class="visible-xs">
    <div class="col-md-12">
        <div class="row">
            <div class="col-xs-6 pr5">
                <button type="button" class="btn btn-primary btn-block br4" data-toggle="modal" data-target="#FILTER"><i
                            class="fa fa-bars"></i> Filter Results
                </button>
            </div>
            <div class="col-xs-6 pl5">
                <button type="button" class="btn btn-default btn-block br4" data-toggle="modal" data-target="#MODIFY"><i
                            class="fa fa-search"></i> Modify Search
                </button>
            </div>
        </div>
    </div>
    <div class="modal left fade" id="FILTER" tabindex="1" role="dialog" aria-labelledby="FILTER">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true"><i class="fa fa-times"></i></span></button>
                    <h4 class="modal-title" id="FILTER">Filter Search</h4>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal right fade" id="MODIFY" tabindex="-1" role="dialog" aria-labelledby="MODIFY">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i
                                class="fa fa-times"></i></span></button>
                <h4 class="modal-title" id="MODIFY">Modify Search</h4>
            </div>
            <div class="panel-body">
                <?php include $include_path . 'views/modules/hotels/partials/search.php'; ?>
            </div>
        </div>
    </div>
</div>
<div class="wrapper">
    <hr class="hidden-lg hidden-md" style="margin-top: 10px; margin-bottom: 10px; border: 0; border-top: 1px solid #dddddd;">
    <div class="content">
        <div class="listing-bg">
            <div class="container plr0">
                <div class="row hotels_module">
                    <div class="sidebar hidden-xs">
                        <?php include $include_path . 'views/modules/hotels/partials/filter.php'; ?>
                    </div>
                    <div class="col-sm-12 col-md-9 pull-right fn">
                        <div class="row">
                            <div class="col-sm-12 col-md-12">
                                <div id="hotels-list">
                                    <div id="hotel-partial" data-total="<?php echo $total; ?>" style="min-height: 800px;">
                                        <?php include $include_path . 'views/modules/hotels/partials/hotels.php'; ?>
                                    </div>
                                    <div class="ajax-load-page text-center" style="display:none">
                                        <?php for ($i = 0; $i < 5; $i++) { ?>
                                            <div class="row">
                                                <div class="col-md-3 col-xs-3"
                                                     style="padding-right:0px;margin-right: -20px">
                                                    <div class="content-placeholder image">
                                                        <span class="content-placeholder-background"></span>
                                                    </div>
                                                </div>
                                                <div class="col-md-9 col-xs-9"
                                                     style="padding-left: 30px;padding-right: 0px">
                                                    <div class="content-placeholder header">
                                                        <span class="content-placeholder-background"></span>
                                                    </div>
                                                    <div class="content-placeholder subheading">
                                                        <span class="content-placeholder-background"></span>
                                                    </div>
                                                    <div class="content-placeholder paragraph">
                                                        <span class="content-placeholder-background"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
$(".sidebar").stick_in_parent({
offset_top: 10
});
</script>

