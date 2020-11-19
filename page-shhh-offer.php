<?php


// TODO - Put this in utilities
// TODO - Surface this to editors
$deadline = new DateTime("2020-12-31 23:59:59", new DateTimeZone('America/Los_Angeles'));
$currentTime = new DateTime('',new DateTimeZone('America/Los_Angeles'));


if ($currentTime > $deadline) 
{ 
    header("Location: ". get_site_url() ."/membership", FALSE, 301);
         die(); 
}



$UWAA->Memberchecker->getSession();
get_header(); 
wp_enqueue_script(array('responsiveFrame', 'responsiveFrameHelper'));

$rawParentQueryStringParams = strtoupper($_SERVER['QUERY_STRING']);     

		  
      parse_str($rawParentQueryStringParams, $parentPageParams);
		  $childPageParams = array();  

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

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>      
      

      <div class="row uwaa-home-branding-row">
    
      <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>

      </div>

      <div class="uw-body-copy"> 

        <?php
      
        // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */


             ?>


       



<?php the_content(); ?>

 <p>

          <?php  

            if(array_key_exists("JOIN", $parentPageParams) ) {

                          echo get_field('custom_text_one');

                        }

                        if(array_key_exists("RENEW", $parentPageParams) ) {

                          echo get_field('custom_text_two');

                        }

          ?>

          </p>

<?php


          endwhile;

        ?>



        </div>  
      <!-- Ending us-body-copy -->

        <?php  // The Store
          $frameURL = "https://secure.gifts.washington.edu/membership/uwaa";          
          $childPageParams['MEMBCODES'] = "CAS,CAJ";
          $countOfParentParams = count($parentPageParams);

          if ($countOfParentParams > 0 ) {

            if(array_key_exists("JOIN", $parentPageParams)) {

              $childPageParams['JOIN'] = $parentPageParams['JOIN'];

            }

            if(array_key_exists("RENEW", $parentPageParams)) {

              $childPageParams['RENEW'] = $parentPageParams['RENEW'];

            }

            if(array_key_exists("NEWGRAD", $parentPageParams)) {

              $childPageParams['NEWGRAD'] = $parentPageParams['NEWGRAD'];

            }

            if(array_key_exists("APPEALCODE", $parentPageParams)) {

              $childPageParams['appealCode'] = $parentPageParams['APPEALCODE'];

            }

            if(array_key_exists("UTM_SOURCE", $parentPageParams)) {

              $childPageParams['UTM_SOURCE'] = $parentPageParams['UTM_SOURCE'];

            }

            if(array_key_exists("UTM_MEDIUM", $parentPageParams)) {

              $childPageParams['UTM_MEDIUM'] = $parentPageParams['UTM_MEDIUM'];

            }

            if(array_key_exists("UTM_CAMPAIGN", $parentPageParams)) {

              $childPageParams['UTM_CAMPAIGN'] = $parentPageParams['UTM_CAMPAIGN'];

            }          
            
          }

          $childPageQueryString = http_build_query($childPageParams);
          $frameURL .= "?" . $childPageQueryString;

        ?>
      
          <iframe id="MembershipStoreFrame" src="<?php echo $frameURL; ?>" width="100%" height="3250px" frameborder="0" scrolling="no" style="margin-top:10px;"></iframe>
     

      </div>

     
   

  </div>
     
</div>

<?php get_footer(); ?>
