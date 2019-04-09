<?php $this->load->view('front/messages'); ?>
<div class="panel panel-default">
 <div class="panel-heading">Customizations</div>
  <div class="panel-body">
      <form method="post" action="<?=base_url('customizations')?>" >
  <div class="panel panel-default">
  <div class="panel-heading">Header HTML</div>
  <textarea name="header_html" id="" cols="30"  rows="10" class="form-control" placeholder="Content Goes here..."><?php  if(!empty($result->header_html)){ echo $result->header_html;} ?></textarea>
  </div>
  <hr>
  <div class="panel panel-default">
  <div class="panel-heading">Footer HTML</div>
  <textarea name="footer_html" id="" cols="30" rows="10" class="form-control" placeholder="Content Goes here..."><?php if(!empty($result->footer_html)){ echo $result->footer_html;} ?></textarea>
 </div>
 <hr>
 <div class="panel panel-default">
  <div class="panel-heading">Global CSS</div>
  <textarea name="global_css" id="" cols="30" rows="10" class="form-control" placeholder="Content Goes here..."><?php if(!empty($result->global_css)){ echo $result->global_css;} ?></textarea>
 </div>
 <!--<hr>
 <div class="panel panel-default">
  <div class="panel-heading">Global JS</div>
  <textarea name="" id="" cols="30" rows="10" class="form-control" placeholder="Content Goes here..."></textarea>
 </div>
 <hr>-->
 <hr>
 <button type="submit" class="btn btn-primary btn-block">Save</button>
      </form>

  </div>
</div>