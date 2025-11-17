<?php 

if(get_field('linktree_title')) {
  $linktreetitle = get_field('linktree_title');
} else { 
  $linktreetitle = 'UW Alumni Association';
}
$linktreeblurb = get_field('linktree_blurb');
        echo '<h1 class="linktree-title">'. $linktreetitle .'</h1>';
        echo '<a href="https://www.washington.edu/alumni/"><img class="alumnilogo" src="'. get_bloginfo("stylesheet_directory") .'/assets/logos/logo-uwaa-2025.svg" alt="'. $linktreetitle .'" /></a>';
        
        if( $linktreeblurb ) {
        echo '<div class="linktree-blurb">'. $linktreeblurb .'</div>';
        } else { 
          //
        }

        if( have_rows ('upcoming_events') ):

            echo '<div class="link-block">';
                echo '<h2>Upcoming Events</h2>';

                while( have_rows('upcoming_events')) : the_row();

                    $eventtitle = get_sub_field('event_title');
                    $eventlink = get_sub_field('event_link');

                    echo '<a href="'. $eventlink .'">'. $eventtitle .'</a>';

                endwhile;

            echo '</div>';

        else:
            //
        endif;    

                if( have_rows ('get_involved') ):

            echo '<div class="link-block">';
                echo '<h2>Get Involved</h2>';

                while( have_rows('get_involved')) : the_row();

                    $linktitle = get_sub_field('link_title');
                    $linkurl = get_sub_field('link_url');

                    echo '<a href="'. $linkurl .'">'. $linktitle .'</a>';

                endwhile;

            echo '</div>';

        else:
            //
        endif;   

    
        ?>

<?php
  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>