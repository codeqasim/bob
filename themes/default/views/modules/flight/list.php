<script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/jquery.sticky-kit.js"></script>
<style>
.wrapper, .header, .footer { position: relative; }
.wrapper { padding: 10px; }
.sidebar { position: absolute; max-width: 270px; float: left; margin-bottom: 15px }
.top { position: absolute; top: 10px; }
.clear { clear: both; float: none; }
</style>

<div class="modify_area hidden-xs">
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-sm-9" id="flight_records">
                <h3 class="mt0">
                    <strong id="total-records">0</strong> Flights are available
                </h3>
                <p>2 Travelers, Dates : <?php echo date('d/m/Y'); ?> - <?php echo date('d/m/Y'); ?></p>
            </div>
        </div>
        <?php include $include_path . 'views/modules/flight/partials/search.php'; ?>
    </div>
</div>

<div class="flights_list">
<div class="wrapper">
    <div class="container">
        <div class="row" id="flights_row"></div>
        <?php include $include_path . 'views/modules/flight/loader.php'; ?>
        <script type="text/javascript">
            $(document).ready(function () {
                get_airlines();
            });

            function get_airlines() {
                var passengers = parseInt($("#cvalue-flights").val()) + parseInt($("#ivalue-flights").val()) + parseInt($("#avalue-flights").val());
                var cityfrom = $(".kcityfrom").val();
                var cityto = $(".kcityto").val();
                var dep_date = $('.caleran_dep').val();
                if (cityfrom != "" && cityto != "") {
                    var form = $('#search_form_kiwi');
                    var form_data = form.serialize();
                    $.ajax({
                        type: "POST",
                        url: '<?php echo site_url('flight/get_airlines/'); ?>',
                        data: form_data,
                        beforeSend: function () {
                            $("#flight_records").html('<h3 class="mt0"><strong id="total-records"><i class="fa fa-circle-o-notch fa-spin"></i> Searching</strong> Flights</h3><p>'+passengers+' Travellers , Date : '+ dep_date);
                            $("#flights_row").html('');
                            $('.ajax-load').show();
                        },
                        success: function (data) {
                            alert(data);
                            $('.ajax-load').hide();
                            $("#flights_row").html(data).show('slow');
                            var available_flights = $('#available_flights').val();
                            document.title = available_flights + ' Flights Found for '+cityfrom+' - '+cityto;
                            if (available_flights == 0) {
                                $("#flight_records").html('<h3 class="mt0"><strong id="total-records">No </strong> Flights Found for '+cityfrom+' - '+cityto+'</h3><p>' + (passengers) + ' Travellers , Date : ' + dep_date);
                            } else {
                                $("#flight_records").html('<h3 class="mt0"><strong id="total-records">' + available_flights + ' </strong> Flights Found for '+cityfrom+' - '+cityto+'</h3><p>' + (passengers) + ' Travellers , Date : ' + dep_date);
                            }
                        }
                    });
                }
                return false;
            }
        </script>
    </div>
    </div>
    </div>

