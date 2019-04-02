<div class="panel panel-default">
    <div class="panel-heading">Supplier Sign-Up</div>
    <div class="panel-body">
        <?php if(isset($message)){ ?>
        <div class="well">
            <div class="panel-body">
                <img src="<?php echo base_url(); ?>assets/img/check.png" class="img-responsive center-block" alt="" style="max-height: 100px;" />
                <hr>
                <h1 class="text-center text-success">Thanks!</h1>
                <h3 class="text-center">Your account has been registered with us. we will send you email shortly.</h3>
            </div>
        </div>
        <?php }
        if (isset($error) && !empty($error)): ?>
            <div class="alert alert-danger">
                <p><?php echo $error; ?></p>
            </div>
        <?php endif; 
        if(!isset($message)){?>
        <form action="<?php echo base_url('supplier/signup'); ?>" method="post" id="form_submit" class="form-horizontal">
            <fieldset>

                <div class="form-group">
                    <div class="col-md-2 control-label">First Name </div>
                    <div class="col-md-10">
                        <input id="first_name" class="form-control" type="text"  placeholder="First Name" name="first_name" value="<?php echo set_value('first_name'); ?>" required="">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2 control-label">Last Name </div>
                    <div class="col-md-10">
                        <input id="last_name" class="form-control" type="text" placeholder="Last Name" name="last_name" value="<?php echo set_value('last_name'); ?>" required="">
                    </div>
                </div>
                <hr class="soften">
                <div class="form-group">
                    <div class="col-md-2 control-label">Email</div>
                    <div class="col-md-10">
                        <input id="email" class="form-control" type="email" placeholder="Email" name="email" value="<?php echo set_value('email'); ?>" required="">
                    </div>
                </div>
                <hr class="soften">
                <div class="form-group">
                    <div class="col-md-2 control-label">Password</div>
                    <div class="col-md-10">
                        <input id="password" class="form-control" type="password" placeholder="Password" name="password" value="<?php echo set_value('password'); ?>" required="">
                    </div>
                </div>
                <hr class="soften">
                <div class="form-group">
                    <div class="col-md-2 control-label">Mobile</div>
                    <div class="col-md-10">
                        <input id="mobile" class="form-control" type="text" placeholder="Phone" name="mobile" value="<?php echo set_value('mobile'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2 control-label">Country</div>
                    <div class="col-md-10">
                        <select id="country" data-placeholder="Select" name="country_id" class="form-control countries" required="">
                            <option value=""> Select Country </option>
                            <?php foreach ($countries as $cnt): ?>
                                <option value="<?php echo $cnt->id; ?>" <?php if (set_value('country') == $cnt->name) {
                                echo 'selected="selected"';
                            } ?>><?php echo $cnt->name; ?></option>
                           <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2 control-label">State</div>
                    <div class="col-md-10">
                        <select id="state" data-placeholder="Select" name="state_id" class="form-control states" required="">
                            <option value=""> Select State </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2 control-label">City</div>
                    <div class="col-md-10">
                        <select id="" data-placeholder="Select" name="city_id" class="form-control cities" required="">
                            <option value=""> Select City </option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2 control-label">Address 1</div>
                    <div class="col-md-10">
                        <input id="address_one" class="form-control form" type="text" placeholder="Address" name="address_one" value="<?php echo set_value('address_one'); ?>">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-2 control-label">Address 2</div>
                    <div class="col-md-10">
                        <input id="address_two" class="form-control" type="text" placeholder="Address 2" name="address_two" value="<?php echo set_value('address_two'); ?>">
                    </div>
                </div>
            </fieldset>
            <br><br>
            <button type="submit" class="btn btn-primary btn-lg btn-block">Submit</button>
        </form>
        <?php } ?>
    </div>
</div>

<script>
    $(document).ready(function(){

        $(".countries").change(function() {
            $('.states')
                .empty();
            $('.cities')
                .empty();
            $('.cities').append(new Option("Select City", "0"));
            $('.states').append(new Option("Select State", "0"));
            $.ajax({ url: '<?=base_url()?>supplier/getStates',
                type: 'post',
                data : {
                country_id : $(".countries").val(),
                },
                dataType : 'json',
                success: function(output) {
                    var city_array =  output;
                    var list = $(".states");
                    if(city_array.length >0)
                    {
                        $.each(city_array, function(index, item) {
                                list.append(new Option(item.name, item.id));
                        });
                    }else{
                        $(".states").append(new Option("Select State", "0"));
                    }

                }
            });

        });
        $(".states").change(function() {
            $('.cities')
                .empty();
            $.ajax({ url: '<?=base_url()?>supplier/getCities',
                data: {
                    state_id: $(".states").val()
                },
                dataType : 'json',
                type: 'post',
                success: function(output) {
                    var city_array =  output;
                    $(".cities").append(new Option("Select City", "0"));
                    if(city_array.length >0)
                    {
                        $.each(city_array, function(index, item) {
                            $(".cities").append(new Option(item.name, item.id));
                        });
                    }

                }
            });

        });
    });
</script>