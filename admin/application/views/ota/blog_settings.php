<?php if(!empty($save)){ ?>
    <div class="alert alert-success"> Save Successfully</div>
<?php } ?>
<form method="post" action="<?=base_url("blogs/settings")?>">
<div class="panel panel-default">
    <div class="panel-heading">
        <h3 class="panel-title">Blog Settings</h3>
    </div>
    <div class="panel-body">
        <div class="form-horizontal  col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="form-group">
            <label class="col-md-3 control-label">Number of Posts on Home Page</label>
            <div class="col-md-2">
                <input class="form-control" type="text" placeholder="" name="number_home_page" value="<?=$settings_data->number_home_page;?>">
            </div>
            </div>
            <hr>
            <div class="form-group">
                <label class="col-md-3 control-label">Number of Posts on Listing Page</label>
                <div class="col-md-2">
                    <input class="form-control" type="text" placeholder="" name="number_list_posts" value="<?=$settings_data->number_list_posts;?>">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label class="col-md-3 control-label">Number of Category Result</label>
                <div class="col-md-2">
                    <input class="form-control" type="text" placeholder="" name="number_category_result" value="<?=$settings_data->number_category_result;?>">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label class="col-md-3 control-label">Number of Popular Posts</label>
                <div class="col-md-2">
                    <input class="form-control" type="text" placeholder="" name="number_popular_posts" value="<?=$settings_data->number_popular_posts;?>">
                </div>
            </div>
            <hr>
            <div class="form-group">
                <label class="col-md-3 control-label">Show on Homepage </label>
                <div class="col-md-2">
                    <select class="form-control" name="show_home_page">
                        <option value="1" <?php if($settings_data->show_home_page == 1) echo "selected"?> > Yes</option>
                        <option value="0" <?php if($settings_data->show_home_page == 0) echo "selected"?> >No</option>
                    </select>
                </div>
            </div>
            <hr>
        </div>
        <input class="btn btn-primary btn-block" type="submit" value="Submit">
    </div>
</div>
</form>
