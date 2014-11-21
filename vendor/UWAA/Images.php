<?php namespace UWAA;

class Images {

    /** @var [array] [description] */
    private $imageSizes = [];
    private $postThumbnailSize [];

    function __construct() {
        $this->setImageSizes();
        add_theme_support( 'post-thumbnails' ); 

    }

    private setImageSizes() {

        $this->imageSizes = array_merge(array

            'postExcerptRowOfFive' => array (
                'name'  => 'postExcerptRowOfFive',
                'width'  => '215',
                'height'  => '155',
                'crop'  => array (
                    'x_crop_position' => 'center',
                    'y_crop_position' => 'center'
                    )
                ),
            'gridViewNoSidebar' => array (
                'name'  => 'gridViewNoSidebar',
                'width'  => '275',
                'height'  => '190',
                'crop'  => array (
                    'x_crop_position' => 'center',
                    'y_crop_position' => 'center'
                    )
                ),
            'gridViewWithSidebar' => array (
                'name'  => 'gridViewWithSidebar',
                'width'  => '186',
                'height'  => '130',
                'crop'  => array (
                    'x_crop_position' => 'center',
                    'y_crop_position' => 'center'
                    )
                ),
            'sidebarPromotedPost' => array (
                'name'  => 'sidebarPromotedPost',
                'width'  => '302',
                'height'  => '190',
                'crop'  => array (
                    'x_crop_position' => 'center',
                    'y_crop_position' => 'center'
                    )
                ),
        );

        $this->postThumbnailSize = array (
            'height' => '',
            'width' => '',
            'crop' => ''  //boolean.  True to hard crop, false to soft (proportional).

            )

    }

     private function register_image_sizes()
    {
        foreach ($this->imageSizes as $imageSize )
      {
        add_image_size($imageSize);
      }      
    }







}