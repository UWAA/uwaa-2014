<?php namespace UWAA\View;



class ChapterSidebarContent
{

    private $chapterLinkedin;
    private $chapterFacebook;
    private $leader1;
    private $leader1Email;
    private $leader2;
    private $leader2Email;


    function __construct()
    {
        $this->chapterLinkedin = esc_attr(get_post_meta(get_the_ID(), 'mb_chapter_linkedIN', true));
        $this->chapterFacebook = esc_attr(get_post_meta(get_the_ID(), 'mb_chapter_facebook', true));
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
            $widget .= '<a href="mailto:' . $this->leader1Email . '"> '. $this->leader1 .'</a>';
            } 
            if ($this->leader2) {
                $widget .= '<a href="mailto:' . $this->leader2Email . '"> '. $this->leader2 .'</a>';
            }
        $widget .= '</div>';

        echo $widget;

        } //leader1 OR leader2    

    }

     public function renderSocialWidget()
    {
        if ($this->chapterFacebook OR $this->chapterLinkedin) {
        $widget = '<div id="chapter-leader-widget" class="widget widget_text"><h2 class="widgettitle">Ways To Connect</h2>';        
            if ($this->chapterFacebook) {
            $widget .= '<a href="'. $this->chapterFacebook . '">Facebook</a>';
            } 
            if ($this->chapterLinkedin) {
                $widget .= '<a href="' . $this->leader2Email . '">LinkedIn</a>';
            }
        $widget .= '</div>';

        echo $widget;

        } //leader1 OR leader2    

    }



     // <div id="no-chapter-widget" class="widget widget_text">
     // <h2 class="widgettitle">Don't See Your Chapter?</h2>
     //    <div class="uwaa-btn-wrapper"><a class="uwaa-btn btn-slant-right btn-purple" href="#">Let Us Know!</a></div>
     //  </div>
    

	
}