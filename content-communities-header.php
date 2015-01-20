 <div class="communities-header uw-homepage-slider-container uwaa-communities-slider">

 <?php foreach ( $superhero->get_latest_slideshow() as $slide ) :
   
    ?>

<div class="uw-homepage-slider slide-<?php echo $slide->id?>" data-id="<?php echo $slide->id; ?>">
    <div class="chapter-image-column">
        <div class="chapter-image-row">            
            <div class="chapter-image" style="background:url(<?php echo $slide->image; ?>) no-repeat center; background-size:cover;"></div>
        </div>
        <div class="row">
        <div class="chapter-logo">
                <?php 
                $logo = new \UWAA\View\ChapterHeaderLogo($slide->logo); 
                $logo->retriveSVG();
                ?>
            </div>
            </div>
    </div>
    <div class="event-information-column">
        <h2><?php $subtitle = $slide->subtitle ? $slide->subtitle : ''; echo $subtitle ?></h2>
        <h1 class="title" id="<?php echo $slide->id; ?>-title"><?php echo $slide->title; ?></h1>
        <h2><?php $date = $slide->date ? $slide->date : ''; echo $date ?></h2>

        <a class="uw-btn btn-sm btn-none" href="<?php echo $slide->alternateLink ? $slide->alternateLink : $slide->link; ?>" aria-describedby="<?php echo $slide->id; ?>-title">Learn more </a>

        
    </div>        
</div>
            
        <?php endforeach;?>


    
      <div class="slideshow-controls">
          <p class="next-headline"></p>
      </div>

    


</div>