<?php
$ota_modules = $_SESSION['ota_data']->ota_modules;
?>
    <style>
        body {
            background-color: #f4f6f8
        }

        .panel-primary .panel-heading label {
            color: #fff;

        }

        .panel-danger .panel-heading label {
            color: #fff;
        }

        .affix {
            top: 25px;
            z-index: 9999 !important
        }

        .notice {
            padding: 5px;
            padding-left: 20px;
            background-color: #fff;

            margin-bottom: 20px;
            -webkit-box-shadow: 0 5px 8px -6px rgba(0, 0, 0, .6);
            -moz-box-shadow: 0 5px 8px -6px rgba(0, 0, 0, .6);
            box-shadow: 0 5px 8px -6px rgba(0, 0, 0, .6)
        }

        .notice-info {
            border-color: #45abcd
        }

        .notice-primary {
            border-left: 6px solid green;
        }

        .notice-danger {
            border-left: 6px solid red;
        }

        .text-red {
            color: red
        }
    </style>
<?php if ( $data['count'] > 9 && ( $_SERVER['HTTP_HOST'] != 'ajubia.com' || $_SERVER['HTTP_HOST'] != 'localhost' ) ) { ?>
    <div class="container">
        <br><br>
        <div class="notice notice-danger">
            <h4><i class="fa fa-ban" style="color:red"></i> You have already booked more than 5 hotels.</h4>
            <p>Please try later</p>
        </div>
    </div>
    <div style="margin-bottom: 200px;"></div>
<?php } else { ?>
    <div id="top_timer" style="margin-top:-25px;width:100%;z-index:9999" data-spy="affix" data-offset-top="102"
         class="alert alert-danger" style="color: white; height: 60px;">
        <div class="container">
            <h3 class="text-center" style="margin:0"><?= lang( '071' ) ?> : <span id="timer">10:00</span></h3>
        </div>
    </div>
    <input type="hidden" id="submit_form">
    <div class="container booking">
        <div id="saving_booking"></div>
		<?php if ( $user_data->is_login == true ) { ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="notice notice-primary">
                        <h4><i class="fa fa-check" style="color:green"></i> You are already Logged In.</h4>
                    </div>
                </div>
            </div>
		<?php } ?>
        <form action="<?php echo base_url( 'hotels/save_booking' ); ?>" method="post" id="booking_form">
            <div class="row">
                <div class="col-md-8">
					<?php include $include_path . 'views/account/booking_user.php'; ?>
                    <div class="panel panel-primary guest">
                        <div class="panel-heading">
                            <label data-toggle="collapse" data-target="#special" aria-expanded="false"
                                   aria-controls="special" class="control control--checkbox ellipsis fs14">
								<?= lang( '072' ) ?>
                                <input type="checkbox"/>
                                <div class="control__indicator"></div>
                            </label>
                        </div>
                        <div id="special" aria-expanded="false" class="collapse">
                            <div class="panel-body">
                                <textarea name="special_request" placeholder="<?= lang( '072' ) ?>" class="form-control"
                                          cols="30" rows="5" value="Nothing Special"></textarea>
                            </div>
                        </div>
                    </div>
					<?php if ( $ota_modules->hotels->pay_online == 1 || $ota_modules->hotels->pay_later == 1 ) { ?>
                        <div class="panel panel-default guest">
                            <div class="panel-heading">Payment Details</div>
                            <div class="panel-body">
                                <div class="well">
                                    <div class="row">
                                        <div class="col-md-4"><label for="email"><?= lang( '074' ) ?>*</label></div>
                                        <div class="col-md-8">
											<?php if ($ota_modules->hotels->pay_online) { ?>
                                                <div class="col-md-6">
                                                    <label for="pay_online_input" class="control control--radio">
                                                        <strong><?= lang( '075' ) ?></strong>
                                                        <input checked type="radio" name="payment_method"
                                                               id="pay_online_input"
                                                               value="pay_online" data-target="#pay_online"/>
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                </div>
											<?php } ?>
											<?php if ( $ota_modules->hotels->pay_later ) { ?>
                                                <div class="col-md-6">
                                                    <label for="pay_later_input" class="control control--radio">
                                                        <strong><?= lang( '076' ) ?></strong>
                                                        <input type="radio" id="pay_later_input" name="payment_method"
                                                               value="pay_later" <?php if($ota_modules->hotels->pay_online == 0){ ?>checked="checked"<?php } ?>  data-target="#pay_later"/>
                                                        <div class="control__indicator"></div>
                                                    </label>
                                                </div>
											<?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <script>
                                    $('input[name="payment_method"]').click(function () {
                                        $(this).tab('show');
                                    });
                                </script>

                                <div class="tab-content">
									<?php if ( $ota_modules->hotels->pay_online ) { ?>
                                        <div id="pay_online" class="tab-pane active">
											<?php if ( $params['api_name'] == 1 ) { ?>
												<?php
												if ( ! empty( $payment_gateways ) ) {
													$i = 1;
													foreach ( $payment_gateways as $payment_gateway ): ?>
                                                        <div class="col-md-12">
                                                            <label for="<?= $payment_gateway['id'] ?>"
                                                                   class="control control--radio">
                                                                <strong><img
                                                                            src="<?= site_url( $payment_gateway['image'] ); ?>"
                                                                            style="max-height: 35px;margin-top:-7px;"
                                                                            class="img-thumbnail"></strong>
                                                                <input type="radio" name="payment_gateway"
																       <?php if ( $i == 1 ){ ?>checked="checked"<?php } ?>
                                                                       id="<?= $payment_gateway['id'] ?>"
                                                                       value="<?= $payment_gateway['id'] ?>">
                                                                <div class="control__indicator"></div>
                                                            </label>
                                                        </div>
														<?php
														$i ++;
													endforeach;
												}
											} else { ?>
                                                <input type="hidden" name="payment_gateway" value="0">
                                                <hr>
                                                <div class="row">
                                                    <div class="col-sm-7">
                                                        <p><?= lang( '077' ) ?></p>
                                                        <p><?= lang( '078' ) ?></p>
                                                    </div>
                                                    <div class="col-sm-5">
                                                        <img class="pull-right img-responsive"
                                                             src="<?php echo $theme_url; ?>assets/img/visa.png">
                                                    </div>
                                                </div>
                                                <div class="credit-card__strike" style="display:none;">
                                                    <span class="credit-card__strike-text h4 text-chambray"><?= lang( '079' ) ?></span>
                                                </div>
                                                <hr style="display: none;">
                                                <div class="row credit-card__form-container">
                                                    <div class="col-md-7">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="ccname"><?= lang( '080' ) ?>*</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input type="text" class="form-control"
                                                                       placeholder="Your Name"
                                                                       id="name_card"
                                                                       name="name_card" value="David Baker">

                                                            </div>
                                                        </div>
                                                        <div class="clearfix">&nbsp;</div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for="cardNumber"><?= lang( '081' ) ?>*</label>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <input class="form-control" id="card_no"
                                                                       required="required"
                                                                       name="card_no"
                                                                       type="text"
                                                                       placeholder="xxxx-xxxx-xxxx-xxxx"
                                                                       value="4580458045804580">

                                                            </div>
                                                        </div>
                                                        <div class="clearfix">&nbsp;</div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""><?= lang( '083' ) ?>*</label>
                                                            </div>
                                                            <div class="clearfix visible-xs visible-sm">&nbsp;</div>
                                                            <div class="col-md-4">
                                                                <select class="form-control" required="required"
                                                                        name="month">
																	<?php for ( $m = 1; $m <= 12; ++ $m ) { ?>
                                                                        <option <?php if ( $m == date( 'm' ) ) {
																			echo "selected";
																		} ?> value="<?php echo $m; ?>"><?php echo sprintf( "%02d", $m ) . ' - ' . date( 'F', mktime( 0, 0, 0, $m, 1 ) ); ?></option>
																	<?php } ?>
                                                                </select>
                                                            </div>
                                                            <div class="clearfix visible-xs visible-sm">&nbsp;</div>
                                                            <div class="col-md-4">
                                                                <select class="form-control" required="required"
                                                                        name="year">
																	<?php for ( $y = date( 'Y' ); $y < date( "Y", strtotime( date( "Y-m-d" ) . "+10 Years" ) ); $y ++ ) { ?>
                                                                        <option label="<?= $y; ?>"
                                                                                value="<?= $y; ?>" <?php if ( $y == date( 'Y' ) ) {
																			echo 'selected';
																		} ?>><?= $y; ?></option>
																	<?php } ?>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="clearfix">&nbsp;</div>
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <label for=""><?= lang( '0119' ) ?>*</label>
                                                            </div>
                                                            <div class="col-md-4 col-xs-8">
                                                                <input type="text" required="required"
                                                                       name="security_code"
                                                                       class="form-control" placeholder="***"
                                                                       value="123">
                                                            </div>
                                                            <div class="col-md-4 col-xs-4"></div>
                                                        </div>
                                                    </div>
                                                    <div class="clearfix visible-xs visible-sm">&nbsp;</div>
                                                    <div class="col-md-5">
                                                        <div class="secure-panel">
                                                            <div class="panel-body">
                                                                <div class="col-md-2">
                                                                    <div class="row">
                                                                        <img src="<?php echo $theme_url; ?>assets/img/lock-icon.png"
                                                                             class="img-responsive" alt="secure"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="text-success">
                                                                        <strong><?= lang( '0132' ) ?></strong>
                                                                    </div>
																	<?= lang( '0133' ) ?>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <hr>
                                                                <div class="col-md-2">
                                                                    <div class="row">
                                                                        <img src="<?php echo $theme_url; ?>assets/img/shield-icon.png"
                                                                             class="img-responsive" alt="secure"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="text-success">
                                                                        <strong><?= lang( '0134' ) ?></strong>
                                                                    </div>
																	<?= lang( '0135' ) ?>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <hr>
                                                                <div class="col-md-2">
                                                                    <div class="row">
                                                                        <img src="<?php echo $theme_url; ?>assets/img/credit-card-checkmark.png"
                                                                             class="img-responsive" alt="secure"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-10">
                                                                    <div class="text-success">
                                                                        <strong><?= lang( '0136' ) ?></strong>
                                                                    </div>
																	<?= lang( '0137' ) ?>
                                                                </div>
                                                                <div class="clearfix"></div>
                                                                <hr>
                                                                <img src="<?php echo $theme_url; ?>assets/img/credit-cards.png"
                                                                     alt="availble credit cards"
                                                                     class="img-responsive center-block">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											<?php } ?>
                                        </div>
									<?php } ?>
									<?php if ( $ota_modules->hotels->pay_later ) { ?>
                                        <div id="pay_later" class="tab-pane"></div>
									<?php } ?>
                                </div>

                            </div>
                        </div>
                        <p>
                            <small><?= lang( '0138' ) ?></small>
                        </p>
                        <div class="progress-btn">
                            <button style="height:60px"
                                    class="btn btn-success btn-block ladda-button spin booking_botton"
                                    data-style="expand-left"><span
                                        class="ladda-label"><?= lang( '0139' ) ?></span></button>
                        </div>
					<?php } ?>
                </div>
                <div class="col-md-4 summary">
                    <div class="row">
                        <h4><?= lang( '0140' ) ?></h4>
                        <hr>
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?= ( ! empty( $params['slider_image'] ) ) ? $params['slider_image'] : ""; ?>"
                                     class="img-responsive" alt="">
                            </div>
                            <div class="col-md-8">
                                <div class="row">
                                    <h6 class="m0"><strong><?php echo $params['company_name']; ?></strong></h6>
                                    <p class="m0"><?php echo $params['address']; ?></p>
                                    <p class="m0">
										<?php for ( $i = 1; $i <= $params['ratings']; $i ++ ) { ?>
                                            <i class="fa fa-star text-warning"></i>
										<?php } ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hotel_details_panel__checkout">
                                    <ul class="no-margin no-padding">
                                        <li><b> <?= lang( '013' ) ?> <?= lang( '031' ) ?></b><span
                                                    class="pull-right"><?php echo $formated_checkin; ?></span>
                                        </li>
                                        <li><b> <?= lang( '014' ) ?> <?= lang( '031' ) ?></b><span
                                                    class="pull-right"><?php echo $formated_checkout; ?></span>
                                        </li>
                                        <li><b> <?= lang( '0170' ) ?> </b> <span
                                                    class="pull-right"><?php echo $nights->format( "%a" ); ?></span>
                                        </li>
                                    </ul>

                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading"><?= lang( '0167' ) ?></div>
                            <div class="panel-body m0">
								<?php
								$i     = 0;
								$total = 0;

								if ( $params['api_name'] == 1 ) {

									foreach ( $rooms as $room ):
										$total = $total + ( $room['quantity'] * $room['price'] );
										?>
                                        <p class="m0"><i class="fa fa-bed"></i> <?= $i + 1; ?>
                                            <strong><?php echo $room['room_type']; ?></strong>
                                            <span class="pull-right">For <?php echo $room['room_adults']; ?> <?= lang( '016' ) ?> - <?php echo $room['room_childs']; ?> <?= lang( '017' ) ?></span>
                                        </p>
                                        <hr>
										<?php if ( $room['refundable'] == 0 ) { ?>
                                        <p class="m0 text-danger strong"><i
                                                    class="fa fa-info-circle"></i> <?= lang( '0168' ) ?></p>
									<?php } else { ?>
                                        <p class="m0 text-success strong"><?= lang( '0169' ) ?></p>
									<?php } ?>
                                        <br>
                                        <input type="hidden" name="checkin" value="<?=$checkin?>">
                                        <input type="hidden" name="checkout" value="<?=$checkout?>">
                                        <input type="hidden" name="stay" value="<?=$nights->format( "%a" )?>">
                                        <input type="hidden" name="rooms[<?= $i; ?>][room_id]"
                                               value="<?= $room['room_id'] ?>">
                                        <input type="hidden" name="rooms[<?= $i; ?>][room_quantity]"
                                               value="<?= $room['quantity'] ?>">
                                        <input type="hidden" name="rooms[<?= $i; ?>][price]"
                                               value="<?= $room['price'] ?>">
                                        <input type="hidden" name="rooms[<?= $i; ?>][checkin]"
                                               value="<?= $params['checkin'] ?>">
                                        <input type="hidden" name="rooms[<?= $i; ?>][checkout]"
                                               value="<?= $params['checkout'] ?>">
                                        <input type="hidden" name="rooms[<?= $i; ?>][adults]"
                                               value="<?= $params['adults'] ?>">
                                        <input type="hidden" name="rooms[<?= $i; ?>][childs]"
                                               value="<?= $params['childs'] ?>">
                                        <input type="hidden" name="rooms[<?= $i; ?>][room_policy]"
                                               value="<?= $room['room_policy'] ?>">
                                        <input type="hidden" name="rooms[<?= $i; ?>][hotel_id]"
                                               value="<?= $params['hotel_id'] ?>">
                                        <input type="hidden" name="rooms[<?= $i; ?>][currency_code]"
                                               value="<?= $params['currency_name'] ?>">
										<?php $i ++; endforeach;
								} elseif ( $params['api_name'] == 3 ) {

									$total = $rooms->price;
									?>
                                    <p class="m0"><i class="fa fa-bed"></i> <?= $i + 1; ?>
                                        <strong><?php echo $rooms->type; ?></strong>
                                        <span class="pull-right">For  <?php echo $rooms->adults; ?> <?= lang( '016' ) ?> -  <?php echo $rooms->childs; ?><?= lang( '017' ) ?></span>
                                    </p>
                                    <hr>
									<?php if ( $rooms->refundable == 0 ) { ?>
                                        <p class="m0 text-danger strong"><i
                                                    class="fa fa-info-circle"></i> <?= lang( '0168' ) ?></p>
									<?php } else { ?>
                                        <p class="m0 text-success strong"><?= lang( '0169' ) ?></p>
									<?php } ?>
                                    <br>
                                    <input type="hidden" name="rooms[0][room_id]" value="<?= $rooms->id ?>">
                                    <input type="hidden" name="rooms[0][room_quantity]" value="1">
                                    <input type="hidden" name="rooms[0][price]" value="<?= $rooms->price ?>">
                                    <input type="hidden" name="rooms[0][checkin]" value="<?= $params['checkin'] ?>">
                                    <input type="hidden" name="rooms[0][checkout]" value="<?= $params['checkout'] ?>">
                                    <input type="hidden" name="rooms[0][adults]" value="<?= $params['adults'] ?>">
                                    <input type="hidden" name="rooms[0][childs]" value="<?= $params['childs'] ?>">
                                    <input type="hidden" name="rooms[0][hotel_id]" value="<?= $params['hotel_id'] ?>">
                                    <input type="hidden" name="rooms[0][currency_code]"
                                           value="<?= $params['currency_name'] ?>">
								<?php } ?>
                            </div>
                        </div>
                        <div class="form-group total-wrapper">
                            <div class="total_msg">
								<?= lang( '0144' ) ?> <span
                                        class="pull-right"><?php echo $_SESSION['curr_session']->code; ?>&nbsp;0.00</span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <h4>
                                        <div class="pull-left"><?= lang( '0145' ) ?></div>
                                        <div class="pull-right">
                                            <strong><?php echo $_SESSION['curr_session']->code; ?><?php echo number_format( $total ); ?></strong>
                                        </div>
                                    </h4>
									<?php if ( $_SESSION['curr_session']->code != $params['currency_name'] ) { ?>
                                        <div class="well well-sm"
                                             style="margin-top: 34px;color:#000000 !important;background:white;border: 4px solid #eee;">
											<?= lang( '0146' ) ?> <?php echo $params['currency_name']; ?>
                                            <span class="pull-right">
                                    <strong>
                                        <h4 style="padding: 0px;margin: 0px;"><?php echo $params['currency_name'] . " " . number_format( $total ); ?></h4>
                                    </strong>
                                </span>
                                        </div>
									<?php } ?>
                                </div>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="panel">
                            <div class="panel-heading">
                                <h3 class="panel-title coupon-form__panel-title"><?= lang( '0147' ) ?></h3>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="input-group btn-block">
                                            <input placeholder="Enter Voucher Code" class="form-control" value=""
                                                   name="voucher">
                                            <br>
                                            <div class="clearfix"></div>
                                            <br>
                                            <button class="btn btn-success btn-block"><?= lang( '0148' ) ?></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-white">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong><?= lang( '0149' ) ?></strong></h3>
                            </div>
                            <div class="panel-body text-chambray">
                                <p><?= lang( '0150' ) ?></p>
                                <hr>
                                <p><i class="fa fa-phone"></i> +<?php if ( ! empty( $ota_cms->contact->phone ) ) {
										echo $ota_cms->contact->phone;
									} else {
										echo "123 456 789 ";
									} ?></p>
                                <hr>
                                <p><i class="fa fa-envelope-o"></i> <?php if ( ! empty( $ota_cms->contact->email ) ) {
										echo $ota_cms->contact->email;
									} else {
										echo "help@travelservice.com";
									} ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="supplier_id" value="<?php echo $params['supplier_id']; ?>"/>
            <input type="hidden" name="currency_code" value="<?php echo $params['currency_name']; ?>"/>
            <input type="hidden" name="user_status" value="<?php echo ( $user_data->is_login ) ? 1 : 0; ?>"/>
            <input type="hidden" name="user_id" value="<?php echo $user_data->user_id; ?>"/>
            <input type="hidden" name="api_name" value="<?php echo $params['api_name']; ?>"/>
            <input type="hidden" value="0" id="submit_form">
        </form>
    </div>
    <script>

    </script>
    <div style="margin:100px"></div>
    <script>
        $(document).ready(function () {
            var Minutes = 60 * 10;
            var display = document.querySelector('#timer');
            startTimer(Minutes, display);
        });

        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            var interval = setInterval(function () {
                minutes = parseInt(timer / 60, 10)
                seconds = parseInt(timer % 60, 10);
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;
                display.textContent = minutes + ":" + seconds;
                if ($('#submit_form').val() == 0) {
                    if (--timer < 0) {
                        clearInterval(interval);
                        $('#booking_form').slideUp();
                        window.location.replace('<?=site_url()?>')
                    }
                } else {
                    clearInterval(interval);
                    $('#top_timer').fadeOut();
                }
            }, 1000);
        }

        $('#booking_form').submit(function (e) {
            e.preventDefault();
            var form_data = $(this).serializeArray();
            //console.log(form_data);
            if (form_data[10].value == 'login') {
                var email = form_data[11].value;
                var password = form_data[12].value;
                $.ajax({
                    url: '<?php echo site_url( 'flights/check_login/' ); ?>',
                    type: 'post',
                    data: 'email=' + email + '&password=' + password,
                    dataType: 'json',
                    beforeSend: function () {
                        $("html, body").animate({scrollTop: 0}, "fast");
                    },
                    success: function (data) {
                        if (data['status'] == "success") {
                            $('#user_login_status').val("already_login");
                            book_now();
                        } else {
                            $("#ajax_login_response").html('<div class="alert alert-danger">' + data['msg'] + "</div>");
                        }
                    }
                });
            } else {
                book_now();
            }
        });

        function book_now() {
            var form_data = $("#booking_form").serializeArray();
            $.ajax({
                url: '<?=site_url( 'hotels/save_booking/' )?>',
                data: form_data,
                type: "POST",
                dataType: 'json',
                beforeSend: function () {
                    $("html, body").animate({scrollTop: 0}, "fast");
                    $('#submit_form').val(1);
                    $('#booking_form').fadeOut('slow');
                    $('#top_timer').fadeOut();
                    $('#saving_booking').html('<img src="<?php echo base_url(); ?>/assets/img/loading.gif" style="max-height: 50px;display: block;margin-right: auto;margin-left: auto;margin-top: 40px;"><br><h4 style="text-align: center;"><?=lang( '0219' )?></h4>');
                },
                success: function (data) {
                    console.log(data);
                    if (data['status'] == "success") {
                        if (data['data']['payment_method'] == 'pay_later') {
                            verification_form(data['data']['id']);
                        } else {
                            if (data['data']['init_payment']['status'] == "success" && data['data']['init_payment']['url'] != "") {
                                window.location.replace(data['data']['init_payment']['url']);
                            } else {
                                verification_form(data['data']['id']);
                            }
                        }
                    } else {
                        $('#saving_booking').html('<div class="alert alert-danger"><?=lang( '0220' )?></div>');
                    }
                },
                error: function () {
                    $('#saving_booking').html('<div class="alert alert-danger"><?=lang( '0220' )?></div>');
                }
            });
        }

        function verification_form(booking_id) {
            var form = document.createElement("form");
            var element1 = document.createElement("input");
            form.method = "POST";
            form.action = '<?=site_url( "hotels/booking/verification/" )?>';
            element1.value = booking_id;
            element1.name = 'booking_id';
            form.appendChild(element1);
            document.body.appendChild(form);
            form.submit();
        }
    </script>

<?php } ?>