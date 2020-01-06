<?php get_header() ?>


<?php 
    if(have_posts()){
        while(have_posts()){
            the_post(); ?>
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="card mt-2 mb-2">
                                <h3 class="card-title mt-4"> 
                                    <a href="<?php the_permalink(); ?> "><?php the_title(); ?> </a> 
                                </h3>
                                <div>
                                    <span class="post-author"> <i class="fas fa-user"></i><?php the_author_posts_link() ?></span>  
                                    <span class="post-date"><i class="fas fa-calendar-alt"></i>
                                            At <?php the_time('F j, Y'); ?>
                                    </span> 
                                    <span class="post-comments"><i class="fas fa-comments"></i>
                                        <?php comments_popup_link('0 Comments','one Comment','% Comments','comment-url'); ?>
                                    </span>
                                </div>  
                                <?php the_post_thumbnail('',["class" => "img-fluid"]); ?>
                                <hr>
                                <div class="card-body"> 
                                    <p class="categories"> 
                                        <i class="fas fa-tags"></i> <?php the_category(', '); ?>
                                    </p>
                                   
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php
        }
    } 
?>

<!-- <div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="card mt-2 mb-2">
                <img class="card-img-top img-fluid img-thumbnail" src="https://via.placeholder.com/300.png/09f/fff" alt="Card image cap">
                <h5 class="card-title mt-4">Card title</h5>
                <div>
                    <span class="post-author"> <i class="fas fa-user"></i>Author</span>  
                    <span class="post-comments"><i class="fas fa-comments"></i># of comments</span> 
                    <span class="post-date"><i class="fas fa-calendar-alt"></i>Date</span> 
                </div>  
                <hr>
                <div class="card-body">
                    Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s

                <p class="categories"> <i class="fas fa-tags"></i>Html,CSS</p>
                </div>

            </div>
        </div>
    </div>
</div> -->
<?php get_footer() ?>
