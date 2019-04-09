<?php $this->load->view('front/messages'); ?>
<script src="<?=base_url('assets/ckeditor/ckeditor.js')?>" ></script>

<div class="panel panel-default form-horizontal">
 <div class="panel-heading"><?php echo $cms->title;?> </div>
  <div class="panel-body">
 <form action="<?=base_url('cms/'.$cms_id)?>" method="post">

 <div class="row form-group">
    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">TITLE</label>
    <div class="col-md-6">
      <input placeholder="Title" type="text" value="<?php if(!empty($cms->title)){ echo $cms->title;} ?>" class="form-control" name="title">
    </div>
  </div>

  <?php if($cms_id == 1){ ?>
  <div class="row form-group">
    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">PHONE</label>
    <div class="col-md-6">
      <input placeholder="phone" type="text" name="phone" class="form-control" value="<?=$cms->phone?>">
    </div>
  </div>

      <div class="row form-group">
    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">Whatsapp</label>
    <div class="col-md-6">
      <input placeholder="Whatsapp" type="text" name="whatsapp_no" class="form-control" value="<?=$cms->whatsapp_no?>">
    </div>
  </div>

  <div class="row form-group">
    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">EMAIL</label>
    <div class="col-md-6">
      <input placeholder="Email" type="text" name="email" class="form-control" value="<?=$cms->email?>">
    </div>
  </div>

  <div class="row form-group">
    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">ADDRESS</label>
    <div class="col-md-6">
      <input placeholder="Address" type="text" name="address" class="form-control" value="<?=$cms->address?>">
    </div>
  </div>

  <div class="row form-group">
    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">Map URL</label>
    <div class="col-md-11">
      <input placeholder="Map URL" type="text" name="latitude" class="form-control" value="<?=$cms->latitude?>">
    </div>
  </div>

  <!--<div class="row form-group">
    <label class="col-md-1 control-label text-left pull-left" style="text-align: left;">Longitude</label>
    <div class="col-md-6">
      <input type="text" name="longitude" class="form-control" value="<?=$cms->longitude?>">
    </div>
  </div>-->

  <?php } ?>
  <hr>
 <div class="row form-group">
    <div class="col-md-12">
      <textarea name="description"  id="editor1" rows="10" cols="80"><?php if(!empty($cms->description)){ echo $cms->description;} ?></textarea>
      <br>
      <input type="submit" value="Submit" class="btn btn-primary">
      <input type="hidden" name="cms_id" value="<?=$cms_id?>">
    </div>
  </div>
  </form>
 </div>
</div>

<script>
    CKEDITOR.replace( 'editor1' );
</script>
