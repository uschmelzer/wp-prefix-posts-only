<?php


// Add this to your functions.php



// -------------------------------------------------------------------
// Wordpress: Add a Prefix to url for posts only 
// -------------------------------------------------------------------
// CURRENT:           /my-news-title
// NEW    : /my-prefix/my-news-title
// -------------------------------------------------------------------
// Based on 
// https://wordpress.stackexchange.com/a/242513/130668
// -------------------------------------------------------------------



// -------------------------------------------------------------------
// Rewrite for the new prefix
// -------------------------------------------------------------------
// "my-prefix"
// -------------------------------------------------------------------
function dvs_add_rewrite_rules( $wp_rewrite )
{
    $new_rules = array(
        'my-prefix/(.+?)/?$' => 'index.php?post_type=post&name='. $wp_rewrite->preg_index(1),
    );

    $wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
}
add_action('generate_rewrite_rules', 'dvs_add_rewrite_rules'); 


// -------------------------------------------------------------------
// Change the links
// -------------------------------------------------------------------
// "my-prefix"
// -------------------------------------------------------------------
function dvs_change_blog_links($post_link, $id=0){

    $post = get_post($id);

    if( is_object($post) && $post->post_type == 'post'){
        return home_url('/my-prefix/'. $post->post_name.'/');
    }

    return $post_link;
}
add_filter('post_link', 'dvs_change_blog_links', 1, 3);


// -------------------------------------------------------------------
// END - Change Prefix for posts only 
// -------------------------------------------------------------------

