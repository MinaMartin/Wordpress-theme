<?php
    //Number of comments
    $coments_arg= array(
        "status" => "approve" //only approved comments
    );
    $comments = get_comments($coments_arg); 

    $comment_counter =0 ;

    foreach($comments as $comment){
        $post_id= $comment -> comment_post_ID; //get post id
        
        if(!in_category('Games',$post_id)){ //check if post is not in Games category
            continue;
        }
        $comment_counter ++ ;
    }
    $cat = get_queried_object();
    $posts_count = $cat -> count;
?>

<div class="sidebar-games">
    <div class="widget">
        <h3><?php single_cat_title() ?> Statistics</h3>
        <div class="widget-content">
            <ul class="list-unstyled">
                <li>
                    <span>Comments Count: </span> <?php echo $comment_counter; ?>
                </li>
                <li class="mt-2">
                    <span>Articles Count: </span> <?php echo $posts_count; ?>
                </li>
            </ul>
        </div>
    </div>
    <div class="widget">
        <h3>Latest Movies posts</h3>
        <div class="widget-content">
            <ul>
                <?php
                    $args= array(
                        "posts_per_page" => 3,
                        "cat"            => 10
                    );
                    $query =new WP_query($args);

                    if($query-> have_posts()){
                        while($query-> have_posts()){?>
                            <?php $query -> the_post(); ?>
                            <ul class="list-unstyled">
                                <li class="">
                                    <a href='<?php echo the_permalink() ?>' target="blank"><?php echo the_title(); ?></a>
                                </li>
                            </ul>
                            <?php
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
    <div class="widget">
        <h3>Hot 3 posts with most comments</h3>
        <div class="widget-content">
            <ul>
                <?php
                    $hotpost_args= array(
                        "posts_per_page" => 3,
                        "orderby"            => 'comment_count'
                    );
                    $hotpost_query =new WP_query($hotpost_args);

                    if($query-> have_posts()){
                        while($hotpost_query-> have_posts()){?>
                            <?php $hotpost_query -> the_post(); ?>
                            <ul class="list-unstyled">
                                <li class="">
                                    <a href='<?php echo the_permalink() ?>' target="blank"><?php 
                                    echo the_title();
                                    echo " --->" ;
                                    comments_number("No Comments","1 Comment","% Commetns"); 
                                    ?></a>
                                </li>
                            </ul>
                            <?php
                        }
                    }
                ?>
            </ul>
        </div>
    </div>
</div>