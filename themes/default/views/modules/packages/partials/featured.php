<section class="featured-packages feature">
    <div class="container line">
        <div class="col-md-12">
            <h6><?=lang('021')?> <?=lang('01003')?></h6>
        </div>
        <div class="clearfix"></div>
        <?php foreach ($feature_tours as $feature_tour) { ?>
            <?php
                $tour_type = str_replace('_', '', $feature_tour->type_key);
                $price = round(($feature_tour->adultprice + $feature_tour->childprice + $feature_tour->infantprice) / 3);
                $days = $feature_tour->days . " Days";
            ?>
            <div class="col-md-4 wow fadeIn">
                <div class="img">
                    <a href="<?=$searchForm->detailPageLink($feature_tour)?>">
                        <div class="box">
                            <img style="height: auto;" src="<?=$feature_tour->thumbnail?>" alt="<?=$feature_tour->name?>" class="img_dark img-responsive" />
                        </div>
                        <div class="body text-left wow fadeInUp">
                            <h4 class="strong"><?=$feature_tour->location?></h4>
                            <p class="desc"><?=substr($feature_tour->name,0,35)?></p>
                            <?php for ($i = 0; $i < 5; $i++): ?>
                                <?php if($i < $feature_tour->stars): ?>
                                    <i class="fa fa-star text-warning"></i>
                                <?php else: ?>
                                    <i class="fa fa-star-o text-warning"></i>
                                <?php endif; ?>
                            <?php endfor; ?>
                            <h3><span><small><?=$_SESSION['curr_session']->code?></small> <?=$price?></span> <strong class="pull-right"><?=$days?></strong></h3>
                            <p><i class="fa fa-calendar"></i> <?=$tour_type?></p>
                        </div>
                    </a>
                </div>
            </div>
        <?php } ?>
    </div>
</section>