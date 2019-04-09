<div class="panel panel-default">
    <?php $this->load->view('front/messages'); ?>
    <div class="panel-heading"><?php if(!empty($b_title)) echo $b_title; ?></div>
    <div class="panel-body"><?php echo $data['list']; ?> </div>
</div>
<div id="upload_model" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Upload Image</h4>
            </div>
            <div class="modal-body">
                <div id="upload_form_blog">
                    <form action="<?=base_url('blogs')?>" method="post" id="image_form" enctype="multipart/form-data">
                        <input type="hidden" id="blog_id" name="blog_id" value="">
                        <input type="file" id="image" required name="image_blog"  value="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-default">Submit</button>
            </div>
            </form>
        </div>

    </div>
</div>
<script>
    function upload_image(id){
        $('#blog_id').val(id);
        $('#upload_model').modal('show');
    }
</script>