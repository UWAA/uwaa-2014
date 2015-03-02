<?php

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
                else{
                    echo "UWAA members, please contact UWAA at 206-543-0540 for benefit information.";
                }
}
?>
