<style>
    body {
        background: #f4f6f8
    }
</style>
<div class="container booking_status">
    <div class="row">
		<?php if ( ! isset( $data->error ) ) { ?>
            <script>
                /* JS Code for timer */
                // var countDownDate = new Date("Feb 26, 2019 22:37:25").getTime();
                // var x = setInterval(function () {
                //     var now = new Date().getTime();
                //     var distance = countDownDate - now;
                //     var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                //     var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                //     var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                //     var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                //     document.getElementById("clock").innerHTML = /*days + "d " + hours + "h " + */  minutes + "m " + seconds + "s ";
                //     if (distance < 0) {
                //         clearInterval(x);
                //         document.getElementById("clock").innerHTML = "EXPIRED";
                //     }
                // }, 1000);
            </script>
            <div class="col-md-4">
                <div class="itinerary">

					<?php if ( $invoice['super_booking']['booking_status'] == 'confirmed' ) { ?>
                        <h2 class="text-success"><?= lang( '0183' ) ?> <i class="fa fa-check"></i></h2>
                        <p><?= lang( '0184' ) ?></p>
                        <hr>
					<?php } elseif ( $invoice['super_booking']['booking_status'] == 'pending' ) { ?>
                        <h2 class="text-warning"><?= lang( '0185' ) ?> <i class="fa fa-clock-o"></i>
                            <small class="text-inverse" id="demo"></small>
                        </h2>
                        <p><?= lang( '0186' ) ?></p>
                        <hr>
					<?php } else { ?>
                        <h2 class="text-danger"><?= lang( '0187' ) ?> <i class="fa fa-times"></i></h2>
                        <p><?= lang( '0188' ) ?></p>
                        <hr>
					<?php } ?>
                    <label>Booking Code</label>
                    <h2><?php echo $invoice['super_booking']['id']; ?></h2>
                </div>
                <div class="list-group">
                    <a href="#" class="list-group-item" onclick="printDiv('printableArea')">
                        <div class="row">
                            <div class="col-md-2 col-xs-3 col-sm-2"><i class="fa fa-print"></i></div>
                            <div class="col-md-10 col-xs-9 col-sm-10"><?= lang( '0189' ) ?>
                                <span><?= lang( '0190' ) ?></span></div>
                        </div>
                    </a>
                    <a href="#" class="list-group-item">
                        <div class="row">
                            <div class="col-md-2 col-xs-3 col-sm-2"><i class="fa fa-trash-o text-danger"></i></div>
                            <div class="col-md-10 col-xs-9 col-sm-10"><?= lang( '0191' ) ?><span
                                        class="text-danger"><?= lang( '0192' ) ?></span></div>
                        </div>
                    </a>
                    <script>
                        /* JS code for print*/
                        // function printDiv(divName) {
                        //     var printContents = document.getElementById(divName).innerHTML;
                        //     var originalContents = document.body.innerHTML;
                        //     document.body.innerHTML = printContents;
                        //     window.print();
                        //     document.body.innerHTML = originalContents;
                        // }
                    </script>
                </div>
            </div>
            <div class="col-md-8 reservation" id="printableArea">
                <div class="row">
                    <div class="panel panel-primary">
                        <div class="panel-heading"><i class="fa fa-file-text-o"></i> <?= lang( '0193' ) ?></div>
                        <div bgcolor="#DEF2FB" color="#000" class="heading text-center strong">
                            <h2><?= $invoice['hotel']['company_name']; ?></h2>
                        </div>
                        <div class="col-md-6">
                            <p class="m0">
								<?php for ( $i = 1; $i <= $invoice['hotel']['rating']; $i ++ ) { ?>
                                    <i class="fa fa-star text-warning"></i>
								<?php } ?>
                            </p>
							<?php if ( ! empty( $invoice['hotel']['address'] ) ): ?>
                                <p class="strong m0"><i
                                            class="fa fa-map-marker"></i> <?= $invoice['hotel']['address']; ?></p>
							<?php endif; ?>
							<?php if ( ! empty( $invoice['hotel']['phone_number'] ) ): ?>
                                <p><i class="fa fa-phone"></i> <?= $invoice['hotel']['phone_number']; ?></p>
							<?php endif; ?>
                        </div>
                        <div class="col-md-6 hidden-print">
                            <div class="col-md-5">
                                <a target="blank"
                                   href="https://google.com/maps?q=<?= $invoice['hotel']['latitude']; ?>,<?= $invoice['hotel']['longitude'] ?>&amp;z=12&amp;output=embed"
                                   class="btn btn-primary pull-right"><?= lang( '0194' ) ?></a>
                            </div>
                            <div class="col-md-7">
                                <button data-toggle="modal" data-target="#whatsapp" class="btn btn-success pull-right">
                                    <i class="fa fa-whatsapp"></i> Whatsapp Location
                                </button>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <!-- Modal -->
                        <div id="whatsapp" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                <!-- Modal content-->
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        <h4 class="modal-title"><?= lang( '0195' ) ?></h4>
                                    </div>
                                    <div class="modal-body">
                                        <label><?= lang( '0196' ) ?></label>
                                        <input type="text" class="form-control input-lg" value="+923311442244"/>
                                        <hr>
                                        <div class="alert alert-success"><?= lang( '0197' ) ?></div>
                                        <div class="alert alert-danger"><?= lang( '0198' ) ?></div>
                                        <iframe src="https://google.com/maps?q=<?= $invoice['hotel']['latitude']; ?>,<?= $invoice['hotel']['longitude'] ?>&amp;z=12&amp;output=embed"
                                                style="width:100%" height="350" frameborder="0" style="border:0"
                                                allowfullscreen=""></iframe>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close
                                        </button>
                                        <button class="btn btn-primary"><?= lang( '0199' ) ?></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="col-md-12">
                            <table class="table">
                                <thead style="background: #eee;" class="ttu">
                                <tr>
                                    <td><strong><?= lang( '042' ) ?></strong></td>
                                    <td><strong><?= lang( '015' ) ?></strong></td>
                                    <td><strong><?= lang( '013' ) ?></strong></td>
                                    <td><strong><?= lang( '014' ) ?></strong></td>
                                </tr>
                                </thead>
                                <tbody>
								<?php foreach ( $invoice['hotel_booking'] as $rooms ): ?>
                                    <tr>
                                        <td><?= $rooms['type'] ?></td>
                                        <td><?= $rooms['adults'] + $rooms['childs']; ?></td>
                                        <td><?= $rooms['checkin'] ?></td>
                                        <td><?= $rooms['checkout'] ?></td>
                                    </tr>
								<?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-md-12">
                            <p class="strong ttu"><?= lang( '0200' ) ?> <?= lang( '046' ) ?></p>
                            <div class="row">
                                <div class="clearfix"></div>
								<?php foreach ( $invoice['aminities'] as $amenities ) { ?>
                                    <div class="col-md-3"><i class="fa fa-check text-success"></i> <?= $amenities ?>
                                    </div>
								<?php } ?>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-md-12">
                            <p class="strong ttu"> <?= lang( '0201' ) ?>
                                <small class="pull-right text-muted"><?= lang( '0202' ) ?> <strong><?=$invoice['hotel_booking'][0]['currency_code']?></strong>
                                </small>
                            </p>
							<?php $i = 1; $total = 0;  foreach (  $invoice['hotel_booking'] as $rooms ): ?>
                                <hr>
                                <p><?= lang( '0203' ) ?> <?=$i;?>: <?= $rooms['type'] ?> <span class="pull-right"><?= $rooms['currency_code'] ?> <?= number_format( $rooms['price'] ,2 ) ?></span>
							<?php $i++; $total = $total+$rooms['price']; endforeach; ?>
                                </p>
                            <hr>
                            <p><?= lang( '0204' ) ?>
                                <span class="pull-right"><?= $rooms['currency_code'] ?> 00.00</span>
                            </p>
                            <hr>
                            <p><?= lang( '0205' ) ?> <span class="pull-right"><?= $rooms['currency_code'] ?> 00.00</span></p>
                            <h4 class="well">
                                <strong><?= lang( '0145' ) ?>
                                    <span class="pull-right">
                                        <?= $rooms['currency_code'] ?> <?= number_format( $total ,2) ?>
                                    </span>
                                </strong>
                            </h4>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-md-12">
                            <p class="strong ttu"> <?= lang( '0207' ) ?></p>
                            <p class="m0"><strong><?= lang( '0208' ) ?> :</strong> <?= $invoice['account']['first_name']." ".$invoice['account']['last_name'] ?></p>
	                        <?php if ( ! empty( trim( $invoice['account']['address'] ) ) && $invoice['account']['address'] != "null" ) { ?>
                            <p class="m0"><strong><?= lang( '098' ) ?> :</strong> <?= $invoice['account']['address'] ?></p>
	                        <?php } ?>
							<?php if ( ! empty( trim( $invoice['account']['mobile_number'] ) ) && $invoice['account']['mobile_number'] != "null" ) { ?>
                                <p class="m0"><strong><?= lang( '092' ) ?> :</strong> <?= $invoice['account']['mobile_number'] ?>
                                </p>
							<?php } ?>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        <div class="col-md-12">
                            <p><strong class="ttu"><?= lang( '0209' ) ?></strong></p>
                            <p><?= lang( '0210' ) ?></p>
                            <p><strong class="ttu"><?= lang( '0211' ) ?></strong></p>
                            <p><?= lang( '0212' ) ?></p>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
		<?php } else {
			//echo $data->error;
		}
		?>
    </div>
</div>