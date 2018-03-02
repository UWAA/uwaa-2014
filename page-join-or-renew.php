<?php
$rawParentQueryStringParams = strtoupper($_SERVER['QUERY_STRING']);

      // echo $rawParentQueryStringParams;

      

      // if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=E-WASHINGTON") !== FALSE) {        
      //   ECHO "BAD EWA, sleeping";
      //   sleep(2);
      //   header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=e-washington", FALSE, 301);
      //   die();
        
      // }

      // if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=WASHINGTON-DC") !== FALSE) {        
      //   sleep(2);
      //   header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=washington-dc", FALSE, 301);
      //   die();
        
      // }

      // if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=NEW-YORK") !== FALSE) {        
      //   sleep(2);
      //   header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=new-york", FALSE, 301);
      //   die();
        
      // }
      // if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=CALIFORNIA") !== FALSE) {        
      //   sleep(2);
      //   header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=california", FALSE, 301);
      //   die();
        
      // }
      // if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=NEWSLETTER&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=OREGON") !== FALSE) {        
      //   sleep(2);
      //   header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=oregon", FALSE, 301);
      //   die();
        
      // }
      if (strpos($rawParentQueryStringParams, "JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=NEWSLETTER&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=PUGET-SOUND") !== FALSE) {                
        header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=puget-sound", FALSE, 301);
        die();
        
      }



      // if ($rawParentQueryStringParams == 'JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=E-WASHINGTON') {        
      //   header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=e-washington");
      //   die();
        
      // }

      // if ($rawParentQueryStringParams == 'JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=WASHINGTON-DC') {        
      //   header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=washington-dc");
      //   die();
        
      // }

      // if ($rawParentQueryStringParams == 'JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=NEW-YORK') {        
      //   header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=new-york");
      //   die();
        
      // }
      // if ($rawParentQueryStringParams == 'JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=ANNOUNCEMENT&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=CALIFORNIA') {        
      //   header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=california");
      //   die();
        
      // }
      // if ($rawParentQueryStringParams == 'JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=NEWSLETTER&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=OREGON') {        
      //   header("Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=oregon");
      //   die();
        
      // }
      // if ($rawParentQueryStringParams == 'JOIN=TRUE/?APPEALCODE=A18S08?UTM_SOURCE=NEWSLETTER&UTM_MEDIUM=EMAIL&UTM_CAMPAIGN=SPRING-DRIVE&UTM_CONTENT=PUGET-SOUND') {        
      //   header("Location: Location: https://www.washington.edu/cms/alumni/membership/be-a-member/join-or-renew?join=true&appealCode=A18S08&utm_source=announcement&utm_medium=email&utm_campaign=spring-drive&utm_content=puget-sound");
      //   die();
        
      // }


$UWAA->Memberchecker->getSession();
// @TODO Make booleans for store state (join vs. renew)


      

get_header(); 
wp_enqueue_script(array('responsiveFrame', 'responsiveFrameHelper'));

		 
		  
      parse_str($rawParentQueryStringParams, $parentPageParams);
		  $childPageParams = array();

          $parentPageParams["MEMBCODES"] = preg_replace("/|CM(J|D),*/", "", $parentPageParams["MEMBCODES"]);
          $parentPageParams["MEMBCODES"] = preg_replace("/|LAD/", "", $parentPageParams["MEMBCODES"]);

          // LAD is life joint thing

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

			   $childPageParams['APPEALCODE'] = $parentPageParams['APPEALCODE'];

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
