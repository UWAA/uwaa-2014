<?php
wp_enqueue_script('memberChecker');       
wp_localize_script( 'memberChecker', 'callMemberCheckerAJAX', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
?>


        <?php
        if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == false) {
            return;
        } elseif ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {
            echo '<div id="join-renew-buttons" class="">';
            echo esc_html($UWAA->Memberchecker->session->get('firstName')).' , thank you for your support!';
            echo '</div>';
        } else {
        ?>
        <div id="join-renew-buttons" class="">
            <div class="uwaa-btn-wrapper"><a class="uwaa-btn uwaa-btn-join btn-slant-right " href="#">Join UWAA</a></div>
            <div class="uwaa-btn-wrapper"><a class="uwaa-btn uwaa-btn-renew btn-slant-left " href="#">Renew</a></div>
        </div>

        <?php        
        }
        ?>