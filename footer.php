    <div class="container-fluid">
        <div id="uwaa-footer" class="uw-footer">
            <nav role="navigation" aria-label="uwaa social networking" class="social-icons">
                <ul class="uwaa-social">
                    <li><a href="https://www.facebook.com/UWalum" class="facebook"><span class="offscreen">UW Alumni Facebook</span></a></li>
                    <li><a href="http://instagram.com/uwalum" class="instagram"><span class="offscreen">UW Alumni Instagram</span></a></li>
                    <li><a href="https://www.linkedin.com/groups?gid=40422" class="linkedin"><span class="offscreen">UW Alumni LinkedIn</span></a></li>
                </ul>
            </nav>
            <nav role="navigation" aria-label="about uwaa and join" class="contact-links">
            <span>CONTACT UWAA: 206-543-0540 <a href="mailto:uwalumni@uw.edu">uwalumni@uw.edu</a></span>
            <div>
                <ul class="footer-links">
                    <li><a href="<?php echo home_url('/about-uwaa'); ?>">About UWAA</a></li>                    
                    <li><a href="<?php echo home_url('/join-or-renew'); ?>">Join</a></li>
                </ul>                   
            </div>
            </nav>
            <div class="uwaa-logo">
                <a href="<?php echo get_bloginfo('url') ?>" title="University of Washington Alumni Association">  <!-- TODO -->
                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
	 width="108.688px" height="38.578px" version="1.1" viewBox="0 0 108.7 38.6"
	 xml:space="preserve">
  <defs>
    <style>
      .st0 {
        fill: #fff;
      }
    </style>
  </defs>
  <path class="st0" d="M4.5,8.2c-.4,1.4-.8,2.9-1.1,4.4l1.1,4.1.9,3.9H1.3c-.5,1.6-.8,3.3-1.3,4.8h6.7l1.2,4.5h5.8v-.3L7.7,8.2h-3.2Z"/>
  <path class="st0" d="M22,8.2h-6.1v21.7h13.6v-5h-7.6V8.2h0Z"/>
  <path class="st0" d="M44.1,21.2c0,1.4-.2,2.3-.8,3s-1.4,1-2.6,1-2-.3-2.6-1c-.5-.7-.8-1.7-.8-3v-12.9h-5.9v12.9c0,1.5.2,2.9.5,4s.8,2,1.5,2.8c.8.8,1.7,1.3,2.9,1.7,1.2.4,2.6.6,4.4.6s3.2-.2,4.4-.5c1.2-.4,2.1-.9,2.9-1.7s1.2-1.7,1.5-2.9.5-2.5.5-4v-12.9h-5.9v12.9h0Z"/>
  <path class="st0" d="M66.3,17.2l-.9,4.2h-.2l-.9-4.2-3-9h-8.4v21.7h5.4v-14.7h.2l1.4,5.2,2.8,8.5h4.8l2.9-8.5,1.4-5.2h.2v14.7h5.4V8.2h-8.4l-3,9h0Z"/>
  <path class="st0" d="M94.2,20.1h-.3l-1.4-2.3-7-9.5h-4.8v21.7h5.2v-12h.3l1.6,2.6,6.8,9.4h4.7V8.2h-5.2v11.9h0Z"/>
  <path class="st0" d="M108.6,8.2h-6.1v21.7h6.1V8.2Z"/>
</svg>
                </a>
            </div>
        </div>
    </div>
    <div role="contentinfo" class="uw-footer">

        <a href="http://www.washington.edu" class="footer-wordmark">University of Washington</a>

        <a href="http://www.washington.edu/boundless/"><h3 class="be-boundless">Be boundless</h3></a>

        <h4>Connect with us:</h4>

        <nav aria-label="social networking">
            <ul class="footer-social">
                <li><a class="facebook" href="http://www.facebook.com/UofWA">Facebook</a></li>
                <li><a class="twitter" href="http://twitter.com/UW">Twitter</a></li>
                <li><a class="instagram" href="http://instagram.com/uofwa">Instagram</a></li>
                <li><a class="youtube" href="http://www.youtube.com/user/uwhuskies">YouTube</a></li>
                <li><a class="linkedin" href="http://www.linkedin.com/company/university-of-washington">LinkedIn</a></li>
                <li><a class="pinterest" href="http://www.pinterest.com/uofwa/">Pinterest</a></li>
            </ul>
        </nav>

        <nav aria-label="footer navigation">
            <ul class="footer-links">
                <li><a href="http://www.uw.edu/accessibility">Accessibility</a></li>
                <li><a href="http://uw.edu/contact">Contact Us</a></li>
                <li><a href="http://www.washington.edu/jobs">Jobs</a></li>
                <li><a href="http://www.washington.edu/safety">Campus Safety</a></li>
                <li><a href="http://my.uw.edu/">My UW</a></li>
                <li><a href="http://www.washington.edu/rules/wac">Rules Docket</a></li>
                <li><a href="http://www.washington.edu/online/privacy/">Privacy</a></li>
                <li><a href="http://www.washington.edu/online/terms/">Terms</a></li>
            </ul>
        </nav>

        <p>&copy; <?php echo date("Y"); ?> University of Washington  |  Seattle, WA</p>


    </div>

    </div><!-- #uw-container-inner -->
    </div><!-- #uw-container -->

<?php wp_footer(); ?>
<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/clear.png" id="flag">
</body>
</html>
