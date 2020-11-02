<?php

$ID = get_page_by_path( 'virtualwarmup');

$now = new DateTime( 'now' ,new DateTimeZone('America/Los_Angeles') );
$kickoff = new DateTime(get_field('countdown_end_time', $ID ), new DateTimeZone('America/Los_Angeles') );

$promoText = get_post_meta(get_the_ID(), 'mb_benefit_promotion', true);

if (!empty($promoText)) {

    echo '<h2>How to get your benefit</h2>';

    if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == false) 
    {
        echo "You membership has expired, please renew to get great member benefits";
            } 
    
            elseif ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {
                
                echo do_shortcode(wp_kses(get_post_meta(get_the_ID(), 'mb_benefit_promotion', true), array('a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ), 'div' => array(
            'class' => array()
            ))));
                } 

            elseif (has_term('virtual-warmup', 'uwaa_content_promotion') && $now > $kickoff) {
                
                echo do_shortcode(wp_kses(get_post_meta(get_the_ID(), 'mb_benefit_promotion', true), array('a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ), 'div' => array(
            'class' => array()
            ))));
                } 
                else{
                    echo "Log in or <a href=\" " . get_site_url() . "/membership/join-or-renew/?join\">join the UWAA</a>";
                }
}
?>
