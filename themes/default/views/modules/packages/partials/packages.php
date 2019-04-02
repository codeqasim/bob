<div id="hotel-partial" data-total="<?php echo $list->total_records; ?>">
    <?php if (isset($list->hotels) && count($list->hotels) > 0): foreach ($list->hotels as $h) { ?>
            <div class="list mb10">
                <section class="row">
                    <div class="col-sm-12 col-md-12">
                        <div class="col-md-3 col-sm-3 col-xs-4 wow fadeIn">
                            <div class="row bgdark">
                                <div class="img">
                                    <div class="review_score"><strong><?php echo $h->rating; ?>/5</strong></div>
                                    <a href="<?php $slugs = (isset($booking_url)) ? '/'.$booking_url : '';
                                                    echo base_url('hotels/'.$h->country.'/'.$h->city.'/'.$h->slug_name.$slugs);?>">
                                        <?php if ($h->image_url) { ?>
                                            <img src="<?php echo $list->image_path . 'thumbs/' . $h->image_url; ?>" alt="<?php echo $h->name; ?>">
                                        <?php } else { ?>
                                            <img src="<?php echo $theme_url; ?>assets/img/hotel.jpg" alt="<?php echo $h->name; ?>">
                                         <?php } ?>
                                        <img src="<?php echo $theme_url; ?>assets/img/overlay.png" alt="<?php echo $h->name; ?>">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-xs-8 col-sm-9 col-md-9 hotelInfo">
                            <div class="title mt10">
                                <h3 class="col-md-8 pull-left">
                                    <div class="row">
                                        <a class="ellipsis" href="<?php echo base_url('hotels/'.$h->country.'/'.$h->city.'/'.$h->slug_name.$slugs);?>"><?php echo $h->name; ?></a>
                                    </div>
                                </h3>
                                <h3 class="col-md-4 text-right">
                                    <div class="listing_price"><small>USD</small> <strong>$<?php echo $h->price; ?></strong></div>
                                </h3>
                                <div class="clearfix"></div>
                                <p><i class="icon-location-6"></i><?php echo ucwords($h->city); ?><span class="stars"><?php for ($j = 1; $j <= $h->rating; $j++) { ?> <i class="fa fa-star text-warning"></i><?php } ?></span></p>
                            </div>
                            <hr>
                            <p class="fs12 hidden-xs"><?php echo substr($h->description, 0, 200); ?></p>
                            <div class="row">
                                <div class="col-md-12 col-xs-12">
                                    <a href="<?php echo base_url('hotels/'.$h->country.'/'.$h->city.'/'.$h->slug_name.$slugs);?>" class="btn btn-primary" title="">Book Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <div class="clear"></div>
            </div>
    <?php } else: echo 'No record found';
endif;
?>
</div>