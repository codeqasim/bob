<style>
    .form-control {
        width: 80px
    }
</style>
<div class"container">
<div class="row">
    <div class="col-md-12" >
        <div class="panel panel-default">
            <div class="panel-heading">Payment Gateways Management</div>
            <div class="panel-body">
                <table class="xcrud-list table table-striped table-hover">
                    <thead>
                    <tr class="xcrud-th">
                        <th style="width:20px">#</th>
                        <th style="width:180px" class="text-center">STATUS</th>
                        <th class="xcrud-column xcrud-action">NAME</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php  foreach ($gateways as $index => $gateway) {
                        if ($gateway->is_super_active) { ?>
                            <tr disabled>
                                <td class="xcrud-current xcrud-num"><?= $index + 1 ?></td>
                                <td>
                                    <label class="switch-light switch-ios">
                                        <input type="checkbox" id="<?= $gateway->id ?>"
                                               onchange="enable(this.id,'<?= $gateway->main_id ?>');"
                                               onclick="" <?php if ($gateway->status) {
                                            echo "checked";
                                        } ?>>
                                        <span><span>Disable</span><span>Enable</span></span>
                                        <a></a>
                                    </label>
                                </td>
                                <td><?= $gateway->title ?>  </td>
                            </tr>
                        <?php }
                    } ?>
                    </tbody>
                    <tfoot>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<script>
    function enable(id, gateway_id) {
        var is_active = 0;
        if ($('#' + id).is(':checked')) {
            is_active = 1;
        }
        else {
            is_active = 0;
        }
        $.ajax({
            url: '<?=base_url()?>paymentGateways/update_gateways',
            data: {
                ota_gateway_id: gateway_id,
                gateway_id: id,
                is_active: is_active,
            },
            type: 'post',
            success: function (output) {
                if (output == "done") {
                    launch_toast();
                } else {
                    alert("contact to admin")
                }
            }
        });
    }
</script>