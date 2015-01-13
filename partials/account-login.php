<?php
wp_enqueue_script('memberChecker');       
wp_localize_script( 'memberChecker', 'callMemberCheckerAJAX', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
?>


        <?php
        if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == false) {
            echo 'Welcome back '.esc_html($UWAA->Memberchecker->session->get('firstName')).'';
        } elseif ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {
            // $UWAA->Memberchecker->renderCard();
            $UWAA->Memberchecker->renderDetails();
        } else {
        ?><form method="POST" id="memberloginForm">
        <fieldset>        
        <p><input type="text" name="idNumber"><label>Member ID Number</label></p>
        <p><input type="text" name="lastName"><label>Last Name</label></p>
        <input type="hidden" name="action" value="callMemberChecker">
        <button type="submit">Submit</button>
        </fieldset>
        </form>

        <?php        
        }
        ?>



<form id="memberlogout" method="POST">
<input type="hidden" name="action" value="memberLogout">
<button type="submit">Logout</button>
</form>


