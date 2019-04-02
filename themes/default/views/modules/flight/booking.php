<style>
    body {
        background-color: #f4f6f8
    }

    .panel-primary .panel-heading label {
        color: #fff
    }

    .affix {
        top: 25px;
        z-index: 9999 !important
    }

    .notice {
        padding: 5px;
        padding-left: 20px;
        background-color: #fff;
        border-left: 6px solid #e54a4a;
        margin-bottom: 20px;
        -webkit-box-shadow: 0 5px 8px -6px rgba(0, 0, 0, .6);
        -moz-box-shadow: 0 5px 8px -6px rgba(0, 0, 0, .6);
        box-shadow: 0 5px 8px -6px rgba(0, 0, 0, .6)
    }

    .notice-info {
        border-color: #45abcd
    }

    .text-red {
        color: red
    }
</style>
<div id="top_timer" style="margin-top:-25px;width:100%;z-index:9999" data-spy="affix" data-offset-top="102"
     class="alert alert-danger" style="color: white; height: 60px;">
    <div class="container">
        <h3 class="text-center" style="margin:0"><?= lang( '071' ) ?> : <span id="timer">10:00</span></h3>
    </div>
</div>
<input type="hidden" id="submit_form" value="0">
<div class="container">
    <div id="saving_booking">
	    <?php if ( $booking['data']['mode'] == 'sandbox' ) { ?>
            <div class="col-md-12">
                <div class="notice notice-primary">
                    <h4><i class="fa fa-warning" style="color:#e54a4a"></i> You are currently in test mode.</h4>
                    <ul>
                        <li>No booking will be made.</li>
                        <li>No transaction will be charged.</li>
                    </ul>
                </div>
            </div>
	    <?php } ?>
    </div>
</div>
<div class="container booking">
    <div class="row">
        <div class="col-md-12">
            <form action="<?php echo base_url( 'flights/save_booking' ); ?>" method="post" id="booking_form">
				<?php date_default_timezone_set( 'UTC' ); ?>
                <input type="hidden" name="booking_token" value="<?= $booking['data']['booking_token']; ?>">
                <input type="hidden" name="visitor_uniqid" value="<?= $params['visitor_uniqid']; ?>">
                <input type="hidden" name="flight_id" value="<?= $params['flight_id']; ?>">
                <input type="hidden" name="flights_checked" id="flights_checked"
                       value="<?= $booking['data']['flights_checked']; ?>">
                <div class="col-md-8">
					<?php include $include_path . 'views/account/booking_user.php'; ?>
                    <div class="panel panel-primary">
                        <div class="panel-heading">
							<?= lang( '064' ) ?>
                        </div>
                        <div class="panel-body">
							<?php foreach ( $passengers as $key => $value ) {
								for ( $i = 0; $i < $value; $i ++ ) { ?>
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><?= ucwords( $key ); ?> <?= $i + 1; ?><?= lang( '065' ) ?></div>
                                        <div class="panel-body">
                                            <div class="row form-group">
                                                <div class="col-md-2 col-sm-12 col-xs-12">
                                                    <label><?= lang( '089' ) ?>*</label>
                                                    <select class="form-control"
                                                            name="<?= $key; ?>[<?= $i; ?>][title]" required="required">
                                                        <option value="" disabled
                                                                required="required"><?= lang( '089' ) ?></option>
                                                        <option selected label="Mr"
                                                                value="Mr"><?= lang( '058' ) ?></option>
                                                        <option label="Mrs" value="Mrs"><?= lang( '060' ) ?></option>
                                                    </select>
                                                </div>
                                                <div class="col-md-4 col-xs-12">
                                                    <label><?= lang( '090' ) ?>*</label>
                                                    <input type="text" class="form-control" required="required"
                                                           placeholder="<?= lang( '090' ) ?>" <?php if ( $booking['data']['mode'] == 'sandbox' ) { ?>
                                                           value="test" readonly
													       <?php } ?>name="<?= $key ?>[<?= $i; ?>][name]">
													<?php if ( $booking['data']['mode'] == 'sandbox' ) { ?>
                                                        <p class="text-red"><?= lang( '066' ) ?> </p>
													<?php } ?>
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <label><?= lang( '091' ) ?>*</label>
                                                    <input type="text" class="form-control" required="required"
                                                           placeholder="<?= lang( '091' ) ?>" <?php if ( $booking['data']['mode'] == 'sandbox' ) { ?>  value="test"  readonly <?php } ?>
                                                           name="<?= $key ?>[<?= $i; ?>][surname]">
													<?php if ( $booking['data']['mode'] == 'sandbox' ) { ?>
                                                        <p class="text-red"><?= lang( '066' ) ?> </p>
													<?php } ?>
                                                </div>
                                            </div>
                                            <div class="row form-group">

                                                <div class="col-md-6 col-xs-12">
                                                    <label><?= lang( '094' ) ?>*</label>
                                                    <input type="email" placeholder="Email" required="required"
                                                           name="<?= $key ?>[<?= $i; ?>][email]" class="form-control"
                                                           value="">
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <label><?= lang( '092' ) ?>*</label>
                                                    <input type="number" value="" placeholder="Phone"
                                                           required="required" name="<?= $key ?>[<?= $i; ?>][phone]"
                                                           class="form-control">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                               <div class="col-md-6 col-xs-12">
                                                    <label><?= lang( '067' ) ?>*</label>
                                                    <input type="date" placeholder="Phone" required="required"
                                                           name="<?= $key ?>[<?= $i; ?>][birthday]"
                                                           <?php if ( $key == 'adults' ){ ?>max="<?php echo date( 'Y-m-d', strtotime( date( 'Y-m-d' ) . "-18 Years" ) ); ?>" <?php } ?>
                                                           class="form-control">
                                                </div>

                                                <div class="col-md-6 col-xs-12">
                                                    <label><?= lang( '068' ) ?></label>
                                                    <input type="date" name="<?= $key ?>[<?= $i; ?>][expiration]"
                                                           class="form-control"
                                                           min="<?php echo date( 'Y-m-d', strtotime( 'tomorrow' ) ); ?>"
                                                           required="required">
                                                </div>
                                            </div>
                                            <div class="row form-group">
                                                <div class="col-md-6 col-xs-12">
                                                    <label><?= lang( '069' ) ?></label>
                                                    <input type="text" name="<?= $key ?>[<?= $i; ?>][cardno]"
                                                           class="form-control" required="required" value=""
                                                           placeholder="<?= lang( '069' ) ?>">
                                                </div>
                                                <div class="col-md-6 col-xs-12">
                                                    <label><?= lang( '070' ) ?></label>
                                                    <select class="nationality"
                                                            name="<?= $key ?>[<?= $i; ?>][nationality]"
                                                            required="required">
                                                        <option value=""><?= lang( '0105' ) ?></option>
                                                        <?php foreach ( $countries as $country ) { ?>
                                                            <option value="<?= $country['sortname'] ?>"><?= $country['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <input type="hidden" value="1" name="<?= $key ?>[<?= $i; ?>][hold_bags]">
                                        </div>
                                    </div>
                                    <input type="hidden" name="<?= $key ?>[<?= $i; ?>][category]" value="<?= $key; ?>">
                                    <hr>
								<?php }
							} ?>
                        </div>
                    </div>
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
                    <div class="panel panel-default guest">
                        <div class="panel-heading"><?= lang( '073' ) ?></div>
                        <div class="panel-body">
                            <div class="well">
                                <div class="row">
                                    <div class="col-md-4"><label for="email"><?= lang( '074' ) ?>*</label></div>
                                    <div class="col-md-8">
                                        <div class="col-md-6">
                                            <label for="pay_now" class="control control--radio">
                                                <strong><?= lang( '075' ) ?></strong>
                                                <input checked type="radio" onclick="payment_type('pay_now');"
                                                       name="payment_method" id="pay_now" value="pay_now"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="pay_leter" class="control control--radio">
                                                <strong><?= lang( '076' ) ?></strong>
                                                <input type="radio" id="pay_leter" onclick="payment_type('pay_later');"
                                                       name="payment_method" value="pay_later"/>
                                                <div class="control__indicator"></div>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div id="payment">
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
                                <div class="credit-card__strike">
                                    <span class="credit-card__strike-text h4 text-chambray"><?= lang( '079' ) ?></span>
                                </div>
                                <hr>
                                <div class="row credit-card__form-container">
                                    <div class="col-md-7">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="ccname"><?= lang( '080' ) ?>*</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" class="form-control" placeholder="Your Name"
                                                       id="name_card"
                                                       name="name_card" <?php if ( $booking['data']['mode'] == 'sandbox' ) { ?>  value="David Baker"  readonly <?php } ?>>
												<?php if ( $booking['data']['mode'] == 'sandbox' ) { ?>
                                                    <p class="text-red"><?= lang( '082' ) ?></p>
												<?php } ?>
                                            </div>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for="cardNumber"><?= lang( '081' ) ?>*</label>
                                            </div>
                                            <div class="col-md-8">
                                                <input class="form-control" id="card_no" name="card_no" type="text"
                                                       placeholder="xxxx-xxxx-xxxx-xxxx"
												       <?php if ( $booking['data']['mode'] == 'sandbox' ) { ?>value="4580458045804580"
                                                       readonly<?php } ?> > <?php if ( $booking['data']['mode'] == 'sandbox' ) { ?>
                                                    <p class="text-red"><?= lang( '082' ) ?></p>
												<?php } ?>
                                            </div>
                                        </div>
                                        <div class="clearfix">&nbsp;</div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <label for=""><?= lang( '083' ) ?>*</label>
                                            </div>
                                            <div class="clearfix visible-xs visible-sm">&nbsp;</div>
                                            <div class="col-md-4">
                                                <select class="form-control" required="required" name="month">
													<?php for ( $m = 1; $m <= 12; ++ $m ) { ?>
                                                        <option <?php if ( $m == date( 'm' ) ) {
															echo "selected";
														} ?> value="<?php echo $m; ?>"><?php echo sprintf( "%02d", $m ) . ' - ' . date( 'F', mktime( 0, 0, 0, $m, 1 ) ); ?></option>
													<?php } ?>
                                                </select>
                                            </div>
                                            <div class="clearfix visible-xs visible-sm">&nbsp;</div>
                                            <div class="col-md-4">
                                                <select class="form-control" required="required" name="year">
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
                                                <input type="text" required="required" name="security_code"
                                                       class="form-control" placeholder="***" value="">
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
                                                <img class="img-responsive center-block"
                                                     src="<?php echo $theme_url; ?>assets/img/credit-cards.png"
                                                     alt="availble credit cards">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <p>
                        <small><?= lang( '0138' ) ?></small>
                    </p>
                    <div id="booking_button">
						<?php if ( $booking['data']['flights_checked'] == 1 ) { ?>
                            <div class="progress-btn">
                                <button style="height:60px"class="btn btn-success btn-block ladda-button spin booking_botton" name="booking-btn" data-style="expand-left">
                                    <span class="ladda-label"><?= lang( '0139' ) ?></span>
                                </button>
                            </div>
						<?php } ?>
                    </div>
                </div>
                <div class="col-md-4 summary">
                    <div class="row">
                        <h4><?= lang( '0140' ) ?></h4>
						<?php $flight_ids = explode( "|", $params['flight_id'] ); ?>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="hotel_details_panel__checkout">
                                    <ul class="no-margin no-padding">
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-default">
                            <div class="panel-heading"><?= lang( '0141' ) ?></div>
                            <div class="panel-body m0">
                                <ul class="no-margin no-padding">
									<?php foreach ( $booking['data']['flights'] as $key => $flight ) {
										$datetime1 = new DateTime( date( "Y-m-d h:i:s a", $flight['arrival_utc_time'] ) );
										$datetime2 = new DateTime( date( "Y-m-d h:i:s a", $flight['departure_utc_time'] ) );
										$interval  = $datetime1->diff( $datetime2 );
										$duration  = $interval->format( '%h' ) . " Hours " . $interval->format( '%i' ) . " Minutes";
										?>
                                        <li>
                                            <img style="width: 35px; float: left; margin-right: 5px;" src="<?php echo base_url(); ?>assets/images/airlines/<?= $flight['operating_airline']['iata'] ?>.png" lass="img-responsive" alt="">
                                            <b> From <?= $flight['from_city'] ?></b>
                                            <span class="pull-right">
                                              <?= date( "Y-m-d H:i", $flight['departure_time'] ) ?>
                                          </span>
                                            <input type="hidden" name="flight_data[<?= $key; ?>][operating_airline_iata]" value="<?= $flight['operating_airline']['iata']; ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][operating_airline_name]" value="<?= $flight['operating_airline']['name']; ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][src_name]" value="<?= $flight['from_city']; ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][dst_name]" value="<?= $flight['to_city']; ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][dtime_utc]" value="<?= $flight['departure_time']; ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][atime_utc]" value="<?= $flight['arrival_time']; ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][price]" value="<?= $booking['data']['total'] ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][flight_id];" value="<?= $flight_ids[ $key ]; ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][flight_no];" value="<?= $flight['flight_no']; ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][src_station];" value="<?= $flight['from_station']; ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][dst_station];" value="<?= $flight['to_station']; ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][src_country];" value="<?= $flight['from_country']; ?>">
                                            <input type="hidden" name="flight_data[<?= $key; ?>][dst_country];" value="<?= $flight['to_country']; ?>">

                                        </li>
                                        <li><b>
                                                To <?= $flight['dst_name'] ?>
                                            </b>
                                            <span class="pull-right">
                                                <?= date( "Y-m-d H:i", $flight['arrival_time'] ) ?>
                                            </span>
                                        </li>
                                        <li>
                                            <b>
                                                <?= lang( '0142' ) ?>
                                            </b>
                                            <span class="pull-right">
                                                <?= $duration ?>
                                            </span>
                                            <hr>
                                        </li>
									<?php } ?>
                                    <li><b><?= lang( '016' ) ?></b> <span class="pull-right"><?= $passengers['adults']; ?></span>
                                        <input type="hidden" name="[adults]" value="<?= $passengers['adults']; ?>">
                                    </li>
                                    <li><b><?= lang( '017' ) ?></b> <span
                                                class="pull-right"><?= $passengers['children']; ?></span>
                                        <input type="hidden" name="[children]" value="<?= $passengers['children']; ?>">
                                    </li>
                                    <li>
                                        <b><?= lang( '018' ) ?></b> <span
                                                class="pull-right"><?= $passengers['infants']; ?></span>
                                        <input type="hidden" name="[infants]" value="<?= $passengers['infants']; ?>">
                                        <hr>
                                        <b><?= lang( '0143' ) ?></b> <span
                                                class="pull-right"><?= $passengers['infants'] + $passengers['adults'] + $passengers['children']; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="form-group total-wrapper">
                            <div class="total_msg">
								<?= lang( '0144' ) ?> <span class="pull-right"><?= $payment_info['currency'] ?>&nbsp;0.00</span>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <h4>
                                        <div class="pull-left"><?= lang( '0145' ) ?></div>
                                        <div class="pull-right">
                                            <strong>
                                                <?= $payment_info['currency'] ?>
                                                &nbsp;<?= $payment_info['flight_price']; ?>
                                            </strong>
                                        </div>
                                    </h4>
                                </div>
                            </div>
                            <div class="well well-sm" style="color:#000000 !important;background:white;border: 4px solid #eee;">
								<?= lang( '0146' ) ?> EURO
                                <span class="pull-right">
                        <strong>
                            <h4 style="padding: 0px;margin: 0px;"><?= $booking['data']['currency'] ?> <?= $booking['data']['total'] ?></h4>
                        </strong>
                    </span>
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
            </form>
        </div>
    </div>
</div>
<div style="margin:100px"></div>
<script>
    $(document).ready(function () {
        var flights_checked = $('#flights_checked').val();
        if (flights_checked == "") {
            get_flight_details();
        }
        var Minutes = 60 * 10;
        var display = document.querySelector('#timer');
        startTimer(Minutes, display);
    });

    function get_flight_details() {
        $.ajax({
            type: "POST",
            url: '<?php echo site_url( 'flights/flight_recheck/' ); ?>',
            data: "<?=urldecode( http_build_query( $params ) )?>",
            beforeSend: function () {
                $('#booking_button').html('<img src="<?php echo base_url(); ?>assets/img/loading.gif" style="max-height: 50px;display: block;margin-right: auto;margin-left: auto;margin-top: 40px;"><br><h4 style="text-align: center;">Updating Booking Information</h4>');
            },
            success: function (data) {
                if (parseInt(data) == 1) {
                    $('#booking_button').html('<button class="btn btn-success btn-block btn-lg booking_botton">Complete Booking</button>');
                } else {
                    setTimeout(function () {
                        get_flight_details();
                    }, 5000);
                }
            }
        });
    }

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

    function payment_type(method) {
        if (method === 'pay_now') {
            var credit_card = '<div class="row"> <div class="col-sm-7"> <p>In a hurry?</p><p>Pay with Visa Checkout, the easier way to pay online.</p></div><div class="col-sm-5"> <img class="pull-right img-responsive" src="<?php echo $theme_url; ?>assets/img/visa.png"> </div></div><div class="credit-card__strike"> <span class="credit-card__strike-text h4 text-chambray">Or pay with traditional checkout</span> </div><hr> <div class="row credit-card__form-container"> <div class="col-md-7"> <div class="row"> <div class="col-md-4"> <label for="ccname">Name on card*</label> </div><div class="col-md-8"> <input type="text" class="form-control" placeholder="Your Name" id="name_card" name="name_card" value=""> </div></div><div class="clearfix">&nbsp;</div><div class="row"> <div class="col-md-4"> <label for="cardNumber">Card number*</label> </div><div class="col-md-8"> <input class="form-control" id="card_no" name="card_no" type="text" placeholder="xxxx-xxxx-xxxx-xxxx"> </div></div><div class="clearfix">&nbsp;</div><div class="row"> <div class="col-md-4"> <label for="">Expiration date*</label> </div><div class="clearfix visible-xs visible-sm">&nbsp;</div><div class="col-md-4"> <select class="form-control" required="required" name="month"> <option value="">Month</option> <option value="01" >Jan</option> <option value="02" >Feb</option> <option value="03" >Mar</option> <option value="04" >Apr</option> <option value="05" >May</option> <option value="06" >Jun</option> <option value="07" >Jul</option> <option value="08" >Aug</option> <option value="09" >Sep</option> <option value="10" >Oct</option> <option value="11" >Nov</option> <option value="12" >Dec</option> </select> </div><div class="clearfix visible-xs visible-sm">&nbsp;</div><div class="col-md-4"> <select class="form-control" required="required" name="year"> <option value="">Year</option> <option value="2019">2019</option> <option value="2020">2020</option> <option value="2021">2021</option> <option value="2022">2022</option> <option value="2023">2023</option> </select> </div></div><div class="clearfix">&nbsp;</div><div class="row"> <div class="col-md-4"> <label for="">Security code*</label> </div><div class="col-md-3 col-xs-8"> <input type="text"  required="required" name="security_code" class="form-control" placeholder="***"> </div><div class="col-md-5 col-xs-4"></div></div></div><div class="clearfix visible-xs visible-sm">&nbsp;</div><div class="col-md-5"> <div class="secure-panel"> <div class="panel-body"> <div class="col-md-2"> <div class="row"> <img src="<?php echo $theme_url; ?>assets/img/lock-icon.png" class="img-responsive" alt="secure"/> </div></div><div class="col-md-10"> <div class="text-success"> <strong>100% Secure</strong> </div>We use 128-bit SSL encryption. </div><div class="clearfix"></div><hr> <div class="col-md-2"> <div class="row"> <img src="<?php echo $theme_url; ?>assets/img/shield-icon.png" class="img-responsive" alt="secure"/> </div></div><div class="col-md-10"> <div class="text-success"> <strong>Trusted worldwide</strong> </div>We do not store or view your card data. </div><div class="clearfix"></div><hr> <div class="col-md-2"> <div class="row"> <img src="<?php echo $theme_url; ?>assets/img/credit-card-checkmark.png" class="img-responsive" alt="secure"/> </div></div><div class="col-md-10"> <div class="text-success"> <strong>Easy payment</strong> </div>We accept the following payment methods: </div><div class="clearfix"></div><hr> <img class="img-responsive center-block" src="<?php echo $theme_url; ?>assets/img/credit-cards.png" alt="availble credit cards"> </div></div></div></div>';
            $('#payment').html(credit_card).fadeIn('slow');
        } else {
            $('#payment').slideUp();
            $('#payment').html("");
        }
    }
</script>
<script>
    function book_now() {
        var form_data = $('#booking_form').serialize();
        $.ajax({
            type: "POST",
            url: '<?php echo site_url( 'flights/save_booking/' ); ?>',
            data: form_data,
            dataType: 'json',
            beforeSend: function () {
                $("html, body").animate({scrollTop: 0}, "fast");
                $('#submit_form').val(1);
                $('#booking_form').fadeOut('slow');
                $('#top_timer').fadeOut();
                $('#saving_booking').html('<img src="<?php echo base_url(); ?>/assets/img/loading.gif" style="max-height: 50px;display: block;margin-right: auto;margin-left: auto;margin-top: 40px;"><br><h4 style="text-align: center;">Processing Data</h4>');
            },
            success: function (data) {
                $("#save_booking").html(data);
                if (data['payment_method'] == 'pay_later') {
                    $('#saving_booking').html('<img src="<?php echo base_url(); ?>assets/img/loading.gif" style="max-height: 50px;display: block;margin-right: auto;margin-left: auto;margin-top: 40px;"><br><h4 style="text-align: center;">Creating Invoice</h4>');
                    window.location.replace('<?php echo base_url( 'flights/invoice/' )?>' + data['content_internal']['id']);
                } else {
                    $('#saving_booking').html('<img src="<?php echo base_url(); ?>assets/img/loading.gif" style="max-height: 50px;display: block;margin-right: auto;margin-left: auto;margin-top: 40px;"><br><h4 style="text-align: center;">Creating Invoice</h4>');
                    if (data['kiwi_response'] == 0) {
                        $('#saving_booking').html('<div class="alert alert-danger">Unable to book please try booking again.</div>');
                    } else if (parseInt(data['payment_init_content']) == 0) {
                        $('#saving_booking').html('<div class="alert alert-danger">Unable to initialize payment please try booking again.</div>');
                    } else if (parseInt(data['content_make_payment']) == 0) {
                        $('#saving_booking').html('<div class="alert alert-danger">Unable to proceed with the payemnt please try booking again .</div>');
                    } else if (data['content_payment_confirm'] == 0) {
                        $('#saving_booking').html('<div class="alert alert-danger">Unable to confirm payment please try booking again .</div>');
                    } else {
                        $('#saving_booking').html('<img src="<?php echo base_url(); ?>assets/img/loading.gif" style="max-height: 50px;display: block;margin-right: auto;margin-left: auto;margin-top: 40px;"><br><h4 style="text-align: center;">Creating Invoice</h4>');
                        if (data['payment_method'] = 'pay_later') {
                            window.location.replace('<?php echo base_url( 'flights/invoice/' )?>' + data['content_internal']['id']);
                        } else {
                            window.location.replace('<?php echo base_url( 'flights/invoice/' )?>' + data['content_internal']['id']);
                        }
                    }
                }
            }
        });
    }

    $('#booking_form').submit(function (e) {
        e.preventDefault();
        var form_data = $(this).serializeArray();
        if (form_data[4].value == 'login') {
            var email = form_data[5].value;
            var password = form_data[6].value;
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
</script>

<script>
    $(document).ready(function () {
        $(".nationality").select2({
            width: '100%',
        });
    });
</script>