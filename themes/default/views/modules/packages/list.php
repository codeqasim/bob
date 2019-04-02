<script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/jquery.sticky-kit.js"></script>
<style>
    .wrapper, .header, .footer {
        position: relative;
    }

    .wrapper {
        padding: 10px;
    }

    .sidebar {
        position: absolute;
        max-width: 270px !important;
        float: left;
        margin-bottom: 15px
    }
</style>
<div class="modify_area">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-9">
                <h3 class="mt0"><strong id="total-records">
                        <span id="total_records_count"><?=$package["count"]?></span>
                    </strong> Packages are available in <strong><?=$searchForm->getText()?></strong>
                </h3>
                <p class="fs10"><?=$searchForm->guests->total()?> Travelers, <?=$searchForm->packageDate?></p>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="hidden-xs">
            <?php include $include_path . 'views/modules/packages/partials/search.php'; ?>
        </div>
    </div>
</div>

<div class="wrapper">
    <div class="container">

        <?php if (isset($package['data']) && ! empty($package['data'])): ?>
            <div class="sidebar hidden-xs">
                <?php include $include_path . 'views/modules/packages/partials/filter.php'; ?>
            </div>
            <div class="col-md-9 col-xs-12 featured-packages feature pull-right" style="padding:0px">
            <div class="">
                <?php foreach ($package["data"] as $feature_tour): ?>
                    <?php
                        $tour_type = str_replace('_', '', $feature_tour->type_key);
                        $price = round(($feature_tour->adultprice + $feature_tour->childprice + $feature_tour->infantprice) / 3);
                        $days = $feature_tour->days . " Days";
                    ?>
                    <div class="col-md-6 wow fadeIn animated">
                        <div class="img">
                            <a href="<?=$searchForm->detailPageLink($feature_tour)?>" target="_blank">
                                <div class="box">
                                    <img style="height: auto;" src="<?=$feature_tour->thumbnail?>" alt="<?=$feature_tour->name?>" class="img_dark img-responsive" />
                                </div>
                                <div class="body text-left wow fadeInUp">
                                    <h4 class="strong"><?=$feature_tour->location?></h4>
                                    <p class="desc"><?=$feature_tour->name?></p>
                                    <?php for ($i = 0; $i < 5; $i++): ?>
                                        <?php if($i < $feature_tour->stars): ?>
                                            <i class="fa fa-star text-warning"></i>
                                        <?php else: ?>
                                            <i class="fa fa-star-o text-warning"></i>
                                        <?php endif; ?>
                                    <?php endfor; ?>
                                    <h3><span><small><?=$_SESSION['curr_session']->code?></small> <?=$price?></span> <strong class="pull-right"><?=$days?></strong></h3>
                                    <p><i class="fa fa-calendar"></i> <?=$tour_type?></p>
                                    <p><?=$feature_tour->type_value?></p>
                                </div>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <?php else: ?>
            <div style="margin-top:-25px;min-height: 350px; padding: 25px;">
                <img src="<?php echo $theme_url; ?>assets/img/not_found.gif" style="max-width:200px"
                     class="img-responsive center-block" alt="not found"/>
                <h4 style="margin: 25px 0 10px !important;" class="form-group text-center"><strong>No Results found.</strong></h4>
                <p class="text-center">
                    Sorry, We couldn't find any results for the dates you are searching for.
                    <br>
                    We suggest you modify your search and try again.
                </p>
                <input value="0" type="hidden" id="available_flights">
            </div>
        <?php endif; ?>

    </div>
</div>

<script>
    $(".sidebar").stick_in_parent({
        offset_top: 10
    });
</script>
