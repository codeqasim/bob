<style>
.form-control { width: 80px }
 td { text-transform: uppercase; letter-spacing: 2px; font-weight: bold; }
</style>
<div class"container">
    <div class="panel panel-default">
        <div class="panel-heading">Pages Management</div>
        <div class="panel-body">
            <table class="xcrud-list table table-striped table-hover">
                <thead>
                    <tr class="xcrud-th">
                        <th style="width:20px">#</th>
                        <th class="xcrud-column xcrud-action">NAME</th>
                        <th class="">EDIT</th>
                    </tr>
                </thead>
                <tbody>
                     <?php foreach ($pages as $index=>$page) { ?>
                     <tr disabled >
                        <td class="xcrud-current xcrud-num"><?=$index+1?></td>
                        <td><?=$page->name?> </td>
                        <td class="xcrud-current xcrud-actions xcrud-fix"><span class="btn-group"><a class="btn btn-default btn-sm btn btn-warning" href="<?=base_url('page/'.$page->name)?>" title="Edit" target="_self"><i class="fa fa-edit"></i></a></span></td>
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
</script>