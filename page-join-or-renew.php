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

		  $rawParentQueryStringParams = strtoupper($_SERVER['QUERY_STRING']);
		  parse_str($rawParentQueryStringParams, $parentPageParams);
		  $childPageParams = array();


 
          

	  	if(array_key_exists("MEMBCODES", $parentPageParams) && $parentPageParams["MEMBCODES"] == "CMJ,CMS") {

          ?> 
			  
	  	<h1>Cyber Member Monday &mdash; Early Access</h1>

		  <p>
	  	Launching now, you can save 40% on UWAA annual memberships! As a loyal Husky, we&rsquo;re offering you early access to our Cyber Member Monday rate. Whether you want to treat yourself or give the gift of membership, sign up today to enjoy generous benefits like exclusive invitations to member events and discounts at dozens of businesses&mdash;while supporting and staying connected to the UW.
		  </p>


	  	<p>
	  		<strong>UWAA members enjoy:</strong>
	  		
			  <ul>
					<li>Invitations to exclusive member events, like UWAA Movie Nights, Nike Night and more</li>
					<li>Early registration to free campus lectures, and discounts to UWAA public events like Alaska Airlines Dawg Dash</li>
					<li>Borrowing privileges at UW Libraries collections on all three UW campuses</li>
					<li>Discounts and benefits at dozens of businesses in the Pacific Northwest and online nationwide</li>
					<li>Knowing we support UW students and public higher education in the state of Washington</li>
			  </ul>
	  		
	  	</p>
	  	<p>Be connected. Be proud. Be a member.</p>

	  	



			<?php
		  } else {         

            ?>

	  	<h1>Choose a membership option</h1>


	  	<p>
	  		<strong>UWAA members enjoy:</strong>

			<ul>
				<li>Invitations to exclusive member events, like UWAA Movie Nights, Nike Night and more</li>
				<li>Early registration to free campus lectures, and discounts to UWAA public events like Alaska Airlines Dawg Dash</li>
				<li>Borrowing privileges at UW Libraries collections on all three UW campuses</li>
				<li>Discounts and benefits at dozens of businesses in the Pacific Northwest and online nationwide</li>
				<li>Knowing we support UW students and public higher education in the state of Washington</li>
			</ul>
	  		
	  	</p>
	  	<p>Be connected. Be proud. Be a member.</p>

      </div>

		<?php

		  } //END ELSE

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
  
      <iframe id="MembershipStoreFrame" src="<?php echo $frameURL; ?>" width="100%" height="3250px" frameborder="0" scrolling="no"></iframe>
     

    </div>
   

  </div>

</div>

<?php get_footer(); ?>
