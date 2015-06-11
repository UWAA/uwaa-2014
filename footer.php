    <div class="container-fluid">
        <div id="uwaa-footer" class="uw-footer">
            <nav role="navigation" aria-label="uwaa social networking" class="social-icons">
                <ul class="uwaa-social">
                    <li><a href="https://www.facebook.com/UWalum" class="facebook"><span class="offscreen">UW Alumni Facebook</span></a></li>
                    <li><a href="https://www.twitter.com/UWalum" class="twitter"><span class="offscreen">UW Alumni Twitter</span></a></li>
                    <li><a href="http://instagram.com/uwalum" class="instagram"><span class="offscreen">UW Alumni Instagram</span></a></li>
                    <li><a href="https://www.linkedin.com/groups?gid=40422" class="linkedin"><span class="offscreen">UW Alumni LinkedIn</span></a></li>
                </ul>
            </nav>
            <nav role="navigation" aria-label="about uwaa and join" class="contact-links">
            <span>CONTACT UWAA: 206-543-0540 <a href="mailto:uwalumni@uw.edu">uwalumni@uw.edu</a></span>
            <div>
                <ul class="footer-links">
                    <li><a href="<?php echo home_url('/about'); ?>">About UWAA</a></li>                    
                    <li><a href="<?php echo home_url('/join-or-renew'); ?>">Join</a></li>
                </ul>                   
            </div>
            </nav>
            <div class="uwaa-logo">
                <?php get_template_part('assets/uwaa', 'logo.svg');?>
            </div>
        </div>
    </div>
    <div class="uw-footer">

        <a href="http://www.washington.edu" class="footer-wordmark">University of Washington</a>

        <a href="http://www.washington.edu/boundless/be-boundless/"><h3 class="be-boundless">Be boundless</h3></a>

        <h4>Connect with us:</h4>

        <nav role="navigation" aria-label="social networking">
            <ul class="footer-social">
                <li><a class="facebook" href="http://www.facebook.com/UofWA">Facebook</a></li>
                <li><a class="twitter" href="http://twitter.com/UW">Twitter</a></li>
                <li><a class="instagram" href="http://instagram.com/uofwa">Instagram</a></li>
                <li><a class="tumblr" href="http://uofwa.tumblr.com/">Tumblr</a></li>
                <li><a class="youtube" href="http://www.youtube.com/user/uwhuskies">YouTube</a></li>
                <li><a class="linkedin" href="http://www.linkedin.com/company/university-of-washington">LinkedIn</a></li>
                <li><a class="pinterest" href="http://www.pinterest.com/uofwa/">Pinterest</a></li>
                <li><a class="vine" href="https://vine.co/uofwa">Vine</a></li>
                <li><a class="google" href="https://plus.google.com/+universityofwashington/posts">Google+</a></li>
            </ul>
        </nav>

        <nav role="navigation" aria-label="footer links">
            <ul class="footer-links">
                <li><a href="http://www.uw.edu/accessibility">Accessibility</a></li>
                <li><a href="http://uw.edu/home/siteinfo/form">Contact Us</a></li>
                <li><a href="http://www.washington.edu/jobs">Jobs</a></li>
                <li><a href="http://www.washington.edu/safety">Campus Safety</a></li>
                <li><a href="http://myuw.washington.edu/">My UW</a></li>
                <li><a href="http://www.washington.edu/admin/rules/wac/rulesindex.html">Rules Docket</a></li>
                <li><a href="http://www.washington.edu/online/privacy">Privacy</a></li>
                <li><a href="http://www.washington.edu/online/terms">Terms</a></li>
            </ul>
        </nav>

        <p role="contentinfo">&copy;	 2014 University of Washington  |  Seattle, WA</p>


    </div>

    </div><!-- #uw-container-inner -->
    </div><!-- #uw-container -->

<?php wp_footer(); ?>

</body>
</html>
