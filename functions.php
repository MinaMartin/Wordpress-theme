<?php

    require_once('class-wp-bootstrap-navwalker.php');
    /**********function to add custom styles */
    function add_styles(){
        wp_enqueue_style('Bootstrap-css',get_template_directory_uri() . '/css/bootstrap.min.css');
        wp_enqueue_style('Fontawesome-css',get_template_directory_uri() . '/css/all.css');
        wp_enqueue_style('main',get_template_directory_uri() . '/css/main.css');
        //prepare the css files to be added 
    }

    /**********function to add custom script */
    function add_scripts(){
        //remove jquery registeration
        wp_deregister_script('jquery');
        //register new jquery file
        wp_register_script('jquery',get_template_directory_uri().'/js/jquery-3.4.1.min.js',array(),false,true);
        //enqueue the jquery file 
        wp_enqueue_script('jqeury');
        wp_enqueue_script('Bootstrap-js',get_template_directory_uri() . '/js/bootstrap.min.js'
        ,array('jquery'),false,true);
        wp_enqueue_script('main-js',get_template_directory_uri() . '/js/main.js',array()
        ,false,true);
        //prepare the js files to be added 
        //we changed the last falue to true so the scripts are put before closing bod tag not in the header
    }

    /**Adding Custom menu support  */
    function register_custom_menu(){
        register_nav_menus(array(
            'bootstrap-menu' => 'Navigation Bar',
            'footer-menu' => 'Footer menu',
        ) );
    }  

    function bootstrap_menu(){
        wp_nav_menu(array(
            'theme_location' => 'bootstrap-menu', // Defined when registering the menu
            'menu_class'     => 'navbar-nav',
            'menu_id'        => 'primary-menu',
            'container'      => false,
            'depth'          => 0,
            'walker'         =>new wp_bootstrap_navwalker(),
            'fallback_cb'    => 'Bootstrap_NavWalker::fallback', // For menu fallback
        ));
    }
    /************************************************ */

    /***Adding post thumbnail */
    add_theme_support('post-thumbnails');
    /************************************************* */

    /***changing # of words shown by excerpt */
    function change_excerpt($length){
        if(is_author()){
        return 10;
        }elseif(is_category()){
            return 50;
        }
        else{
            return 15;
        }
    }

    function excerpt_change_dots(){
        return " ..";
    }

    add_filter('excerpt_length','change_excerpt'); //(name of the filter,function)
    add_filter('excerpt_more','excerpt_change_dots'); //(name of the filter,function)


    /************************************************* */


    /************************************************* */
    /**Actions */
    add_action( 'wp_enqueue_scripts', 'add_styles' ); //adding the css files 
    add_action( 'wp_enqueue_scripts', 'add_scripts' );//adding the js files
    add_action('init','register_custom_menu');//addign the custom menu
    /************************* */


    /***************Number pagination********** */
    function numbering_pagination(){
        global $wp_query;

        $number_of_all_pages=$wp_query -> max_num_pages;
        $current_page = max(1,get_query_var('paged')); // get current page

        if($number_of_all_pages > 1){
            return paginate_links(array(
                'base'      => get_pagenum_link() . '%_%',
                "format"   => "page/%#%",
                "current"   => $current_page,
                'mid_size'  => 1, // How many numbers to either side of the current pages. Default 2.
                'end-size'  => 2 // How many numbers on either the start and the end list edges. Default 1.
            ));
        }
    }

    /*********************** */

    /***********Register Sidebar */
    function Sidebar (){
        register_sidebar(array(
            "id"            => "main-sidebar",
            "name"          => "Main Sidebar",
            "description"   => "Appears every where",
            "before_widget" => "<div class='widget-content'>",
            'after_widget'  => "</div>",
            'before_title'  => "<h3 class='widget-title'>",
            'after_title'   => "</h3>"
        ));
    }

    add_action('widgets_init','Sidebar');
    /********************************** */


    /****Remove paragraph elements from the posts */
    function remove_p ($content){
        remove_filter("the_content",'wpautop');
        return $content;
    }    

    add_filter('the_content','remove_p',0);
    /********************************** */
?>
