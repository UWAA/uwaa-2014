<?php
wp_enqueue_script('memberChecker');       
wp_localize_script( 'memberChecker', 'callMemberCheckerAJAX', array( 'ajaxurl' => admin_url( 'admin-ajax.php' ) ) );
?>

    <div class="container">
        <div class="row">
            <div class="<?php echo ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) ? 'col-sm-6' : 'col-sm-12' ?>">
                <?php
        if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == false) {
            echo 'Welcome back '.esc_html($UWAA->Memberchecker->session->get('firstName')).'';
        } elseif ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {
            // $UWAA->Memberchecker->renderCard();
            $UWAA->Memberchecker->renderDetails();
            
        } else {
        ?>

        <h2>Please log in to view your member account.</h2>
            <form method="POST" id="memberloginForm">
                <fieldset>
                    <label class="screen-reader-text" for="idNumber">Member Number</label>
                    <input type="text" name="idNumber" placeholder="Member Number" autocomplete="off">
                    <label class="screen-reader-text" for="lastName">Last Name</label>
                    <input type="text" name="lastName" placeholder="Last Name" autocomplete="off">><label>Last Name</label>
                    <input type="hidden" name="action" value="callMemberChecker">                     
                </fieldset>
            </form>


        <?php        
        }
        ?>
            </div>
            
            <?php
            if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {
                
                echo '<div class="col-sm-6">';
                $UWAA->Memberchecker->renderCard();

                
                echo '<form id="memberlogout" method="POST">
                        <input type="hidden" name="action" value="memberLogout">                                      
                      </form>
                    <a id="memberCheckerLogout">Logout</a>';

                echo '</div>';
            
                }
                ?>
            
        </div>  
    </div>
        






