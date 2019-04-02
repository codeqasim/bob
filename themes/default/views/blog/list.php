<div class="container">
    <div class="row blog-lsiting">
        <div class="col-md-8 go-right blog-content">
            <div class="panel panel-default">
                <div class="panel-heading title_rtl"><?php if(isset($category)){ echo $category; }else{ echo 'Latest'; } ?> Posts</div>
                <div class="panel-body">
                    <?php 
                    if($blog){
                    foreach ($blog as $b) { ?>
                        <div class="col-md-12 col-xs-6">
                        <div class="row">
                        <div class="box">
                            <div class="col-md-4 go-right">
                                <div class="row">
                                    <div class="img h130">
                                        <a href="<?php echo base_url('blog/'.strtolower(str_replace(' ','-',$b->category).'/'.str_replace(' ','-',$b->title))); ?>" class="post-detail" data-id="<?php echo $b->id; ?>">
                                            <img class="img-responsive fadeIn animated" src="<?php echo  $b->image; ?>" alt="">
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <a href="<?php echo base_url('blog/'.strtolower(str_replace(' ','-',$b->category).'/'.str_replace(' ','-',$b->title))); ?>" class="post-detail" data-id="<?php echo $b->id; ?>">
                                    <h4 class="go-right ellipsis"><strong><?php echo $b->title; ?></strong></h4>
                                </a>
                                <div class="clearfix"></div>
                                <div class="post_info clearfix">
                                    <div class="post-left go-right">
                                        <ul class="go-right">
                                            <li><i class="fa fa-calendar text-muted"></i> On <span><?php echo date('d/m/Y', strtotime($b->created_at)); ?></span></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="RTL"> <?php echo substr($b->description, 0, 100) . '...'; ?></p>
                            </div>
                        </div>
                        <div class="clearfix"></div>
                        <hr>
                        </div>
                        </div>
                    <?php } }else{ echo 'No record found'; } ?>
                </div>
            </div>
            <?php if($links){ ?>
            <?php echo $links; ?>
            <?php } ?>
        </div>
        <?php include 'side.php'; ?>
    </div>
</div>