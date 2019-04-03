<div class="bgwhite footer" style="z-index:9;position:relative;">
    <footer>

        <!-- linkback Powered by -->
            <div class="hidden-xs hidden-sm" style="padding:10px;background:#ffffff;">
                <div class="container">
                    <div style="text-align:center">Powered by <a href="https://www.travelhope.com" target="_blank">
                            <img src="<?php echo base_url(); ?>assets/img/powered.png" style="height:22px" height="22"
                                 alt="TRAVELHOPE">
                            <span style="letter-spacing: 0; font-size: 14px; font-weight: bold;">TRAVELHOPE</span></a>
                    </div>
                </div>
            </div>

        <!-- linkback Powered by -->

        <div class="container">
            <div class="col-md-6 text-center sideline p10">
                <div class="social">
                    <h3><?= lang('0151') ?></h3>
                    <ul class="nav nav-tabs RTL nav-justified">
                            <li><a data-toggle="tooltip" target="blank"><i class=""></i></a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6 text-center p10 newsletter">
                <h3><?= lang('0152') ?></h3>
                <div class="input-group p30">
                    <input type="text" class="form-control newsletter_email" id="newsletter_email"
                           placeholder="your@email.com">
                    <span class="input-group-btn progress-btn">
                 <button type="button" id="subscribe" class="btn btn-primary btn-block ladda-button spin"
                         data-style="expand-left"><span class="ladda-label">Subscribe</span></button>
                </span>
                </div>
                <div class="news" hidden id="news_success">
                    <div class="alert alert-success" id="success-alert">
                        <!--<button href="javascript:;" type="button" class="close" data-dismiss="alert">x</button> -->
                        <?= lang('0153') ?>
                    </div>
                </div>
                <div class="news" hidden id="news_error">
                    <div class="alert alert-danger" id="success-alert">
                        <!--<button href="javascript:;" type="button" class="close" data-dismiss="alert">x</button> -->
                        <?= lang('0154') ?>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <div class="footer_padding wow fadeIn">
        <div class="container">
            <div class="customer">
                <div style="border-left: 1px solid #ccc;" class="footer-block col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <h3 class="heading-contact-info">
                        <a href="tel:<?php if (!empty($ota_cms->contact->phone)) {
                            echo $ota_cms->contact->phone;
                        } else {
                            echo "123 456 789 ";
                        } ?>">
                    <span>
                    <i class="fa fa-phone text-primary"></i>
                    </span>
                            <?php if (!empty($ota_cms->contact->phone)) {
                                echo $ota_cms->contact->phone;
                            } else {
                                echo "123 456 789 ";
                            } ?>
                        </a>
                    </h3>
                </div>
                <div class="footer-block col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <h3 class="heading-contact-info">
                        <a href="<?php echo base_url(); ?>contact">
                    <span>
                    <i class="fa fa-envelope-o text-warning"></i>
                    </span>
                            <?= lang('0155') ?>
                        </a>
                    </h3>
                </div>
                <div class="footer-block col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <h3 class="heading-contact-info">
                        <a href="<?php echo base_url(); ?>livechat">
                    <span>
                    <i class="fa fa-comment-o text-danger"></i>
                    </span><?= lang('0156') ?></a>
                    </h3>
                </div>
                <div class="footer-block col-lg-3 col-md-3 col-sm-3 col-xs-3">
                    <h3 class="heading-contact-info">
                        <a href="https://api.whatsapp.com/send?phone=<?php if (!empty($ota_cms->contact->whatsapp_no)) {
                            echo $ota_cms->contact->whatsapp_no;
                        } else {
                            echo "123 456 789 ";
                        } ?>">
                    <span>
                    <i class="fa fa-whatsapp text-success"></i>
                    </span><?php if (!empty($ota_cms->contact->whatsapp_no)) {
                                echo $ota_cms->contact->whatsapp_no;
                            } else {
                                echo "123 456 789 ";
                            } ?></a>
                    </h3>
                </div>
            </div>
        </div>
    </div>
    <div class="sub_footer wow fadeIn">
        <div class="container">
            <div class="center">
                <ul class="nav nav-tabs RTL nav-justified">
                    <?php foreach ($ota_cms as $cm) { ?>
                        <li><a href="<?php echo base_url($cm->slug); ?>"><?= $cm->page_name ?></a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
    <nav class="container footer wow fadeIn">
        <div class="row">
            <div id="navbar" class="navbar-collapse">
                <ul class="nav navbar-nav hidden-xs hidden-sm">
                    <li class="supplier-signup"><a id="supplier-signup"
                                                   href="javascript:void(0)"><?= lang('0157') ?></a></li>
                    <li><a target="_blank" href="<?php echo SERVERURL . 'auth/login'; ?>"><?= lang('0158') ?></a></li>
                    <li><a target="_blank" href="https://www.agentpanel.com/signup"><?= lang('0159') ?></a></li>
                    <li><a target="_blank" href="https://www.agentpanel.com/login"><?= lang('0160') ?></a></li>
                    <form action="<?= SERVERURL . 'auth/signup/'  ?>"
                          target="_blank" id="hiddenform"></form>
                </ul>
                <ul class="nav navbar-nav navbar-right">
                    <li class="javascript:void(0)"><a
                                href="<?php echo base_url(); ?>"><?= lang('0161') ?>
                            <span class="sr-only">(current)</span></a></li>
                </ul>
            </div>
        </div>
    </nav>
</div>
<?php if (!empty($customization->footer_html)) {
    echo $customization->footer_html;
} ?>
<style>
    <?php if(!empty($customization->global_css)){echo $customization->global_css;} ?>
</style>

<script type="text/javascript" src="<?php echo $theme_url; ?>assets/js/script.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#all-hotels').click((e) => {
            e.preventDefault();
            var today = new Date();
            var tomorrow = new Date(today);
            var nextDate = new Date(today);
            tomorrow.setDate(today.getDate() + 1);
            nextDate.setDate(today.getDate() + 2);
            var next = tomorrow.toLocaleDateString();
            var next2 = nextDate.toLocaleDateString();

            // change date format
            next = next.split("/");
            next = pad(next[1], 2) + '-' + pad(next[0], 2) + '-' + next[2];
            next2 = next2.split("/");
            next2 = pad(next2[1], 2) + '-' + pad(next2[0], 2) + '-' + next2[2];
            var slug = 'hotels/' + next + '/' + next2 + '/2/0';
            window.location = "<?php echo base_url(); ?>" + slug;
        });


        <?php if(!empty($active_tab)){ ?>
        $(".navbar-nav li").removeClass('active');
        $("#menu_item_<?=$active_tab?>").addClass('active');
        <?php } ?>
    });

    $("#supplier-signup").click(function (e) {
        e.preventDefault();
        $("#hiddenform").submit();
    });

    function pad(num, size) {
        var s = num + "";
        while (s.length < size)
            s = "0" + s;
        return s;
    }

    var cb, optionSet1;

    function multiDelfunc(url, chkclass) {
        var checkedValues = $('.' + chkclass + ':checked').map(function () {
            return this.value;
        }).get();

        if (checkedValues.length < 1) {
            alert("Please select atleast one.");
        } else {
            var answer = confirm("Are you sure you want to delete?");
            if (answer) {
                $.post(url, {items: checkedValues}, function (theResponse) {
                    console.log(theResponse);
                    window.location = window.location.href;
                });
            }
        }
    }

    $('#subscribe').click(function () {
        if (validateEmail($(".newsletter_email").val() || $(".newsletter_email").val().trim() != "")) {
            $.ajax({
                url: '<?=base_url()?>home/subscribe',
                data: {
                    email: $('.newsletter_email').val(),
                },
                type: 'post',
                success: function (output) {
                    if (output) {
                        $('#news_success').show("slow");
                        $('#news_error').hide("slow");
                        $("#news_success").delay(3000).hide("slow");
                    } else {
                        $('#news_success').hide("slow");
                        $('#news_error').show("slow");
                        $("#news_error").delay(3000).hide("slow");
                    }
                }
            });
        } else {
            alert("Email Incorrect")
        }
    });

    function validateEmail($email) {
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        return emailReg.test($email);
    }


</script>
<?php include 'live.php'; ?>
</body>
</html>