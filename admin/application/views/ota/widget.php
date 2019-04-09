<?php $this->load->view('front/messages'); ?>
<div class="panel panel-default">
    <div class="panel-heading">Customizations</div>
    <div class="panel-body">
        <!--<div class="panel panel-default">
  <div class="panel-heading">Global Applet Code</div>
  <textarea name="header_html" id="" cols="30"  rows="10" class="form-control" placeholder="Content Goes here..."><?php if (!empty($result->header_html)) {
            echo $result->header_html;
        } ?></textarea>
  </div>
  <hr>-->
        <form action="Post" id="live_chat_inc">
            <div class="panel panel-default">
                <div class="panel-heading">Livechat INC <span class="pull-right">
                        <label class="switch-light switch-ios">
                        <input type="checkbox"  <?php if(!empty($result->live_chat->widget_status)){ echo "checked";} ?>  name="check"  onclick="">
                        <span><span>Disable</span><span>Enable</span></span>
                        <a></a>
                        </label>
                </div>
                <div class="panel-body">
                    <input value="live_chat" name="name" type="hidden">
                    <input type="text" name="code" value="<?php if(!empty($result->live_chat->credentials)){ echo json_decode($result->live_chat->credentials)->code;} ?>" class="form-control" placeholder="Code"/>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>
        </form>
        <hr>
        <form action="Post" id="tawk_to">
            <div class="panel panel-default">
                <div class="panel-heading">Tawk To<span class="pull-right">
                        <label class="switch-light switch-ios">
                        <input type="checkbox" <?php if(!empty($result->tawk_to->widget_status)){ echo "checked";} ?> name="check" onclick="">
                        <span><span>Disable</span><span>Enable</span></span>
                        <a></a>
                        </label>
                </div>
                <div class="panel-body">
                    <input value="tawk_to" name="name" type="hidden">
                    <input type="text" name="code" value="<?php if(!empty($result->tawk_to->credentials)){ echo json_decode($result->tawk_to->credentials)->code;} ?>" class="form-control" placeholder="Code"/>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>
        </form>
        <hr>
        <form action="Post" id="google_analytics">
            <div class="panel panel-default">
                <div class="panel-heading">Google Analytics<span class="pull-right">
                        <label class="switch-light switch-ios">
                        <input type="checkbox" <?php if(!empty($result->google_analytics->widget_status)){ echo "checked";} ?> name="check" onclick="">
                        <span><span>Disable</span><span>Enable</span></span>
                        <a></a>
                        </label>
                </div>
                <div class="panel-body">
                    <input value="google_analytics"  name="name" type="hidden">
                    <input type="text" name="code" value="<?php if(!empty($result->google_analytics->credentials)){ echo json_decode($result->google_analytics->credentials)->code;} ?>" class="form-control" placeholder="Code"/>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>
        </form>
        <hr>
        <form action="Post" id="google_tags">
            <div class="panel panel-default">
                <div class="panel-heading">Google Tags<span class="pull-right">
                        <label class="switch-light switch-ios">
                        <input type="checkbox" name="check" <?php if(!empty($result->google_tags->widget_status)){ echo "checked";} ?> onclick="">
                        <span><span>Disable</span><span>Enable</span></span>
                        <a></a>
                        </label>
                </div>
                <div class="panel-body">
                    <input value="google_tags" name="name" type="hidden">
                    <input type="text" value="<?php if(!empty($result->google_tags->credentials)){ echo json_decode($result->google_tags->credentials)->code;} ?>" name="code" class="form-control" placeholder="Code"/>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Save</button>
            </div>
        </form>
        <hr>
    </div>
</div>
<script>
    $('#live_chat_inc').submit(function (e) {
        e.preventDefault();
        var form = $(this).serializeArray();
        $.ajax({
            url: "<?=base_url("widgets/update_widgets")?>",
            type: "post",
            data: form,
            beforeSend: function () {

            },
            success: function (response) {
                if (response == "done") {
                    launch_toast();

                } else {
                    alert("something wrong.")
                }
            },
            error: function () {
                alert("something wrong.")


            }
        });
    });
    $('#tawk_to').submit(function (e) {
        e.preventDefault();
        var form = $(this).serializeArray();
        $.ajax({
            url: "<?=base_url("widgets/update_widgets")?>",
            type: "post",
            data: form,
            beforeSend: function () {

            },
            success: function (response) {
                if (response == "done") {
                    launch_toast();

                } else {
                    alert("something wrong.")
                }
            },
            error: function () {
                alert("something wrong.")


            }
        });
    });
    $('#google_analytics').submit(function (e) {
        e.preventDefault();
        var form = $(this).serializeArray();
        $.ajax({
            url: "<?=base_url("widgets/update_widgets")?>",
            type: "post",
            data: form,
            beforeSend: function () {

            },
            success: function (response) {
                if (response == "done") {
                    launch_toast();

                } else {
                    alert("something wrong.")
                }
            },
            error: function () {
                alert("something wrong.")


            }
        });
    });
    $('#google_tags').submit(function (e) {
        e.preventDefault();
        var form = $(this).serializeArray();
        $.ajax({
            url: "<?=base_url("widgets/update_widgets")?>",
            type: "post",
            data: form,
            beforeSend: function () {

            },
            success: function (response) {
                if (response == "done") {
                    launch_toast();

                } else {
                    alert("something wrong.")
                }
            },
            error: function () {
                alert("something wrong.")


            }
        });
    });
</script>