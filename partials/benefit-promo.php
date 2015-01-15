
<h2>How to get your benefit</h2>
<?php

if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == false) 
{
     echo "You membership has expired, please renew to get great member benefits";
        } 

        elseif ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {
            //Maybe sketchy, need to be able to have links in this
            echo esc_html(get_post_meta(get_the_ID(), 'mb_benefit_promotion', true));
            } 
            else{
                echo "UWAA Members, Login to see how to claim your benefit";
            }

?>

