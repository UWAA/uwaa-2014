<?php
        if ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == false) {
            return;
        } elseif ($UWAA->Memberchecker->isLoggedIn == true && $UWAA->Memberchecker->hasActiveMembership == true) {
            $UWAA->Memberchecker->renderThankYouText();
        } else {
          $joinPage = site_url("be-a-member/join-or-renew");
          $joinLink = ($joinPage ? $joinPage . "?join=true" : '#');
          $renewLink = ($joinPage ? $joinPage . "?renew=true" : '#');          
        ?>
        <div id="join-renew-buttons" class="">
            <div class="uwaa-btn-wrapper"><a class="uwaa-btn uwaa-btn-join btn-slant-right " href="<?php echo $joinLink; ?>">Join UWAA</a></div>
            <div class="uwaa-btn-wrapper"><a class="uwaa-btn uwaa-btn-renew btn-slant-left " href="<?php echo $renewLink; ?>">Renew</a></div>
        </div>

        <?php        
        }
        ?>