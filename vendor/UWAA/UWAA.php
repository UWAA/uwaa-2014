<?php namespace UWAA;

/*
 *  This is the UWAA object that contains all the classes for our added back-end functionality
 *  All classes should be accessible by \UWAA\ClassName
 */

class UWAA
{

    protected $wp;
    public $UI;
    public $SidebarMenuWalker;
    public $Memberchecker;
    public $Utilities;
    public $RegionalTags;
    public $session;

    function __construct($wp)
    {
        $this->wp = $wp;
        $this->initialize();

    }

    private function initialize()
    {

        //Front-End specific helper functions
        $this->UI = new \UWAA\View\UI;
        $this->SidebarMenuWalker = new \UWAA\SidebarMenuWalker;
        $this->Memberchecker = new \UWAA\Memberchecker\Memberchecker;
        $this->Utilities = new \UWAA\Utilities;
        $this->RegionalTags = new \UWAA\RegionalTags;



        //Scripts needed on all pages of the theme, and registrations for ad-hoc scripts.

        new \UWAA\Scripts;  //Loads UWAA child-theme specific scripts
        new \UWAA\Styles;
        new \UWAA\Sidebars;
        new \UWAA\Images;


        //Custom Taxonomies
        new \UWAA\Taxonomies\Tours; //Holds custom taxonomy used for sorting tours
        new \UWAA\Taxonomies\Media;
        // new \UWAA\Taxonomies\ContentSection;
        new \UWAA\Taxonomies\ContentPromotion;
        new \UWAA\Taxonomies\Events;
        new \UWAA\Taxonomies\Benefits;
        new \UWAA\Taxonomies\AppRegionalTag;
        new \UWAA\Taxonomies\Resources;

        //Relabels Tags
        new \UWAA\Taxonomies\RenameTags;


        //Custom Post Types
        new \UWAA\CustomPostTypes\Tours;
        new \UWAA\CustomPostTypes\Benefits;
        new \UWAA\CustomPostTypes\Events;
        new \UWAA\CustomPostTypes\RegionalChapters;
        new \UWAA\CustomPostTypes\Membergrams;
        new \UWAA\CustomPostTypes\TPCMembergrams;


        //OpenGraph Tagging
        new \UWAA\OpenGraph;  //Facebook and Twitter Card Generator


        //Custom Meta Boxes
        new \UWAA\CustomMetaBoxes\MetaBoxes; //Holds custom taxonomies

        //API
        new \UWAA\API\RequestHandler($this->wp, $this->Memberchecker);  //Sets up the UWAA API for specialized feeds
        new \UWAA\API\RSSFeed($this->RegionalTags); // Customized RSS Feeds

        //Widgets
        new \UWAA\Widgets\SidebarFeaturedPost;
        new \UWAA\Widgets\SidebarPullQuote;
        new \UWAA\Widgets\SidebarSeeYourChapter;
        new \UWAA\Widgets\SubPrefSignupForm;
        new \UWAA\Widgets\SocialSidebar;
        new \UWAA\ContentExperiments;

    }


    //Custom work for Quicklinks

    public function Quicklinks(){
        new Quicklinks;
    }
}
