<?php


get_header(); 
wp_enqueue_script(array('responsiveFrame', 'responsiveFrameHelper'));


$rawParentQueryStringParams = strtoupper($_SERVER['QUERY_STRING']);
		 
		  
      parse_str($rawParentQueryStringParams, $parentPageParams);
		  $childPageParams = array();

?>


<div class="uw-hero-image membership"></div>



<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->     

          <h2 class="uw-site-title">UWAA Membership </h2>
        
        

      <div class="row uwaa-home-branding-row">
    
     <?php include(locate_template( 'partials/sidebar-single-breadcrumbs.php')); ?>

    </div>

      <div class="uw-body-copy">    



 <?php



    ?> 
    
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

		<?php  // The Frame		  

        
          $frameURL = "https://online.gifts.washington.edu/secure/updatecc/UWAAupdate";
        

        

        
        $appealCodeIFrameParams = array();


	   

	   if (count($parentPageParams) > 0) {

      if(array_key_exists("IDS", $parentPageParams)) {

			   $childPageParams['ids'] = strtoupper($parentPageParams['IDS']);

		   }  

		   if(array_key_exists("NOTIFICATIONGUID", $parentPageParams)) {

			   $childPageParams['notificationGUID'] = strtoupper($parentPageParams['NOTIFICATIONGUID']);

		   }

		   

       if(array_key_exists("D_IDS", $parentPageParams)) {

			   $childPageParams['d_ids'] = strtoupper($parentPageParams['D_IDS']);

		   }

		   if(array_key_exists("FULLCARDUPDATE", $parentPageParams)) {

			   $childPageParams['FULLCARDUPDATE'] = $parentPageParams['FULLCARDUPDATE'];

		   }

		   if(array_key_exists("REFERRERNAME", $parentPageParams)) {

			   $childPageParams['REFERRERNAME'] = $parentPageParams['REFERRERNAME'];

		   }

		   if(array_key_exists("CARDLASTUPDATEDDATE", $parentPageParams)) {

			   $childPageParams['CARDLASTUPDATEDDATE'] = $parentPageParams['CARDLASTUPDATEDDATE'];

		   }

		   if(array_key_exists("lastFour", $parentPageParams)) {

			   $childPageParams['lastFour'] = $parentPageParams['lastFour'];

		   }		 

		   $childPageQueryString = http_build_query($childPageParams);
		   $frameURL .= "?" . $childPageQueryString;
	   }

		?>
  
      <iframe id="MembershipStoreFrame" src="<?php echo $frameURL; ?>" width="100%" height="400" frameborder="0" scrolling="no" style="margin-top:10px;"></iframe>
     

    </div>
   

  </div>

</div>

<?php get_footer(); ?>
