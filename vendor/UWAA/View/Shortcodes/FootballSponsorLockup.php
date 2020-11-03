<?php namespace UWAA\View\Shortcodes;
/*
 *  Button shortcode allows for styled buttons to be added to content
 *  [button color='gold' button-type='type' url='link url' small='true']Button Text[/button]
 *  optional small attribute makes the button small.  Assume large if not present
 */

class FootballSponsorLockup
{


    function __construct()
    {
        add_shortcode('football-sponsors', array($this, 'addSponsors'));
        
    }


    


    public  function addSponsors( $atts, $content="" ) {        

    $content = <<<'BLOCK'
    <p style="text-align: center"><em>Thank you to our partners</em></p><p style="text-align: center"><a href="https://www.alaskaair.com/"><img class="aligncenter" src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2017/07/10182705/Logo_Alaska_Web4.png" alt="Logo_Alaska_Airlines_Small" width="109" height="48"></a><br><a href="https://www.becu.org/landing/uw-cards"><img style="padding: 30px" src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2015/06/10172428/Logo_BECU_190x70.gif" alt="BECU Airlines logo" width="200"></a>        <a href="https://www.starbucks.com"><img class="logo alignnone wp-image-45876" style="padding: 30px" src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2018/08/21115755/Starbucks.png" alt="Starbucks Logo" srcset="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2018/08/21115755/Starbucks.png 1200w, https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2018/08/21115755/Starbucks-150x150.png 150w, https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2018/08/21115755/Starbucks-296x300.png 296w, https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2018/08/21115755/Starbucks-1011x1024.png 1011w, https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2018/08/21115755/Starbucks-428x428.png 428w, https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2018/08/21115755/Starbucks-375x380.png 375w, https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2018/08/21115755/Starbucks-750x759.png 750w, https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2018/08/21115755/Starbucks-1140x1154.png 1140w, https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2018/08/21115755/Starbucks-50x50.png 50w, https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2018/08/21115755/Starbucks-300x300.png 300w" sizes="(max-width: 60px) 100vw, 60px" width="60" height="61"></a>        <a href="http://redhook.com/"><img class="logo aligncenter wp-image-22216 size-full" style="padding: 25px 30px 35px 30px" src="https://s3-us-west-2.amazonaws.com/uw-s3-cdn/wp-content/uploads/sites/94/2017/07/10182710/Logo_Redhook_Web4.png" alt="Redhook logo" width="80" height="53"></a></p>
BLOCK;
        

    return $content;

    }

}