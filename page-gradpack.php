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
              <h1>Con<span class="bold">grad</span>ulations<br/> Class of 2015!</h1>
            </div>
            </div>
        
    </div>

      <a href="#flickr"><div id="yellow-dot">Find<br/>Your Free<br/>Photo<span></span></div></a>
      <div class="join-row">
        <div class="wrapper loveUW">
            <h3>You&rsquo;re one of us now.  Discover what UWAA membership means.</h3>
            <div class="uwaa-btn-wrapper join-row"><a class="uwaa-btn btn-slant-left btn-purple" href="https://secure3.convio.net/uw/site/Donation2?df_id=4220&4220.donation=form1" target="_blank">Join Now</a></div>            
      </div>
        </div>
      </div>
    
     

 

   
    <div class="content-row">
      <div class="image-left">
        <div class="image membersLove">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_LoveUW_600x397.jpg" id="careers_image" alt="placeholder">
          </div> 
        <div class="copy">
          <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_one_title', true)) ?></h3>
          <p><?php echo wp_kses(get_post_meta(get_the_ID(), 'mb_row_one_content', true), array('a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ), 'div' => array(
            'class' => array()
            ))); ?>
        </p>
      </div>          
      </div>
    </div>

  <div class="white-spacer"></div>

     <div class="content-row">
      <div class="image-right">
        <div class="image HCN">
          <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_Careers_600x397.jpg" id="careers_image" alt="placeholder">
      </div>
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_two_title', true)) ?></h3>
        <p><?php echo wp_kses(get_post_meta(get_the_ID(), 'mb_row_two_content', true), array('a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ), 'div' => array(
            'class' => array()
            ))); ?>
        </p>
      </div>

      </div>
    </div>

<div class="white-spacer"></div>

    <div class="content-row">
      <div class="image-left">
        <div class="image libraries">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_Libraries_600x397.jpg" id="careers_image" alt="placeholder">
          </div> 
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_three_title', true)) ?></h3>
        <p><?php echo wp_kses(get_post_meta(get_the_ID(), 'mb_row_three_content', true), array('a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ), 'div' => array(
            'class' => array()
            ))); ?>
        </p>
      </div>
          
      </div>
    </div>

  <div class="white-spacer"></div>

     <div class="content-row">
      <div class="image-right">
         <div class="image events" id="slideshow1">
            <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_Events-Movie-Nights_600x397.jpg" id="careers_image" alt="placeholder">
            <p class="caption">Movie Nights</p>
          </div>
          <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_Events-Game-Warm-Up-Party_600x397.jpg" id="careers_image" alt="placeholder">
            <p class="caption">Washington Warm Ups</p>
          </div>
          <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_Events-BBQs_600x397.jpg" id="careers_image" alt="placeholder">
            <p class="caption">Salmon Barbeques</p>
          </div>
          <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_Events-Mariners-Night_600x397.jpg" id="careers_image" alt="placeholder">
            <p class="caption">Husky Night at the Mariners</p>
          </div>
          <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_Events-Networking_600x397.jpg" id="careers_image" alt="placeholder">
            <p class="caption">Networking Happy Hour</p>
          </div>
          <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_Events-Science-Twist_600x397.jpg" id="careers_image" alt="placeholder">
            <p class="caption">Science with a Twist</p>
          </div>
          <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_Events-Trivia_600x397.jpg" id="careers_image" alt="placeholder">
            <p class="caption">Trivia Night</p>
          </div>
      </div> 
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_four_title', true)) ?></h3>
        <p><?php echo wp_kses(get_post_meta(get_the_ID(), 'mb_row_four_content', true), array('a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ), 'div' => array(
            'class' => array()
            ))); ?>
        </p>
      </div>
       
      </div>
    </div>

<div class="white-spacer"></div>

    <div class="content-row">
      <div class="image-left">
        <div class="image support" id="slideshow2">
            <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_UW-Seattle-Campus_600x397.jpg" id="careers_image" alt="placeholder">
            <p class="caption">UW Seattle Campus</p>
          </div>
          <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_UW-Bothell-Campus_600x397.jpg" id="careers_image" alt="placeholder">
            <p class="caption">UW Bothell Campus</p>
          </div>
          <div class="slide">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_UW-Tacoma-Campus_600x397.jpg" id="careers_image" alt="placeholder">
            <p class="caption">UW Tacoma Campus</p>
          </div>
          </div> 
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_five_title', true)) ?></h3>
        <p><?php echo wp_kses(get_post_meta(get_the_ID(), 'mb_row_five_content', true), array('a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ), 'div' => array(
            'class' => array()
            ))); ?>
        </p>
      </div>
          
      </div>
    </div>

  <div class="white-spacer"></div>

     <div class="content-row">
      <div class="image-right">
        <div class="image join">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_LicensePlate-Membership_600x460.jpg" id="careers_image" alt="placeholder">
          </div>
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_six_title', true)) ?></h3>
        <p><?php echo wp_kses(get_post_meta(get_the_ID(), 'mb_row_six_content', true), array('a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ), 'div' => array(
            'class' => array()
            ))); ?>
        </p>       
      </div>
           
      </div>
    </div>

<div class="white-spacer"></div>

    <div class="content-row">
      <a class="anchor" name='flickr'></a>
      <div class="image-left">
        <div class="image flickr">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_StudentCollage_600x397.jpg" id="careers_image" alt="placeholder">
          </div> 
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_seven_title', true)) ?></h3>
        <p><?php echo wp_kses(get_post_meta(get_the_ID(), 'mb_row_seven_content', true), array('a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ), 'div' => array(
            'class' => array()
            ))); ?>
        </p>
      </div>
          
      </div>
    </div>

  <div class="white-spacer"></div>

     <div class="content-row">
      <div class="image-right">
        <div class="image gradLinks">
            <img src="https://uw.edu/alumni/images/membership/gradpack/GradPack_UW-Graduation_600x397.jpg" id="careers_image" alt="placeholder">
          </div>
        <div class="copy">
        <h3><?php echo esc_html(get_post_meta(get_the_ID(), 'mb_row_eight_title', true)) ?></h3>
        <p><?php echo wp_kses(get_post_meta(get_the_ID(), 'mb_row_eight_content', true), array('a' => array(
            'href' => array(),
            'title' => array(),
            'class' => array()
        ), 'div' => array(
            'class' => array()
            ))); ?>
        </p>   

        
        
      </div>
        
           
      </div>
    </div>

</div>

<?php 
 endwhile;

 get_footer(); ?>
