<h1><?php the_title() ?></h1>
<div class="text-center">
            <script src="https://fast.wistia.com/embed/medias/onbjt5vurx.jsonp" async></script><script src="https://fast.wistia.com/assets/external/E-v1.js" async></script><div class="wistia_responsive_padding" style="padding:56.25% 0 0 0;position:relative;">
            <div class="wistia_responsive_wrapper" style="height:100%;left:0;position:absolute;top:0;width:100%;">
            <div class="wistia_embed wistia_async_onbjt5vurx seo=false videoFoam=true autoPlay=true" style="height:100%;width:100%">&nbsp;</div></div></div>
            <!-- NOTE: popover=true popoverAnimateThumbnail=true makes autoplay not work -->
        </div>
<?php

  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>
