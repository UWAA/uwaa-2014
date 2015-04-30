<?php
$tourName = esc_js($_GET['tourName']);
$tourURL = esc_js($_GET['tourURL']);
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
'defaultValues' : 'Field1=<?php echo $tourName; ?>&Field431=<?php echo $tourURL; ?>'



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
