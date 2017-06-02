<?php
get_header(); 
wp_enqueue_script(array('gradpack'));
wp_enqueue_style('gradpack');

while ( have_posts() ) : the_post();
?>

<div id="spacer"></div>
<?php uw_mobile_front_page_menu(); ?>


<div class="gradpack">

      <div id="header">
        <div id="header-bg"></div>  
        <div id="header-fore"></div>
  
         
            <div class="container">
            <div id="conGRADulations">
              <h1>Con<span class="bold">grad</span>ulations<br/> Class of <?php echo date(Y) ?>!</h1>
            </div>
              <a href="#flickr"><div id="yellow-dot">Find<br/>Your <br> Free<br/>Photo<span></span></div></a>
            </div>


          
    </div>

      
      <div class="join-row">
        <div class="wrapper loveUW">
            <h3>From GRAD to GOLD, UWAA membership keeps you connected.</h3>
            <div class="uwaa-btn-wrapper join-row"><a class="uwaa-btn btn-slant-left btn-purple" href="https://www.washington.edu/alumni/membership/be-a-member/join-or-renew/?newgrad=true" target="_blank">Join Now</a></div>            
      </div>
        </div>
      </div>
    
 

   
    <div class="content-row be-together events">
      <div class="image-left">      
         <div class="image events" id="slideshow1">
            <div class="slide">
            <!-- slide -->
            <img src="https://depts.washington.edu/alumni/assets/images/membership/GradPack_Events-DawgDash_600x397.jpg"  alt="Dawg Dash participants">
            <p class="caption">Dawg Dash</p>
          </div>
          <div class="slide">
            <img src="https://www.washington.edu/alumni/images/membership/gradpack/GradPack_Events-Movie-Nights_600x397.jpg"  alt="placeholder">
            <p class="caption">Member Movie Nights</p>
          </div>         
          <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_Events-Sounders_600x397.jpg"  alt="Two UW Alumni fans at the Sounder Game with UW Alumni Scarves">
            <p class="caption">UW Day at the Sounders</p>
          </div>
          <div class="slide">
          <!-- updated -->
            <img src="https://depts.washington.edu/alumni/assets/images/membership/GradPack_Events-Toast_600x397.jpg"  alt="placeholder">
            <p class="caption">Grad Toast</p>
          </div>
           <div class="slide">
          <!-- updated -->
            <img src="https://depts.washington.edu/alumni/assets/images/membership/GradPack_Events-BBQ2_600x397.jpg"  alt="placeholder">
            <p class="caption">Salmon BBQs</p>
          </div>        
      </div>
        
        <div class="copy">
          <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_one_title', true)) ?></h3>
          <p><?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mb_row_one_content', true)
            ); ?>
        </p>
      </div>          
      </div>
    </div>

  <div class="white-spacer"></div>

     <div class="content-row">
      <div class="image-left">
        <div class="image in-the-know libraries">
            <img src="https://depts.washington.edu/alumni/assets/images/membership/GradPack_In-the-Know_600x397.jpg"  alt="UW alumni seated in an audience ">
          </div> 
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_two_title', true)) ?></h3>
        <p><?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mb_row_two_content', true)); ?>
        </p>
      </div>

      </div>
    </div>

<div class="white-spacer"></div>

    <div class="content-row">
      <div class="image-left">
      <div class="image connected hcn">
          <img src="https://depts.washington.edu/alumni/assets/images/membership/GradPack_Connected_600x397.jpg"  alt="UW Alumni at a networking event">
      </div>
        
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_three_title', true)) ?></h3>
        <p><?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mb_row_three_content', true)); ?>
        </p>
      </div>
          
      </div>
    </div>

  <div class="white-spacer"></div>

     <div class="content-row">
     <div class="image-left">
     <div class="image connected ">
            <img src="https://depts.washington.edu/alumni/assets/images/membership/GradPack_Champion_600x397.jpg"  alt="UW student with alumni mentor">
          </div> 
       
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_four_title', true)) ?></h3>
        <p><?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mb_row_four_content', true)); ?>
        </p>
      </div>
       
      </div>
    </div>

    <div class="white-spacer"></div>

     <div class="content-row">
     <div class="image-left">
     <div class="image proud support">
            <img src="https://depts.washington.edu/alumni/assets/images/membership/GradPack_Proud_600x397.jpg"  alt="UW student with alumni mentor">
          </div> 
       
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_five_title', true)) ?></h3>
        <p><?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mb_row_five_content', true)); ?>
        </p>
      </div>
       
      </div>
    </div>

<div class="white-spacer"></div>
    <div class="content-row">
      <div class="image-left">
        <div class="image gradpack">
            <img src="https://depts.washington.edu/alumni/assets/images/membership/GradPack_LicPlateCar_Swag_600x397.jpg"  alt="UW student with alumni mentor">
          </div>
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_six_title', true)) ?></h3>
        <p><?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mb_row_six_content', true)); ?>
        </p>
      </div>
          
      </div>
    </div>

  <div class="white-spacer"></div>

     <div class="content-row">
      <div class="image-left">
      <div class="image support" id="slideshow2">
            <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_UW-Seattle-Campus_600x397.jpg"  alt="placeholder">
            <p class="caption">UW Seattle campus</p>
          </div>
          <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_UW-Bothell-Campus_600x397.jpg"  alt="placeholder">
            <p class="caption">UW Bothell campus</p>
          </div>
          <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_UW-Tacoma-Campus_600x397.jpg"  alt="placeholder">
            <p class="caption">UW Tacoma campus</p>
          </div>
          <div class="slide">
            <img src="https://depts.washington.edu/alumni/assets/images/membership/GradPack_ClassAct_600x397.jpg"  alt="placeholder">
            <p class="caption">The W on Stevens Way</p>
          </div>

          
          </div> 
        
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_seven_title', true)) ?></h3>
        <p><?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mb_row_seven_content', true)); ?>
        </p>       
      </div>
           
      </div>
    </div>

<div class="white-spacer"></div>
<!-- same -->
    <div class="content-row">
      <a class="anchor" name='flickr'></a>
      <div class="image-left">
        <div class="image flickr">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_StudentCollage_600x397.jpg"  alt="placeholder">
          </div> 
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_eight_title', true)) ?></h3>
        <p><?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mb_row_eight_content', true)); ?>
        </p>
      </div>
          
      </div>
    </div>

  <div class="white-spacer"></div>
<!-- same -->
     <div class="content-row">
      <div class="image-left">
        <div class="image gradLinks">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_UW-Graduation_600x397.jpg"  alt="placeholder">
          </div>
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_nine_title', true)) ?></h3>
        <p class="noWidowEnder"><?php echo apply_filters('the_content', get_post_meta(get_the_ID(), 'mb_row_nine_content', true)); ?>
        </p>   

        
        
      </div>
        
           
      </div>
    </div>

</div>

<?php 
 endwhile;

 get_footer(); ?>
