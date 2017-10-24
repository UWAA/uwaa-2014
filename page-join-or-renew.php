<?php

$UWAA->Memberchecker->getSession();
// @TODO Make booleans for store state (join vs. renew)

get_header(); 
wp_enqueue_script(array('responsiveFrame', 'responsiveFrameHelper'));

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

          ?>
          <h1><?php the_title() ?></h1>
                    

          <?php

          the_content();            


          endwhile;     

        ?>

      </div>

        <?php

        $frameURL = "https://secure.gifts.washington.edu/membership/uwaa";

      $appealCodeIFrameParam = '';
      
      if(isset($_GET['appealcode'])) {
          $appealCodeIFrameParam = 'appealcode='. filter_var($_GET['appealcode'], FILTER_SANITIZE_STRING);
          $frameURL = "https://secure.gifts.washington.edu/membership/uwaa?" . $appealCodeIFrameParam ; 
      }

      
      if ($_GET['join'] == TRUE) {
        $frameURL = "https://secure.gifts.washington.edu/membership/uwaa?join=true&". $appealCodeIFrameParam;
      } elseif ($_GET['renew'] == TRUE){
         $frameURL = "https://secure.gifts.washington.edu/membership/uwaa?renew=true&" . $appealCodeIFrameParam;
      } elseif ($_GET['newgrad'] == TRUE) {
         $frameURL = "https://secure.gifts.washington.edu/membership/uwaa?newgrad=true&" . $appealCodeIFrameParam;
      }

        ?>
  
      <iframe id="MembershipStoreFrame" src="<?php echo $frameURL; ?>" width="100%" height="3250px" frameborder="0" scrolling="no"></iframe>
     

    </div>
   

  </div>

</div>

<?php get_footer(); ?>
