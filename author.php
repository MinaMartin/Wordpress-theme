<?php get_header() ?>

<div class="container">
    <h2 class="text-center mt-4 mb-4 display-4 font-weight-bold"> <?php echo the_author_meta('nickname'); ?> Page</h2>
    <div class="row author-page">
        <div class="col-3">
        <?php
            $fall_name= "<strong>".get_the_author_meta("first_name")." ".get_the_author_meta("last_name")."</strong>";
            $avatar_args= array(
                "class" => "img-fluid img-thumbnail center"
            );
            echo  get_avatar(get_the_author_meta('ID'),200,'','User Avatar',$avatar_args) ;//avatar of the author with user ID 
        ?>
        </div>
        <div class="col-9">
            <ul class="list-unstyled">
                <li><strong>First Name : </strong><?php echo the_author_meta('first_name'); ?></li>
                <li><strong>Last Name : </strong><?php echo the_author_meta('last_name'); ?></li>
                <li><strong>Nickame Name : </strong><?php echo the_author_meta('nickname'); ?></li>
                <?php
                    if(get_the_author_meta("description")){?>

                        <p class="description"> <?php the_author_meta('description') ?></p>

                     <?php
                    }
                ?>
            </ul>
        </div>
    </div>
</div>

<div class="container">
    <div class="row author-stats">
        <div class="col-lg-3 col-md-4">
                <p class="stats">Posts Count <span><?php echo count_user_posts(get_the_author_meta('ID')) ?></span></p>
        </div>
        <div class="col-lg-3 col-md-4">
            <p class="stats">Comments Count<span>
                <?php 
                    $args = array(
                        'author__in' =>get_the_author_meta('ID') ,
                        "count"      => true
                    );
                    echo get_comments($args); //get number of comments  (https://codex.wordpress.org/Function_Reference/get_comments)
                ?>
                </span></p>
        </div>
        <div class="col-lg-3 col-md-4">
            <p class="stats">Posts Count<span>50</span></p>
        </div>
        <div class="col-lg-3 col-md-4">
            <p class="stats">Posts Count<span>50</span></p>
        </div>
    </div>
    <hr>
</div>

<div class="container mb-5">
    <div class="row">
        <?php 
        $author_posts_per_page=2;
        $args=array(
            'author' => get_the_author_meta('ID'),
            "posts_per_page" => $author_posts_per_page // if we write -1 that will retrieve all the posts 
        );
        $author_query = new WP_query($args);
            if($author_query ->have_posts()){?>

                <h3 class= 'comments-count'>
                <?php 
                    if($author_posts_per_page <= count_user_posts(get_the_author_meta('ID')) ){
                        echo "<div >Latest [" .  $author_posts_per_page . "] post(s) of " .  get_the_author_meta('nickname') . "</div>";
                    }else{
                        echo "<div >Latest posts of " . get_the_author_meta('nickname') ."</div>";
                    }
                ?>
                </h3>

                <?php
                while($author_query -> have_posts()){
                    $author_query ->the_post(); ?>
                    <div class="col-sm-12">
                        <div class="card mt-2 mb-2">
                            <h3 class="card-title mt-2"> 
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
                            <?php the_post_thumbnail('',["class" => "img-fluid img-size img-thumbnail mt-2" ,'title' => "post-image"]); ?>
                            <hr>
                            <div class="card-body">
                                <?php the_excerpt("Mina"); ?>
                            </div>
                        </div>
                    </div>
                <?php
                }
            } 
        ?>
    </div>
    <?php  /************Start of retrieving comments */
        wp_reset_postdata(); 
        $author_comments_per_page=4;

        if($author_posts_per_page <= get_comments($args) ){
            echo "<div class= 'comments-count-author-page'>Latest [" .
              $author_comments_per_page . "] comment(s)" . "</div>";
        }else{
            echo "<div class='comments-count-author-page' >Latest comments of " . get_the_author_meta('nickname') ."</div>";
        }

        $commetns_args=array(
            'user_id' => get_the_author_meta('ID'),
            "number" => $author_comments_per_page, // if we write -1 that will retrieve all the posts 
            "status" =>  'approve' ,
            "post_status" => "publish",
            "post_type"   => "post"
        );
        $comments = get_comments($commetns_args);
        if($comments){
            foreach ($comments as $comment) { ?>
                <div class="comment">
                    <a href="<?php echo get_permalink($comment -> comment_post_ID) ?>" > 
                        <?php echo get_the_title($comment -> comment_post_ID) ; ?>
                    </a>
                    <br>
                    <span><?php echo "<i class='fas fa-calendar-alt'></i> published at ".$comment -> comment_date ?> </span>
                    <p class="mt-4 mb-0 red-color"><?php echo $comment -> comment_content ?> </p>
                    <br>
                </div>
            <?php
            }
        }else{
            echo "<h2>No Comments Found from " . get_the_author_meta('nickname') . "<h2>";
        }
    ?>
    
</div>



<?php get_footer() ?>