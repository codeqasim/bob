<?php if ( ! empty( $list ) && count( $list ) > 0 ) {
	foreach ( $list as $h ) { ?>
        <div class="list mb10" id="<?php echo ceil( $h['price'] ); ?>">
            <section class="row">
                <div class="col-sm-12 col-md-12">
                    <div class="col-md-3 col-sm-3 col-xs-3 wow fadeIn">
                        <div class="row bgdark">
                            <div class="img res_img">
                                <div class="review_score"><strong><i
                                                class="fa fa-thumbs-o-up"></i> <?php echo $h['rating']; ?>/5</strong>
                                </div>
                                <a href="<?php echo base_url( 'hotel/' . $h['hotel_slug'] . "/" . $search['from'] . "/" . $search['to'] . "/" . $search['adults'] . "/" . $search['childs'] . "/" . $h['api_name'] ); ?>">
                                    <img src="<?php echo $h['image']; ?>" alt="<?php echo $h['company_name']; ?>">
                                    <img src="<?php echo $theme_url; ?>assets/img/overlay.png"
                                         alt="<?php echo $h['company_name']; ?>">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xs-9 col-sm-9 col-md-9 hotelInfo">
                        <div class="title mt10">
                            <h3 class="col-md-8 pull-left">
                                <div class="row">
                                    <a class="ellipsis"
                                       href="<?php echo base_url( 'hotel/' . $h['hotel_slug'] . "/" . $search['from'] . "/" . $search['to'] . "/" . $search['adults'] . "/" . $search['childs'] . "/" . $h['api_name'] ); ?>"><?php echo $h['company_name']; ?></a>
                                </div>
                            </h3>
                            <h3 class="col-md-4 text-right">
                                <div class="listing_price">
                                    <small><?= strtoupper( $_SESSION['curr_session']->code ); ?></small>
                                    <strong><?php echo ceil( $h['price'] ); ?>
                                    </strong>
                                </div>
                            </h3>
                            <div class="clearfix"></div>
                            <p><i class="icon-location-6"></i><?php echo ucwords( $h['city_name'] ); ?><span
                                        class="stars"><?php for ( $j = 1; $j <= $h['rating']; $j ++ ) { ?> <i
                                            class="fa fa-star text-warning"></i><?php } ?></span></p>
                        </div>
                        <hr class="hidden-xs">
                        <div class="fs12 hidden-xs"><?php echo substr( $h['description'], 0, 160 ); ?></div>
                        <div class="row">
                            <div class="">
                                <a href="<?php echo base_url( 'hotel/' . $h['hotel_slug'] . "/" . $search['from'] . "/" . $search['to'] . "/" . $search['adults'] . "/" . $search['childs'] . "/" . $h['api_name'] ); ?>"
                                   class="btn btn-primary" title="">Book Now</a>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <div class="clear"></div>
        </div>
	<?php } ?>
    <input type="hidden" id="total" value="<?php echo $total; ?>"/>
    <input type="hidden" id="offset" value="20"/>
<?php }  ?>
