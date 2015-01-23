<?php
wp_enqueue_script('membershipStoreInit');  

?>

    <div class="row">
        <div class="col-sm-3 col-sm-offset-9">            
            <div class="uwaa-btn-wrapper"><a class="uwaa-btn uwaa-btn-join btn-slant-right" href="?join">Join</a></div>
            <div class="uwaa-btn-wrapper"><a class="uwaa-btn uwaa-btn-renew btn-slant-left btn-gold" href="?renew">Renew</a></div>
        </div>
    </div>

    <div class="row" id="store-breadcrumbs">
        <div class="col-sm-4">
            <p>You Chose:  <span></span></p>
        </div>
        <div class="col-sm-2 col-sm-offset-1">            
            <p id="reset">Go Back</p>
        </div>
        
    </div>
    

    
     <div id="store">

        

        <div id="join-option-set" class="option-set">
             <div class="option-row primary" id="join">

                <div class="option-box has-options" id="annual-join">
                <h2>annual</h2>
                <h3>Membership</h3>
                </div>

                <div class="option-box has-options" id="life-join">
                <h2>life</h2>
                <h3>Membership</h3>
                </div>

                <div class="option-box" id="new-grad">
                <h2>New Grad</h2>
                <h3>Membership</h3>
                </div>

                <div class="option-box" id="gift">
                <h2>Gift</h2>
                <h3>Membership</h3>
                </div>

             </div>

             <div class="option-row" id="annual-join-options">

                 <div class="option-box" id="annual-single-join">
                 <h2>Annual Single</h2>
                 <h3>Membership</h3>
                 </div>

                 <div class="option-box" id="annual-joint-join">
                 <h2>Annual Joint</h2>
                 <h3>Membership</h3>
                 </div>

             </div>

             <div class="option-row" id='life-join-options'>

                 <div class="option-box" id="life-single-join">
                 <h2>Life Single</h2>
                 <h3>Membership</h3>
                 </div>

                 <div class="option-box" id="life-joint-join">
                 <h2>Life Joint</h2>
                 <h3>Membership</h3>
                 </div>
             </div>
         </div>


         <!-- Renewal -->
         <div id="renewal-option-set" class="option-set">             
             <div class="option-row primary" id="renew">

                <div class="option-box renew" id="annual-single-renew">
                <h2>Annual Single</h2>
                <h3>Membership</h3>
                </div>

                <div class="option-box renew" id="annual-joint-renew">
                <h2>Annual Joint</h2>
                <h3>Membership</h3>
                </div>
                
                <div class="option-box upgrade" id="life-single-upgrade">
                <h2>Life Single</h2>
                <h3>Membership</h3>
                </div>
                
                <div class="option-box upgrade" id="life-joint-upgrade">
                <h2>Life Joint</h2>
                <h3>Membership</h3>
                </div>
                 
             </div>
         </div>

     </div>    
        






