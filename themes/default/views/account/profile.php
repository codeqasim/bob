<div class="container">
<?php if (!empty($message)) { ?>
    <div class="alert alert-<?=$class?>"><?php echo $message; ?></div>
<?php } ?>
    <div class="clearfix"></div>
    <form action="<?=base_url("account/profile")?>"  method="POST" >
        <div class="form-horizontal">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title go-text-right"><?=lang('088');?></h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-3 go-right"><?=lang('090');?></div>
                        <div class="col-md-6 go-right">
                            <input class="form-control" type="text" placeholder="<?=lang('090');?>" name="first_name"  value="<?php if(!empty($user_data->first_name)){ echo $user_data->first_name; } ?>" readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 go-right"><?=lang('091');?></div>
                        <div class="col-md-6 go-right">
                            <input class="form-control" type="text" placeholder="<?=lang('091');?>" name="last_name"  value="<?php if(!empty($user_data->last_name)){ echo $user_data->last_name; } ?>"  readonly>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 go-right"><?=lang('092');?></div>
                        <div class="col-md-6 go-right">
                            <input class="form-control" type="text" placeholder="<?=lang('092');?>" name="mobile_number"  value="<?php if(!empty($user_data->mobile_number)){ echo $user_data->mobile_number; } ?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title go-text-right"><?=lang('093');?>?</h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-3 go-right"><?=lang('094');?></div>
                        <div class="col-md-6 go-right">
                            <input class="form-control" type="text" placeholder="<?=lang('094');?>" name="email"  value="<?php if(!empty($user_data->email)){ echo $user_data->email; } ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 go-right"><?=lang('095');?></div>
                        <div class="col-md-6 go-right">
                            <input class="form-control" type="password" placeholder="<?=lang('095');?>" name="password"  value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 go-right"><?=lang('096');?></div>
                        <div class="col-md-6 go-right">
                            <input class="form-control" type="password" placeholder="<?=lang('096');?>" name="confirmpassword"  value="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title go-text-right"><?=lang('097');?></h3>
                </div>
                <div class="panel-body">
                    <div class="form-group">
                        <div class="col-md-3 go-right"><?=lang('098');?></div>
                        <div class="col-md-6 go-right">
                            <input class="form-control" type="text" placeholder="<?=lang('098');?>" name="address"  value="<?php  if(!empty($user_data->address)){ echo $user_data->address; } ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 go-right"><?=lang('0105')?></div>
                        <div class="col-md-6">
                            <select id="country" data-placeholder="Select" name="country_id" class="form-control countries select2" required="">
                                <option value=""> <?=lang('030')?> <?=lang('0105')?></option>
                                <?php foreach ($countries as $cnt): ?>
                                    <option value="<?php echo $cnt->id;?>" <?php if($cnt->id == $user_data->country_id){ echo  " selected"; } ?> ><?php echo $cnt->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 go-right"><?=lang('0101')?></div>
                        <div class="col-md-6">
                            <select id="state" data-placeholder="Select" name="state_id" class="form-control states select2">
                                <option value=""> <?=lang('030')?> <?=lang('0101')?></option>
                                <?php foreach ($states as $state): ?>
                                    <option value="<?php echo $state->id; ?>" <?php if($state->id == $user_data->state_id){ echo  "selected"; } ?> ><?php  echo $state->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-3 go-right"><?=lang('0100')?></div>
                        <div class="col-md-6">
                            <select id="" data-placeholder="Select" name="city_id" class="form-control cities select2">
                                <option value=""> <?=lang('030')?> <?=lang('0100')?></option>
                                <?php foreach ($cities as $city): ?>
                                    <option value="<?php echo $city->id; ?>" <?php if($city->id == $user_data->city_id){ echo  "selected"; } ?> ><?php  echo $city->name; ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="panel-footer">
                    <div class="progress-btn">
                    <button class="btn btn-primary btn-block ladda-button spin" data-style="expand-left"><span class="ladda-label"><?=lang('086')?></span></button>
                </div>
                </div>
            </div>
        </div>
    </form>
</div>
<script>
$(".select2").select2({
placeholder:"<?=lang('030')?>",
width:'100%'
});
</script>
<script>
    $(document).ready(function(){

        $(".countries").change(function() {
            $('.states')
                .empty();
            $('.cities')
                .empty();
            $('.cities').append(new Option("Select City", "0"));
            $('.states').append(new Option("Select State", "0"));
            $.ajax({ url: "<?=base_url('home/getStates')?>",
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
            $.ajax({ url: "<?=base_url('home/getCities')?>",
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
