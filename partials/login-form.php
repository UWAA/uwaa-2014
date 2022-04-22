<?php
wp_enqueue_script('memberChecker');
wp_localize_script( 'memberChecker', 'callMemberCheckerAJAX', array( 'ajaxurl' => str_replace('http:','https:',home_url('/api/memberValidator'))) );
?>


        <?php
        if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == false) {

            echo 'Welcome back '.esc_html($UWAA->Memberchecker->session->get('firstName')).'';

        } elseif ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {

            echo '<div class="widget">';
            
            $UWAA->Memberchecker->renderCard();

            echo '<form id="memberlogout" method="POST">
                        <input type="hidden" name="action" value="memberLogout">                                      
                      </form>
                    <a id="memberCheckerLogout">Logout</a>';

            echo '</div>';
        } else {            
        ?>

        <div id="loginSidebar" class="widget">
        <h2 class="widgettitle">Log In</h2>
        <form method="GET" id="memberloginForm">
                <fieldset>
                    <label class="screen-reader-text" for="idNumber">Member Number</label>
                        <input type="text" name="idNumber" placeholder="Member Number" autocomplete="off" disabled>                    
                    <div>
                        <label class="screen-reader-text" for="lastName">Last Name</label>
                        <input type="text" name="lastName" placeholder="Last Name" autocomplete="off" disabled>
                        <input id="loginSubmit" type="submit">
                    </div>
                    <input type="hidden" name="action" value="callMemberChecker">
                </fieldset>
            </form>
            <div id="form-message"></div>
            <div id="error-message"> 
            <span style="color:red">We are currenly experiencing an outage of our member verifcation service. Please call if you have specific questions about your benefits.</span>
                
            </div>
            </div>


        <?php        
        }
        ?>