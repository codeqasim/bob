<div class="panel with-nav-tabs panel-default">
    <div class="panel-heading">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#GENERAL" data-toggle="tab">General Settings</a></li>
            <li><a href="#THEME" data-toggle="tab">Themes</a></li>
            <li><a href="#LANGUAGES" data-toggle="tab">Languages</a></li>
            <li><a href="#CURRENCIES" data-toggle="tab">Currencies</a></li>
            <!--<li><a href="#CONTACT" data-toggle="tab">Contact</a></li>-->
            <!--<li class="dropdown">
                <a href="#" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                <ul class="dropdown-menu" role="menu">
                        <li><a href="#tab4default" data-toggle="tab">Default 4</a></li>
                </ul>
                </li>-->
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="GENERAL">
                <form action="<?php echo base_url('settings'); ?>" method="POST" class="form-horizontal"
                      enctype="multipart/form-data">
                    <?php $this->load->view('front/messages'); ?>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Business Logo</label>
                        <div class="col-md-4">
                            <input type="file" class="btn btn-default upload-image" id="hlogo" name="logo">
                            <span class="help-block">Only PNG file supported</span>
                        </div>
                        <div class="col-md-4">
                            <img src="<?php if (!empty($settings_data->logo)) {
                                echo $settings_data->path . $settings_data->logo;
                            } else {
                                echo IMGURL . "logo.png";
                            } ?>" class="hlogo_preview_img img-fluid brand-logos logo">
                            <input type="hidden" name="old_logo" value=""/>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Favicon</label>
                        <div class="col-md-4">
                            <input type="file" class="btn btn-default upload-image" id="hfavicon" name="favicon">
                            <span class="help-block">Only PNG file supported</span>
                        </div>
                        <div class="col-md-4">
                            <img style="position: absolute; left: 188px; top: 32px; max-height: 34px;" src="<?php if (!empty($settings_data->favicon)) { echo $settings_data->path . $settings_data->favicon;
                            } else { echo IMGURL . "favicon.png"; } ?>" class="hlogo_preview_img img-fluid brand-logos favicon">
                            <input type="hidden" name="old_favicon" value=""/>
                            <img src="<?php echo base_url(); ?>assets/img/browser.png" alt="favicon" class="" />
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Business Name</label>
                        <div class="col-md-4">
                            <input name="business_name" value="<?php if (!empty($settings_data->business_name)) {
                                echo $settings_data->business_name;
                            } ?>" type="text" class="form-control" placeholder="Business Name"/>
                        </div>
                    </div>
                    <input type="hidden" name="type_settings" value="settings"/>

                    <hr>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Business Slogan</label>
                        <div class="col-md-4">
                            <input name="business_slogan" value="<?php if (!empty($settings_data->business_slogan)) {
                                echo $settings_data->business_slogan;
                            } ?>" type="text" class="form-control" placeholder="Business Slogan"/>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Copyrights</label>
                        <div class="col-md-4">
                            <input name="copyrights" value="<?php if (!empty($settings_data->copyrights)) {
                                echo $settings_data->copyrights;
                            } ?>" type="text" class="form-control " placeholder="Copyrights"/>
                        </div>
                    </div>
                    <!--                    <hr>-->
                    <!--                    <div class="row form-group">-->
                    <!--                        <label  class="col-md-2 control-label text-left">Multi Currency</label>-->
                    <!--                        <div class="col-md-4">-->
                    <!--                           <select name="" id="" class="form-control">-->
                    <!--                             <option value="enable">Enable</option>-->
                    <!--                             <option value="disable">Disable</option>-->
                    <!--                           </select>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <hr>-->
                    <!--                    <div class="row form-group">-->
                    <!--                        <label  class="col-md-2 control-label text-left">Multi Language</label>-->
                    <!--                        <div class="col-md-4">-->
                    <!--                           <select name="" id="" class="form-control">-->
                    <!--                             <option value="enable">Enable</option>-->
                    <!--                             <option value="disable">Disable</option>-->
                    <!--                           </select>-->
                    <!--                        </div>-->
                    <!--                    </div>-->
                    <!--                    <hr>-->
                    <hr>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">User Restriction</label>
                        <div class="col-md-4">
                            <select name="user_restrication" id="" class="form-control">
                                <option value="1"<?php if ($settings_data->user_restrication) {
                                    echo "selected";
                                } ?>>Enable
                                </option>
                                <option value="0" <?php if (!$settings_data->user_restrication) {
                                    echo "selected";
                                } ?> >Disable
                                </option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <?php if($package->is_currency_detection) {?>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">Auto Currency Detection</label>
                        <div class="col-md-4">
                            <select name="is_ota_currency_detection" id="" class="form-control">
                                <option value="1"<?php if ($settings_data->is_ota_currency_detection) {
                                    echo "selected";
                                } ?>>Enable
                                </option>
                                <option value="0" <?php if (!$settings_data->is_ota_currency_detection) {
                                    echo "selected";
                                } ?> >Disable
                                </option>
                            </select>
                        </div>
                    </div>
                    <?php } else{
                        echo "For auto currencies detection please update your package";
                    } ?>

                    <hr>
                    <div class="row form-group">
                        <label class="col-md-2 control-label text-left">User Registration</label>
                        <div class="col-md-4">
                            <select name="registration_restrication" id="" class="form-control">
                                <option value="1" <?php if ($settings_data->registration_restrication) {
                                    echo "selected";
                                } ?>>Enable
                                </option>
                                <option value="0" <?php if (!$settings_data->registration_restrication) {
                                    echo "selected";
                                } ?>>Disable
                                </option>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block btn-md">Save</button>
                </form>
            </div>
            <div class="tab-pane fade" id="THEME">
                <form action="<?php echo base_url('settings'); ?>" method="POST" class="form-horizontal"
                      enctype="multipart/form-data">
                    <div class="tab-pane wow fadeIn animated in" id="THEME">
                        <div class="row form-group">
                            <label class="col-md-2 control-label text-left">Theme</label>
                            <div class="col-md-4">
                                <select name="theme" class="form-control">
                                    <?php foreach ($themes as $t) { ?>
                                        <option value="<?php echo $t; ?>" <?php if ($settings_data->theme == $t) {
                                            echo 'selected="selected"';
                                        } ?>><?php echo $t; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <input type="hidden" name="type_settings" value="themes"/>
                        <hr>
                        <div class="row form-group">
                            <label class="col-md-2 control-label text-left">Hero Slider</label>
                            <div class="col-md-4">
                                <input type="file" class="btn btn-default upload-image" id="slider" name="slider">
                                <span class="help-block">Only JPG file supported</span>
                            </div>
                            <?php if (!empty($settings_data->slider)) { ?>
                                <div class="col-md-4">
                                    <img src="<?php echo $settings_data->path . $settings_data->slider; ?>"
                                         class="hlogo_preview_img img-responsive brand-logos slider-preview">
                                </div>
                            <?php } else { ?>
                                <img src="<?= IMGURL . "slider.jpg"; ?>"
                                     class="hlogo_preview_img img-responsive brand-logos slider-preview">
                            <?php } ?>
                        </div>
                        <hr>
                        <div class="row form-group">
                            <label class="col-md-2 control-label text-left">Main Color</label>
                            <div class="col-md-4">
                                <input type="color" class="form-control" name="color"
                                       value="<?= $settings_data->color ?>"/>
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-primary col-md-12">Save</button>
                    </div>
                </form>
            </div>
            <div class="tab-pane fade" id="LANGUAGES">
                <?php if ($package->multi_language) { ?>
                    <form method="post" id="myForm" action="post" class="form-inline">
                        <div class="list-group">
                            <?php foreach ($ota_languages as $ota_language) { ?>
                                <div class="list-group-item">
                                    <label for="<?= $ota_language->id ?>">
                                        <input type="checkbox"
                                               onchange="enable(this.id);" <?php if ($ota_language->name == "English") {
                                            echo "Disabled";
                                        } ?>   <?php if (!empty($ota_language->ota_id)) {
                                            echo "checked";
                                        } ?> id="<?= $ota_language->id ?>"> <?= $ota_language->country ?>
                                        - <?= $ota_language->name ?>
                                    </label>
                                    <input type="radio" name="default"
                                           onchange="change_default(this.id);" <?php if (!empty($ota_language->is_default)) {
                                        echo "checked";
                                    } ?> id="<?= $ota_language->id ?>lang">
                                </div>
                            <?php } ?>
                        </div>
                    </form>
                <?php } else { ?>
                    Please Update Your package
                <?php } ?>
            </div>
            <div class="tab-pane fade" id="CURRENCIES">
                <?php if ($package->multi_currency) { ?>
                    <form method="post" id="myForm" action="post" class="form-inline">
                        <div class="list-group">
                            <?php foreach ($ota_currencies as $ota_currency) { ?>
                                <div class="list-group-item">
                                    <label for="<?= $ota_currency->id ?>"><input type="checkbox"
                                                                                 onchange="enable_curriency(this.id);" <?php if ($ota_currency->name == "USD") {
                                            echo "Disabled";
                                        } ?>  <?php if (!empty($ota_currency->ota_id)) {
                                            echo "checked";
                                        } ?> id="<?= $ota_currency->id ?>curr"> <?= $ota_currency->country_name ?>
                                        - <?= $ota_currency->name ?></label>
                                    <input type="radio" name="default"
                                           onchange="change_default_currency(this.id);" <?php if (!empty($ota_currency->is_default)) {
                                        echo "checked";
                                    } ?> id="<?= $ota_currency->id ?>curr_">
                                </div>
                            <?php } ?>
                        </div>
                    </form>
                <?php } else { ?>
                    Please Update Your package
                <?php } ?>
            </div>
            <!--<div class="tab-pane fade form-horizontal" id="CONTACT">
            <div class="row form-group">
                <label  class="col-md-2 control-label text-left">Email Address</label>
                <div class="col-md-4">
                    <input name="email" value="" type="text" class="form-control" placeholder="Email" />
                </div>
            </div>
            <hr>
            <div class="row form-group">
                <label  class="col-md-2 control-label text-left">Phone Number</label>
                <div class="col-md-4">
                    <input name="phone" value="" type="number" class="form-control" placeholder="Phone" />
                </div>
            </div>
            <hr>
            <div class="row form-group">
                <label  class="col-md-2 control-label text-left">Whatsapp Number</label>
                <div class="col-md-4">
                    <input name="phone" value="" type="number" class="form-control" placeholder="Whatsapp" />
                </div>
            </div>
            </div>-->
        </div>
    </div>
</div>
<script type="text/javascript">
    function enable(id) {
        if ($('#' + id).is(':checked')) {
            $.ajax({
                url: '<?=base_url()?>dashboard/add_language',
                data: {
                    language_id: id,
                },
                type: 'post',
                success: function (output) {
                    if (output == "done") {
                        launch_toast();
                    } else {
                        alert("Error");
                    }
                }
            });
        }
        else {
            $.ajax({
                url: '<?=base_url()?>dashboard/delete_language',
                data: {
                    language_id: id,
                },
                type: 'post',
                success: function (output) {
                    if (output == "done") {
                        launch_toast();
                    } else {
                        alert("Error");
                    }
                }
            });
        }
    }

    function change_default(id) {
        var id_ = id.replace('lang', '');
        $.ajax({
            url: '<?=base_url()?>dashboard/change_default',
            data: {
                language_id: id_,
            },
            type: 'post',
            success: function (output) {
                if (output == "done") {
                    $("#" + id).attr('checked', true);
                    launch_toast();
                } else {
                    alert("Error");
                }
            }
        });
    }

    function enable_curriency(id) {
        var id_ = id.replace('curr', '');
        if ($('#' + id).is(':checked')) {
            $.ajax({
                url: '<?=base_url()?>dashboard/add_currency',
                data: {
                    currency_id: id_,
                },
                type: 'post',
                success: function (output) {
                    if (output == "done") {
                        launch_toast();
                    } else {
                        alert("Error");
                    }
                }
            });
        }
        else {
            $.ajax({
                url: '<?=base_url()?>dashboard/delete_currency',
                data: {
                    currency_id: id_,
                },
                type: 'post',
                success: function (output) {
                    if (output == "done") {
                        launch_toast();
                    } else {
                        alert("Error");
                    }
                }
            });
        }
    }

    function change_default_currency(id) {
        var id_ = id.replace('curr_', '');
        $.ajax({
            url: '<?=base_url()?>dashboard/change_default_currency',
            data: {
                currency_id: id_,
            },
            type: 'post',
            success: function (output) {
                if (output == "done") {
                    $("#" + id_).attr('checked', true);
                    launch_toast();
                } else {
                    alert("Error");
                }
            }
        });
    }


    function readLogo(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $('.logo').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#hlogo").change(function () {
        readLogo(this);
    });

    function readFavicon(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.favicon').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#hfavicon").change(function () {
        readFavicon(this);
    });

    function readFaviconSlider(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.slider-preview').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#slider").change(function () {
        readFaviconSlider(this);
    });
</script>