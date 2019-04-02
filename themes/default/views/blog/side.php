<div class="col-md-4">
    <div class="clearfix"></div>
    <div class="panel panel-default">
        <div class="panel-heading go-text-right">Quick Search</div>
        <div class="panel-body">
            <form id="blog-search-form" action="#" method="POST">
                <div class="input-group RTL">
                    <input type="text" name="keyword" required="" placeholder="Search What?" class="form-control sub_email">
                    <span class="input-group-btn">
                        <button class="btn btn-primary" type="submit"><i class="fa fa-search"></i> Search</button>
                    </span>
                </div>
            </form>
        </div>
    </div>
    <div class="list-group">
        <div class="panel panel-default">
            <div class="panel-heading go-text-right">Categories and Posts</div>
            <?php foreach($categories as $c){ ?>
            <a href="<?php echo base_url('blog/'.strtolower(str_replace(' ','-',$c->category))); ?>" class="list-group-item post-detail">
                <strong class="go-right"><?php echo $c->category; ?></strong> <span class="go-left badge badge-primary"><?php echo $c->total_post; ?></span>
                <div class="clearfix"></div>
            </a>
            <?php } ?>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading go-text-right">Popular Posts</div>
        <div class="panel-body blog-hr">
                <?php foreach($popular_posts as $p){ ?>
                    <div class="row">
                        <a href="<?php echo base_url('blog/'.strtolower(str_replace(' ','-',$p->category).'/'.str_replace(' ','-',$p->title))); ?>" class="col-md-4 col-sm-4 col-xs-12 go-right post-detail" data-id="<?php echo $p->id; ?>">
                            <img class="img-responsive fadeIn animated h50 w100p" src="<?php echo $p->image; ?>" alt="">
                        </a>
                        <div class="desc col-md-8 col-sm-8 col-xs-12 go-left row">
                            <h5 class="go-text-right mt0 ellipsis post-title mb5"><a href="<?php echo base_url('blog/'.strtolower(str_replace(' ','-',$p->category).'/'.str_replace(' ','-',$p->title))); ?>" class="post-detail" data-id="<?php echo $p->id; ?>"><?php echo $p->title; ?></a></h5>
                            <p class="text-warning weak"><?php echo date('d/m/Y', strtotime($p->created_at)); ?></p>
                        </div>
                    </div>
                    <hr>
            <?php } ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function () {
        $('#blog-search-form').submit((e) => {
            e.preventDefault();
            var fields = $('#blog-search-form').serializeArray();
            var slug = 'blog/search/';
            keyword = fields[0].value;
            slug += keyword.replace(/\s+/g, '-').toLowerCase();
                
            window.location = "<?php echo base_url(); ?>" + slug;
        });
    });
</script>