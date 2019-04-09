<style>
.form-control { width: 80px }
</style>
<div class"container">
    <div class="panel panel-default">
        <div class="panel-heading">Modules Management</div>
        <div class="panel-body">
            <table class="xcrud-list table table-striped table-hover">
                <thead>
                    <tr class="xcrud-th">
                        <th style="width:20px">#</th>
                        <th style="width:180px" class="text-center">STATUS</th>
                        <th class="xcrud-column xcrud-action">NAME</th>
                        <th class="text-center">Show Featured</th>
                        <th class="">ORDER</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                     <?php foreach ($modules as $index=>$module) { if($module->is_super_active){ ?>
                     <tr disabled >
                        <td class="xcrud-current xcrud-num"><?=$index+1?></td>
                        <td>
                        <label class="switch-light switch-ios">
                        <input type="checkbox"  id="<?=$module->id?>" onchange="enable(this.id);" <?php if(!$module->package){ echo "disabled";} ?> onclick="" <?php if($module->is_child_active){ echo "checked";}?>>
                        <span><span>Disable</span><span>Enable</span></span>
                        <a></a>
                        </label>
                        </td>
                        <td><?=$module->nic_name?> <?php if(!$module->package) { ?> <a href="<?=base_url('account')?>">Upgrade Your Account</a> <?php } ?> </td>
                        <td>
                        <label class="switch-light switch-ios">
                        <input type="checkbox" <?php if($module->is_feature_cities){ echo "checked";}?>   id="ab<?=$module->id?>" onchange="enable_features(<?=$module->id?>);" >
                        <span><span>No</span><span>Yes</span></span>
                        <a></a>
                        </label>
                        </td>
                         <td><input type="number"  onchange="change_order(<?=$module->id?>,this.value)"  class="form-control input-sm text-center" value="<?=$module->order?>"/></td>
                        <td class="xcrud-current xcrud-actions xcrud-fix"><span class="btn-group"><a class="btn btn-default btn-sm btn btn-warning" href="<?=base_url($module->name."/settings")?>" title="Edit" target="_self"><i class="fa fa-edit"></i></a>
                        <!--<a class="xcrud-action btn btn-danger btn-sm" title="Remove" href="javascript:;" data-primary="8" data-task="remove" data-confirm="Do you really want remove this entry?"><i class="glyphicon glyphicon-remove"></i></a>--></span></td>
                    </tr>
                    <?php }} ?>
                </tbody>
                <tfoot>
                </tfoot>
            </table>
        </div>
    </div>
</div>
<script>
    function change_order(id,value) {
        $.ajax({
            url: '<?=base_url()?>dashboard/update_modules_order',
            data: {
                module_id: id,
                order: value,
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
            url: '<?=base_url()?>dashboard/update_modules',
            data: {
                module_id: id,
                is_active: is_active,
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
    function enable_features(id) {
        var is_active = 0;
        if($('#ab'+id).is(':checked'))
        {
            is_active = 1;
        }
        else
        {
            is_active = 0;
        }
        $.ajax({
            url: '<?=base_url()?>dashboard/module_update_features',
            data: {
                module_id: id,
                is_active: is_active,
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