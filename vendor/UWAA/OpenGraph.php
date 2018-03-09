<?php namespace UWAA;
use \UWAA\View\UI as UI;

/**
* 
*/
class OpenGraph
{
    
    function __construct()
    {
        add_action('wp_head', array($this, 'handleOpenGraph'), 5);

    }


    public function handleOpenGraph() {
    global $post;

    if(get_the_title($post->ID) == "Choose a membership option") {

        $speciaOGTitle = sanitize_text_field(get_post_meta(get_the_ID(), 'mb_special_og_title', true));
        $speciaOGDescription = sanitize_text_field(get_post_meta(get_the_ID(), 'mb_special_og_description', true));


        ?>
            <meta property="og:title" content="<?php echo $speciaOGTitle ?>"/>
            <meta property="og:description" content="<?php echo $speciaOGDescription ?>"/>
            <?php
            return;
        }

 
    if(is_single()) {

        

        if(has_post_thumbnail($post->ID)) {                                     
            $feature = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'original');
            $img_src = $feature['0'];            
            $img_dimensions = "
                 <meta property=\"og:image:width\"      content=\" ". $feature['1'] ." \">
                 <meta property=\"og:image:height\"     content=\" ". $feature['2'] ." \">
             ";
        } else {
            $img_src = get_stylesheet_directory_uri() . '/assets/opengraph_fallback.jpg';
            $img_dimensions = "";
        }
        if($excerpt = $post->post_excerpt) {
            $excerpt = strip_tags($post->post_excerpt);
            $excerpt = str_replace("", "'", $excerpt);
        } else {
            $excerpt = get_bloginfo('description');
        }
    ?>
 
    <meta property="og:title" content="<?php echo the_title(); ?>"/>
    <meta property="og:description" content="<?php echo $excerpt; ?>"/>
    <meta property="og:type" content="article"/>
    <meta property="og:url" content="<?php echo the_permalink(); ?>"/>
    <meta property="og:site_name" content="<?php echo get_bloginfo(); ?>"/>
    <meta property="og:image" content="<?php echo $img_src; ?>"/>
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@uwalum">
    <meta name="twitter:title" content="<?php echo the_title(); ?>">
    <meta name="twitter:description" content="<?php echo $excerpt; ?>">
    <meta name="twitter:image" content="<?php echo $img_src; ?>">
 
<?php
    echo $img_dimensions;
    } else {
        return;
    }
}

}