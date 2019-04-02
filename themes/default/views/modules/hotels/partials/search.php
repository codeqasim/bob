<div class="panel panel-default row hidden-sm hidden-xs" style="margin-top:-15px;">
    <div class="panel-heading">
        <h4 style="margin:0px" class="text-center"><i class="fa fa-bed"></i> Search Best Hotels</h4>
    </div>
</div>
<?php
if ( ! empty( $_SESSION['hotel_search'] ) && empty( $search ) ) {
	$search = $_SESSION['hotel_search'];
}
?>
<form id="search-form-hotels" class="search_form" action="" method="POST">
    <div class="col-md-4 c40">
        <div id="form_errors"></div>
        <div class="form-group">
            <label><?= lang( '011' ) ?></label>
            <select id="country" name="country" required="required" style="display: none;">
				<?php if ( ! empty( $search["city"] ) ) { ?>
                    <option value="<?= $search["city"] ?>"><?= ucwords( str_replace( "-", " ", $search["city"] ) ) ?></option>
				<?php } ?>
            </select>
        </div>
    </div>
    <div class="col-md-3 col-sm-12 col-xs-12 c20">
        <div class="form-group">
            <label><?= lang( '013' ) ?> - <?= lang( '014' ) ?></label>
            <input readonly type="text" required="required" placeholder="<?= lang( '013' ) ?> - <?= lang( '014' ) ?>"
                   class="form-control checkinout" id="checkin" name="checkin"
                   value="<?= ( ! empty( $search["from"] ) ) ? $search["from"] . ' - ' . $search["to"] : ""; ?>"
                   autocomplete="off"/>
        </div>
    </div>
    <div class="bgfade col-md-2 col-xs-12 c20">
        <div class="form-group">
            <label><?= lang( '015' ) ?></label>
            <div class="clearfix"></div>
            <input readonly id="guest" data-toggle="collapse" data-target="#option" aria-expanded="true"
                   aria-controls="option" type="text"
                   value="<?= lang( '015' ) ?> <?= ( ! empty( $search["adults"] ) ) ? $search["adults"] + $search["childs"] : 1; ?>"
                   placeholder="" name="" class="form-control">
            <div class="col-md-12">
                <div class="hidden-guest flipInX animated collapse guests col-md-2 col-xs-12" id="option"
                     aria-expanded="true">
                    <div class="">
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
                                            <input name="adults" id="avalue" type="text"
                                                   class="form-control input-sm text-center"
                                                   value="<?= ( ! empty( $search["adults"] ) ) ? $search["adults"] : 1; ?>"
                                                   placeholder="2">
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
                            <button class="btn btn-secondary btn-sm" type="button" id="cmin"><i class="fa fa-minus"></i></button>
                            </span>
                                            <input type="text" name="child" id="cvalue"
                                                   class="form-control input-sm text-center"
                                                   value="<?= ( ! empty( $search["children"] ) ) ? $search["children"] : 0; ?>"
                                                   placeholder="0">
                                            <span class="input-group-btn">
                            <button class="btn btn-secondary btn-sm" type="button" id="cplus"><i class="fa fa-plus"></i></button>
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
    </div>
    <div class="visible-xs">
        <div class="clearfix"></div>
    </div>
    <div class="col-md-3 c20">
        <label>&nbsp;</label>
        <div class="progress-btn">
            <button type="submit" class="btn btn-primary btn-block ladda-button spin" data-style="expand-left">
                <span class="ladda-label"><?= lang( '010' ) ?></span></button>
        </div>
    </div>
</form>

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
<script type="text/javascript">

    $(".checkinout").caleran({
        isHotelBooking: true,
        continuous: true,
        startEmpty: true,
        minSelectedDays: 1,
        format: "YYYY-MM-DD",
        autoCloseOnSelect: true,
        disabledRanges: [
            {
                start: moment(),
                end: moment().add(-1, "days")
            }
        ]
    });
    //$(".checkinout").caleran({
    //    showOn: "bottom",
    //    autoAlign: false,
    //    showHeader: false,
    //    autoCloseOnSelect: true,
    //    minDate: "<?//=date('Y-m-d');?>//",
    //    calendarCount: 2,
    //    format: "YYYY-MM-DD",
    //    singleDate: false,
    //});
    $("#country").select2({
        placeholder: "<?=lang( '0218' )?>",
        width: '100%',
        minimumInputLength: 3,
        allowClear: true,
        ajax: {
            url: '<?php echo site_url( "hotels/getlocation" );?>',
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        escapeMarkup: function (markup) {
            return markup;
        },
        templateSelection: function (data) {
            return data.text;
        }
    });

    $(document).ready(function () {
        $('#search-form-hotels').submit(function (e) {
            e.preventDefault();
            var fields = $('#search-form-hotels').serializeArray();
            var slug = 'hotels/search/';
            loc = fields[0].value;
            loc = loc.split(",");
            slug += loc[0].replace(/\s+/g, '-').toLowerCase() + '/';
            var date_array = fields[1].value.split(" ");
            var checkin = date_array[0];
            var checkout = date_array[2];
            slug += checkin.replace(/\//g, '-') + '/';
            slug += checkout.replace(/\//g, '-') + '/';
            slug += fields[2].value + '/';
            slug += fields[3].value + '/';
            window.location = "<?php echo base_url(); ?>" + slug;
        });
    });
</script>