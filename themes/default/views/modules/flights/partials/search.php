<!--<script src="--><?php //echo $theme_url; ?><!--assets/js/bootstrap3-typeahead.min.js"></script>-->
<?php
//$params = $_SESSION['params'];
if ( ! empty( $params ) ) {
	if ( ! empty( $params['triptype'] ) && $params['triptype'] == 'return' ) {
		if ( ! empty( $params['ret_date'] ) ) {
			$date = $params['dep_date'] . " - " . $params['ret_date'];
		} else {
			$date = $params['dep_date'];
		}
	} else {
		$date = $params['dep_date'];
	}
}
?>
<script>
    function clear_input(id) {
        $('.' + id).val('');
        $('.' + id).focus();
        $('.clear_' + id).fadeOut('fast');
    }
</script>
<div class="panel panel-default row hidden-sm hidden-xs" style="margin-top:-15px;">
    <div class="panel-heading">
        <h4 style="margin:0px" class="text-center"><i class="fa fa-plane"></i> Search Flights</h4>
    </div>
</div>

<form id="search_form_kiwi" class="search_form responsive" action="<?php echo site_url( 'flights/' ); ?>" method="POST">
    <div class="col-md-3 c25 hide_on_availability">
        <div class="form-group">
            <label><?= lang( '023' ) ?></label>
            <input type="text" class="kcityfrom form-control" required="required"
                   value="<?php echo ( ! empty( $params['kcityfrom'] ) ) ? $params['kcityfrom'] : ""; ?>"
                   data-provide="typeahead" name="kcityfrom" placeholder="From City" autocomplete="off">
            <span class="clear_kcityfrom"
			      <?php if ( empty( $params['kcityfrom'] ) ) { ?>style="display: none" <?php } ?> onclick="clear_input('kcityfrom')"><i
                        class="fa fa-remove"></i></span>
        </div>
    </div>
    <div class="col-md-3 c25 hide_on_availability">
        <div class="form-group">
            <label><?= lang( '024' ) ?></label>
            <input type="text" class="kcityto form-control" required="required" data-provide="typeahead"
                   value="<?php echo ( ! empty( $params['kcityto'] ) ) ? $params['kcityto'] : ""; ?>" name="kcityto"
                   placeholder="To City" autocomplete="off">
            <span class="clear_kcityto" <?php if ( empty( $params['kcityto'] ) ) { ?>style="display: none" <?php } ?> onclick="clear_input('kcityto')"><i
                        class="fa fa-remove"></i></span>
        </div>
    </div>
    <div class="col-md-2 col-sm-6 col-xs-12 c20">
        <div class="form-group">
            <label><?= lang( '025' ) ?></label>
            <input class="caleran_dep form-control" name="dep_date"
                   value="<?php echo ( ! empty( $date ) ) ? $date : date( 'Y-m-d' ); ?>" autocomplete="off"/>
        </div>
    </div>
    <div class="bgfade col-md-2 col-xs-12 c20">
        <div class="form-group">
            <label><?= lang( '015' ) ?></label>
            <div class="clearfix"></div>
            <input readonly id="guest-flights" data-toggle="collapse" data-target="#optionsflights" aria-expanded="true"
                   aria-controls="optionsflights" type="text" value="" placeholder="<?= lang( '015' ) ?> 2" name=""
                   class="form-control">
            <div class="col-md-12">
                <div class="hidden-guests flipInX animated collapse  guests col-md-2 col-xs-12" id="optionsflights"
                     aria-expanded="true">
                    <div class="">
                        <div class="col-md-12 col-xs-12">
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
                                        <button class="btn btn-secondary btn-sm" type="button" onclick="minus_adults()"><i
                                                    class="fa fa-minus"></i></button>
                                        </span>
                                            <input name="adults" id="avalue-flights" type="text"
                                                   class="form-control input-sm text-center"
                                                   value="<?php echo ( ! empty( $params['adults'] ) ) ? $params['adults'] : "1"; ?>"
                                                   placeholder="2">
                                            <span class="input-group-btn">
                                        <button class="btn btn-secondary btn-sm" type="button" onclick="add_adults()"><i
                                                    class="fa fa-plus"></i></button>
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
                                        <button class="btn btn-secondary btn-sm" type="button" onclick="minus_childs()"><i
                                                    class="fa fa-minus"></i></button>
                                        </span>
                                            <input type="text" name="child" id="cvalue-flights"
                                                   class="form-control input-sm text-center"
                                                   value="<?php echo ( ! empty( $params['child'] ) ) ? $params['child'] : "0"; ?>"
                                                   placeholder="0">
                                            <span class="input-group-btn">
                                        <button class="btn btn-secondary btn-sm" type="button" id="cplus-flights"
                                                onclick="add_childs()"><i class="fa fa-plus"></i></button>
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
                                        <strong><?= lang( '018' ) ?></strong>
                                    </div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="input-group">
                                        <span class="input-group-btn">
                                        <button class="btn btn-secondary btn-sm" type="button" id="imin-flights"
                                                onclick="minus_infants()"><i class="fa fa-minus"></i></button>
                                        </span>
                                            <input type="text" name="infants" id="ivalue-flights"
                                                   class="form-control input-sm text-center"
                                                   value="<?php echo ( ! empty( $params['infants'] ) ) ? $params['infants'] : "0"; ?>"
                                                   placeholder="0">
                                            <span class="input-group-btn">
                                        <button class="btn btn-secondary btn-sm" type="button" id="iplus-flights"
                                                onclick="add_infants()"><i class="fa fa-plus"></i></button>
                                        </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="clearfix"></div>
                    <div id="flights_buttons" class="btn btn-done btn-block"><?= lang( '07' ) ?></div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-2 col-xs-12 pull-left c10">
        <div class="form-group">
            <label><?= lang( '038' ) ?> <?= lang( '029' ) ?></label>
            <div class="select-wrapper">
                <select class="form-control" name="triptype" id="triptype" onchange="flight_type(this.value)">
                    <option value="oneway" <?php if ( ! empty( $params['triptype'] ) && $params['triptype'] == 'oneway' ) {
						echo 'selected';
					} ?> ><?= lang
						( '036' )
						?></option>
                    <option value="return" <?php if ( ! empty( $params['triptype'] ) && $params['triptype'] == 'return' ) {
						echo 'selected';
					} ?>><?= lang
						( '037' ) ?></option>
                </select>
            </div>
        </div>
    </div>
    <div class="col-md-12 col-25 col-xs-12 c100">
        <div class="progress-btn">
            <button class="btn btn-primary btn-block ladda-button spin" data-style="expand-left"><span class="ladda-label"><?= lang( '010' ) ?></span></button>
        </div>
    </div>
</form>
<script>
    $("#flights_buttons").click(function () {
        $(".hidden-guests").removeClass("in")
    });
</script>
<script>
    $(document).ready(function () {
        grand_total();
        $(".caleran_dep").caleran({
            showOn: "bottom",
            autoAlign: false,
            showHeader: false,
            autoCloseOnSelect: true,
            minDate: "<?=date( 'Y-m-d' );?>",
            calendarCount: 1,
            format: "YYYY-MM-DD",
			<?php if(! empty( $params['triptype'] ) && $params['triptype'] == 'return') { ?>
            singleDate: false,
			<?php } else { ?>
            singleDate: true,
			<?php  } ?>
        });
    });

    $("#search_form_kiwi").submit(function (e) {
        var form_data = $(this).serializeArray();
        console.log(form_data);
        var kcity_from_array = form_data[0].value.split("-");
        var kcityfrom = kcity_from_array[0];
        var kcityfromcode = kcity_from_array[1];

        var kcity_to_array = form_data[1].value.split("-");
        var kcityto = kcity_to_array[0];
        var kcitytocode = kcity_to_array[1];

        var triptype = form_data[6].value;

        if (triptype == 'oneway') {

            var dep_date_array = form_data[2].value.split(" ");
            var dep_date = dep_date_array[0];

        } else {
            var dep_date_array = form_data[2].value.split(" ");
            var dep_date = dep_date_array[0];
            var return_date = dep_date_array[2];
        }

        var adults = form_data[3].value;
        var child = form_data[4].value;
        var infants = form_data[5].value;

        if (triptype == 'oneway') {
            var new_url = "<?php echo site_url( 'flights/' ) ?>" + kcityfromcode + "/" + kcityfrom + "/" + kcitytocode + "/" + kcityto + "/" + dep_date + "/" + adults + "/" + child + "/" + infants + "/" + triptype;
        } else {
            var new_url = "<?php echo site_url( 'flights/' ) ?>" + kcityfromcode + "/" + kcityfrom + "/" + kcitytocode + "/" + kcityto + "/" + dep_date + "/" + adults + "/" + child + "/" + infants + "/" + triptype + "/" + return_date;
        }
        window.location.replace(new_url);
        return false;
    });
</script>
<script type="text/javascript">
    function add_adults() {
        var avalue = parseInt($("#avalue-flights").val());
        if (avalue < 9) {
            $("#avalue-flights").val(avalue + 1);
            grand_total();
        }
    }

    function minus_adults() {
        var avalue = parseInt($("#avalue-flights").val());
        if (avalue > 1) {
            $("#avalue-flights").val(avalue - 1);
            grand_total();
        }
    }

    function add_childs() {
        var cvalue = parseInt($("#cvalue-flights").val());
        if (cvalue < 9) {
            $("#cvalue-flights").val(cvalue + 1);
            grand_total();
        }
    }

    function minus_childs() {
        var cvalue = parseInt($("#cvalue-flights").val());
        if (cvalue > 0) {
            $("#cvalue-flights").val(cvalue - 1);
            grand_total();
        }
    }

    function add_infants() {
        var ivalue = parseInt($("#ivalue-flights").val());
        if (ivalue < 9) {
            $("#ivalue-flights").val(ivalue + 1);
            grand_total();
        }
    }

    function minus_infants() {
        var ivalue = parseInt($("#ivalue-flights").val());
        if (ivalue > 0) {
            $("#ivalue-flights").val(ivalue - 1);
            grand_total();
        }
    }

    function grand_total() {
        var cvalue = parseInt($("#cvalue-flights").val());
        var ivalue = parseInt($("#ivalue-flights").val());
        var avalue = parseInt($("#avalue-flights").val());
        $("#guest-flights").val("<?=lang( '015' )?> " + (ivalue + cvalue + avalue));
    }

    var $input = $(".kcityfrom");
    if ($input == "") {
        $(".kcityfrom").removeClass('loading');
    }
    var xhrCount = 0;
    $input.typeahead({
        source: function (query, process) {
            $('.clear_kcityfrom').fadeOut('fast');
            $(".kcityfrom").addClass('loading');
            var seqNumber = ++xhrCount;
            var ajaxRequest =  $.getJSON('<?php echo site_url( "get_cities" );?>',
                {query: query},
                function (data) {
                    if (seqNumber === xhrCount) {
                        return process(data);
                    }
                });
            return ajaxRequest;
        },
        autoSelect: true,
        minLength: 3,
        fitToElement: true,
        displayText: function (item) {
            $(".kcityfrom").removeClass('loading');
            return '<i class="flag ' + item.countrycode.toLowerCase() + '"></i>' + item.airportname + ' (' + item.cityname + ') ' + '-' + item.citycode;
        },
        sorter: function (texts) {
            return texts;
        },
        highlighter: function (item) {
            var query = this.query;
            if (!query) {
                return '<div class="list-item"> ' + item + '</div>';
            }
            var reEscQuery = query.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
            var reQuery = new RegExp('(' + reEscQuery + ')', "gi");
            var jElem = $('<div class="list-item"></div>').html(item);
            var textNodes = $(jElem.find('*')).add(jElem).contents().filter(function () {
                return this.nodeType === 3;
            });
            textNodes.replaceWith(function () {
                return $(this).text().replace(reQuery, '<strong>$1</strong>')
            });
            return jElem.html();
        },
        afterSelect: function (item) {
            $(".kcityfrom").removeClass('loading');
            $('.clear_kcityfrom').fadeIn('fast');
            $('.kcityfrom').val(item.cityname + '-' + item.citycode);
        }
    });
</script>
<script type="text/javascript">
    var $input = $(".kcityto");
    if ($input == "") {
        $(".kcityto").removeClass('loading');
    }
    var xhrCount = 0;
    $input.typeahead({
        source: function (query, process) {
            $(".clear_kcityto").fadeOut('fast');
            $(".kcityto").addClass('loading');
            var seqNumber = ++xhrCount;
            var ajaxRequest =  $.getJSON('<?php echo site_url( "get_cities" );?>',
                {query: query},
                function (data) {
                    if (seqNumber === xhrCount) {
                        return process(data);
                    }
                });
            return ajaxRequest;
        },
        autoSelect: true,
        minLength: 3,
        fitToElement: true,
        displayText: function (item) {
            $(".kcityto").removeClass('loading');
            return '<i class="flag ' + item.countrycode.toLowerCase() + '"></i>' + item.airportname + ' (' + item.cityname + ') ' + '-' + item.citycode;
        },
        sorter: function (texts) {
            return texts;
        },
        highlighter: function (item) {
            var query = this.query;
            if (!query) {
                return '<div class="list-item"> ' + item + '</div>';
            }
            var reEscQuery = query.replace(/[\-\[\]\/\{\}\(\)\*\+\?\.\\\^\$\|]/g, "\\$&");
            var reQuery = new RegExp('(' + reEscQuery + ')', "gi");
            var jElem = $('<div class="list-item"></div>').html(item);
            var textNodes = $(jElem.find('*')).add(jElem).contents().filter(function () {
                return this.nodeType === 3;
            });
            textNodes.replaceWith(function () {
                return $(this).text().replace(reQuery, '<strong>$1</strong>')
            });
            return jElem.html();
        },
        afterSelect: function (item) {
            $(".kcityto").removeClass('loading');
            $('.clear_kcityto').fadeIn('fast');
            $('.kcityto').val(item.cityname + '-' + item.citycode);
        }
    });
</script>
<script type="text/javascript">
    // $("#calendar").caleran({
    //     startOnMonday: true,
    //     autoCloseOnSelect: true
    // });

    function flight_type(id) {
        if (id == 'oneway') {
            $(".caleran_dep").caleran({
                calendarCount: 1,
                singleDate: true,
                format: "YYYY-MM-DD",
                minDate: "<?=date( 'Y-m-d' );?>",
                autoCloseOnSelect: true,
            });
        } else {
            $(".caleran_dep").caleran({
                calendarCount: 2,
                singleDate: false,
                format: "YYYY-MM-DD",
                minDate: "<?=date( 'Y-m-d' );?>",
                autoCloseOnSelect: true,
            });
        }
    }
</script>