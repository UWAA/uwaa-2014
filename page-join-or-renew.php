<?php

$rawParentQueryStringParams = strtoupper($_SERVER['QUERY_STRING']);     

$UWAA->Memberchecker->getSession();

function previewOrActiveDrive() {
  if (is_user_logged_in() && get_field('controls')['drive_preview_drive_content'] === true )  {
    return true;
    
  }
  return false;
}

function driveIsActive() {
  if (get_field('controls')['drive_custom_is_active'] === true) {
    return true;
    
  }
  return false;
}

function cyber() {
  if (get_field('controls')['drive_custom_cyber'] === true) {    
    return true;
    }
  return false;
}

if ((cyber() && previewOrActiveDrive()) || cyber() && driveIsActive()) {
  add_filter( 'body_class', function( $classes ) {
    return array_merge( $classes, array( 'cyberweek' ) );
} );
}


get_header(); 
wp_enqueue_script(array('responsiveFrame', 'responsiveFrameHelper'));






$rawParentQueryStringParams = strtoupper($_SERVER['QUERY_STRING']);     
		 
		  
      parse_str($rawParentQueryStringParams, $parentPageParams);
		  $childPageParams = array();


      if (array_key_exists("MEMBCODES", $parentPageParams)) {
      $parentPageParams["MEMBCODES"] = preg_replace("/|LAD/", "", $parentPageParams["MEMBCODES"]);

          // LAD is life joint thing
      }

      // var_dump();
            
// <!-- drive_custom_is_control_shown -->

// TODO  - ACF Field Control


if(previewOrActiveDrive() || driveIsActive() ) {
  // show the join/renew custom superheros
if(array_key_exists("JOIN", $parentPageParams) && get_field('drive_custom_join_superhero')) {

  $superhero = get_field('drive_custom_join_superhero');
?>
  
  <div class="uwaa-hero-image" style="background-image:url(<?php echo esc_url($superhero['url']); ?>);"></div>

<?php

} elseif (array_key_exists("RENEW", $parentPageParams ) && get_field('drive_custom_renew_superhero') )  {

  $superhero = get_field('drive_custom_renew_superhero');
?>
  
  <div class="uwaa-hero-image" style="background-image:url(<?php echo esc_url($superhero['url']); ?>);"></div>

<?php } elseif(cyber()) { ?> 

  <div class="uw-hero-image cyber-video-wrapper">  
  
    <video id="cyber-video"  playsinline autoplay muted loop poster="<?php bloginfo("stylesheet_directory"); ?>/assets/headers/Page_Header_Cyber.png">
        <source  src="<?php bloginfo("stylesheet_directory"); ?>/assets/video/cyberheader.webm" type="video/webm" >
        <source src="<?php bloginfo("stylesheet_directory"); ?>/assets/video/cyberheader.mp4" type="video/mp4" >
    </video>
</div>

<?php } else { ?> 

  <div class="uw-hero-image membership"></div> 

<?php
}

} else { ?>

<div class="uw-hero-image membership"></div>

<?php  } ?>






<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->     

      <?php 

        if( previewOrActiveDrive() || driveIsActive() ) {
          // show the join/renew custom superheros
        if(array_key_exists("JOIN", $parentPageParams) ) {
        
          ?>
          <h2 class="uw-site-title drive-custom" style="color:<?php echo esc_attr( get_field('drive_custom_superhero_text_color') ) ?>;"><?php echo get_field('drive_custom_join_headline') ?> </h2>
        
        <?php

        } elseif (array_key_exists("RENEW", $parentPageParams ) && get_field('drive_custom_renew_superhero') )  {       
          
        ?>

         <h2 class="uw-site-title drive-custom" style="color:<?php echo esc_attr( get_field('drive_custom_superhero_text_color') ) ?>;"><?php echo get_field('drive_custom_renew_headline') ?> </h2>
        
        <?php } elseif(cyber()) 
        
          { 

          }
        
          
          else { ?> 
        
          <h2 class="uw-site-title">UWAA Membership </h2>
        
        <?php
        }

        } else { ?>

          <h2 class="uw-site-title">UWAA Membership </h2>
        
        <?php  } ?>

      <div class="row uwaa-home-branding-row">
    
     <!-- TODO - Make a cyber something toggle. -->
     
     <?php if(!cyber()) { include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); }?>

    </div>

      <div class="uw-body-copy">    



 <?php


// First, if we're not in drive, just do the WordPress content
$currentMonth = date('m');

$currentDate = date('m/d');


//Set up a directive to automatically revert to normal store operations after a special period is over.
$isSpecialDriveActive = false;




if (previewOrActiveDrive() || driveIsActive() ) {  //Content in this shows if a user is logged in, or if the 'drive active' true/false field is checked
  if(array_key_exists("JOIN", $parentPageParams)) {

    ?> <h1> <?php echo get_field('drive_custom_join_subhead'); ?></h1>
    
    <?php
    
    echo get_field('drive_custom_join_content');

     } elseif (array_key_exists("RENEW", $parentPageParams)) {

      ?> <h1> <?php echo get_field('drive_custom_renew_subhead'); ?></h1>
    
    <?php
    
      echo get_field('drive_custom_renew_content');

    } elseif (cyber() OR (array_key_exists("JOIN", $parentPageParams) AND cyber() ) OR (array_key_exists("RENEW", $parentPageParams) AND cyber() ) ) {

      ?> <h1> <?php echo get_field('drive_custom_cybermonday_subhead'); ?></h1>
    
    <?php
    
      echo get_field('drive_custom_cybermonday_content');
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

		  

        if (previewOrActiveDrive()  && get_bloginfo( 'name') == "Alumni" ) {
          $frameURL = "https://ua-dev-secure.gifts.washington.edu/membership/uwaa";
        } elseif (previewOrActiveDrive() && get_bloginfo( 'name') == "uwalum" ) {
          $frameURL = "http://localhost:41157/uwaa";
        } else {
          $frameURL = "https://secure.gifts.washington.edu/membership/uwaa";
        }

        

        

        

        
        $appealCodeIFrameParams = array();


	   

	   if (count($parentPageParams) > 0) {

           


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

       if(array_key_exists("GIFT", $parentPageParams)) {

			   $childPageParams['GIFT'] = $parentPageParams['GIFT'];

		   }


		   $childPageQueryString = http_build_query($childPageParams);
		   $frameURL .= "?" . $childPageQueryString;
	   }

		?>
  
      <iframe allowtransparency="true" id="MembershipStoreFrame" src="<?php echo $frameURL; ?>" width="100%" height="3250px" frameborder="0" scrolling="no" style="margin-top:10px;"></iframe>
     

    </div>
   

  </div>

</div>

<?php get_footer(); ?>
