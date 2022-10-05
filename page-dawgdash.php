<?php
// Jump-in Single-Page Template

wp_enqueue_script('dd23map');
wp_enqueue_style('mapbox331');
get_header();







?>

<!-- Header - ACF field for side image, ACF field for header text content -->

<div class="dawgdash-container">
<div class="dawgdash-header no-gutters">
<div class="image">
<?php 

$headerImage = get_field('header_image');
$size = 'full'; // (thumbnail, medium, large, full or custom size)
if( $headerImage ) {
  echo wp_get_attachment_image( $headerImage, $size );
}

function headerText() {
  if( isRaceDay() ) {
    return get_field("race_day_header_text");
}
return get_field('header_copy');
}

function headerTitle() {
  if(isRaceDay()) {
    return get_field("race_day_header_title");
}
return get_field('header_title');
}

?>
</div>
<div class="text">
<h1><?php echo html_entity_decode(headerTitle() ) ?></h1>
<p><?php echo html_entity_decode(headerText()) ?></p>
</div>
</div>



<?php

$regBandText = (isRaceDay() ? get_field('race_day_cta_text') : get_field('register_bands_text') );
$regBandLink = (isRaceDay() ? get_field('race_day_cta_button_text') : get_field('register_bands_button_text') );
$regBandURL = (isRaceDay() ? get_field('race_day_cta_button_link') : get_field('getmeregistered_link') );
$regBandSubtext = (isRaceDay() ? "<br><span>" . get_field('race_day_cta_subtext') . "</span>" : "");



?>


<div class="register-row yellow-background">            
<div class="register-row-content">              
<p><?php echo $regBandText.$regBandSubtext?>
</p>
<a href="<?php echo $regBandURL;  ?>" class="btn btn-primary btn-lg" tabindex="-1" role="button"><?php echo $regBandLink;  ?></a>

</div>



</div>

<?php
$isBeforeTagboardLiveTime = $UWAA->Utilities->isCurrentTimeBefore("09/29/2022 00:00");

function isPreviewForAdminTrue($type){
  if(!is_user_logged_in( )){
    return false;
  }

  switch ($type) {
    case 'tagboard':
    if(get_field("tagboard_display_tagboard_preview")) {
      return true;
    }
      break;
    case 'race-day':
      if(get_field("race_day_preview")) {
       return true;
      }
      break;
      case 'after-race':
      
      break;    
      case 'post-race':
        if(get_field("post_race_preview")) {
      return true;
    }
        break;
    
    default:
      return false;
      break;
  }
}







// God... horrible... DRY
function isRaceDay(){
  $date_now = date('Y-m-d H:i:s');  
  if($date_now > get_field("race_day_cutover_time")) {    
    return true;
  }

  if(!is_user_logged_in( )){
    return false;
  }

  if(get_field("race_day_preview")) {
       return true;
  }

  

  return false;  

}

function isRaceDayAfterRace(){
   $date_now = date('Y-m-d H:i:s');  
  $date_now = date('Y-m-d H:i:s');  
   $date_now = date('Y-m-d H:i:s');  
  
  if($date_now > get_field("race_day_race_end_time")) {    
    return true;
  }
  if(!is_user_logged_in( )){
    return false;
  }

    if(get_field("race_day_race_end_preview")) {
       return true;
      }
    return false;
  }  



function isPostRace(){
  
    if(get_field("post_race_preview")) {
      return true;
    }
   
    
    if(!is_user_logged_in( )){
    return false;
  }

    $date_now = date('Y-m-d H:i:s');  
  $date_now = date('Y-m-d H:i:s');  
    $date_now = date('Y-m-d H:i:s');  
  
    if($date_now < get_field("post_race_cutover_time")) {    
    return true;
  }
  return false;
}

if(!$isBeforeTagboardLiveTime or isPreviewForAdminTrue("tagboard") or get_field("display_tagboard_publically") == true)
{

?>

<!-- Leader of the pack -->

<div class="att-pack-leader-row light-purple-background">
  <div class="att-pack-leader-content">
  <div class="logo-headline">
    <div class="att-logo">
      <img src="<?php echo get_stylesheet_directory_uri(  );?>/assets/dawgdash23/ATT_Logo.png" alt="AT&T Logo">
    </div>
    
    <h2>leaders of the&nbsp;pack</h2>
  </div>

  <?php $leaderCopy = (isPostRace()) ? "Take a look at the community members who helped us meet our goal in the AT&T #DawgDashCares event! Each person posting represents at least $100 for student scholarships." : "Share your Dawg Dash photo on Instagram or Twitter with #DawgDashCares and AT&T will donate $100 to the UWAA Scholarship Fund. Tag @ATT and your donation doubles!";  ?>
  <div class="copy"><p><?php echo $leaderCopy ?></p></div>
</div>

</div>



<div class="tagboard row">
  <div class="tagboard-embed" style="background-color: black" tgb-embed-id="7028"></div><script src="https://static.tagboard.com/embed/assets/js/embed.js"></script>
</div>


<?php }?>


<?php if (isRaceday() == false) { ?>

<div class="details-row black-background">

<div class="image">
<?php 

$detailsImage = get_field('registration_details_image');
$size = 'full'; // (thumbnail, medium, large, full or custom size)
if( $detailsImage ) {
  echo wp_get_attachment_image( $detailsImage, $size );
}

?>
</div>


<div class="copy">
<h2><?php html_entity_decode(the_field('registration_details_title') ) ?></h2>
<p><?php html_entity_decode(the_field('registration_details_copy') ) ?></p>
<ul>
<li><div><?php html_entity_decode(the_field('member_title') ) ?></div><div class="price">$<?php html_entity_decode(the_field('member_price') ) ?></div></li>
<li><div><?php html_entity_decode(the_field('general_public_title') ) ?></div><div class="price">$<?php html_entity_decode(the_field('general_public_price') ) ?></div></li>
<li><div><?php html_entity_decode(the_field('student_title') ) ?></div><div class="price">$<?php html_entity_decode(the_field('student_price') ) ?></div></li>
</ul>

</div>





</div>







<div class="membership-special-row light-purple-background">            
<div class="subtitle"><?php html_entity_decode(the_field('membership_band_subtitle') ) ?></div>
<div class="price">$<?php html_entity_decode(the_field('member_special_price') ) ?></div>
<div class="copy"><?php html_entity_decode(the_field('membership_band_copy') ) ?></div>

</div>


<?php 
if(get_field('registration_items_pups_image')){ ?>

<style type="text/css">
   div.registration-item.pups {
    background-image: url(<?php the_field('registration_items_pups_image'); ?>) !important;
   }
</style>

<?php }?>

<?php 
if(get_field('registration_items_dogs_image')){ ?>

<style type="text/css">
   div.registration-item.dogs {
    background-image: url(<?php the_field('registration_items_dogs_image'); ?>) ,url(<?php echo get_stylesheet_directory_uri(  );?>/assets/dawgdash23/2023_Dawg-Dash-Dawgdanna-WSECU_250x38.png) !important;
   }
</style>

<?php }?>

<?php 
if(get_field('registration_items_virtual_image')){ ?>

<style type="text/css">
   div.registration-item.virtual {
    background-image: url(<?php the_field('registration_items_virtual_image'); ?>) !important;
   }
</style>

<?php }


  $regItemCutoverTime = "09/16/2022 23:59";
  $columnSize = "col-sm-6";

  if ($UWAA->Utilities->isCurrentTimeBefore($regItemCutoverTime)) {
  $columnSize = "col-sm-4";
  }







?>





<div class="registration-item-row black-background">
<div class="registration-item <?php echo $columnSize; ?> pups">
<h2><?php html_entity_decode(the_field('registration_items_pups_title') ) ?></h2>
<p class="subhead"><?php html_entity_decode(the_field('registration_items_pups_subhead') ) ?></p>
<p class="copy"><?php html_entity_decode(the_field('registration_items_pups_copy') ) ?></p>
<p class="price">$<?php html_entity_decode(the_field('registration_items_pups_price') ) ?></p>
</div>
<div class="registration-item <?php echo $columnSize; ?> dogs">
<h2><?php html_entity_decode(the_field('registration_items_dogs_title') ) ?></h2>
<p class="subhead"><?php html_entity_decode(the_field('registration_items_dogs_subhead') ) ?></p>
<p class="copy"><?php html_entity_decode(the_field('registration_items_dogs_copy') ) ?></p>
<p class="price">$<?php html_entity_decode(the_field('registration_items_dogs_price') ) ?></p>
</div>

<?php if ($UWAA->Utilities->isCurrentTimeBefore($regItemCutoverTime)) { ?>
  
  <div class="registration-item <?php echo $columnSize; ?> virtual">
<h2><?php html_entity_decode(the_field('registration_items_virtual_title') ) ?></h2>
<p class="subhead"><?php html_entity_decode(the_field('registration_items_virtual_subhead') ) ?></p>
<p class="copy"><?php html_entity_decode(the_field('registration_items_virtual_copy') ) ?></p>
<p class="price">$<?php html_entity_decode(the_field('registration_items_virtual_price') ) ?></p>
</div>

<?php } ?>




</div>


<div class="black-background">
<div class="row no-gutters">


<div class="sponsor-block-row">
<div class="bonus-copy">
  <div class="subtitle">Members Get More!</div>
  <div class="copy">Complete your running look with a UWAA member-exclusive cherry blossom cooling buff.</div>
</div>
<div class="sponsor-block uwaa"></div>

</div>

  </div>
  </div>




<div class="register-row yellow-background">            
<div class="register-row-content">              
<p><?php the_field('register_bands_text') ?>              
</p>
<a href="<?php echo get_field('getmeregistered_link') ?>" class="btn btn-primary btn-lg" tabindex="-1" role="button"><?php the_field('register_bands_button_text') ?></a>

</div>

</div>



<?php } //end race-day?>


<div class="black-background">
<div class="row no-gutters">


<div class="sponsor-block-row">
<a href="https://www.alaskaair.com/promo/as2216">
<div class="sponsor-block alaska"></div>
</a>
</div>
<?php if (!isRaceDay() ) { ?>
<div class="sponsor-block-row">
<a href="https://www.brooksrunning.com/en_us/blog/training-workouts/">
<div class="sponsor-block brooks half-size"></div>
</a>

<div class="sponsor-block att half-size"></div>
</div>
<?php } ?>
</div>


</div>

<?php if(!isRaceDayAfterRace()) { ?>

<div class="map-container light-purple-background">    
<div class="row no-gutters">

<div class="container">

<div class="course-map-title-row light-purple-background">            

<div class="title">Course Map</div>


</div>

</div>

<div id='legend' style='display:none;'>
<img style="float: left;width:200px;" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2022/06/30130615/Dawg-Dash-Logo_504x446.png" alt="Alaska Airlines Dawg Dash 2022" />
<h1>COURSE ROUTES</h1>
<nav class='legend clearfix'>
<span style='background:#8d5dda;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
<strong>5K</strong>
<br />
<span style='background:#ecc813;'>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span><strong>10K</strong>

<br />
</div>
<div id='map'></div>



</div>
</div>


<div class="white-background">

<div class="faq-title-row light-purple-background">            

<div class="title">Frequently Asked Questions</div>


</div>

<div class="row no-gutters">



<div class="faq-row white-background">            
<div class="faq-content">              
<?php the_field('faq') ?>              


</div>



</div>

</div>

<?php } //end ifBeforeRaceTime ?>


<div class="white-background">
  <div class="banner-row no-gutters">
    <div class="banner banner-sm"></div>
    <div class="banner banner-lg"></div>
    <div class="banner-background"></div>
  </div>
</div>


<div class="white-background">
<div class="row no-gutters">



<div class="faq-row white-background">            
<div class="register-row-content">              
<p style="text-align: center;"><em>Special thanks to our partners</em></p>
<p style="text-align: center;"><a href="http://alaskaair.com"><img class="aligncenter wp-image-22219" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2022/06/30230420/2023_Dawg-Dash-Partner-Alaska_800x270.png" alt="Alaska Airlines logo" width="204" height="90" /></a></p>
<p style="text-align: center;"><a href="https://uw.edu/alumni"><img class="aligncenter wp-image-XXXXX size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2022/07/07171757/2023_Dawg-Dash-Partner-UWAA_186x70.png" alt="" width="186" height="70" /></a><a href="https://www.att.com/"><img class="aligncenter wp-image-21331 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2019/08/21115831/Logo_ATT_190x70.gif" alt="logo_01_BECU" width="131" height="48" /></a><a href="https://www.becu.org/everyday-banking/debit-card/uw-card"><img class="aligncenter wp-image-29659 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2015/06/10172428/Logo_BECU_190x70.gif" alt="" width="190" height="70" /></a></p>
  <p style="text-align: center;"><a href="https://www.brooksrunning.com/"><img class="aligncenter wp-image-21340 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2017/05/10183156/logo_Brooks.jpg" alt="logo_Brooks" width="131" height="48" /></a> <a href="http://www.bookstore.washington.edu/home/home.taf?"><img class="aligncenter wp-image-21328 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2022/06/30230423/2023_Dawg-Dash-Partner-UBS_186x70-1.png" alt="logo_00_bookstore" width="131" height="48" /></a><a href="https://www.uwmedicine.org/"><img class="aligncenter wp-image-51338" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2022/07/06132640/UWM_ColorLogo.png" alt="" width="160" height="47" /></a><a href="https://wsecu.org/"><img class="aligncenter wp-image-21330 size-full" src="https://uw-s3-cdn.s3.us-west-2.amazonaws.com/wp-content/uploads/sites/94/2017/05/10183203/logo_05_WSECU.png" alt="logo_05_WSECU" width="131" height="48" /></a></p>
  
  
  </div>
  
  
  
  </div>
  
  </div>
  </div>

</div>
  
  
  
  <!-- /jumpin-container -->
  </div>
  
  
  
  <?php get_footer(); ?>
  