<?php

  if ( is_archive() )
    the_excerpt();
  else
    the_content();

 ?>