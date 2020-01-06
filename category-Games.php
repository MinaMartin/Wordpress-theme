<?php get_header() ?>

<div class="container home-page">
    <div class="cat-info  mt-5">
        <div class="row">
            <h2 class='col-md-6'><?php echo single_cat_title()  ?></h2> 
            <br>
            <div class="cat-span col-md-6 ">
                <span class="articles-count">Articles count is <strong>20</strong></span>
                <br>
                <span class="articles-count">Comments count is <strong>20</strong></span>
            </div>
        </div>
        <div class="category-content mt-3"><?php echo category_description();  ?> </div>
    </div>

    <div class="row">
        <div class="col-sm-8 mb-4">
        <?php 
            if(have_posts()){
                while(have_posts()){
                    the_post(); ?>
                        <div class="card mt-2 mb-2">
                            <div class="row">
                                <div class="col-md-5">
                                    <?php the_post_thumbnail('',["class" => "img-fluid mt-2 img-size img-thumbnail" ,'title' => "post-image"]); ?>
                                </div>
                                <div class="col-md-7">
                                    <h3 class="card-title mt-2"> 
                                        <a href="<?php the_permalink(); ?> "><?php the_title(); ?> </a> 
                                    </h3>
                                    <div>
                                        <span class="post-author"> <i class="fas fa-user"></i><?php the_author_posts_link() ?></span>  
                                        <span class="post-date"><i class="fas fa-calendar-alt"></i>
                                                At <?php the_time('F j, Y'); ?>
                                        </span> 
                                        <span class="post-comments"><i class="fas fa-comments"></i>
                                            <?php comments_popup_link('0 Comments','One Comment','% Comments','comment-url'); ?>
                                        </span>
                                    </div> 
                                    <div class="card-body"> 
                                        <div class="categories"> 
                                            <i class="fas fa-tags"></i> <?php the_category(', '); ?>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <?php the_excerpt("Mina"); ?>
                                    </div>
                                    <p class="post-tags mt-2">
                                        <?php 
                                        if(has_tag())
                                        the_tags();
                                        else{
                                            echo "Tags:there are no tags";
                                        } ?>
                                    </p> 
                                </div>      
                            </div>
                        </div>
                        <?php
                }
            } 
            ?>
        </div> <!----->
        <div class="col-sm-4 "> <!--Sidebar--->
        <?php
            if(is_active_sidebar('Main Sidebar')){
                get_sidebar('Main Sidebar'); // or we can write dynamic_sidebar() to show the defaut sidebar or we give it the name o the sidebar we want
            }
        ?>
        </div>
    </div>
    <div class="text-center mt-3">
        <?php echo numbering_pagination(); ?>
    </div>
</div>
<?php get_footer() ?>
