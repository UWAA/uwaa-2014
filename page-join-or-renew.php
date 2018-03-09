<?php

$rawParentQueryStringParams = strtoupper($_SERVER['QUERY_STRING']);

      if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=E-WASHINGTON") !== FALSE) {        
        header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=e-washington", FALSE, 301);
        die();
        
      }

      if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=WASHINGTON-DC") !== FALSE) {        
        // header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=washington-dc", FALSE, 301);
        header("Location: http://alumni.test/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=washington-dc", FALSE, 301);
        die();
        
      }

      if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=NEW-YORK") !== FALSE) {                
        header("Location: http://alumni.test/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=new-york", FALSE, 301);
        die();
        
      }
      if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=CALIFORNIA") !== FALSE) {        
        header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=california", FALSE, 301);
        die();
        
      }
      if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=NEWSLETTER&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=OREGON") !== FALSE) {        
        header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=oregon", FALSE, 301);
        die();
        
      }
      if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=NEWSLETTER&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=PUGET-SOUND") !== FALSE) {                
        header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=puget-sound", FALSE, 301);
        die();
        
      }

$UWAA->Memberchecker->getSession();




      

get_header(); 
wp_enqueue_script(array('responsiveFrame', 'responsiveFrameHelper'));


$rawParentQueryStringParams = strtoupper($_SERVER['QUERY_STRING']);     
		 
		  
      parse_str($rawParentQueryStringParams, $parentPageParams);
		  $childPageParams = array();


      if (array_key_exists("MEMBCODES", $parentPageParams)) {
      $parentPageParams["MEMBCODES"] = preg_replace("/|CM(J|D),*/", "", $parentPageParams["MEMBCODES"]);
      $parentPageParams["MEMBCODES"] = preg_replace("/|LAD/", "", $parentPageParams["MEMBCODES"]);

          // LAD is life joint thing
      }
      

    

     // In the event a malformed spring drive URL still comes in, we'll blow away the calling params and at least ensure the the appeal is appended.
     if(!array_key_exists("APPEALCODE", $parentPageParams) && strpos($rawParentQueryStringParams, 'A18S08') !== FALSE) {
      unset($parentPageParams);
      $parentPageParams = array();
      $parentPageParams["APPEALCODE"] = "A18S08";
      $parentPageParams["JOIN"] = "TRUE";
     }
      

          

?>

<div class="uw-hero-image membership"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->
      <h2 class="uw-site-title">UWAA Membership</h2>

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
             get_template_part( 'content', 'page' );


          endwhile;


          ?>



      </div>  
      <!-- Ending us-body-copy -->

		<?php  // The Store

		  

        $frameURL = "https://secure.gifts.washington.edu/membership/uwaa";
        $appealCodeIFrameParams = array();


	   

	   if (count($parentPageParams > 0)) {

           


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


		   $childPageQueryString = http_build_query($childPageParams);
		   $frameURL .= "?" . $childPageQueryString;
	   }

		?>
  
      <iframe id="MembershipStoreFrame" src="<?php echo $frameURL; ?>" width="100%" height="3250px" frameborder="0" scrolling="no" style="margin-top:10px;"></iframe>
     

    </div>
   

  </div>

</div>

<?php get_footer(); ?>
