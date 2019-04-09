<?php  if(!empty($errors)){ ?>
    <div class="alert alert-danger"> <?=$errors?></div>
<?php } ?>

<div class="panel panel-default">
 <div class="panel-heading">Module Settings</div>
 <div class="panel-body">
        <div class="tab-content">
            <div class="tab-pane fade in active" id="PROFILE">
                <form action="<?=base_url(uri_string())?>" method="POST" class="form-horizontal" enctype="multipart/form-data">
                    <?php $this->load->view('front/messages'); ?>

                    <!--<div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Global Markup</label>
                        <div class="col-md-2">
                         <input type="number" placeholder="Percentage" min="0" max="100" class="form-control" />
                        </div>
                    </div>-->
                    <input name="testing" type="hidden" value="1231">
                    <!--<hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Listing page results</label>
                        <div class="col-md-2">
                         <input type="number" placeholder="Number" min="0" class="form-control" />
                        </div>
                    </div>-->
                    <!--<hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Related Hotels</label>
                        <div class="col-md-2">
                         <input type="number" placeholder="Number" min="0" class="form-control" />
                        </div>
                    </div>-->
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
                    <hr>
                    <div class="row form-group">
                        <label  class="col-md-2 control-label text-left">Featured Cities</label>
                        <div class="col-md-10">
                            <table class="table table-striped table-responsive table-bordered">
                                <thead>
                                    <tr>
                                     <td>City Name</td>
                                     <td>Order</td>
                                     <td>Image</td>
                                     <td></td>
                                    </tr>
                                </thead>

                               <?php foreach ($data->feature_cities as $feature_city )  {?>
                                <tr>
                                <td>
                                <input disabled name="" class="form-control" value="<?=$feature_city->city;?>" ></input>
                                </td>
                                <td>
                                <input type="number" name="" onchange="change_number(this.value,'<?=$feature_city->city_id?>')" class="form-control text-center" value="<?=$feature_city->number?>"/>
                                </td>
                                <td>
                                <img src="<?=$feature_city->image?>" style="max-width:50px" class="img-responsive img-thumbnail">
                                </td>
                                <td>
                                <span class="btn btn-danger btn-block" onclick="remove_city('<?=$feature_city->city_id?>')"><i class="fa fa-times"></i></span>
                                </td>
                                </tr>
                               <?php } ?>
                            </table>
                            <hr>
                            <span class="btn btn-primary col-md-4" data-toggle="modal" data-target="#myModal">Add More</span>
                            <input type="hidden" id="number" value="1">
                        </div>
                    </div>
                    <hr>
                    <button type="submit" class="btn btn-primary btn-block btn-lg">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content modal-lg">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" style="color:#ffffff">&times;</button>
                <h4 class="modal-title">Featured Cities</h4>
            </div>
            <form method="post" id="form_submit">
            <div class="modal-body">
                <div class="row form-group">
                    <!--<label  class="col-md-2 control-label text-left">Featured Cities</label> -->
                    <div class="col-md-12">
                        <div class="more_row">
                            <div class="row">
                                <div class="col-md-4"><select name="feature_cities[]" required class="myselect"></select></div>
                                <input name="module_id" type="hidden" value="<?=$data->module_id?>">
                                <div class="col-md-2"><input type="number" name="order_number[]" onchange="" class="form-control text-center" value="1"/><br></div>
                                <div class="col-md-4"><input type="file" required name="cities_images[]" class="form-control" accept="image/*" ><br></div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="btn btn-primary" onclick="add_row()">Add More</span>
            </div>       
            <!--<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button   class="btn btn-primary">Save</button>
           </div>-->
            <div class="progress-btn">
            <button type="submit" class="btn btn-success btn-block ladda-button spin" data-style="expand-left"><span class="ladda-label">Save</span></button>
             </div>
            </form>
        </div>
    </div>
</div>

<script src="<?php echo base_url(); ?>assets/js/select2.min.js"></script>
<script>
/* Select2 */
$(document).ready(function() {
    $('.myselect').select2({
        placeholder: "Select a City",
        width: '100%',
        minimumInputLength: 3,
        ajax: {
            url: '<?=base_url('home/cities')?>',
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
<script>
    function remove_city(name)
    {
        var result = confirm("Want to delete?");
        if (result) {

            $.post("<?php  echo site_url('dashboard/delete_hotel_feature'); ?>", {
                name: name,
                module_id : "<?=$data->module_id?>"
            }, function (data) {
                if (data == "success") {
                    launch_toast();
                    setTimeout(
                        function()
                        {
                            window.location.reload();
                        }, 2000);
                } else {
                    $("#msg").html("<div class='alert alert-danger'>"+data['error']+"</div>");
                }
            });
        }

    }
    function add_row(){
        $('.myselect').select2("destroy");
        var number = parseInt($("#number").val());
        var number = number+1;
        $('.more_row').append('<div class="row" id="'+number+'"><div class="col-md-4"><select id="selet2_'+number+'" name="feature_cities[]" class="myselect"></select></div> <div class="col-md-2"><input type="number" name="order_number[]" onchange="" class="form-control text-center" value="1"/><br></div><div class="col-md-4"><input type="file" name="cities_images[]" class="form-control" accept="image/*"></input></div><div class="col-md-2"><span class="btn btn-danger btn-block" onclick="remove('+number+')"><i class="fa fa-times"></i></span><br></div>\n' +
            '                                    <br>\n' +
            '                                </div>');
        $("#number").val(number);
        $('.myselect').select2({
            placeholder: "Select a City",
            width: '100%',
            minimumInputLength: 3,
            ajax: {
                url: '<?=base_url('home/cities')?>',
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data
                    };
                },
                cache: true
            }
        });
        $("html, body").animate({ scrollTop: $(document).height()-$(window).height() });
    }
    function remove(id){
        $('#'+id).html('');
    }
    function change_number(number,city_id)
    {
        $.post("<?php  echo site_url('dashboard/change_number_hotel_feature'); ?>", {
            number: number,
            module_id : "<?=$data->module_id?>",
            city_id : city_id,
        }, function (data) {
            if (data == "success") {
                launch_toast();
            } else {
                $("#msg").html("<div class='alert alert-danger'>"+data['error']+"</div>");
            }
        });
    }
    $( "#form_submit" ).submit(function( event ) {
        event.preventDefault();
        var form = $('#form_submit')[0];
        var formData = new FormData(form);
        $.ajax({
            url: "<?php  echo site_url('dashboard/update_hotel_feature'); ?>",
            //enctype: 'multipart/form-data',
            type: 'POST',
            data: formData,
            success: function (data) {
                if (data == "success") {

                    launch_toast();
                    $('#myModal').modal('hide');
                    setTimeout(
                        function()
                        {
                            window.location.reload();
                        }, 2000);
                } else {
                    $("#msg").html("<div class='alert alert-danger'>"+data['error']+"</div>");
                }
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });

</script>
<!--<link rel="stylesheet" href="<?php echo base_url(); ?>assets/multi_select/multiple-select.css" />
<script src="<?php echo base_url(); ?>assets/multi_select/multiple-select.js"></script>
<script>
$(function() {
$('#ms').change(function() {
console.log($(this).val());
}).multipleSelect({
width: '100%',
placeholder: "Select",
filter: true,
multiple: true,
single: true
});
});
</script>
<style>
.multiple{width:100% !important}
</style>-->