<?php namespace UWAA;

function add_CustomMetaBox($id, $options) {
    new CustomMetaBox($id, $options);
}

// hook the translation filters
/add_filter(  'gettext',  'change_post_to_stories'  );
/add_filter(  'ngettext',  'change_post_to_stories'  );

function change_post_to_stories( $translated ) {
     $translated = str_ireplace(  'Post',  'Story',  $translated );  // ireplace is PHP5 only
     return $translated;
}