<?php


// TODO - Put this in utilities
// TODO - Surface this to editors
$deadline = new DateTime("2019-12-02 23:59:59", new DateTimeZone('America/Los_Angeles'));
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

<div class="cyber-header uw-homepage-slider-container">
<?php

include(locate_template('content-cyber-superhero.php'));

?>
  
</div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>      
      

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


<?php if(uw_list_pages()){ ?>
	<div id="mobile-sidebar">
		<button id="mobile-sidebar-menu" class="visible-xs" aria-hidden="true" tabindex="1">
	    	<div aria-hidden="true" id="ham">
		    	<span></span>
				<span></span>
				<span></span>
				<span></span>
			</div>
	   		<div id="mobile-sidebar-title" class="page_item"> Close Menu </div>
		</button>
		<div id="mobile-sidebar-links" aria-hidden="true" class="visible-xs">  <?php uw_sidebar_menu(); ?></div>
	</div>
<?php } ?>

<?php the_content(); ?>

<?php


          endwhile;

        ?>



        </div>  
      <!-- Ending us-body-copy -->

        <?php  // The Store
          $frameURL = "https://secure.gifts.washington.edu/membership/uwaa";          
          $childPageParams['MEMBCODES'] = "CMS,CMJ";
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

      <div class="col-md-4 uw-sidebar">
        <?php

          the_widget("UWAA\Widgets\SidebarFeaturedPost");

        ?>
      </div>
   

  </div>
     
</div>

<?php get_footer(); ?>
