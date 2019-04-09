<style>
.order { width: 80px }
</style>
<div class"container">
    <div class="panel panel-default">
        <div class="panel-heading">Social Management</div>
        <div class="panel-body">
            <table class="xcrud-list table table-striped table-hover">
                <thead>
                    <tr class="xcrud-th">
                        <th style="width:20px">#</th>
                        <th style="width:180px" class="text-center">STATUS</th>
                        <th class="xcrud-column xcrud-action">NAME</th>
                        <th class="">ORDER</th>
                        <th class="">URL LINK</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                     <?php foreach($socials as $index=>$so) { ?>

                     <tr>

                        <td class="xcrud-current xcrud-num"><?=$index+1?>
                            <input type="hidden" name="" id="social_<?=$index+1?>" value="<?php if(empty($so->social_id)){echo "0";}else{echo $so->social_id;}?>">
                            <input type="hidden" name="" id="main_id<?=$index+1?>" value="<?=$so->id?>">
                        </td>
                        <td>
                        <label class="switch-light switch-ios">
                        <input type="checkbox" name='check' id="check_<?=$index+1?>" value="" <?php if($so->status){echo "checked";} ?> onclick="">
                        <span><span>Disable</span><span>Enable</span></span>
                        <a></a>
                        </label>
                        </td>


                        <td><?=$so->social_name;?></td>
                        <td><input type="number" name="social_order" id="order_<?=$index+1?>" class="order form-control input-sm text-center" value="<?php if(!empty($so->social_order)){echo $so->social_order; }else{ echo $index+1;}?>"/></td>
                        <td><input type="text" name="sdfdsfsdf" id="url_<?=$index+1?>" value="<?php if(!empty($so->social_link)){echo $so->social_link;}?>" class="form-control input-sm text-center" placeholder="URL Link" /></td>
                        <td class="xcrud-current xcrud-actions xcrud-fix">
                         <button onclick="subimt(<?=$index+1?>)" class="btn btn-default btn-sm">
                                <span class="glyphicon glyphicon-floppy-disk"></span>
                            </button></td>
                    </tr>
                    <?php } ?>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script>

    function subimt(i) {
        if(document.getElementById('check_'+i).checked) {
            var check = 1
        } else {
            var check = 0
        }
        var order = document.getElementById('order_'+i).value;
        var url = document.getElementById('url_'+i).value;
        var id_main = document.getElementById('main_id'+i).value;
        var social = document.getElementById('social_'+i).value;
        $.ajax({
            url: "<?php  echo site_url('dashboard/update_social'); ?>",
            type: 'POST',
            data: "social_order="+order+"&social_link="+url+"&social_status="+check+"&id="+id_main+"&social_id="+social,
            success: function (data) {
                if(data == "done")
                {
                    launch_toast();
                }else{
                    alert("SomeThing Wrong")
                }
            }
        });

    }


</script>