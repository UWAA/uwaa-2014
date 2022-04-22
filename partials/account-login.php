<?php
wp_enqueue_script('memberChecker');
wp_localize_script( 'memberChecker', 'callMemberCheckerAJAX', array( 'ajaxurl' => str_replace('http:','https:',home_url('/api/memberValidator'))) );
?>

    
        <div class="row">
            <div class="<?php echo ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) ? 'col-sm-6' : 'col-sm-12' ?>">
                <?php
        if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == false) {
            echo 'Welcome back '.esc_html($UWAA->Memberchecker->session->get('firstName')).'';
        } elseif ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {            
            $UWAA->Memberchecker->renderDetails();  
            
        } else {
        ?>

        <!-- <h3>Please log in to view your member account.</h3> -->


            <form method="GET" id="memberloginForm" class="uwaa-form">
                <fieldset>
                    <label class="screen-reader-text" for="idNumber">Member Number</label>
                    <input  type="text" name="idNumber" placeholder="Member Number" autocomplete="off" disabled>
                    <label class="screen-reader-text" for="lastName">Last Name</label>
                    <div>
                        <input  type="text" name="lastName" placeholder="Last Name" autocomplete="off" disabled>
                        <input id="loginSubmit" type="submit">
                    </div>
                    <!-- <input type="hidden" name="action" value="callMemberChecker"> -->


                </fieldset>
            </form>

            <div id="form-message"></div>
            <div id="error-message">
             <span style="color:red">We are currenly experiencing an outage of our member verifcation service. Please call if you have specific questions about your benefits.</span>
             </div>

            <!-- <div class="accordion">
                <div class="panel closed">
                    <h4 class="accordion-heading" aria-atomic="true" aria-live="polite">Log-In Help<span class="chevron closed"></span><span aria-expanded="false" class="indicator" style="position: absolute; clip: rect(1px 1px 1px 1px);">Collapsed</span></h4>
                    <div class="collapse" aria-hidden="true" style="display: none;">
                        <p>
                            Need Content to help with login here.
                        </p>
                    </div>
                </div>
            </div> -->


        <?php        
        }
        ?>
            </div>
            
            <?php
            if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {
                
                echo '<div class="col-sm-6">';
                $UWAA->Memberchecker->renderCard();

                
                //keeping here temporarily 
                // echo <input type="hidden" name="action" value="memberLogout">
                echo '<form id="memberlogout" method="POST">
                        
                      </form>
                    <a id="memberCheckerLogout">Logout</a>';

                echo '</div>';
            
                }
                ?>
            
        </div>  
    
        






