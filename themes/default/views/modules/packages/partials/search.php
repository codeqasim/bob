<style>
    .select2 {
        width: 100% !important;
    }
</style>
<div id="tourPackage">
    <div class="panel panel-default row hidden-sm hidden-xs" style="margin-top:-15px;">
        <div class="panel-heading">
            <h4 style="margin:0px" class="text-center"><i class="fa fa-suitcase"></i> <?= lang('0217') ?></h4>
        </div>
    </div>
    <form id="search-form" class="search_form responsive" action="<?=base_url('packages/search')?>" method="GET">
        <!-- destination -->
        <div class="col-md-5 c40">
            <div class="form-group">
                <label><?= lang('011') ?></label>
                <?= $searchForm->getLocationsDd() ?>
            </div>
        </div>
        <!--/. destination -->

        <!-- date -->
        <div class="col-md-2 col-sm-6 col-xs-12 c20">
            <div class="form-group">
                <label><?= lang('031') ?></label>
                <input readonly type="text" placeholder="<?= lang('031') ?>" class="form-control" id="packageDate" name="packageDate" value="<?=$searchForm->packageDate?>" required/>
            </div>
        </div>
        <!--/. date -->

        <!-- guests -->
        <div class="bgfade col-md-2 col-xs-12 c20">
        <div class="form-group">
            <label><?= lang('015') ?></label>
            <div class="clearfix"></div>
            <input readonly id="guest" data-toggle="collapse" data-target="#options" aria-expanded="true" aria-controls="options" type="text"
                   value="<?=lang('015')?> <?=$searchForm->guests->total()?>" class="form-control">
            <div class="col-md-12">
                <div class="hidden-guest flipInX animated collapse guests col-md-2 col-xs-12" id="options" aria-expanded="true">
                    <div class="row">
                        <div class="col-md-12 col-xs-6">
                            <div class="form-horizontal">
                                <div class="col-md-5">
                                    <div class="row pt5 text-center"><strong><?= lang('016') ?></strong></div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="input-group">
                                            <!-- plus button -->
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary btn-sm" type="button" id="amin"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <input name="adults" id="avalue" type="text" class="form-control input-sm text-center"
                                                   value="<?=$searchForm->guests->adult?>" placeholder="<?=$searchForm->guests->adult?>">
                                            <!-- minus button -->
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
                                    <div class="row pt5 text-center"><strong><?= lang('017') ?></strong></div>
                                </div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="input-group">
                                            <!-- plus button -->
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary btn-sm" type="button" id="cmin"><i class="fa fa-minus"></i></button>
                                            </span>
                                            <input type="text" name="child" id="cvalue" class="form-control input-sm text-center"
                                                   value="<?=$searchForm->guests->child?>" placeholder="<?=$searchForm->guests->child?>">
                                            <!-- minus button -->
                                            <span class="input-group-btn">
                                                <button class="btn btn-secondary btn-sm" type="button" id="cplus"><i class="fa fa-plus"></i></button>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <!--/. guests -->

        <!-- submit -->
        <div class="visible-xs"><div class="clearfix"></div></div>
        <div class="col-md-3 c20">
            <label>&nbsp;</label>
            <div class="progress-btn">
                <button type="submit" class="btn btn-primary btn-block ladda-button spin" data-style="expand-left">
                    <span class="ladda-label"><?= lang('010') ?></span>
                </button>
            </div>
        </div>
    </form>
</div>

<!-- load libs -->
<script src="<?php echo $theme_url; ?>assets/multi_select/multiple-select.js"></script>

<script type="text/javascript">
$(document).ready(function () {

    $("#tourPackage #hiden").click(function () {
        $("#tourPackage .hidden-guest").removeClass("in")
    });
    $('#tourPackage #amin').off().on('click', function () {
        if ($("#tourPackage #avalue").val() > 1) {
            $("#tourPackage #avalue").val($("#tourPackage #avalue").val() - 1);
            $("#tourPackage #guest").val("Guest ".concat(parseInt($("#tourPackage #guest").val().split(" ")[1]) - 1))
        }
    });
    $('#tourPackage #aplus').off().on('click', function () {
        if ($("#tourPackage #avalue").val() < 9) {
            $("#tourPackage #avalue").val(parseInt($("#tourPackage #avalue").val()) + 1);
            $("#tourPackage #guest").val("Guest ".concat(parseInt($("#tourPackage #guest").val().split(" ")[1]) + 1))
        }
    });
    $('#tourPackage #cmin').off().on('click', function () {
        if ($("#tourPackage #cvalue").val() > 0) {
            $("#tourPackage #cvalue").val($("#tourPackage #cvalue").val() - 1);
            $("#tourPackage #guest").val("Guest ".concat(parseInt($("#tourPackage #guest").val().split(" ")[1]) - 1))
        }
    });
    $('#tourPackage #cplus').off().on('click', function () {
        if ($("#tourPackage #cvalue").val() < 5) {
            $("#tourPackage #cvalue").val(parseInt($("#tourPackage #cvalue").val()) + 1);
            $("#tourPackage #guest").val("Guest ".concat(parseInt($("#tourPackage #guest").val().split(" ")[1]) + 1))
        }
    });

    $("#packageDate").caleran({
        showOn: "bottom",
        autoAlign: false,
        showHeader: false,
        autoCloseOnSelect: true,
        minDate: "<?=date('Y-m-d');?>",
        calendarCount: 1,
        format: "YYYY-MM-DD",
        singleDate: true,
    });

    $("#tourPackage #locations").select2();
    $("#tourPackage #locationsAjax").select2({
        placeholder: "<?=lang('0218')?>",
        width: '100%',
        minimumInputLength: 3,
        allowClear:true,
        ajax: {
            url: '<?php echo site_url("packages/typeahead");?>',
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        },
        escapeMarkup: function(markup) {
            return markup;
        },
        templateSelection: function(data) {
            return data.text;
        }
    });

    $('#tourPackage #ms').change(function () {
        console.log($(this).val());
    }).multipleSelect({
        width: '100%',
        placeholder: "Select Days",
        filter: true,
        single: true,
    });

    $('#tourPackage #search-form').submit(function(e) {
        e.preventDefault();
        var searchform = $('#tourPackage #search-form');
        var fields = searchform.serializeArray();
        var action = searchform.attr("action") + "/";
        $.each(fields, function (index, field) {
            action += field.value + "/";
        });
        window.location = action;
    });
});
</script>
