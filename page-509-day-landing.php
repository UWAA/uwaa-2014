<?php 
get_header();
$rawParentQueryStringParams = strtoupper($_SERVER['QUERY_STRING']);
parse_str($rawParentQueryStringParams, $parentPageParams);

$successMessageOnly = false;
$oneClickSubmission = false;

if (array_key_exists('ONECLICKSUBMISSION', $parentPageParams) && $parentPageParams['ONECLICKSUBMISSION'] == TRUE ) {
  $oneClickSubmission = true;
}

if (array_key_exists('SUCCESSMESSAGEONLY', $parentPageParams) && $parentPageParams['SUCCESSMESSAGEONLY'] == TRUE ) {
  $successMessageOnly = true;
}
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

<!-- K:\env\wordpress\www\uwalum-test\public_html\wp-content\themes\uwaa-2014\logos\regionLogo-eastern-washington.svg.php -->

<div class="container uw-body">

  <div class="row">

    <div class="col-md-12 uw-content" role='main'>    

  <?php get_template_part('partials/sidebar', 'page-breadcrumbs') ?>

  
      <div class="uw-body-copy">

        <?php
          // Start the Loop.
          while ( have_posts() ) : the_post();

            /*
             * Include the post format-specific template for the content. If you wanp,t to
             * use this in a child theme, then include a file called called content-___.php
             * (where ___ is the post format) and that will be used instead.
             */
            get_template_part( 'content', 'page' );

          endwhile;

          
        ?>

		<div style="margin-top:40px;">

        <?php if ($oneClickSubmission) {
          echo "We will send your gift to the address we have on file. Happy 509 Day!";
        } elseif ($successMessageOnly) {
          echo "We have received your address. Happy 509 Day!";
        } else {

        ?>

		<h2>Please enter your current mailing address.</h2>
        <script src="//app-sj19.marketo.com/js/forms2/js/forms2.min.js"></script>
<form id="mktoForm_1065">
<noscript>Please make sure JavaScript is enabled to fill out the sign up form.</noscript>
</form>
<script>
if (typeof MktoForms2 === 'undefined') {
  console.log('no bueno');
  document.getElementById('mktoForm_1065').textContent = 'Your browser settings are preventing our form from being displayed.';
} else {
  MktoForms2.loadForm("//app-sj19.marketo.com", "131-AQO-225", 1065);
}

</script>
        <?php }  //end else ?>


        
      </div>
	  </div>
      </div>
    </div>

  </div>



<?php get_footer(); ?>
