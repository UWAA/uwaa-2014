<?php
wp_enqueue_script('membershipStoreInit');  

?>

    <div id="store">    

    <div class="row" id="store-breadcrumbs">
        <div class="col-sm-6">
            <span>Would you like to join UWAA, or renew your current membership?</span>
            <br/>
            <p>See all membership <a href="#pricing">pricing options.</a></p>
        </div>

        <div class="col-sm-4 col-sm-offset-2  text-right">
            <p id="go-back">Go Back</p> 
            <p id="reset">Start Over</p>            
        </div>
        
    </div>
    

    <!-- TODO Make the convio links editable fields for editors -->
     
    <div id="join-renew-option-set" class="option-set">
        
        <div class="option-row primary" id="join-renew">             

                <div class="option-box main-options" id="join">
                <h2>join</h2>
                <h3>UWAA</h3>
                </div>

                <div class="option-box main-options" id="renew">
                <h2>renew</h2>
                <h3>Your Membership</h3>
                </div>

            </div>        

    </div>

        

        <div id="join-option-set" class="option-set">
             <div class="option-row primary" id="join-options">

                
                <div class="option-box has-options" id="annual-join">
                <h2>annual</h2>
                <h3>Membership</h3>
                </div>

                <div class="option-box has-options" id="life-join">
                <h2>life</h2>
                <h3>Membership</h3>
                </div>

                <a href="https://secure3.convio.net/uw/site/Donation2?df_id=4220&4220.donation=form1">
                    <div class="option-box" id="new-grad">
                    <h2>New Grad</h2>
                    <h3>Membership</h3>
                    </div>
                </a>

                <a href="https://secure3.convio.net/uw/site/Donation2?4400.donation=form1&amp;df_id=4400">
                    <div class="option-box" id="gift">
                    <h2>Gift</h2>
                    <h3>Membership</h3>
                    </div>
                </a>

             </div>

             <div class="option-row" id="annual-join-options">

                <a href="https://secure3.convio.net/uw/site/Donation2?df_id=2840&2840.donation=form1">
                    <div class="option-box" id="annual-single-join">
                    <h2>Annual Single</h2>
                    <h3>Membership</h3>
                    </div>
                 </a>

                 <a href="https://secure3.convio.net/uw/site/Donation2?df_id=2940&2940.donation=form1" class="">
                    <div class="option-box" id="annual-joint-join">
                    <h2>Annual Joint</h2>
                    <h3>Membership</h3>
                 </div></a>


             </div>

             <div class="option-row" id='life-join-options'>

                 <a href="https://secure3.convio.net/uw/site/Donation2?df_id=2960&2960.donation=form1">
                    <div class="option-box" id="life-single-join">
                    <h2>Life Single</h2>
                    <h3>Membership</h3>
                    </div>
                 </a>

                 <a href="https://secure3.convio.net/uw/site/Donation2?df_id=3000&3000.donation=form1" class="">
                    <div class="option-box" id="life-joint-join">
                    <h2>Life Joint</h2>
                    <h3>Membership</h3>
                    </div>
             </div></a>
         </div>


         <!-- Renewal -->
         <div id="renew-option-set" class="option-set">             
             <div class="option-row primary" id="renew-options">

                <a href="https://secure3.convio.net/uw/site/Donation2?df_id=3061&3061.donation=form1">
                    <div class="option-box renew" id="annual-single-renew">
                    <h2>Annual Single</h2>
                    <h3>Membership</h3>
                    </div>
                </a>

                <a href="https://secure3.convio.net/uw/site/Donation2?df_id=3060&3060.donation=form1">
                    <div class="option-box renew" id="annual-joint-renew">
                    <h2>Annual Joint</h2>
                    <h3>Membership</h3>
                    </div>
                </a>

                <a href="https://secure3.convio.net/uw/site/Donation2?df_id=2960&2960.donation=form1">
                    <div class="option-box upgrade" id="single-life-upgrade">
                    <h2>Life Single</h2>
                    <h3>Membership Upgrade</h3>
                    </div>
                </a>

                <a href="https://secure3.convio.net/uw/site/Donation2?df_id=3064&3064.donation=form1">
                    <div class="option-box upgrade" id="joint-life-upgrade">
                    <h2>Life Joint</h2>
                    <h3>Membership Upgrade</h3>
                    </div>
                </a>
               
                 
             </div>
         </div>

     </div>    
    







