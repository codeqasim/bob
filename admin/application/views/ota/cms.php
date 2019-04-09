<style>
.order { width: 80px }
 td { text-transform: uppercase; letter-spacing: 2px; font-weight: bold; }
</style>
<div class"container">
    <div class="panel panel-default">
        <div class="panel-heading">CMS Page Management</div>
        <div class="panel-body">
            <table class="xcrud-list table table-striped table-hover">
                <thead>
                    <tr class="xcrud-th">
                        <th style="width:20px">#</th>
                        <th style="width:180px" class="text-center">STATUS</th>
                        <th class="xcrud-column xcrud-action">NAME</th>
                        <th class="">EDIT</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($cmspages as $index=>$cm) {?>
                     <tr>
                        <td class="xcrud-current xcrud-num"><?=$index+1?></td>
                        <td>
                        <label class="switch-light switch-ios">
                        <input type="checkbox"  id="<?=$cm->id?>" onchange="enable(this.id);"  <?php if($cm->status){ echo "checked";}?>>
                        <span><span>Disable</span><span>Enable</span></span>
                        <a></a>
                        </label>
                        </td>
                        <td><?=$cm->page_name?></td>
                        <td class="xcrud-current xcrud-actions xcrud-fix"><span class="btn-group"><a class="btn btn-default btn-sm btn btn-warning" href="<?=base_url('cms/'.$cm->id)?>" title="Edit" target="_self"><i class="glyphicon glyphicon-edit"></i></a></span></td>
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
    function enable(id) {
        var is_active = 0;
        if($('#'+id).is(':checked'))
        {
            is_active = 1;
        }
        else
        {
            is_active = 0;
        }
        $.ajax({
            url: '<?=base_url()?>dashboard/cms_enable',
            data: {
                cms_id: id,
                status: is_active,
            },
            type: 'post',
            success: function (output) {
                if (output == "done") {
                    launch_toast();
                } else {
                    alert("Module is not in your package please update your package.");
                }
            }
        });
    }
</script>