<?php namespace UWAA\View;



class ChapterSidebarContent
{

    private $chapterLinkedin;
    private $chapterFacebook;
    private $chapterFacebookName;
    private $chapterLinkedinName;
    private $leader1;
    private $leader1Email;
    private $leader2;
    private $leader2Email;


    function __construct()
    {
        $this->chapterLinkedin = esc_attr(get_post_meta(get_the_ID(), 'mb_chapter_linkedIn', true));
        $this->chapterFacebook = esc_attr(get_post_meta(get_the_ID(), 'mb_chapter_facebook', true));
        $this->chapterTwitter = esc_attr(get_post_meta(get_the_ID(), 'mb_chapter_twitter', true));
        $this->chapterLinkedInName = esc_html(get_post_meta(get_the_ID(), 'mb_chapter_linkedIn_name', true));
        $this->chapterFacebookName = esc_html(get_post_meta(get_the_ID(), 'mb_chapter_facebook_name', true));
        $this->chapterTwitterName = esc_html(get_post_meta(get_the_ID(), 'mb_chapter_twitter_name', true));
        $this->leader1 = esc_html(get_post_meta(get_the_ID(), 'mb_chapter_leader_1', true));
        $this->leader1Email = esc_attr(get_post_meta(get_the_ID(), 'mb_chapter_leader_1_email', true));
        $this->leader2 = esc_html(get_post_meta(get_the_ID(), 'mb_chapter_leader_2', true));
        $this->leader2Email = esc_attr(get_post_meta(get_the_ID(), 'mb_chapter_leader_2_email', true));

    }



    public function renderLeaderWidget()
    {
        if ($this->leader1 OR $this->leader2) {
        $widget = '<div id="chapter-leader-widget" class="widget widget_text"><h2 class="widgettitle">Chapter Leaders</h2>';        
            if ($this->leader1) {
            $widget .= '<a class="email" href="mailto:' . $this->leader1Email . '"> '. $this->leader1 .'</a>';
            } 
            if ($this->leader2) {                
                $widget .= '<a class="email" href="mailto:' . $this->leader2Email . '"> '. $this->leader2 .'</a>';
            }
        $widget .= '</div>';

        echo $widget;

        } //leader1 OR leader2    

    }

     public function renderSocialWidget()
    {
        if ($this->chapterFacebook OR $this->chapterLinkedin) {
        $widget = '<div id="chapter-social-widget" class="widget widget_text"><h2 class="widgettitle">Ways To Connect</h2><div class="textwidget">';        
            if ($this->chapterFacebook) {
            $widget .= '<a target="_blank" class="facebook" href="'. $this->chapterFacebook . '">' . ($this->chapterFacebookName ? $this->chapterFacebookName : '') . ' Facebook</a>';
            } 
            if ($this->chapterLinkedin) {
                $widget .= '<a target="_blank" class="linkedIn" href="' . $this->chapterLinkedin . '">' . ($this->chapterLinkedInName ? $this->chapterLinkedInName : '') . ' LinkedIn</a>';
            }
            if ($this->chapterTwitter) {
                $widget .= '<a target="_blank" class="twitter" href="' . $this->chapterTwitter . '">' . ($this->chapterTwitterName ? $this->chapterTwitterName : '') . ' Twitter</a>';
            }
        $widget .= '</div></div>';

        echo $widget;

        } //leader1 OR leader2    

    }

    public function renderChapterContactForm() {
        get_template_part('partials/forms', 'communities-connect');
    }

    public function renderCommunitiesChapterMenu() {        
     

        echo sprintf( '<nav id="desktop-relative" role="navigation" aria-label="relative">%s</nav>', $this->uwaa_list_pages() ) ;

    }

    public function renderMobileCommunitiesChapterMenu() {        
     

        echo sprintf( '<nav id="mobile-relative" role="navigation" aria-label="mobile-menu">%s</nav>', $this->uwaa_list_pages($mobile = TRUE)) ;

    }

    private function uwaa_list_pages($mobile = FALSE)
    {
    global $UWAA;
    global $post;    

    $toggle = $mobile ? '<button class="uw-mobile-menu-toggle">Menu</button>' : '';
    $class  = $mobile ? 'uw-mobile-menu' : 'uw-sidebar-menu';

    $menu = wp_nav_menu( array(
    'theme_location'  => \UW_Dropdowns::LOCATION
    ,'container' => false    
    ,'depth' => 3    
    , 'sub_menu' => true
    , 'show_parent' => true    
    , 'container_id'    => ''
    , 'walker'       => $UWAA->SidebarMenuWalker
    , 'echo'        => 0
    , 'items_wrap' => '' . $toggle . '<ul class="' . $class . ' first-level"><li class="pagenav"><a href=" ' .get_bloginfo('url') . '" title="Home" class="homelink">Home</a><ul id="%1$s" class="%2$s">%3$s</li></ul>' 
    ));


    return $menu ? $menu : '';

    }

	
}