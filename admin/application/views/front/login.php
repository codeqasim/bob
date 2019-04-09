<style>
    header {
        display: none
    }

    footer {
        display: none
    }

    .image:before {
        width: 100%;
        opacity: 0.7;
        background: #0031bc;
        content: "";
        position: relative;
        height: 100%;
    }
</style>
</div>
<div class="col-md-4">

<div class="panel-body">
    <div class="navbar-default">
    <div class="navbar-header btn-block">
        <a class="navbar-brand btn-block" href="<?php echo base_url(); ?>">
        <h3><strong>BookOnBoard</strong></h3>
        </a>
    </div>
    </div>
    <div class="clearfix"></div>
    <hr style="1px solid #d2d2d2">
        <?php if (isset($error) && !empty($error)) { ?>
            <div class="alert alert-danger">
                <?php echo $error; ?>
            </div>
        <?php } ?>
        <form action="<?php echo base_url('login'); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input id="username" type="email" placeholder="Email" name="email" autocomplete="off"
                       class="form-control" required value="<?php if ($this->input->cookie('email') == TRUE) {
                    echo $this->input->cookie('email', TRUE);
                } ?>">
                <i class="icon_mail_alt"></i>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input id="password" type="password" name="password" placeholder="Password" class="form-control"
                       required value="<?php if ($this->input->cookie('password') == TRUE) {
                    echo $this->input->cookie('password', TRUE);
                } ?>">
                <i class="icon_lock_alt"></i>
            </div>
            <div class="row">
                <div class="col-xs-6">
                    <div class="checkboxes">
                        <label class="container_check">
                            <input type="checkbox" id="remember" name="remember" <?php if ($this->input->cookie('email') == TRUE) { echo 'checked="checked"'; } ?>>
                            Remember me
                        </label>
                    </div>
                </div>
                <div class="col-xs-6 text-right"><a id="forgot" data-toggle="collapse" data-target="#forgetpass" aria-expanded="false" aria-controls="forgetpass" href="javascript:void(0);">Forgot Password ?</a>
                </div>
            </div>
            <div class="clearfix"></div>
            <hr>
            <div class="progress-btn">
            <button name="login-submit" class="btn btn-success btn-lg btn-block ladda-button spin" data-style="expand-left"><span class="ladda-label">Login</span></button>
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
                        <button type="submit" class="r btn btn-warning btn-block">Resend Email</button>
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
    <div style="height:100vh; background: #0031bc url(<?php echo base_url(); ?>assets/img/account.jpg) no-repeat center 100%;"
         class="row image"></div>
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
    })
    $('#resend_email').submit(function (e) {
        e.preventDefault();
        var data = $('#resend_email').serializeArray();
        $.ajax({
            url: '<?=base_url("home/forget_password")?>',
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
</script>
<div>