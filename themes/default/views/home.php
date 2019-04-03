<?php include $include_path.'/functions.php'; ?>
<div class="mt-25"></div>
<script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/owl.js"></script>
<section class="main">
<div class="hero">
    <div class="ppr_rup ppr_priv_homepage_hero">
        <div data-wow-duration="2s" data-wow-delay="2s" class="homeHero default_home wow fadeIn" style="background-image: url('<?php echo $image_path.$slider; ?>'); <!--background-position:50% bottom-->">
        </div>
    </div>
    <div class="slide">
        <div class="container plr0">
          <div class="col-md-12">
            <!--
            <div class="hidden-sm hidden-xs">
                <h2 class="text-center">Travel like never before!</h2>
                <p class="form-group text-center">Search over 450 airlines and more than 320,000 hotels around the world!.</p>
            </div>
            -->
            <div class="hidden-sm hidden-xs" style="margin-top:20px"></div>
            <div class="panel panel-default shadow wow fadeIn">
                <div class="panel-heading hidden-lg hidden-sm hidden-md">
                <!--<h4 style="margin:0px" class="text-center"><i class="fa fa-plane"></i> Flight</h4>-->
                    <div class="panel-tools pull-left">
                        <ul class="nav nav-tabs nav-justified">
                         <?php include $include_path.'/menu.php'; ?>
                        </ul>
                    </div>
                </div>
                <div class="panel-body">
                    <div class="tab-content">
                         <div class="tab-pane fade active in"  id="menu_item_hotels" role="tabpanel" aria-labelledby="home-tab">
                          <?php  include $include_path.'views/modules/hotels/partials/search.php'; ?>
                         </div>
                        <div class="tab-pane"  id="menu_item_flights" role="tabpanel" aria-labelledby="flight-tab">
                          <?php  include $include_path.'views/modules/flights/partials/search.php'; ?>
                         </div>
                    </div>
                </div>
            </div>
            </div>
        </div>
    </div>
</div>
<!--<div class="featured benifits fadeIn animated">
    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <div class="row">
                    <div data-wow-duration="0.5s" data-wow-delay="0.5s" class="wow fadeInDown col-md-2 col-xs-2"><i class="one"></i></div>
                    <div data-wow-duration="0.6s" data-wow-delay="0.5s" class="wow fadeInUp col-md-10 col-xs-10">
                        <h4>Trusted Online Travel Leader</h4>
                        <p>300 million members & 30 million authentic reviews</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div data-wow-duration="0.7s" data-wow-delay="0.5s" class="wow fadeInDown col-md-2 col-xs-2"><i class="two"></i></div>
                    <div data-wow-duration="0.8s" data-wow-delay="0.5s" class="wow fadeInUp col-md-10 col-xs-10">
                        <h4>Service You Can Trust</h4>
                        <p>One-stop multilingual service & hassle-free travel</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="row">
                    <div data-wow-duration="0.9s" data-wow-delay="0.5s" class="wow fadeInDown col-md-2 col-xs-2"><i class="three"></i></div>
                    <div data-wow-duration="1s" data-wow-delay="0.5s" class="wow fadeInUp col-md-10 col-xs-10">
                        <h4>Worldwide Coverage</h4>
                        <p>Over 1,200,000 hotels in more than 200 countries & flights to over 5,000 cities</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </div>-->
</section>

<?php if(!empty($blog_settings->show_home_page)){  ?>
<?php  include $include_path.'views/blog/featured.php'; ?>
<?php } ?>
<?php if(!empty($ota_modules->flights->is_feature_cities)){ ?>
<?php include $include_path.'views/modules/flights/partials/featured.php'; ?>
<?php } ?>
<?php if(!empty($ota_modules->hotels->is_feature_cities)){ ?>
<?php include $include_path.'views/modules/hotels/partials/featured.php'; ?>
<?php } ?>
<?php if(!empty($ota_modules->packages->is_feature_cities)){ ?>
<?php include $include_path.'views/modules/packages/partials/featured.php'; ?>
<?php } ?>

<!--<section class="featured-packages feature">
    <div class="container line">
        <div class="col-md-12">
            <h6><?=lang('021')?> <?=lang('01003')?></h6>
        </div>
        <div class="clearfix"></div>
        <div class="owl-carousel packages">
            <?php for ($i = 1; $i <= 14; $i++) { ?>
                <div class="col-md-12">
                    <div class="bgwhite box">
                        <div class="img">
                            <a href="javascript:void(0)">
                                <img src="<?php echo $theme_url; ?>assets/img/data/city.jpg" alt="" class="img-responsive" />
                            </a>
                        </div>
                        <div class="panel-body">
                            <h5 class="strong">Baku Special Tour</h5>
                            <p class="text-muted">3 Nights, Per Adult</p>
                            <i class="fa fa-check text-success"></i> Flight &nbsp; <i class="fa fa-check text-success"></i> Hotels &nbsp; <i class="fa fa-check text-success"></i> Transfers
                            <h3><small class="text-muted">USD</small> $280</h3>
                            <a href="javascript:void(0)" class="btn btn-danger btn-block"> More Details</a>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</section>-->


<!--<section class="featured-destinations feature">
    <div class="container line">
    <div class="col-md-12">
       <h6><?=lang('021')?> </h6>
        <div class="clearfix"></div>
            <input onkeyup="QuickSearch()" id="filterinput" class="form-control input-lg bgwhite" type="text" placeholder="Search country by name..."/>
            <i class="country_search fa fa-search"></i>
          <div class="clearfix"></div>
        <div class="scroll">
            <ul class="dest-ul" id="filter">
                <?php $countries = json_decode(file_get_contents($theme_url . 'assets/js/countries.json'));
foreach ($countries as $cnt) { ?>
                    <li class="col-xs-6  col-sm-4 col-md-3 col-lg-2">
                        <div class="fadeIn animated">
                            <a href="javascript:void(0)">
                                <div class="raw">
                                    <div class="img">
                                        <a href="<?php echo base_url('hotels/' . str_replace(' ', '-', strtolower($cnt->nicename))); ?>">
                                            <?php $img = (file_exists($include_path.'assets/img/countries/'.$cnt->iso.'.jpg')) ? $cnt->iso : 'BH'; ?>
                                            <img src="<?php echo $theme_url.'assets/img/countries/'.$img.'.jpg'; ?>" alt="<?php echo $cnt->nicename; ?>" class="img-responsive" />
                                        </a>
                                        <h3 class="ellipsis"><?php echo $cnt->nicename; ?></h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </li>
                <?php } ?>
            </ul>
        </div>
    </div>
    </div>
</section>-->
<script>
    function QuickSearch() {
        // Declare variables
        var input, filter, ul, li, h3, i;
        input = document.getElementById('filterinput');
        filter = input.value.toUpperCase();
        ul = document.getElementById("filter");
        li = ul.getElementsByTagName('li');

        // Loop through all list items, and hide those who don't match the search query
        for (i = 0; i < li.length; i++) {
            h3 = li[i].getElementsByTagName("h3")[0];
            if (h3.innerHTML.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
            } else {
                li[i].style.display = "none";
            }
        }
    }
</script>
<script>
    $(document).ready(function () {
        $('.packages').owlCarousel({
            loop: true,
            margin: 10,
            nav: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        })
    });
    $(document).ready(function () {
        $('.airlines').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 10,
            nav: true,
            navText: ["<i class='fa fa-angle-left'></i>","<i class='fa fa-angle-right'></i>"],
            lazyLoad: true,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 2
                },
                1000: {
                    items: 4
                }
            }
        })
    });
</script>
