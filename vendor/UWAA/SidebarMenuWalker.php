<?php
namespace UWAA;

class SidebarMenuWalker extends \Walker_Nav_Menu {

    public function start_el( &$output, $page, $depth = 0, $args = array(), $current_page = 0 ) {
        // var_dump($args->walker->has_children);
        // var_dump($page);
        if ( $depth ) {
            $indent = str_repeat( "\t", $depth );
        } else {
            $indent = '';
        }

        $css_class = array( 'pagenav', 'page-item-' . $page->ID );


        if ( $args->walker->has_children ) {
            $css_class[] = 'page_item_has_children';
        }


        $is_current = false;     
            if ( $page->current_item_ancestor ) {
                $css_class[] = 'current_page_ancestor';
            }
            if ( $page->current ) {
                $is_current = true;
                $css_class[] = 'current_page_item';
            } elseif ( $page->current_item_parent ) {
                $css_class[] = 'current_page_parent';
            }
     

       
        $css_classes = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) ); 

        if ( '' === $page->title ) {
            $page->title = sprintf( __( '#%d (no title)' ), $page->ID );
        }

        $args->link_before = empty( $args->link_before ) ? '' : $args->link_before;
        $args->link_after = empty( $args->link_after ) ? '' : $args->link_after;

        /** This filter is documented in wp-includes/post-template.php */
        
        if ($is_current) {
            $output .= $indent . sprintf(
                '<li class="%s"><span>%s%s%s</span>',
                $css_classes,
                $args->link_before,
                apply_filters( 'the_title', $page->title, $page->ID ),
                $args->link_after
            );   
        } else {
            $output .= $indent . sprintf(
                '<li class="%s"><a href="%s">%s%s%s</a>',
                $css_classes,
                $page->url,
                $args->link_before,
                apply_filters( 'the_title', $page->title, $page->ID ),
                $args->link_after
            );   
        }


        // if ( ! empty( $args['show_date'] ) ) {
        //     if ( 'modified' == $args['show_date'] ) {
        //         $time = $page->post_modified;
        //     } else {
        //         $time = $page->post_date;
        //     }

        //     $date_format = empty( $args['date_format'] ) ? '' : $args['date_format'];
        //     $output .= " " . mysql2date( $date_format, $time );
        // }
    }


    function start_lvl(&$output, $depth = 0, $args = array() ) {
    $indent = str_repeat("\t", $depth);
    $output .= "\n$indent<ul class=\"children\">\n";
  }    

}
