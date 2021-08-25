<?php



$UWAA->Memberchecker->getSession();

function previewOrActiveDrive() {
  if (is_user_logged_in() || get_field('controls')['drive_custom_is_active']) {
    return TRUE;
    
  }
  return FALSE;
}

get_header(); 
wp_enqueue_script(array('responsiveFrame', 'responsiveFrameHelper'));


$rawParentQueryStringParams = strtoupper($_SERVER['QUERY_STRING']);     
		 
		  
      parse_str($rawParentQueryStringParams, $parentPageParams);
		  $childPageParams = array();


?>            


<div class="uwaa-hero-image" style="background-image:url(https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2021/08/23155413/2021_Lapsed-Life_sh.jpg)"></div>








<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->     

     

      <div class="row uwaa-home-branding-row">
    
     <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>

    </div>

      <div class="uw-body-copy">    



 <?php


// First, if we're not in drive, just do the WordPress content
$currentMonth = date('m');

$currentDate = date('m/d');


//Set up a directive to automatically revert to normal store operations after a special period is over.
$isSpecialDriveActive = false;




if (previewOrActiveDrive() ) {  //Content in this shows if a user is logged in, or if the 'drive active' true/false field is checked
  if(array_key_exists("JOIN", $parentPageParams)) {

    ?> <h1> <?php echo get_field('drive_custom_join_subhead'); ?></h1>
    
    <?php
    
    echo get_field('drive_custom_join_content');

     } elseif (array_key_exists("RENEW", $parentPageParams)) {

      ?> <h1> <?php echo get_field('drive_custom_renew_subhead'); ?></h1>
    
    <?php
    
      echo get_field('drive_custom_renew_content');
    ?>
      
       <?php
     } else {

      // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            
             get_template_part( 'content', 'page' );
            
             


          endwhile;

     }
} else {

  // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            
             get_template_part( 'content', 'page' );
            
             


          endwhile;

   

}
          ?>



      </div>  
      <!-- Ending us-body-copy -->

		<?php  // The Store

		  

        $frameURL = "https://ua-dev-secure.gifts.washington.edu/membership/uwaa/payout";
        $appealCodeIFrameParams = array();


	   

	   if (count($parentPageParams) > 0) {

           


		   if(array_key_exists("MD5HASH", $parentPageParams)) {

			   $childPageParams['MD5HASH'] = strtolower($parentPageParams['MD5HASH']);

		   }		  

		   if(array_key_exists("APPEALCODE", $parentPageParams)) {

			   $childPageParams['appealCode'] = $parentPageParams['APPEALCODE'];

		   }

		   if(array_key_exists("MEMBCODES", $parentPageParams)) {

			   $childPageParams['MEMBCODES'] = $parentPageParams['MEMBCODES'];

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
       
		//    Simplified from main store to prevent encoding issues
		   $frameURL .= "?membcodes=" . $childPageParams["MEMBCODES"] . "&MD5Hash=" . $childPageParams["MD5HASH"];
	   }

		?>
  
      <iframe id="MembershipStoreFrame" src="<?php echo $frameURL; ?>" width="100%" height="3250px" frameborder="0" scrolling="no" style="margin-top:10px;"></iframe>
     
<!-- http://localhost:41157/uwaa/payout?membcodes=LSP&MD5Hash=0000031956,800.64bc46a73c1785312db742399de681df -->
    </div>
   

  </div>

</div>

<?php get_footer(); ?>
