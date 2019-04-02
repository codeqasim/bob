<style>
    header, nav, .footer {
        display: none
    }

    footer {
        display: none
    }

    .text-red {
        color: red
    }
</style>
</div>
<div class="col-md-4">
    <div class="panel-body stage">
        <div class="navbar-default">
            <div class="navbar-header btn-block">
                <a style="min-width:100%;background:#f4f6f8" class="navbar-brand btn-block center-block"
                   href="<?php echo base_url(); ?>"><img src="<?php echo $image_path . $logo; ?>" data-retina="true"
                                                         alt="" class="center-block"></a>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr style="1px solid #d2d2d2">
        <?=(!empty($msg)) ? $msg : ""; ?>
        <form action="<?php echo base_url('account/login'); ?>" method="post">
            <div class="form-group">
                <label><?= lang('094') ?></label>
                <input id="username" type="email" placeholder="<?= lang('094') ?>" name="email" autocomplete="off"
                       class="form-control" required value="">
                <i class="icon_mail_alt"></i>
                <span class="text-red"><?php echo form_error('email'); ?></span>
            </div>
            <div class="form-group">
                <label><?= lang('095') ?></label>
                <input id="password" type="password" name="password" placeholder="<?= lang('095') ?>"
                       class="form-control" required value="">
                <i class="icon_lock_alt"></i>
                <span class="text-red"><?php echo form_error('password'); ?></span>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="checkboxes">
                        <label class="container_check">
                            <input type="checkbox" id="remember" name="remember">
                            <?= lang('0113') ?>
                        </label>
                    </div>
                </div>
                <div class="col-xs-6 text-right"><a id="forgot" data-toggle="collapse" data-target="#forgetpass"
                                                    aria-expanded="false" aria-controls="forgetpass"
                                                    href="javascript:void(0);"><?= lang('0112') ?> ?</a>
                </div>
            </div>
            <div class="progress-btn">
                <button type="submit" class="btn btn-success btn-block ladda-button spin" data-style="expand-left"><span
                            class="ladda-label"><?= lang('039') ?></span></button>
            </div>
            <h2></h2>
            <p class="text-center"><?= lang('0116') ?></p>
            <h2></h2>
            <div class="progress-btn">
                <a class="btn btn-primary btn-block ladda-button spin" href="<?php echo base_url(); ?>account/signup"
                   data-style="expand-left"><span class="ladda-label"><?= lang('040') ?></span></a>
            </div>
        </form>
        <div class="collapse" id="forgetpass" style="position: relative; z-index: 9999;">
            <form id="resend_email" method="POST">
                <div class="well">
                    <div class="form-group">
                        <input placeholder="Email Adress emailaddress" type="email" class="form-control" name="email"
                               required/>
                        <i class="icon_mail_alt"></i>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="r btn btn-warning btn-block"> <?= lang('0117') ?></button>
                    </div>
                    <div class="alert alert-success" id="success">Reset done please check your email.</div>
                    <div class="alert alert-danger" id="errors">Sorry this email was not found try again.</div>
                </div>
            </form>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="col-md-8">
    <div style="height:100vh; background: <?=$_SESSION['ota_data']->ota->color ?> url(<?php echo $image_path . $slider; ?>) no-repeat center 100%;"
         class="row account_bg"></div>
</div>
<script type="text/javascript">
    $('#errors').hide();
    $('#success').hide();
    $(document).ready(function () {
        $('#forgot-form').submit(function (e) {
            e.preventDefault();
            var $this = $(this);
            $('#forgot-form .btn').attr('disabled', 'disabled');
            $.ajax({
                type: 'POST',
                data: $('#forgot-form').serialize(),
                url: '<?php echo base_url(); ?>ota/forgot-password',
                success: function (response) {
                    $this.append(response);
                    $('#forgot-form input[type=text]').val(' ');
                    setTimeout(() => {
                        $('#forgot-form .alert').fadeOut('slow');
                        $('#forgot-form .btn').removeAttr('disabled');
                    }, 3000)
                }
            });
        });
    });


    $('#resend_email').submit(function (e) {
        e.preventDefault();
        var data = $('#resend_email').serializeArray();

        $.ajax({
            url: '<?=base_url("account/forget_password")?>',
            data: data,
            type: 'post',
            success: function (output) {
                if (output) {
                    $("#success").show("slow");
                    $('#errors').hide("slow");
                    $("#success").delay(3000).hide("slow");
                } else {
                    $('#success').hide("slow");
                    $('#errors').show("slow");
                    $("#errors").delay(3000).hide("slow");

                }
            }
        });
    });


    // function validateEmail($email) {
    //     var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
    //     return emailReg.test( $email );
    // }

</script>
<div>