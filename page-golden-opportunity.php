<?php
$UWAA->Memberchecker->getSession();
/*
 * Template Name: UWAA-Membership
 * Description: A Page Template for membership pages.
 */

get_header(); 
$memberid = $_GET['mem'];
$memberNumber = 'No Member Number Found';

$safeMemberNumber = filter_var($_GET['mem'], FILTER_SANITIZE_NUMBER_INT);
$memberNumber = $safeMemberNumber;

if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {
  
  $memberNumber = $UWAA->Memberchecker->getMemberIDNumber(); 
}
?>

<div class="uw-hero-image membership"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->
      <h2 class="uw-site-title">UWAA Membership</h2>

     <?php get_template_part('partials/sidebar', 'page-breadcrumbs') ?>

      <div class="uw-body-copy">      

      <?php while ( have_posts() ) : the_post(); ?>

          
          <h1><?php the_title() ?></h1>
                  
        <?php

          the_content();
            

          

          endwhile;  

      ?>


      <div id="wufoo-z4mx8b61ioft32">
</div>
<script type="text/javascript">var z4mx8b61ioft32;(function(d, t) {
var s = d.createElement(t), options = {
'userName':'uwalum',
'formHash':'z4mx8b61ioft32',
'autoResize':true,


/* Autofill Magic! */
'defaultValues':'field5=<?php echo $memberNumber; ?>',


'height':'400',
'async':true,
'host':'wufoo.com',
'header':'show',
'ssl':true};
s.src = ('https:' == d.location.protocol ? 'https://' : 'http://') + 'www.wufoo.com/scripts/embed/form.js';
s.onload = s.onreadystatechange = function() {
var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
try { z4mx8b61ioft32 = new WufooForm();z4mx8b61ioft32.initialize(options);z4mx8b61ioft32.display(); } catch (e) {}};
var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, 'script');</script>        

    

      </div>

    </div>
    <div class="col-md-4 uw-sidebar">
    <?php        
        uw_sidebar_menu();
        dynamic_sidebar( 'membership_sidebar' );
    ?>
    </div>

  </div>

</div>

<?php get_footer(); ?>
