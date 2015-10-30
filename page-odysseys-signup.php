<?php

//TODO -refactor Do we want this logic here? 
$tourName = preg_replace('/%2526%25238217%253B/', "%27", esc_js($_GET['tourName'])); // Fix for URL encoding issues
$tourURL = esc_js($_GET['tourURL']);
$tourDeparture = esc_js($_GET['tourDepartureDate']);

$rawDate = str_split($tourDeparture, 4);
$rawDayAndYear = str_split($rawDate['1'] , 2);

$tourDepartureDay = esc_js($rawDayAndYear['0']);
$tourDepartureMonth = esc_js($rawDayAndYear['1']);
$tourDepartureYear = $rawDate['0'];

get_header();

?>

<div class="uw-hero-image travel"></div>

<div class="container uw-body">

  <div class="row">

    <div class="col-md-8 uw-content" role='main'>

      <!-- <a href="<?php echo home_url('/'); ?>" title="<?php echo esc_attr( get_bloginfo() ) ?>"><h2 class="uw-site-title"><?php bloginfo(); ?></h2></a> -->
      <h2 class="uw-site-title">UW Alumni Tours</h2>

     <?php get_template_part('partials/sidebar', 'page-breadcrumbs') ?>

      <div class="uw-body-copy"> 

      <h1><?php the_title() ?></h1>
        
        <div id="wufoo-ze6o0mb04ys2e8">
Fill out my <a href="https://uwalum.wufoo.com/forms/ze6o0mb04ys2e8">online form</a>.
</div>
<script type="text/javascript">var ze6o0mb04ys2e8;(function(d, t) {
var s = d.createElement(t), options = {
'userName':'uwalum',
'formHash':'ze6o0mb04ys2e8',
'autoResize':true,
'height':'1559',
'async':true,
'host':'wufoo.com',
'header':'show',
'ssl':true,

//Prepopulate Tour Name
'defaultValues' : 'Field1=<?php echo $tourName; ?>&Field431=<?php echo $tourURL; ?>&Field3-1=<?php echo $tourDepartureDay; ?>&Field3-2=<?php echo $tourDepartureMonth; ?>&Field3=<?php echo $tourDepartureYear; ?>'



};
s.src = ('https:' == d.location.protocol ? 'https://' : 'http://') + 'www.wufoo.com/scripts/embed/form.js';
s.onload = s.onreadystatechange = function() {
var rs = this.readyState; if (rs) if (rs != 'complete') if (rs != 'loaded') return;
try { ze6o0mb04ys2e8 = new WufooForm();ze6o0mb04ys2e8.initialize(options);ze6o0mb04ys2e8.display(); } catch (e) {}};
var scr = d.getElementsByTagName(t)[0], par = scr.parentNode; par.insertBefore(s, scr);
})(document, 'script');</script>
     

     

         

      </div>

    </div>
    <div class="col-md-4 uw-sidebar">
    <?php 
        uw_sidebar_menu();
        dynamic_sidebar( 'travel_sidebar' ); 
    ?>
    </div>

  </div>

</div>

<?php 
get_template_part('partials/tours-footer');
get_footer(); ?>
