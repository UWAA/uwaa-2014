 <?php foreach ( $superhero->get_latest_slideshow() as $slide ) :
   
    ?>


    <div class="chapter-image-column">
        <div class="chapter-image-row">            
            <div class="chapter-image slide-<?php echo $slide->id .' ' .$slide->header_text_color ?>" data-id="<?php echo $slide->id; ?>" style="background:url(<?php echo $slide->image; ?>) no-repeat center; background-size:cover;"></div>
        </div>
        <div class="row">
        <div class="chapter-logo">
                <?php 
                new \UWAA\View\ChapterHeaderLogo($slide->logo); 
                ?>
            </div>
            </div>
    </div>
    <div class="event-information-column">
        <h2><?php $subtitle = $slide->subtitle ? $slide->subtitle : ''; echo $subtitle ?></h2>
        <h1><?php echo $slide->title; ?></h1>
        <h2><?php $date = $slide->date ? $slide->date : ''; echo $date ?></h2>
    </div>        
            
        <?php endforeach;?>

      <div class="slideshow-controls">
          <p class="next-headline"></p>
      </div>
