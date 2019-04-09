<?php $this->load->view('front/messages'); ?>
<div class="panel panel-default">
 <div class="panel-heading">Account</div>
  <div class="panel-body">
<div class="panel with-nav-tabs panel-default">
    <div class="panel-heading">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#PAYMENT" data-toggle="tab">Payment</a></li>
            <li><a href="#INVOICES" data-toggle="tab">Invoices</a></li>
            <li><a href="#PROFILE" data-toggle="tab">Profile</a></li>
        </ul>
    </div>
    <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade  in active" id="PAYMENT">
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left"><h4 class="text-center"><strong>Package</strong></h4></label>
                        <div class="col-md-4"><h4><?php echo $account_data->title." USD $".  $account_data->price; ?> / Monthly</h4></div>
                        <!--<div class="col-md-4">
                            <select class="form-control" name="amount" id="select_amount" required="required">
                                <option value="0">Startup</option>
                                <option value="0">Agency</option>
                                <option value="0">Pro</option>
                                <option value="0" disabled>Entreprise</option>
                            </select>
                        </div>

                        <div class="col-md-6">
                            <button id="upgrade" class="btn btn-success btn-block">Upgrade</button>
                        </div>-->
                    </div>
                    <hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left"><h4 class="text-center">
                        <strong>Amount</strong></h4>
                        </label>
                        <div class="col-md-2">
                          <span style="position: absolute; left: 31px; top: 7px; font-size: 20px; color: #0a4fd0; font-weight: bold;">$</span>
                            <input type="number" class="form-control" id="select_amount" name="amount" placeholder="Enter Amount" style="padding-left:40px;font-size: 12px;" />
                           <!-- <select class="form-control" name="amount" id="select_amount" required="required">
                                <option value="0">Select Amount</option>
                                <option value="10">$25 </option>
                                <option value="20">$50 </option>
                                <option value="30">$100 </option>
                            </select>-->
                        </div>
                        <form method="post"  id="submit_amount" action="<?=base_url('account')?>">
                           <input type="hidden" id="amount_value" name="amount">
                        </form>
                        <div class="col-md-2">
                            <button id="btn_paynow" class="btn btn-primary btn-block">Pay Now</button>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <div class="col-md-6 ">
                            <div class="well well-sm text-center"><h3 class="text-sucess"> Available Balance $<strong><?=$account_data->balance?></strong></h3></div>
                        </div>
                    </div>
                     <hr>
                    <div class="row form-group">
                        <div class="col-md-6 ">
                            <div class="well well-sm text-center"><h3 class="text-danger"> Charges to be Paid $<strong><?=$account_data->debit_balance?></strong></h3></div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
            </div>

            <div class="tab-pane fade" id="PROFILE">
                <form action="<?=base_url('account')?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <?php $this->load->view('front/messages'); ?>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">First Name</label>
                        <div class="col-md-4">
                            <input name="first_name" value="<?php  if(!empty($account_data->first_name)){ echo $account_data->first_name;} ?>" type="text" class="form-control" placeholder="First Name" />
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Last Name</label>
                        <div class="col-md-4">
                            <input name="last_name" value="<?php  if(!empty($account_data->last_name)){ echo $account_data->last_name;} ?>" type="text" class="form-control" placeholder="Last Name" />
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Mobile Number</label>
                        <div class="col-md-4">
                            <input name="mobile_number" value="<?php  if(!empty($account_data->mobile_number)){ echo $account_data->mobile_number;} ?>" type="text" class="form-control" placeholder="Mobile Number" />
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Email</label>
                        <div class="col-md-4">
                            <input name="email" value="<?php  if(!empty($account_data->email)){ echo $account_data->email;} ?>" type="text" class="form-control" placeholder="Email" />
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Password</label>
                        <div class="col-md-4">
                            <input name="password" value="" type="text" class="form-control" placeholder="Password" />
                        </div>
                    </div>

                    <hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Country</label>
                        <div class="col-md-4">
                            <select class="form-control" name="country_id" required="required">
                                <option value="">Select Country</option>
                                <?php foreach ($countries as $country) {?>
                                    <option value="<?=$country->id?>" <?php if($country->id == $account_data->country_id){ echo "selected";} ?> ><?=$country->name?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Address</label>
                        <div class="col-md-4">
                            <input name="address" value="<?php  if(!empty($account_data->address)){ echo $account_data->address;} ?>" type="text" class="form-control" placeholder="Address" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block bt   n-md">Save</button>
                </form>
            </div>

            <div class="tab-pane fade" id="INVOICES">
                <?php echo $transactions; ?>
            </div>
        </div>
    </div>
</div>
 </div>
</div>
<script>

    $('#btn_paynow').click(function(){
        if($("#select_amount").val() != "0")
        {
            $("#amount_value").val($("#select_amount").val());
            $("#submit_amount").submit();
        }else{
            alert("please select amount.")
        }
    });

</script>