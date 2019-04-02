<?php if ( $voucher['code'] == 200 ) {
	date_default_timezone_set( 'UTC' );
	?>
    <style>
        nav {
            display: none
        }

        body {
            background: #eee
        }

        p {
            font-size: 14px
        }

        .header {
            display: none
        }

        .footer {
            display: none
        }

        .company p {
            margin: 0px
        }

        .container {
            width: 800px
        }

        .passenger strong {
            text-transform: uppercase
        }

        .flights h2, .flights h3 {
            margin: 0px !important
        }

        .flights strong {
            text-transform: uppercase
        }

        .borders {
            border: 1px solid #c6c6c6;
            padding: 8px;
        }

        .borders img {
            margin-right: 10px;
        }
    </style>
    <div class="container" style="margin-top:25px">
        <h4 class="text-center">Your Electronic Ticket Voucher & Invoice</h4>
		<?php if ( $voucher['data']['super_booking']['payment_method'] == 'pay_now' ) { ?>
            <div class="alert alert-success text-center">Invoice Status : Paid</div>
		<?php } else { ?>
            <div class="alert alert-danger text-center">Invoice Status : Unpaid</div>
		<?php } ?>
        <div class="panel panel-default">
            <div class="panel-heading">Flight Voucher</div>
            <div class="panel-body">
                <div class="col-md-5"><a href="<?php echo base_url(); ?>" target="_blank"><img
                                src="<?php echo $image_path . $logo; ?>" class="img-responsive" alt="logo"/></a></div>
                <div class="col-md-7 text-right company">
                    <p>65 EEE WAlton Road<br>Lahore, Pakistan</p>
                    <p>Phone +923311442244</p>
                    <p>Email info@ajubia.com</p>
                    <p>Web www.ajubia.com</p>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="panel panel-default passenger">
                    <div class="panel-heading">Passenger Details</div>
                    <div class="panel-body">
						<?php foreach ( $voucher['data']['passengers'] as $passenger ) { ?>
                            <div class="col-md-6">
                                <p class="well well-sm">
                                    <strong>Name: </strong><?= $passenger['title']; ?> <?= $passenger['name']; ?><br>
                                    <strong>Date of Birth: </strong><?= date( 'd-M-Y', $passenger['birthday'] ); ?><br>
                                    <strong>Email: </strong><?= $passenger['email']; ?><br>
                                    <strong>Phone: </strong><?= $passenger['phone']; ?><br>
                                    <strong>Card No: </strong><?= $passenger['cardno']; ?><br>
                                    <strong>Card Expiry: </strong><?= date( 'd-M-Y', $passenger['expiration'] ); ?><br>
                                    <strong>Category: </strong><?= $passenger['category']; ?>
                                </p>
                            </div>
						<?php } ?>
                    </div>
                </div>
                <!--                <div class="panel panel-default">-->
                <!--                    <div class="panel-heading">Ticket Numbers</div>-->
                <!--                    <div class="panel-body text-center">-->
                <!--                        <div class="col-md-4"><p class="well well-sm">345 0984 3324 553 </p></div>-->
                <!--                        <div class="col-md-4"><p class="well well-sm">345 0984 3324 553 </p></div>-->
                <!--                        <div class="col-md-4"><p class="well well-sm">345 0984 3324 553 </p></div>-->
                <!--                    </div>-->
                <!--                </div>-->
                <div class="panel panel-default flights">
                    <div class="panel-heading">Flight Details</div>
                    <div class="panel-body">
						<?php foreach ( $voucher['data']['flights'] as $flights ) { ?>
                            <p><strong>Booking Reference</strong> : <?= $flights['flight_id'] ?></p>
                            <strong>Airline</strong> : <?= $flights['operating_airline_name'] ?><br>
                            <strong>Flight Number</strong> : <?= $flights['flight_no'] ?><br>
                            <strong>Class</strong> : Economy<br>
                            <strong>Dration</strong> : 6 Hours<br>
                            <!--                        <strong>Stops</strong> : 2 Stops</p>-->
                            <div class="borders">
                                <div class="row">
                                    <div class="col-md-1">
                                        <img src="http://localhost/travelhope_net/assets/images/airlines/<?= $flights['operating_airline_iata']; ?>.png"
                                             alt=""/>
                                    </div>
                                    <div class="col-md-11">
                                        <strong>From City</strong>
                                        : <?= $flights['src_station'] ?> <?= date( 'D d-M-Y H:i a', $flights['arrival_utc_time'] ); ?>
                                        - <?= $flights['src_name'] ?> <?= $flights['src_country'] ?>
                                        <br>
                                        <strong>To City</strong> : <?= $flights['dst_station'] ?>
                                        - <?= $flights['dst_name'] ?> <?= $flights['dst_country'] ?>
                                    </div>
                                </div>
                            </div>
                            <hr>
						<?php } ?>
                        <h3><strong>TOTAL</strong> : EUR <?= $voucher['data']['flights'][0]['price'] ?>/= 01 Adult - 1
                            Child</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="copyrights text-center">
            <p>Re-Confirm all onwards/return flights at-least 72 houre perior to departure by calling </p>
            <h5><strong>Reservations Phone : +923311442244</strong></h5>
            <p>Airline agent b2c, B / IATA SALE</p>
            <hr>
            <p><strong>AJUBIA.COM</strong> is independently owned & operaed by Ajubia & C.O</p>
        </div>
    </div>
<?php } else {
    redirect('404');
    ?>
<?php } ?>