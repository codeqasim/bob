<section class="featured-destinations feature bgb">
    <div class="container line">
        <div class="col-md-12">
            <h6><?=lang('021')?> <?=lang('01001')?></h6>
            <div class="clearfix"></div>
            <ul class="featured_hotels">
                <?php foreach ($ota_modules->hotels->feature_cities as $feature_cities){ ?>
                <li><a href="<?php echo base_url("hotels/".strtolower(str_replace(' ','-',$feature_cities->city))."/".date('Y-m-d')."/".date('Y-m-d', strtotime(date('Y-m-d') . "+1 day"))."/1/0/"); ?>" style="background-image:url(<?php echo $feature_cities->image; ?>) !important;" class="col-xs-12 wow fadeIn"><span class="wow fadeInUp"><?=strtolower($feature_cities->city)?></span></a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</section>