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


// First, if we're not in drive, just do the WordPress content
$currentMonth = date('m');

$currentDate = date('m/d');


//Set up a directive to automatically revert to normal store operations after a special period is over.
$isSpecialDriveActive = false;


if (array_key_exists("APPEALCODE", $parentPageParams) ) {
  $newGradParentMailer = array('A19GM1');
  if(in_array($parentPageParams["APPEALCODE"], $newGradParentMailer)  ){
    $isSpecialDriveActive = true;
    ?>    
    <h1>Get your grad the gift of a lifetime!</h1>
    <p>    
      By giving the gift of UWAA membership, you are giving access to the rich variety of alumni programs, wide array of benefits and continued campus connections that will be there for your grad well into the future. 
    </p>
    

    <?php
  }

}


// GivingDay Direct Appeal
if (array_key_exists("APPEALCODE", $parentPageParams) ) {
  $givingDayAppealCodes = array('A19G1', 'A19G2', 'A19G3');
  if(in_array($parentPageParams["APPEALCODE"], $givingDayAppealCodes) && $currentDate != "04/04" ){
    $isSpecialDriveActive = true;
    ?>
    <img src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2019/03/26133543/Husky-Giving-Day-300.png" alt="Husky-Giving-Day-300" width="191" height="300" class="alignright size-medium wp-image-35280 responsive-center" />
    <h1>Choose your membership option:</h1>
    <p>    
      Husky Giving Day on April 4 is the day when the entire UW community comes together to support the people, programs and causes they care about most.
    </p>
    <p>
      Want to pay it forward? Double your impact as part of our Husky Giving Day deal. Become a UWAA member by April 4, and the UWAA Board of Trustees will match it with a gift membership to a 2019 grad.
    </p>

    <?php
  }

}



//GivingDay Browse-to (no appeal)
if($currentDate == "04/04" ) {
  $isSpecialDriveActive = true;
  ?>
<img src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2019/03/26133543/Husky-Giving-Day-300.png" alt="Husky-Giving-Day-300" width="191" height="300" class="alignright size-medium wp-image-35280 responsive-center" />
  <h1>Choose your membership option:</h1>

  <p>
    Today is Husky Giving Day when the entire UW community comes together to support the people, programs and causes they care about most.
  </p>
  <p>
    Want to pay it forward? Double your impact as part of our Husky Giving Day deal. Join or renew today, and the UWAA Board of Trustees will match it with a gift membership to a 2019 grad.
  </p>
  <?php

}


if ($currentMonth == '10') {
  if(array_key_exists("JOIN", $parentPageParams)) {
      ?>

      <h1>Now is the best time to join</h1>      

<img class="inline wp-image-31784 size-full" src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2019/10/01090237/2019_FallDrive_Inline_1line1.png" alt="Husky for Life" width="280" />
<p>
<img class="inline wp-image-31784 size-full alignright" src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2019/10/01083217/PromotionalItem.jpg" alt="UWAA pennant on" width="175" height="175" /><strong>It’s the fall membership drive!</strong> Through the end of October, our long-time partner <strong>BECU has pledged to match new and renewing member dues with a gift</strong> in support of student scholarships and higher education in Washington, up to $50,000.</p>
<p>Need another reason to join? Join by Oct. 31 and receive a free thank-you gift: a "Husky for Life!" pennant.</p>

<h3>Join the pack</h3>

<h4><strong>Choose your membership option:</strong></h4>
<?php
     } elseif (array_key_exists("RENEW", $parentPageParams)) {
       ?>
      <h1>Now is the best time to join</h1>      

<img class="inline wp-image-31784 size-full" src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2019/10/01090237/2019_FallDrive_Inline_1line1.png" alt="Husky for Life" width="280" />
<p>
<img class="inline wp-image-31784 size-full alignright" src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2019/10/01083217/PromotionalItem.jpg" alt="UWAA pennant on" width="175" height="175" /><strong>It’s the fall membership drive!</strong> Through the end of October, our long-time partner <strong>BECU has pledged to match new and renewing member dues with a gift</strong> in support of student scholarships and higher education in Washington, up to $50,000.</p>
<p>Need another reason to join? Join by Oct. 31 and receive a free thank-you gift: a "Husky for Life!" pennant.</p>

<h3>Join the pack</h3>

<h4><strong>Choose your membership option:</strong></h4>
       <?php
     } else {
      ?>
      <h1>Now is the best time to join</h1>      

<img class="inline wp-image-31784 size-full" src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2019/10/01090237/2019_FallDrive_Inline_1line1.png" alt="Husky for Life" width="280" />
<p>
<img class="inline wp-image-31784 size-full alignright" src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2019/10/01083217/PromotionalItem.jpg" alt="UWAA pennant on" width="175" height="175" /><strong>It’s the fall membership drive!</strong> Through the end of October, our long-time partner <strong>BECU has pledged to match new and renewing member dues with a gift</strong> in support of student scholarships and higher education in Washington, up to $50,000.</p>
<p>Need another reason to join? Join by Oct. 31 and receive a free thank-you gift: a "Husky for Life!" pennant.</p>

<h3>Join the pack</h3>

<h4><strong>Choose your membership option:</strong></h4>
      <?php
     }
} else {

   // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you want to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            if (!$isSpecialDriveActive) {
             get_template_part( 'content', 'page' );
            }
             


          endwhile;

}
          ?>



      </div>  
      <!-- Ending us-body-copy -->

		<?php  // The Store

		  

        $frameURL = "https://secure.gifts.washington.edu/membership/uwaa";
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


		   $childPageQueryString = http_build_query($childPageParams);
		   $frameURL .= "?" . $childPageQueryString;
	   }

		?>
  
      <iframe id="MembershipStoreFrame" src="<?php echo $frameURL; ?>" width="100%" height="3250px" frameborder="0" scrolling="no" style="margin-top:10px;"></iframe>
     

    </div>
   

  </div>

</div>

<?php get_footer(); ?>
