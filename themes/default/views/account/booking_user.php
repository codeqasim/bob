<style>
    .nav-justified>li>a {
        margin-bottom: 0px;
    }
</style>
<ul class="nav nav-pills nav-justified" style="box-shadow: 0 5px 8px -6px rgba(0, 0, 0, .6)">
    <?php if ($user_data->is_login == false) { ?>
        <li class="active">
            <a data-toggle="pill" href="#" href="javascript:void(null)" onclick="user_form_select('guest')">
                <?= lang('0163') ?>
            </a>
        </li>
        <li>
            <a data-toggle="pill" href="javascript:void(null)" onclick="user_form_select('login')">
                <?= lang('0164') ?>
            </a>
        </li>

    <?php } else { ?>
        <input type="hidden" value="already_login" id="user_login_status" name="user_login_status">
    <?php } ?>
</ul>
<?php if ($user_data->is_login == false) { ?>
<input type="hidden" value="guest" id="user_login_status" name="user_login_status">
<?php } else { ?>
<input type="hidden" value="already_login" id="user_login_status" name="user_login_status">
<?php } ?>
<div id="ajax_login_response"></div>
<div class="panel panel-default guest">
    <div class="panel-heading"><?= lang('088') ?></div>
    <div class="panel-body" id="user_panel">
        <div class="row form-group">
            <div class="col-md-2"><label><?= lang('057') ?>*</label></div>
            <div class="col-md-2 col-xs-3">
                <select class="form-control" name="account[title]">
                    <option value="" disabled required="required"><?= lang('089') ?></option>
                    <option selected label="Mr" value="Mr"><?= lang('058') ?></option>
                    <option label="Ms" value="Ms"><?= lang('059') ?></option>
                    <option label="Mrs" value="Mrs"><?= lang('060') ?></option>
                </select>
            </div>
            <div class="col-md-4 col-xs-9">
                <input type="text" class="form-control" required="" placeholder="<?= lang('090') ?>"
                       name="account[first_name]"
                       <?php if ($user_data->is_login == true){ ?>value="<?= $user_data->first_name ?>"
                       readonly<?php } ?> required="required">
                <div class="hidden-lg hidden-md">
                    <br>
                </div>
            </div>
            <div class="col-md-4 col-xs-12">
                <input type="text" class="form-control" required="" placeholder="<?= lang('091') ?>" name="account[last_name]" <?php if ($user_data->is_login == true){ ?>value="<?= $user_data->last_name ?>" readonly<?php } ?> required="required">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2"><label><?= lang('094') ?>* </label></div>
            <div class="col-md-10">
                <input type="email" class="form-control" required="" name="account[email]" placeholder="<?= lang('061') ?>" <?php if ($user_data->is_login == true){ ?>value="<?= $user_data->email ?>" readonly<?php } ?> required="required">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-md-2"><label><?= lang('062') ?>* </label></div>
            <div class="col-md-5">
                <select id="mobile_code" class="form-control" name="account[mobile_code]">
                    <option value="">Mobile Code</option>
                    <?php foreach ($countries  as $country): ?>
                        <option value="<?=$country['phonecode']?>"><?=$country['phonecode']?> <?=$country['name']?></option>
                    <?php endforeach; ?>
                </select>
                <div class="hidden-lg hidden-md">
                    <br>
                </div>
            </div>
            <div class="col-xs-12 col-md-5">
                <input required="" type="number" name="account[number]" maxlength="18" minlength="6" placeholder="<?= lang('063') ?>" class="form-control" <?php if ($user_data->is_login == true && !empty($user_data->mobile_number)){ ?>value="<?= $user_data->mobile_number ?>" readonly<?php } ?>>
            </div>
        </div>
    </div>
</div>
<script>
    function user_form_select(type) {
        $(".select").select2("destroy").select2();
        if (type == 'login') {
            $('#user_login_status').val('login');
            var html_login = '<div class="alert alert-success"><?=lang('0165') ?> <a target="_blank" href="<?php echo base_url(); ?>account/signup"> <?=lang('0166') ?> </a> </div><div class="row form-group"> <div class="col-md-2"> <label><?=lang('094') ?>* </label> </div><div class="col-md-10"> <input type="email" class="form-control" name="account[email]" placeholder="<?=lang('094') ?>" value="" required="required"> </div></div><hr> <div class="row form-group"> <div class="col-md-2"> <label><?=lang('095') ?>* </label> </div><div class="col-md-10"> <input type="password" class="form-control" required name="account[password]" placeholder="<?=lang('095') ?>" value="" required="required"> </div></div>';
            $('#user_panel').html(html_login);
        } else {
            $('#user_login_status').val('guest');
            var html_guest = '<div class="row form-group"> <div class="col-md-2"><label><?=lang('057') ?>*</label></div><div class="col-md-2 col-xs-3"> <select class="form-control" name="account[title]"> <option value="" disabled required="required"><?=lang('089') ?></option> <option selected label="Mr" value="Mr"><?=lang('058') ?></option> <option label="Ms" value="Ms"><?=lang('059') ?></option> <option label="Mrs" value="Mrs"><?=lang('060') ?></option> </select> </div><div class="col-md-4 col-xs-9"> <input type="text" class="form-control" required="" placeholder="<?=lang('090') ?>" name="account[first_name]" <?php if ($user_data->is_login==true){ ?>value="<?=$user_data->first_name ?>" readonly<?php } ?> required="required"> <div class="hidden-lg hidden-md"> <br></div></div><div class="col-md-4 col-xs-12"> <input type="text" class="form-control" required="" placeholder="<?=lang('091') ?>" name="account[last_name]" <?php if ($user_data->is_login==true){ ?>value="<?=$user_data->last_name ?>" readonly<?php } ?> required="required"> </div></div><div class="row form-group"> <div class="col-md-2"><label><?=lang('094') ?>* </label></div><div class="col-md-10"> <input type="email" class="form-control" required="" name="account[email]" placeholder="<?=lang('061') ?>" <?php if ($user_data->is_login==true){ ?>value="<?=$user_data->email ?>" readonly<?php } ?> required="required"> </div></div><div class="row form-group"> <div class="col-md-2"><label><?=lang('062') ?>* </label></div><div class="col-md-5"> <select id="mobile_code" class="form-control" name="account[mobile_code]"> </select> <div class="hidden-lg hidden-md"> <br></div></div><div class="col-xs-12 col-md-5"> <input required="" type="tel" name="account[number]" maxlength="18" minlength="6" placeholder="<?=lang('063') ?>" class="form-control" <?php if ($user_data->is_login==true && !empty($user_data->mobile_number)){ ?>value="<?=$user_data->mobile_number ?>" readonly<?php } ?>> </div></div>';
            $('#user_panel').html(html_guest);
        }
        $('#mobile_code').select2({
            width: '100%',
            placeholder:"Mobile Code",
            ajax: {
                url: '<?php echo site_url("hotels/countries");?>',
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
    }

    $(document).ready(function () {
        $('#mobile_code').select2({
            width: '100%',
            placeholder:"Mobile Code"
        });
    });
</script>