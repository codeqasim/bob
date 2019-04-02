<style>
 header, nav, .footer{display:none}
 footer{display:none}
.text-red { color:red; }
</style>
</div>
<div class="col-md-4">
    <div class="panel-body stage">
        <div class="navbar-default">
            <div class="navbar-header btn-block">
                <a style="min-width:100%;background:#f4f6f8" class="navbar-brand btn-block center-block" href="<?php echo base_url(); ?>"><img src="<?php echo $image_path.$logo; ?>" data-retina="true" alt="" class="center-block"></a>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr style="1px solid #d2d2d2">
        <?=(!empty($msg))?$msg:"";?>
        <form action="<?php echo base_url('account/signup'); ?>" method="POST">
            <div class="form-group">
                <label><?=lang('090')?></label>
                <input id="username" type="text" placeholder="<?=lang('090')?>" name="first_name" autocomplete="off" class="form-control" required value="<?=(!empty($post['first_name']))?$post['first_name']:""?>">
                <i class="icon_mail_alt"></i>
                <span class="text-red"><?php echo form_error('first_name'); ?></span>
            </div>
            <div class="form-group">
                <label><?=lang('091')?></label>
                <input id="username" type="text" placeholder="<?=lang('091')?>" name="last_name" autocomplete="off" class="form-control" required value="<?=(!empty($post['last_name']))?$post['last_name']:""?>">
                <i class="icon_mail_alt"></i>
                <span class="text-red"><?php echo form_error('last_name'); ?></span>
            </div>
            <div class="form-group">
                <label><?=lang('094')?></label>
                <input id="username" type="email" placeholder="<?=lang('094')?>" name="email" autocomplete="off" class="form-control" required value="<?=(!empty($post['email']))?$post['email']:""?>">
                <i class="icon_mail_alt"></i>
                <span class="text-red"><?php echo form_error('email'); ?></span>
            </div>
            <div class="form-group">
                <label><?=lang('095')?></label>
                <input id="password" type="password" name="password" placeholder="<?=lang('095')?>" class="form-control" required value="<?=(!empty($post['password']))?$post['password']:""?>">
                <i class="icon_lock_alt"></i>
                <span class="text-red"><?php echo form_error('password'); ?></span>
            </div>
            <div class="form-group">
                <label><?=lang('096')?></label>
                <input id="password" type="password" name="cpassword" placeholder="<?=lang('096')?>" class="form-control" required value="<?=(!empty($post['cpassword']))?$post['cpassword']:""?>">
                <i class="icon_lock_alt"></i>
                <span class="text-red"><?php echo form_error('cpassword'); ?></span>
            </div>
            <div class="progress-btn">
                <button class="btn btn-primary btn-block ladda-button spin"  type="submit" data-style="expand-left"><span class="ladda-label"><?=lang('040')?></span></button>
            </div>
        </form>
        <h2></h2>
        <p class="text-center"><?=lang('0115')?></p>
        <h2></h2>
        <div class="progress-btn">
            <a class="btn btn-success btn-block ladda-button spin" href="<?php echo base_url(); ?>account/login" data-style="expand-left"><span class="ladda-label"><?=lang('039')?></span></a>
        </div>
    </div>
    <div class="clearfix"></div>
</div>
<div class="col-md-8">
    <div style="height:100vh; background: <?=$_SESSION['ota_data']->ota->color ?> url(<?php echo $image_path.$slider; ?>) no-repeat center 100%;" class="row account_bg"></div>
</div>
<div>