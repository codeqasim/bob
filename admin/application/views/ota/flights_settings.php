<?php  if(!empty($errors)){ ?>
    <div class="alert alert-danger"> <?=$errors?></div>
<?php } ?>

<div class="panel panel-default">
 <div class="panel-heading">Module Settings</div>
 <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="PROFILE">
                <form action="<?=base_url('flights/settings')?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <?php $this->load->view('front/messages'); ?>

                    <!--<div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Global Markup</label>
                        <div class="col-md-2">
                         <input type="number" placeholder="Percentage" min="0" max="100" class="form-control" />
                        </div>
                    </div>
                    <hr>-->
                    <!--<div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Listing page results</label>
                        <div class="col-md-2">
                         <input type="number" placeholder="Number" min="0" class="form-control" />
                        </div>
                    </div>
                    <hr>-->
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Pay Later</label>
                        <div class="col-md-2">
                            <label class="switch-light switch-ios">
                                <input type="checkbox" name="pay_later" <?php if(!empty($data->pay_later)){ echo "checked";} ?>>
                                <span><span>Disable</span><span>Enable</span></span>
                                <a></a>
                            </label>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Pay Now</label>
                        <div class="col-md-2">
                            <label class="switch-light switch-ios">
                                <input type="checkbox" name="pay_now" <?php if(!empty($data->pay_online)){ echo "checked";} ?>>
                                <span><span>Disable</span><span>Enable</span></span>
                                <a></a>
                            </label>
                        </div>
                    </div>
                    <input name="testing" type="hidden" value="1231">
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Test Mode</label>
                        <div class="col-md-2">
                        <label class="switch-light switch-ios">
                        <input type="checkbox" name="test" <?php if(!empty($data->test)){ echo "checked"; } ?>>
                        <span><span>Disable</span><span>Enable</span></span>
                        <a></a>
                        </label>
                         <input type="hidden" name="test123"  placeholder="" min="0" value="something" class="form-control" />
                        </div>
                    </div>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Feature Cities</label>
                        <div class="col-md-2">
                        <label class="switch-light switch-ios">
                        <input type="checkbox" name="is_feature_cities" <?php if(!empty($data->is_feature_cities)){ echo "checked"; } ?>>
                        <span><span>Disable</span><span>Enable</span></span>
                        <a></a>
                        </label>
                        </div>
                    </div>
                    <hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Featured Flights</label>
                        <div class="col-md-10">
                            <span onclick="add_row()" class="btn btn-primary pull-right" style="margin-bottom: 10px">Add More</span>
                            <table class="table table-striped table-responsive table-bordered">
                                <thead>
                                    <tr>
                                     <td>Airline</td>
                                     <td>From City</td>
                                     <td>To City</td>
                                     <td>Order</td>
                                     <td></td>
                                    </tr>
                                </thead>
                                <tbody id="more_row">
                                  <?php foreach ($data->feature_cities as $item) { ?>
                                    <tr id="1">
                                        <td><select name="airlines[]" required id="" class="myselect_airlines"><option value="<?=$item->airline?>"><?=$item->airline_name?></option></select></td>
                                        <td><select name="froms[]" required id="" class="myselect"><option value="<?=$item->from?>"><?=$item->from_name?></option></select></td>
                                        <td><select name="tos[]" required id="" class="myselect"><option value="<?=$item->to?>"><?=$item->to_name?></option></select></td>
                                        <td><input name="numbers[]" required style="width:70px" id="number1" class="form-control"  type="number" value="<?=$item->number?>" /></td>
                                        <td><span class="btn btn-danger" onclick="remove_row(1)"><i class="fa fa-times"></i></span></td>
                                    </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary btn-block">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>
<input type="hidden" value="<?php if(!empty($data->feature_cities)) { echo count($data->feature_cities)-1;}else{ echo  "0";}?>" id="number_counter">
<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script>
/* Select2 */
function remove_row(id){
    $("#"+id).remove();
}
function add_row(){
    $('.myselect').select2("destroy");
    $('.myselect_airlines').select2("destroy");
    var number = parseInt($("#number_counter").val());
    var number = number+1;
    $('#more_row').append('<tr id="'+number+'"><td><select name="airlines[]" required id="" class="myselect_airlines"><option value="">Select Airline</option></select></td>\n' +
        '                                        <td><select name="froms[]" required id="" class="myselect"><option value="">Select Airline</option></select></td>\n' +
        '                                        <td><select name="tos[]" required id="" class="myselect"><option value="">Select Airline</option></select></td>\n' +
        '                                        <td><input name="numbers[]" required id="number'+number+'" style="width:70px" class="form-control" type="number" value="'+number+'" /></td>\n' +
        '                                        <td><span class="btn btn-danger" onclick="remove_row('+number+')"><i class="fa fa-times"  ></i></span></td>\n' +
        '                                    </tr>');
    $("#number_counter").val(number);
    $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
    $('.myselect').select2({
        placeholder: "Select",
        width: '100%',
        minimumInputLength: 3,
        ajax: {
            url: '<?=base_url('home/airports')?>',
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    $('.myselect_airlines').select2({
        placeholder: "Select",
        width: '100%',
        minimumInputLength: 3,
        ajax: {
            url: '<?=base_url('home/get_cities')?>',
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
$(document).ready(function() {
    $('.myselect').select2({
        placeholder: "Select",
        width: '100%',
        minimumInputLength: 3,
        ajax: {
            url: '<?=base_url('home/airports')?>',
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
    $('.myselect_airlines').select2({
        placeholder: "Select",
        width: '100%',
        minimumInputLength: 3,
        ajax: {
            url: '<?=base_url('home/get_cities')?>',
            dataType: 'json',
            processResults: function (data) {
                return {
                    results: data
                };
            },
            cache: true
        }
    });
});
</script>
