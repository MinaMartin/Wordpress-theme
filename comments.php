<?php

// If comments are open or we have at least one comment, load up the comment template.
if ( comments_open() ) { ?>

    <h4 class="comments-count"> <?php comments_number("No Comments","1 Comment","% Commetns"); ?></h4>

    <?php
    echo "<ul class='list-unstyled'>";
        $comments_arguments=array(
            'max_depth' => 4,
            'type' => 'comment',
            'avatar_size' => 60
        );

        wp_list_comments($comments_arguments);
    echo "</ul>";

    $comments_args=array(
        "title_reply" => "Leave You Comment"
    );
    echo "<hr>";
    comment_form($comments_args);

}else{
    echo "<p>No comments allowed in this post</p>";
}
?> 