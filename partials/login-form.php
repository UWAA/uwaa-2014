<?php
wp_enqueue_script('memberChecker');       
wp_localize_script( 'memberChecker', 'callMemberCheckerAJAX', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
?>


        <?php
        if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == false) {

            echo 'Welcome back '.esc_html($UWAA->Memberchecker->session->get('firstName')).'';

        } elseif ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {

            $UWAA->Memberchecker->renderCard();

            echo '<form id="memberlogout" method="POST">
                        <input type="hidden" name="action" value="memberLogout">                                      
                      </form>
                    <a id="memberCheckerLogout">Logout</a>';
        } else {            
        ?>

        <div id="loginSidebar" class="widget">
        <h2 class="widgettitle">Log In</h2>
        <form method="POST" id="memberloginForm">
                <fieldset>
                    <label class="screen-reader-text" for="idNumber">Member Number</label>
                        <input type="text" name="idNumber" placeholder="Member Number" autocomplete="off">                    
                    <div>
                        <label class="screen-reader-text" for="lastName">Last Name</label>
                        <input type="text" name="lastName" placeholder="Last Name" autocomplete="off">
                        <input id="loginSubmit" type="submit">
                    </div>
                    <input type="hidden" name="action" value="callMemberChecker">
                </fieldset>
            </form>
            </div>

        <?php        
        }
        ?>