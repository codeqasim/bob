<style>
    .box
    {
    background-color:#fff;
    border:1px solid #ccc;
    margin-top:10px;
    }
</style>

<div class="container box">
    <div class="table-responsive">
        <br />
        <button class="btn btn-success btn-block" data-toggle="modal" data-target="#add" >Add New Article</button>
        <table id="user_data" class="table table-bordered table-striped">
            <thead>
            <tr>
                <?php  foreach ($headers as $header) {?>
                <th width="<?=$header->width?>"><?=$header->name?></th>
                <?php } ?>
            </tr>
            </thead>
        </table>
    </div>
</div>
<div class="modal" id="add">
    <div class="modal-dialog modal-md">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Blog</h4>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <?php if(!empty($errors)){ ?>
                <div class="col-md-12">
                    <div class="alert alert-danger"> <?=$errors?></div>
                </div>
            <?php }  ?>


            <form action="<?=base_url("blog")?>" method="post" enctype="multipart/form-data">
            <!-- Modal body -->
            <div class="modal-body">

                <div class="row">

                    <div class="col-md-6">

                    <div class="form-group">
                        <label for="exampleFormControlFile1">Add Image</label>
                        <input type="file"  name="blog_img" class="form-control-file" id="blog_image">
                    </div>
                    </div>
                    <div class="col-md-6">
                      <img src="" class="blog_img card-img" alt="">
                    </div>
                </div>

                    <div class="form-group row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Title</label>
                        <div class="col-sm-10">
                            <input type="" required name="title" class="form-control form-control-sm" id="colFormLabelSm" placeholder="Title">
                        </div>
                    </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Category</label>
                    <div class="col-sm-10">
                        <select name="blog_category_id" class="form-control input-lg">
                            <?php foreach ($categories as $cat){ ?>
                            <option value="<?=$cat->id;?>"><?=$cat->category;?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Description</label>
                    <div class="col-sm-10">
                        <textarea name="desc" class="form-control" cols="30" rows="5" style="width:100%"></textarea>
                    </div>
                </div>
                </div>
            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-danger btn-block">Submit</button>
            </div>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript" language="javascript" >
    $(document).ready(function(){

        <?php if(!empty($errors)){ ?>
        $("#add").modal('show');
    <?php } ?>

        var dataTable = $('#user_data').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                url:"<?php echo base_url() . 'dashboard/blog_list'; ?>",
                type:"POST"
            },
            "columnDefs":[
                {
                    "targets":[0, 3, 4],
                    "orderable":false,
                },
            ],
        });
    });
</script>
<script>
    function Update_Function(id) {
        $("#add").modal('show');
    }
    function readFavicon(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.blog_img').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#blog_image").change(function () {
        readFavicon(this);
    });
</script>
