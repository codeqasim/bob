<style>
    body {
        background: #f2f2f2
    }

    .hideon_detail {
        display: none
    }

    .modify_area .c20 {
        width: 33% !important;
        padding-left: 15px;
    }

    .modify_area .form-group {
        margin-bottom: 0px
    }

    .modify_area {
        border-radius: 0 0 4px 4px;
    }

    .affix {
        left: 0;
        position: fixed;
        top: 0;
        width: 100%;
        z-index: 8 !important;
        scroll-behavior: smooth;
    }

    .detail .list .btn {
        top: 10px;
        margin-right: 10px;
    }

    .img img {
        width: 100%;
        height: 100%;
        transition: all 0.3s ease-in-out;
        -moz-transition: all 0.1s ease-in-out;
        -webkit-transition: all 0.1s ease-in-out;
        -o-transition: all 0.1s ease-in-out;
    }
</style>
<div class="container plr0">
    <div class="cover-area">
        <div class="cover">
            <a class="col-md-12">
                <div class="row zoomClass">
                    <img data-wow-duration="1s" data-wow-delay="3s" src="<?= $data->slider_image; ?>"
                         class="img-responsive wow fadeIn" alt=""/>
                </div>
            </a>
        </div>
        <div>
            <ul class="navbar-default wow fadeIn nav nav-tabs nav-justified hidden-xs" data-spy="affix"
                data-offset-top="390">
                <li><a style="width:100px" href=""></a></li>
                <li><a class="br1s active" href="#ROOMS"><?= lang( '042' ) ?></a></li>
                <li><a class="br1s" href="#PHOTOS"><?= lang( '047' ) ?></a></li>
                <li><a class="br1s" href="#DESCRIPTION"><?= lang( '043' ) ?></a></li>
                <li><a class="br1s" href="#LOCATION"><?= lang( '044' ) ?></a></li>
                <li><a class="br1s" href="#POLICY"><?= lang( '045' ) ?></a></li>
                <li><a href="#AMENITIES"><?= lang( '046' ) ?></a></li>
            </ul>
        </div>
        <!---->
    </div>
    <div class="dp">
        <div class="col-md-2 col-xs-4">
            <div class="img-thumbnail">
                <img data-wow-duration="0.5s" data-wow-delay="1s" src="<?php if ( ! empty( $data->thumb ) ) {
					echo $data->thumb;
				} ?>" class="img-responsive wow fadeIn" alt=""/>
            </div>
        </div>
        <div class="col-md-10 col-xs-8">
            <h3>
				<?php for ( $i = 1; $i <= $data->rating; $i ++ ) { ?>
                    <small><i class="fa fa-star text-warning"></i></small>
				<?php } ?>
                <div class="clearfix"></div>
				<?php echo $data->company_name; ?>
            </h3>
            <p><?php echo $data->address; ?></p>
        </div>
    </div>
    <div style="height:50px;width:100%;background:#ffffff;margin-top:64px" class="visible-xs"></div>
</div>
<div class="container detail">
    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default detail_hr">
                <div class="panel-heading"><?= lang( '048' ) ?></div>
                <div class="panel-body">
                    <p><i class="fa fa-map-marker"></i> <?= lang( '044' ) ?> : <?php echo $data->address; ?></p>
                    <hr>
                    <p><i class="fa fa-bed"></i> <?= lang( '049' ) ?> : <?php echo count( $data->rooms ); ?></p>
					<?php if ( ! empty( $query['from'] ) ) { ?>
                        <hr>
                        <p><i class="fa fa-clock-o"></i> <?= lang( '013' ) ?> : <?php echo $query['from']; ?></p>
					<?php }
					if ( ! empty( $query['to'] ) ) { ?>
                        <hr>
                        <p><i class="fa fa-clock-o"></i> <?= lang( '014' ) ?> : <?php echo $query['to']; ?></p>
					<?php }
					if ( ! empty( $data->mobile_number ) ) { ?>
                        <hr>
                        <p><i class="fa fa-mobile"></i> <?= lang( '062' ) ?> : <?php echo $data->mobile_number; ?></p>
					<?php }
					if ( ! empty( $data->email_address ) ) { ?>
                        <hr>
                        <p><i class="fa fa-envelope-o"></i> <?= lang( '094' ) ?> : <?php echo $data->email_address; ?>
                        </p>
					<?php } ?>
                </div>
            </div>
            <div class="anchor panel panel-default">
                <div class="scrolled" id="PHOTOS"></div>
                <div class="panel-heading"><?= lang( '047' ) ?></div>
                <div class="p5 pre-scrollable">
                    <div class="popup">
						<?php foreach ( $data->images as $img ) { ?>
                            <div class="col-md-4 col-xs-4">
                                <div class="row p5">
                                    <div class="img">
                                        <a href="<?php echo $img; ?>" title="">
                                            <img class="img-responsive" src="<?php echo $img; ?>">
                                        </a>
                                    </div>
                                </div>
                            </div>
						<?php } ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div id="LOCATION" class="panel panel-default">
                <div class="panel-heading"><?= lang( '050' ) ?></div>
                <div class="p5">
                    <div class="img">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#LOC">
                            <img class="img-responsive" src="<?php echo $theme_url; ?>assets/img/data/map.png">
                        </a>
                    </div>
                </div>
                <div id="LOC" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><?= lang( '044' ) ?></h4>
                            </div>
                            <iframe style="width:100%;height:400px"
                                    src="https://www.google.com/maps/embed/v1/place?q=<?php echo $data->latitude . "," . $data->longitude; ?>&amp;key=AIzaSyDSO3K4Tq-FSJXir6UTIdoPZllsFYMBc-0"
                                    frameborder="0" style="border:0" allowfullscreen></iframe>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal"><?= lang( '051' ) ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="DESCRIPTION" class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><?= lang( '043' ) ?></div>
                <div class="panel-body">
                    <div class="">
                        <p class="description">
							<?php echo $data->description; ?>
                        </p>
                    </div>
                </div>
            </div>
			<?php if ( $query['api_name'] == 1 ) { ?>
                <div class="panel panel-default">
                    <div class="panel-heading"
                         style="background-color: #4d4d4d; border-bottom: 2px solid #303030;color: #ffffff;">  <?= lang( '0221' ) ?>
                    </div>
                    <div class="panel-body modify_area hidden-xs availability"
                         style="margin-bottom: 0px !important;margin-top: 0px;">
                        <p><?= lang( '052' ) ?> <span
                                    class="pull-right"><?= lang( '054' ) ?> <strong><?= $nights->days; ?></strong></span>
                        </p>
                        <hr style="margin-top: 10px; margin-bottom: 10px; border: 0; border-top: 1px solid #0068d0;">
                        <div id="msg"></div>
                        <div class="row">
                            <form id="refresh_rooms" class="search_form responsive" action="" method="POST">
                                <input type="hidden" value="<?= $query['api_name']; ?>" name="api_name">
                                <input type="hidden" value="<?= $query['currency_name']; ?>" name="currency_name">
                                <input type="hidden" value="<?= $query['hotel_slug']; ?>" name="hotel_slug">
                                <div class="col-md-6 col-sm-12 col-xs-12 c20">
                                    <div class="form-group">
                                        <label><?= lang( '013' ) ?> - <?= lang( '014' ) ?></label>
                                        <input readonly type="text" required="required"
                                               placeholder="<?= lang( '013' ) ?> - <?= lang( '014' ) ?>"
                                               class="form-control checkinout" id="checkin" name="checkin"
                                               value="<?= ( ! empty( $query["from"] ) ) ? $query["from"] . ' - ' . $query["to"] : ""; ?>"
                                               autocomplete="off"/>
                                    </div>
                                </div>
                                <div class="bgfade col-md-6 col-xs-12 c20">
                                    <label><?= lang( '015' ) ?></label>
                                    <div class="clearfix"></div>
                                    <input readonly id="guest" data-toggle="collapse" data-target="#option" aria-expanded="true" aria-controls="option" type="text" value="<?= lang( '015' ) ?> <?= ( ! empty( $query["adults"] ) ) ? $query["adults"] + $query["childs"] : 1; ?>" placeholder="" name="" class="form-control">
                                    <div class="col-md-12">
                                        <div class="hidden-guest flipInX animated collapse guests col-md-2 col-xs-12" id="option" aria-expanded="true">
                                            <div class="row">
                                                <div class="col-md-12 col-xs-6">
                                                    <div class="form-horizontal">
                                                        <div class="col-md-5">
                                                            <div class="row pt5 text-center">
                                                                <strong><?= lang( '016' ) ?></strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="row">
                                                                <div class="input-group">
                                                                <span class="input-group-btn">
                                                                <button class="btn btn-secondary btn-sm" type="button" id="amin"><i class="fa fa-minus"></i></button>
                                                                </span>
                                                                    <input name="adults" id="avalue" type="text" class="form-control input-sm text-center" value="<?= ( ! empty( $query["adults"] ) ) ? $query["adults"] : 1; ?>" placeholder="2">
                                                                    <span class="input-group-btn">
                                                                <button class="btn btn-secondary btn-sm" type="button" id="aplus"><i class="fa fa-plus"></i></button>
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12 col-xs-6">
                                                    <div class="form-horizontal">
                                                        <div class="col-md-5">
                                                            <div class="row pt5 text-center">
                                                                <strong><?= lang( '017' ) ?></strong>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-7">
                                                            <div class="row">
                                                                <div class="input-group">
                                                                <span class="input-group-btn">
                                                                <button class="btn btn-secondary btn-sm" type="button"
                                                                        id="cmin"><i class="fa fa-minus"></i></button>
                                                                </span>
                                                                    <input type="text" name="child" id="cvalue"
                                                                           class="form-control input-sm text-center"
                                                                           value="<?= ( ! empty( $query["childs"] ) ) ? $query["childs"] : 0; ?>"
                                                                           placeholder="0">
                                                                    <span class="input-group-btn">
                                                                <button class="btn btn-secondary btn-sm" type="button"
                                                                        id="cplus"><i class="fa fa-plus"></i></button>
                                                                </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="clearfix"></div>
                                            <div id="hiden" class="btn btn-done btn-block"><?= lang( '07' ) ?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 c20">
                                    <div class="progress-btn">
                                        <button type="submit" class="btn btn-primary btn-lg btn-block ladda-button spin"
                                                data-style="expand-left">
                                            <span class="ladda-label"><?= lang( '010' ) ?></span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
			<?php } ?>

            <script>
                $(document).ready(function () {
                    $('.en').click(function () {
                        $('.bo').prop("disabled", !$(".en").prop("checked"));
                    })
                });
            </script>

            <div id="ROOMS" class="panel panel-default room_options">
                <div class="panel-heading"><?= lang( '049' ) ?></div>
                <div class="panel-body">
                    <?php if($query['api_name'] == 1) { ?>
                    <form action="<?=site_url('hotels/booking/')?>" method="post">
						<?php foreach ( $data->rooms as $room ) {

							if ( ! empty( $room->rooms_data ) ) {
								?>
                                <div class="list box">
                                    <div class="col-md-2 col-sm-3 col-xs-4 wow fadeIn">
                                        <div class="row">
                                            <div class="img">
                                                <img src="<?= $room->images[0]; ?>" alt="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-xs-10 col-md-10">
                                        <div class="title">
                                            <h3 class="col-md-12 pull-left">
                                                <div class="row">
                                                    <h4><?= $room->type; ?>
                                                        <button type="button" data-toggle="collapse" data-target="#info_<?= $room->id; ?>"
                                                                class="more_details pull-right">More Details
                                                        </button>
                                                    </h4>
                                                    <table class="table table-striped table-responsive table-hover">
														<?php foreach ( $room->rooms_data as $availabl_rooms ) { ?>
                                                            <tr>
                                                                <td>
																	<?=$availabl_rooms->adults?> Adults <?=$availabl_rooms->childs?> Child</td>
                                                                <td>
																	<?php if ( !empty($availabl_rooms->room_refundable) && $availabl_rooms->room_refundable == 1 ): ?>
                                                                        <i class="fa fa-check text-success"></i> Refudable
																	<?php endif; ?>
																	<?php if ( !empty($availabl_rooms->room_breakfast) && $availabl_rooms->room_breakfast == 1 ): ?>
                                                                        <i class="fa fa-check text-success"></i> Breakfast
																	<?php endif; ?>
                                                                </td>
                                                                <td>
                                                                    <select name="quantity[<?=$availabl_rooms->id?>]" >
																		<?php for ($i = 1; $i < $availabl_rooms->quantity+1; $i++ ){ ?>
                                                                            <option value="<?=$i;?>"><?=$i;?></option>
																		<?php } ?>
                                                                    </select>
                                                                </td>
                                                                <td>
																	<?= $query['currency_name']; ?>
																	<?=number_format($availabl_rooms->price);?>
                                                                    <input id="myCheckbox" name="check[]" onclick="check_count();" type="checkbox" value="<?=$availabl_rooms->id?>"/>
                                                                </td>
                                                            </tr>
                                                            <input type="hidden" name="room_adults[<?=$availabl_rooms->id?>]" value="<?=$availabl_rooms->adults;?>" >
                                                            <input type="hidden" name="room_childs[<?=$availabl_rooms->id?>]" value="<?=$availabl_rooms->childs;?>" >
                                                            <input type="hidden" name="refundable[<?=$availabl_rooms->id?>]" value="<?=$availabl_rooms->room_refundable;?>" >
                                                            <input type="hidden" name="breakfast[<?=$availabl_rooms->id?>]" value="<?=$availabl_rooms->room_breakfast;?>" >
                                                            <input type="hidden" name="room_type[<?=$availabl_rooms->id?>]" value="<?=$room->type ?>" >
                                                            <input type="hidden" name="price[<?=$availabl_rooms->id?>]"     value="<?=$availabl_rooms->price?>">
                                                            <input type="hidden" name="image[<?=$availabl_rooms->id?>]"     value="<?=$room->images[0]; ?>" >
                                                            <input type="hidden" name="room_policy[<?=$availabl_rooms->id?>]"     value="<?=$availabl_rooms->id?>" >
                                                            <input type="hidden" name="room_id[<?=$availabl_rooms->id?>]"     value="<?=$availabl_rooms->room_id?>" >
														<?php } ?>
                                                    </table>
                                                </div>
                                            </h3>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>

                                <div id="info_<?= $room->id; ?>" class="collapse">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><?= $room->type; ?></div>
                                        <div class="panel-body">

                                            <div class="row">
												<?php foreach ( $room->images as $image ) { ?>
                                                    <div class="col-md-3">
                                                        <img style="height: 120px;width: 150px;margin: 2px;" src="<?=$image?>" class="img-responsive" alt=""/>
                                                    </div>
												<?php } ?>
                                            </div>
                                            <br>
                                            <p>
												<?=$room->room_descriptions;?>
                                            </p>
                                            <div class="row">
												<?php foreach ( $room->amenities as $amenity ) { ?>
                                                    <div class="col-md-4">
                                                        <i class="fa fa-check text-success"></i>
														<?=$amenity->title;?>
                                                    </div>
												<?php } ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
							<?php }
						} ?>
                        <input type="hidden" name="checkin" value="<?php echo $query['from']; ?>">
                        <input type="hidden" name="checkout" value="<?php echo $query['to'];?>">
                        <input type="hidden" name="adults" value="<?php echo $query['adults'];?>">
                        <input type="hidden" name="childs" value="<?php echo $query['childs'];?>">
                        <input type="hidden" name="supplier_id" value="<?php echo $room->supplier_id;?>">
                        <input type="hidden" name="api_name" value="<?php echo $query['api_name'];?>">
                        <input type="hidden" name="hotel_id" value="<?php echo $data->id;?>">
                        <input type="hidden" name="company_name" value="<?php echo $data->company_name;?>">
                        <input type="hidden" name="address" value="<?php echo $data->address;?>">
                        <input type="hidden" name="slider_image" value="<?php echo $data->slider_image;?>">
                        <input type="hidden" name="ratings" value="<?php echo $data->rating;?>">
                        <input type="hidden" name="currency_name" value="<?php echo $query['currency_name'];?>">
                        <div class="progress-btn">
                            <button disabled type="submit" class="btn btn-success btn-lg btn-block ladda-button form_button spin bo" data-style="expand-left">
                                <span id="book" class="ladda-label"><?= lang( '055' ) ?></span></button>
                        </div>
                    </form>
                    <?php } else if($query['api_name'] == 3){ ?>
	                    <?php foreach ($data->rooms as $room) { ?>
                            <div class="list box">
                                <div class="col-md-2 col-sm-3 col-xs-4 wow fadeIn">
                                    <div class="row">
                                        <div class="img">
                                            <img src="<?=(!empty($room->images[0]))?$room->images[0]:""; ?>" alt="">
                                            <!--                                        <a href="--><?php //$slugs = (!empty($booking_url)) ? '/' . $booking_url : ''; ?><!--">-->
                                            <!--                                            -->
                                            <!--                                        </a>-->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-xs-8 col-sm-9 col-md-10">
                                    <div class="title mt10">
                                        <h3 class="col-md-8 pull-left">
                                            <div class="row">
							                    <?php echo $room->room_name; ?><br>
                                                <small><?php echo $room->type; ?></small>
                                                <!--                                            <a class="ellipsis"-->
                                                <!--                                               href="--><?php //echo base_url('hotels/booking/' . $data->hotel_slug . '/' . $room->room_slug); ?><!--"></a>-->
                                            </div>
                                        </h3>

                                        <h3 class="col-md-4 text-right">
                                            <div class="listing_price">
                                                <small><?php echo $_SESSION['curr_session']->code; ?></small>
                                                <strong><?php echo number_format(ceil(currency_converter($data->currency_name,$_SESSION['curr_session']->code,$room->price))); ?></strong></div>
                                        </h3>
                                        <div class="clearfix"></div>
                                        <p><?=(!empty($room->adults))?$room->adults:1?> Adults - <?=(!empty($room->childs))?$room->childs:0?> Child</p>
                                    </div>
                                    <hr style="margin-top: -3px !important;">
                                    <form method="post" action="<?= base_url('hotels/booking/');?>">
                                        <input type="hidden" name="checkin" value="<?=$query['from'];?>">
                                        <input type="hidden" name="checkout" value="<?= $query['to']; ?>">
                                        <input type="hidden" name="adults" value="<?= $query['adults']; ?>">
                                        <input type="hidden" name="childs" value="<?= $query['childs']; ?>">
                                        <input type="hidden" name="room_id" value="<?= $room->id; ?>">
                                        <input type="hidden" name="quantity" value="1">
                                        <input type="hidden" name="supplier_id" value="<?php echo $room->supplier_id;?>">
                                        <input type="hidden" name="api_name" value="<?= $query['api_name']; ?>">
                                        <input type="hidden" name="hotel_id" value="<?= $data->id; ?>">
                                        <input type="hidden" name="company_name" value="<?= $data->company_name; ?>">
                                        <input type="hidden" name="city" value="<?= $data->address; ?>">
                                        <input type="hidden" name="ratings" value="<?= $data->rating; ?>">
                                        <input type="submit" value="Book Now" class="btn btn-primary">
                                        <span class="rooms_desc hidden-xs"><?php echo substr($room->room_descriptions, 0, 100); ?></span>
                                    </form>
                                </div>
                                <div class="clearfix"></div>
                            </div>
	                    <?php } ?>
                    <?php } ?>
                </div>
            </div>

			<?php if ( ! empty( $data->hotel_policy ) ) { ?>
                <div id="POLICY" class="panel panel-default">
                    <div class="panel-heading"><?= lang( '053' ) ?></div>
                    <div class="panel-body">
						<?php echo $data->hotel_policy; ?>
                    </div>
                </div>
			<?php } ?>
            <div id="AMENITIES" class="panel panel-default">
                <div class="panel-heading"><?= lang( '046' ) ?></div>
                <div class="panel-body">
					<?php foreach ( $data->amenities as $am ) { ?>
                        <p class="col-md-6 col-xs-12"><i class="fa fa-check text-success"></i> <?php echo $am->title; ?>
                        </p>
					<?php } ?>
                    <div class="clearfix"></div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(".checkinout").caleran({
        showOn: "bottom",
        autoAlign: false,
        showHeader: false,
        autoCloseOnSelect: true,
        minDate: "<?=date( 'Y-m-d' );?>",
        calendarCount: 2,
        format: "YYYY-MM-DD",
        singleDate: false,
    });
</script>
<script>
    function scrollNav() {
        $('.nav-justified a').click(function () {
            //Animate
            $('html, body').stop().animate({
                scrollTop: $($(this).attr('href')).offset().top - 100
            }, 400);
            return false;
        });
        $('.scrollTop a').scrollTop();
    }

    scrollNav();
</script>
<script>
    $("#hiden").click(function () {
        $(".hidden-guest").removeClass("in")
    });
    $('#amin').off().on('click', function () {
        if ($("#avalue").val() > 1) {
            $("#avalue").val($("#avalue").val() - 1);
            $("#guest").val("Guest ".concat(parseInt($("#guest").val().split(" ")[1]) - 1))
        }
    });
    $('#aplus').off().on('click', function () {
        if ($("#avalue").val() < 9) {
            $("#avalue").val(parseInt($("#avalue").val()) + 1);
            $("#guest").val("Guest ".concat(parseInt($("#guest").val().split(" ")[1]) + 1))
        }
    });
    $('#cmin').off().on('click', function () {
        if ($("#cvalue").val() > 0) {
            $("#cvalue").val($("#cvalue").val() - 1);
            $("#guest").val("Guest ".concat(parseInt($("#guest").val().split(" ")[1]) - 1))
        }
    });
    $('#cplus').off().on('click', function () {
        if ($("#cvalue").val() < 5) {
            $("#cvalue").val(parseInt($("#cvalue").val()) + 1);
            $("#guest").val("Guest ".concat(parseInt($("#guest").val().split(" ")[1]) + 1))
        }
    });

</script>
<script>
    function submitForm() {
        $("#post_request").submit();
    }

    $(document).ready(function () {
        $(".description").shorten();
        $(".description-small").shorten({showChars: 10});
        check_count();
    });

    (function ($) {
        $.fn.shorten = function (settings) {
            "use strict";
            var config = {
                showChars: 500,
                minHideChars: 10,
                ellipsesText: "...",
                moreText: "<div class='btn btn-default btn-sm' style='width:100px;margin-top:10px;'>Read More</div>",
                lessText: "<div class='btn btn-default btn-sm' style='width:100px;margin-top:10px;'>less</div>",
                onLess: function () {
                },
                onMore: function () {
                },
                errMsg: null,
                force: !1
            };
            if (settings) {
                $.extend(config, settings)
            }
            if ($(this).data('jquery.shorten') && !config.force) {
                return !1
            }
            $(this).data('jquery.shorten', !0);
            $(document).off("click", '.morelink');
            $(document).on({
                click: function () {
                    var $this = $(this);
                    if ($this.hasClass('less')) {
                        $this.removeClass('less');
                        $this.html(config.moreText);
                        $this.parent().prev().animate({'height': '0' + '%'}, function () {
                            $this.parent().prev().prev().show()
                        }).hide('fast', function () {
                            config.onLess()
                        })
                    } else {
                        $this.addClass('less');
                        $this.html(config.lessText);
                        $this.parent().prev().animate({'height': '100' + '%'}, function () {
                            $this.parent().prev().prev().hide()
                        }).show('fast', function () {
                            config.onMore()
                        })
                    }
                    return !1
                }
            }, '.morelink');
            return this.each(function () {
                var $this = $(this);
                var content = $this.html();
                var contentlen = $this.text().length;
                if (contentlen > config.showChars + config.minHideChars) {
                    var c = content.substr(0, config.showChars);
                    if (c.indexOf('<') >= 0) {
                        var inTag = !1;
                        var bag = '';
                        var countChars = 0;
                        var openTags = [];
                        var tagName = null;
                        for (var i = 0, r = 0; r <= config.showChars; i++) {
                            if (content[i] == '<' && !inTag) {
                                inTag = !0;
                                tagName = content.substring(i + 1, content.indexOf('>', i));
                                if (tagName[0] == '/') {
                                    if (tagName != '/' + openTags[0]) {
                                        config.errMsg = 'ERROR en HTML: the top of the stack should be the tag that closes'
                                    } else {
                                        openTags.shift()
                                    }
                                } else {
                                    if (tagName.toLowerCase() != 'br') {
                                        openTags.unshift(tagName)
                                    }
                                }
                            }
                            if (inTag && content[i] == '>') {
                                inTag = !1
                            }
                            if (inTag) {
                                bag += content.charAt(i)
                            } else {
                                r++;
                                if (countChars <= config.showChars) {
                                    bag += content.charAt(i);
                                    countChars++
                                } else {
                                    if (openTags.length > 0) {
                                        for (j = 0; j < openTags.length; j++) {
                                            bag += '</' + openTags[j] + '>'
                                        }
                                        break
                                    }
                                }
                            }
                        }
                        c = $('<div/>').html(bag + '<span class="ellip">' + config.ellipsesText + '</span>').html()
                    } else {
                        c += config.ellipsesText
                    }
                    var html = '<div class="shortcontent">' + c + '</div><div class="allcontent">' + content + '</div><span><a href="javascript://nop/" class="morelink">' + config.moreText + '</a></span>';
                    $this.html(html);
                    $this.find(".allcontent").hide();
                    $('.shortcontent p:last', $this).css('margin-bottom', 0)
                }
            })
        }
    })(jQuery)

    $('#refresh_rooms').submit(function (e) {
        e.preventDefault();
        var form_data = $('#refresh_rooms').serializeArray();
        var slug = 'hotel/';
        slug += form_data[2].value + "/";
        var date_array = form_data[3].value.split(" ");
        var checkin = date_array[0];
        slug += checkin.replace(/\//g, '-') + '/';

        var checkout = date_array[2];
        slug += checkout.replace(/\//g, '-') + '/';
        slug += form_data[4].value + '/';
        slug += form_data[5].value + '/';
        slug += form_data[0].value;
        window.location = "<?php echo base_url(); ?>" + slug;
    });

    function check_count() {
        var n = $("input:checked").length;
        if(n == 0) {
            $('.form_button').prop("disabled", true);
        } else {
            $('.form_button').prop("disabled", false);
        }
    }
</script>