<div class="panel panel-default row hidden-sm hidden-xs" style="margin-top:-15px;">
<div class="panel-heading">
<h4 style="margin:0px" class="text-center"><i class="fa fa-book"></i> Get Visa Today</h4>
</div>
</div>
<form id="visaform" class="search_form responsive" action="" method="GET">
  <div class="col-md-12 hide_on_availability">
    <div class="form-group">
        <label><?=lang('023')?> <?=lang('028')?></label>
        <select id="from" required="required">
         <option value=""><?=lang('027')?></option>
            <?php foreach ($countires as $country) { ?>
                <option <?php if($country->sortname == $ivisa_s->from_code){ echo "selected"; }  ?>  value="<?=$country->sortname;?>" ><?=$country->name?></option>
            <?php } ?>
        </select>
        <script>
            $("#from").select2({
                placeholder:"<?=lang('027')?>",
                width:'100%'
            });
        </script>
    </div>
    </div>
    <div class="col-md-12 hide_on_availability">
    <div class="form-group">
        <label><?=lang('024')?> <?=lang('028')?></label>
        <select class="select2" id="to" required="required">
         <option value=""><?=lang('027')?></option>
            <?php foreach ($countires as $country) { ?>
                <option  value="<?=$country->sortname;?>" <?php if($country->sortname == $ivisa_s->to_code){ echo "selected"; }  ?>  ><?=$country->name?></option>
            <?php } ?>
        </select>
        <script>
            $("#to").select2({
                placeholder:"<?=lang('027')?>",
                width:'100%'
            });
        </script>
    </div>
    </div>
    <div class="col-md-12 col-25">
        <div class="progress-btn">
         <button type="submit" class="btn btn-primary btn-lg btn-block ladda-button spin" data-style="expand-left"><span class="ladda-label"><?=lang('010')?></span></button>
        </div>
    </div>
</form>

<script>
$(document).ready(function() {
$("#visaform").submit(function(e){
e.preventDefault();
var from = $("#from").val();
var to = $("#to").val();
window.location.replace('<?=base_url('visa/')?>'+from+"/"+to);
});
});
</script>
<!--<script>-->
<!--/* Select2 */-->
<!--$(document).ready(function() {-->
<!--$(".select2").select2({-->
<!--width: '100%',-->
<!--});-->
<!--});-->
<!--</script>-->