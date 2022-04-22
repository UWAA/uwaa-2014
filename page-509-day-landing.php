<?php 
get_header();
$rawParentQueryStringParams = strtoupper($_SERVER['QUERY_STRING']);
parse_str($rawParentQueryStringParams, $parentPageParams);

$successMessageOnly = false;
$oneClickSubmission = false;

if (array_key_exists('ONECLICKSUBMISSION', $parentPageParams) && $parentPageParams['ONECLICKSUBMISSION'] == TRUE ) {
  $oneClickSubmission = true;
}

if (array_key_exists('SUCCESSMESSAGEONLY', $parentPageParams) && $parentPageParams['SUCCESSMESSAGEONLY'] == TRUE ) {
  $successMessageOnly = true;
}
?>


<?php
$featureImage = $UWAA->UI->returnPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original');

if ($featureImage) { ?>
<div class="uwaa-hero-image <?php echo get_post_meta(get_the_id(), 'mb_header_text_color', true); ?> " style="background-image:url('<?php $UWAA->UI->getPostFeaturedImageURL(get_post_thumbnail_id($post->ID), 'original')?>');"></div>

<?php    
}
else {
  $defaultHeader = TRUE;
  get_template_part( 'header', 'image' ); 
}

?>

<!-- K:\env\wordpress\www\uwalum-test\public_html\wp-content\themes\uwaa-2014\logos\regionLogo-eastern-washington.svg.php -->

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>    

  <?php // get_template_part('partials/sidebar', 'page-breadcrumbs') ?>

  
      <div class="uw-body-copy">

      <h1> <?php the_title() ?> </h1>

      

        <!-- 509 Day Promotion System -->
        <?php 

          if ( get_field("509_promotion_toggle") ) {
            if ($oneClickSubmission) {
                echo get_field("509_address_on_file_text");
              } elseif ($successMessageOnly) {
                echo get_field("509_address_received") ;
              } else {
        ?>

		    <h2>Please enter your current mailing address.</h2>
        
        <?php echo do_shortcode('[wufoo username="uwalum" formhash="p1drn85v1lrvbif" autoresize="true" height="590" header="show" ssl="true"]'); ?>

        <?php 
        }  //end else
        
        } else {

          echo get_field("509_promotion_ended");
          
          } ?>   
      
	  </div>
      </div>
    </div>

  </div>



<?php get_footer(); ?>