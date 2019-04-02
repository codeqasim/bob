<div class="modify_area">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-9">
                <h3 class="mt0"><strong id="total-records">
                        <span id="total_records_count">0</span>
                    </strong> Hotels are available <?php if (isset($hotel_city)) { ?> in <strong><?php echo urldecode(ucwords(str_replace('-', ' ', $hotel_city))); ?></strong><?php } ?>
                </h3>
                <p class="fs10"><?php echo $travelers; ?> Travelers, 1 Room, <?php echo $nights->days; ?> Nights, <?php echo $checkin; ?> - <?php echo $checkout; ?></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="hidden-xs">
            <?php include $include_path . 'views/modules/hotels/partials/search.php'; ?>
        </div>
    </div>
</div>

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
