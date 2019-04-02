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
    transition: all 0.3s ease-in-out; -moz-transition: all 0.1s ease-in-out; -webkit-transition: all 0.1s ease-in-out; -o-transition: all 0.1s ease-in-out;
    }
    .travler-prices-box {
        margin: 10px;
    }
</style>
<div class="container plr0">
    <div class="cover-area">
        <div class="cover">
            <a class="col-md-12">
                <div class="row zoomClass">
                    <img data-wow-duration="1s" data-wow-delay="3s" src="<?=$tour->getProfilePicture()?>"
                         class="img-responsive wow fadeIn" alt="wall image"/>
                </div>
            </a>
        </div>
        <div>
            <ul class="navbar-default wow fadeIn nav nav-tabs nav-justified hidden-xs" data-spy="affix"
                data-offset-top="390">
                <li><a style="width:100px" href=""></a></li>
                <li><a class="br1s active" href="#ITINERARIES"><?= lang('01009') ?></a></li>
                <li><a class="br1s" href="#PHOTOS"><?= lang('047') ?></a></li>
                <li><a class="br1s" href="#DESCRIPTION"><?= lang('043') ?></a></li>
                <li><a class="br1s" href="#LOCATION"><?= lang('044') ?></a></li>
                <li><a class="br1s" href="#POLICY"><?= lang('045') ?></a></li>
                <li><a href="#AMENITIES"><?= lang('046') ?></a></li>
            </ul>
        </div>
    </div>
    <div class="dp">

        <div class="col-md-2 col-xs-4">
            <div class="img-thumbnail">
                <img data-wow-duration="0.5s" data-wow-delay="1s" src="<?=$tour->getProfilePicture()?>" class="img-responsive wow fadeIn" alt="profile image"/>
            </div>
        </div>
        <div class="col-md-10 col-xs-8">
            <h3>
                <?=$tour->getStars()?>
                <div class="clearfix"></div>
                <?=$tour->getName()?>
            </h3>
            <p><?=$tour->getLocation()?></p>
        </div>
    </div>
    <div style="height:50px;width:100%;background:#ffffff;margin-top:64px" class="visible-xs"></div>
</div>
<div class="container detail">

    <div class="row">
        <div class="col-md-4">
            <div class="panel panel-default detail_hr">
                <div class="panel-heading"><?= lang('048') ?></div>
                <div class="panel-body">
                    <p><i class="fa fa-map-marker"></i> <?= lang('044') ?> : <?=$tour->getLocation()?></p>
                    <!--<hr>
                    <p><i class="fa fa-clock-o"></i> <?= lang('013') ?> : from</p>
                    <hr>
                    <p><i class="fa fa-clock-o"></i> <?= lang('014') ?> : to</p>-->
                </div>
            </div>
            <div class="anchor panel panel-default">
                <div class="scrolled" id="PHOTOS"></div>
                <div class="panel-heading"><?= lang('047') ?></div>
                <div class="p5 pre-scrollable">
                    <div class="popup">
                        <?php foreach ($tour->getGallery() as $image): ?>
                            <div class="col-md-4 col-xs-4">
                                <div class="row p5">
                                    <div class="img">
                                        <a href="<?=sprintf($image, 'main')?>" title="picture">
                                            <img class="img-responsive" src="<?=sprintf($image, 'thumbs')?>">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        <div class="clearfix"></div>
                    </div>
                </div>
            </div>
            <div id="LOCATION" class="panel panel-default">
                <!--<div class="panel-heading"><?= lang('050') ?></div>
                <div class="p5">
                    <div class="img">
                        <a href="javascript:void(0)" data-toggle="modal" data-target="#LOC">
                            <img class="img-responsive" src="<?php echo $theme_url; ?>assets/img/data/map.png">
                        </a>
                    </div>
                </div>-->
                <div id="LOC" class="modal fade" role="dialog">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"><?= lang('044') ?></h4>
                            </div>
                            <iframe style="width:100%;height:400px"
                                    src="https://www.google.com/maps/embed/v1/place?q=&amp;key=AIzaSyDSO3K4Tq-FSJXir6UTIdoPZllsFYMBc-0"
                                    frameborder="0" style="border:0" allowfullscreen></iframe>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default"
                                        data-dismiss="modal"><?= lang('051') ?></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="DESCRIPTION" class="col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading"><?= lang('043') ?></div>
                <div class="panel-body">
                    <div class="">
                        <p class="description">
                            <?=$tour->getDescription()?>
                        </p>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">Prices</div>
                <div class="panel-body">
                    <div class="row travler-prices-box">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Type</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($tour->getTravlerPriceDetails() as $travel): ?>
                                <tr>
                                    <td><?=$travel->type?></td>
                                    <td><?=$travel->quantity?></td>
                                    <td><?=$travel->price?></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <!--<p>
                        <?= lang('052') ?>
                        <span class="pull-right"><?= lang('054') ?> <strong>43</strong></span>
                    </p>
                    <hr style="margin-top: 10px; margin-bottom: 10px; border: 0; border-top: 1px solid #0068d0;">
                    <div id="msg"></div>
                    <div class="row">
                        <form id="refresh_rooms" class="search_form responsive" action="" method="POST">

                            <div class="col-md-6 col-sm-12 col-xs-12 c20">
                                <div class="form-group">
                                    <label><?= lang('013') ?> - <?= lang('014') ?></label>
                                    <input readonly type="text" required="required"
                                           placeholder="<?= lang('013') ?> - <?= lang('014') ?>"
                                           class="form-control checkinout" id="checkin" name="checkin"
                                           value="<?= (!empty($query["from"])) ? $query["from"] . ' - ' . $query["to"] : ""; ?>"
                                           autocomplete="off"/>
                                </div>
                            </div>
                            <div class="bgfade col-md-6 col-xs-12 c20">
                                <label><?= lang('015') ?></label>
                                <div class="clearfix"></div>
                                <input readonly id="guest" data-toggle="collapse" data-target="#option"
                                       aria-expanded="true"
                                       aria-controls="option" type="text"
                                       value="<?= lang('015') ?> <?= (!empty($query["adults"])) ? $query["adults"] + $query["childs"] : 1; ?>"
                                       placeholder="" name="" class="form-control">
                                <div class="col-md-12">
                                    <div class="hidden-guest flipInX animated collapse guests col-md-2 col-xs-12"
                                         id="option"
                                         aria-expanded="true">
                                        <div class="row">
                                            <div class="col-md-12 col-xs-6">
                                                <div class="form-horizontal">
                                                    <div class="col-md-5">
                                                        <div class="row pt5 text-center">
                                                            <strong><?= lang('016') ?></strong>
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
                                                                       value="<?= (!empty($query["adults"])) ? $query["adults"] : 1; ?>"
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
                                                            <strong><?= lang('017') ?></strong>
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
                                                                       value="<?= (!empty($query["childs"])) ? $query["childs"] : 0; ?>"
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
                                        <div id="hiden" class="btn btn-done btn-block"><?= lang('07') ?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12 c20">
                                <div class="progress-btn">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block ladda-button spin"
                                            data-style="expand-left">
                                        <span class="ladda-label"><?= lang('010') ?></span></button>
                                </div>
                            </div>
                        </form>
                    </div>-->
                </div>
            </div>

            <div id="ITINERARIES" class="panel panel-default">
                <div class="panel-heading"><?= lang('01009') ?></div>
                <div class="panel-body">
                    <?php foreach ($tour->getItineraries() as $day => $itinerary): ?>
                        <div class="list box">
                            <div class="col-md-2 col-sm-3 col-xs-4 wow fadeIn">
                                <div class="row">
                                    <div class="img">
                                        <img src="<?=$itinerary->image?>" alt="image">
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-8 col-sm-9 col-md-10">
                                <div class="title mt10">
                                    <h3 class="col-md-8 pull-left">
                                        <div class="row">
                                            Day <?=($day+1)?><br>
                                            <small><?=$itinerary->title?></small>
                                        </div>
                                    </h3>
                                    <div class="clearfix"></div>
                                    <p></p>
                                </div>
                                <hr style="margin-top: -3px !important;">
                                <form method="post" action="#">
                                    <input type="submit" value="Book Now" class="btn btn-primary">
                                <span class="rooms_desc hidden-xs"><?=$itinerary->description?></span>
                                </form>
                            </div>
                            <div class="clearfix"></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div id="POLICY" class="panel panel-default">
                <div class="panel-heading"><?= lang('053') ?></div>
                <div class="panel-body">
                   <?=$tour->getCancellationPolicy()?>
                </div>
            </div>
            <div id="AMENITIES" class="panel panel-default">
                <div class="panel-heading"><?= lang('046') ?></div>
                <div class="panel-body">
                    <h4>Inclusive</h4>
                    <?php foreach ($tour->getInclusiveAmenities() as $amenity): ?>
                    <p class="col-md-4 col-xs-12"><i class="fa fa-check text-success"></i> <?=$amenity->title?></p>
                    <?php endforeach; ?>
                    <div class="clearfix"></div>
                    <h4>Exclusive</h4>
                    <?php foreach ($tour->getExclusiveAmenities() as $amenity): ?>
                        <p class="col-md-4 col-xs-12"><i class="fa fa-check text-success"></i> <?=$amenity->title?></p>
                    <?php endforeach; ?>
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
        minDate: "<?=date('Y-m-d');?>",
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

</script>