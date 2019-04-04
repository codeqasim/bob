<style>
    header{display:none}
    footer{display:none}
    .image:before { width: 100%; opacity: 0.7; background: #0031bc; content: ""; position: relative; height: 100%;}
</style>
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>

</div>
<div class="col-md-4" style="height: 100vh; overflow: scroll; overflow-x: hidden;">
    <div class="panel-body">
        <div class="navbar-default">
            <div class="navbar-header btn-block">
                <a class="navbar-brand btn-block" href="<?php echo base_url(); ?>"><img src="<?php echo base_url(); ?>assets/img/logo.png" width="155" height="36" data-retina="true" alt="" class="center-block"></a>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr style="1px solid #d2d2d2">
        <?php if(!empty($error)) {?>
            <div class="alert alert-danger"><?=$error?></div>
        <?php } ?>
        <form action="<?= base_url('signup') ?>" method="post">
            <!--<div class="access_social">
                <a href="#0" class="social_bt facebook">Login with Facebook</a>
                <a href="#0" class="social_bt google">Login with Google</a>
                <a href="#0" class="social_bt linkedin">Login with Linkedin</a>
                </div>
                <div class="divider"><span>Or</span></div>-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control" value="<?=set_value('first_name')?>" type="text" name="first_name" placeholder="First Name" required>
                        <i class="ti-user"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" value="<?=set_value('last_name')?>" type="text" name="last_name" placeholder="last Name" required>
                        <i class="ti-user"></i>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <label>Email</label>
                <input class="form-control" value="<?php if(!empty($email)){ echo $email;}?>" type="text" name="email" placeholder="" required>
                <i class="ti-email"></i>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input class="form-control" type="password" name="password" required>
                <i class="icon_lock_alt"></i>
            </div>
            <div class="form-group">
                <label>Business Name</label>
                <input class="form-control" value="<?=set_value('business_name')?>" type="text" name="business_name" placeholder="Business Name" required>
                <i class="ti-medall-alt"></i>
            </div>
            <!--            <div class="form-group">-->
            <!--                <label>Domain Name</label>-->
            <!--                <input class="form-control" value="--><?//=set_value('ota_domain')?><!--" type="text" name="ota_domain" placeholder="" required>-->
            <!--                <i class="ti-medall-alt"></i>-->
            <!--            </div>-->
            <!--<div class="form-group">
                <label>Sub Domain &nbsp; <small class="muted" style="color:#ABABAB">ABC.TRAVELHOPE.NET</small></label>
                <input class="form-control" value="<?=set_value('ota_subdomain')?>" onkeypress="inputValidation(event, this)" type="text" name="ota_subdomain" placeholder="" required>
                <i class="ti-medall-alt"></i>
            </div>-->
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Country Name</label>
                        <select class="select2" name="country_id" required="required">
                            <option value="">Select Country</option>
                            <?php foreach ($countries as $country) {?>
                                <option value="<?=$country->id?>"><?=$country->name?></option>
                            <?php } ?>
                        </select>
                        <i class="ti-medall-alt"></i>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Package Name</label>
                        <select class="form-control" name="package_id" required>
                            <option value="">Select Packages</option>
                            <?php foreach ($packages as $package) {  ?>
                                <option <?php if(!empty($package_id) && ($package->id == $package_id)){ echo "selected";} ?> value="<?=$package->id?>"><?php if($package->price != "Contact Us") { echo $package->title. ' $'.$package->price;}else{echo $package->title;}?></option>
                            <?php }  ?>
                        </select>
                        <i class="ti-medall-alt"></i>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" value="">
            <div class="progress-btn">
                <button name="login-submit" class="btn btn-success btn-lg btn-block ladda-button spin" data-style="expand-left"><span class="ladda-label">SignUp</span></button>
            </div>
            <!-- <p class="text-center">Have account already ?</p>
        <h2></h2>
        <a class="btn btn-primary btn-block"href="<?php echo base_url(); ?>login">Login!</a>-->
        </form>

    </div>
</div>
<div class="col-md-8">
    <div style="height:100vh; background: #0031bc url(<?php echo base_url(); ?>assets/img/account.jpg) no-repeat center 100%;" class="row image"></div>
</div>
</div>
<div>

    <script>
        $(document).ready(function() {
            $(".select2").select2({
                width: '100%',
            });
        });
        function inputValidation(event, elem)
        {
            var keyCode = event.which || event.keyCode;
            var element = $(elem);

            if(keyCode !== 8 && keyCode == 32) {
                event.preventDefault();
                element.trigger('onkeypress');
            }
        }
    </script>