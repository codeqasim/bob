<?php $this->load->view('front/messages'); ?>
<script src="<?=base_url('assets/ckeditor/ckeditor.js')?>" ></script>

<div class="panel panel-default form-horizontal">
    <div class="panel-heading"><?php echo $page->name;?> </div>
    <div class="panel-body">
        <form action="<?=base_url('page/'.$page->name)?>" method="post" enctype="multipart/form-data">

            <div class="row form-group">
                <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">TITLE</label>
                <div class="col-md-6">
                    <input placeholder="Title" type="text" value="<?php if(!empty($page->title)){ echo $page->title;} ?>" class="form-control" name="title">
                </div>
            </div>
            <input type="hidden" name="page_id" value="<?=$page->page_id;?>">
                <div class="row form-group">
                    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">Author</label>
                    <div class="col-md-6">
                        <input placeholder="phone" type="text" name="author" class="form-control" value="<?php if(!empty($page->author)){ echo $page->author;} ?>">
                    </div>
                </div>
            <div class="row form-group">
                    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">Image</label>
                    <div class="col-md-6">
                        <img src="<?php if(!empty($page->img)){ echo $page->img;} ?>" class="hlogo_preview_img img-fluid brand-logos image">
                        <input placeholder="phone" type="file" id="image_f" name="image" class="form-control" >
                    </div>
            </div>
            <div class="row form-group">
                    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">Description</label>
                    <div class="col-md-6">
                        <textarea placeholder="Description" name="description" class="form-control" ><?php if(!empty($page->description)){ echo $page->description;} ?></textarea>
                    </div>
            </div>
            <div class="row form-group">
                    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">Keywords</label>
                    <div class="col-md-6">
                        <textarea placeholder="Keywords" name="keywords" class="form-control"><?php if(!empty($page->keywords)){ echo $page->keywords;} ?></textarea>
                    </div>
            </div>
<!--            <div class="row form-group">-->
<!--                    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">URL</label>-->
<!--                    <div class="col-md-6">-->
<!--                        <input placeholder="URL" type="text" name="url" class="form-control" value="--><?php //if(!empty($page->url)){ echo $page->url;} ?><!--">-->
<!--                    </div>-->
<!--                </div>-->

            <div class="row form-group">
                <div class="col-md-12">
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    function readFavicon(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.image').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#image_f").change(function () {
        readFavicon(this);
    });
</script>

