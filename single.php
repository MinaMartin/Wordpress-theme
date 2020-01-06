<?php 
get_header();
include(get_template_directory() . '/includes/breadcrumb.php');
?>

<div class="container">
    <div class="row">
        <?php 
            if(have_posts()){
                while(have_posts()){
                    the_post(); ?>
                    <div class="col-12 single">
                        
                        <div class="card mt-2 mb-2">
                        <?php edit_post_link("Edit the post <i class='fas fa-edit' > </i>"); ?>
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
                            <?php the_post_thumbnail('',["class" => "img-fluid img-thumbnail single" ,'title' => "post-image"]); ?>
                            <hr>
                            <div class="card-body"> 
                                <div class="categories"> 
                                    <i class="fas fa-tags"></i> <?php the_category(', '); ?>
                                </div>
                            </div>
                            <div class="card-body">
                                <?php the_content(); ?>
                            </div>
                            <p class="post-tags mt-3">
                                <?php 
                                if(has_tag())
                                the_tags();
                                else{
                                    echo "Tags:there are no tags";
                                } ?>
                            </p>
                        </div>
                    </div>
                <?php
                }
            } 

        ?>
    </div>
    
</div>

<div class="container">
    <h3 class= 'comments-count mt-5'>
        <?php 
            //if($author_posts_per_page <= count_user_posts(get_the_author_meta('ID')) ){
                echo "<div> Similiar Posts of the same Category </div>";
            ///}else{
                //echo "<div class= 'comments-count-author-page' >Latest posts of " . get_the_author_meta('nickname') ."</div>";
            //}
        ?>
    </h3>
</div>
<?php   
    
    $categories = get_the_category();
    $posts = get_post();

        $random_posts_per_page= 5;

        $single_post_args=array(
                'cat' => $categories[0]->cat_ID,
                "posts_per_page" => $random_posts_per_page, // if we write -1 that will retrieve all the posts 
                "post__not_in"   => array($posts->ID),
                "Orderby"        => 'rand'
            );//to get similiar post of the same category and randomize their order and exclude the current show post

    $single_post_query = new WP_query($single_post_args);
    if($single_post_query ->have_posts()){
        while($single_post_query -> have_posts()){
            $single_post_query->the_post(); ?>
            <div class="container">
            <div class="row">
                <div class="card mt-2 mb-2 col-md-12">
                    <div class="col-md-4">
                        <h3 class="card-title mt-2"> 
                            <a href="<?php the_permalink(); ?> "><?php the_title(); ?> </a> 
                        </h3>
                        <?php the_excerpt("Mina"); ?>
                    </div>               
                </div>
            </div>
            </div>
        <?php
        }
    }
?>

<div class="container">
    <div class="row author">
        <?php 

            $avatar_args= array(
                "class" => "img-fluid img-thumbnail center"
            );
            echo "<div class='col-md-3 text-center'>";
                //get_avatar(ID / Email,size,Default,Alternate text,options)
                echo  get_avatar(get_the_author_meta('ID'),90,'','User Avatar',$avatar_args) ;//avatar of the author with user ID 
            echo "</div>";

            echo "<div class='col-md-9'>";
                echo "Created By ";
                $fall_name= "<strong>".get_the_author_meta("first_name")." ".get_the_author_meta("last_name")."</strong>";
                
                echo $fall_name;  

                if(get_the_author_meta("nickname")){?>

                   <span class="nickname">(<?php the_author_meta('nickname') ?>) </span>

                    <?php
                }
                if(get_the_author_meta("description")){?>

                <p class="description"> <?php the_author_meta('description') ?></p>

                <?php
                }else{
                    echo "<p>"."No Description found" . "</p>";
                }

            echo "</div>";

            echo "<div class='author-number-of-posts'> Number of posts created by ".$fall_name." is " .count_user_posts(get_the_author_meta('ID')) ."</div>";

            echo "<div class='author-link mt-2'>User Profile ". get_the_author_posts_link() . "</div>";
        ?>
    </div> 
    <hr>
</div>

<?php
    echo "<div class='post-pagination'>";
        if(get_previous_post_link()){
            previous_post_link('%link',"<i style='margin-right:10px;' class='fas fa-chevron-left'></i>%title");
        }else{
            echo "<span>Prev</span>";
        }
        if(get_next_post_link()){
            next_post_link('%link',"%title<i style='margin-left:10px;' class='fas fa-chevron-right'></i>");
        }else{
            echo "<span>Next</span>";
        }
    echo "</div>";
    //echo get_the_author_meta("first_name");
   
?>

<?php
    echo "<div class='container'>";
        echo "<hr>";
        comments_template();    
    echo "</div>"
?>
<?php get_footer() ?>