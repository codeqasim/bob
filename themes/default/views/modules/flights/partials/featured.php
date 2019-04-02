<section class="featured-flights bgwhite feature">
    <div class="container line">
        <div class="col-md-12">
            <h6><?=lang('021')?> <?=lang('01002')?></h6>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-12">
            <div class="owl-carousel airlines">
                <?php foreach ($ota_modules->flights->feature_cities as $ota_feature) { ?>
                    <a href="<?=$ota_feature->url?>" class="">
                        <div class="box">
                            <p class="text-muted"><?=lang('023')?> <?=$ota_feature->airports_name?><span><img src="<?=base_url("assets/images/airlines/$ota_feature->thumbnail")?>" class="img-responsive" alt="" /></span></p>
                            <h5 class="strong"><?=lang('024')?> <?=$ota_feature->airports_des_name?></h5>
                            <p class="text-muted"><?=date("D, M d",strtotime(date("Y-m-d")."+6 day"))?><i class="fa fa-exchange"></i> <?=date("D, M d",strtotime(date("Y-m-d")."+7 day"));?></p>
                            <div class="clearfix"></div>
                            <!--<hr>
                            <h3 class="price"><small class="text-muted">From</small> $280</h3>-->
                        </div>
                    </a>
                <?php } ?>
            </div>
        </div>
    </div>
</section>