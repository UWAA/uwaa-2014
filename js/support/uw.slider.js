UW.HomepageSlider = Backbone.View.extend({

  el : '.uw-homepage-slider-container',

  slides : '.uw-homepage-slider',

  headline : '.next-headline',

  controls: '.slideshow-controls',

  template : '<p class="next-headline slide-<%= slide %>" style="display:block;"><%= title %></p>',

  events : {
    'click .next-headline' : 'nextSlide',
  },

  initialize : function( options )
  {
    _.bindAll( this, 'render', 'nextSlide', 'changeNextArticle' )
    this.count = this.$el.children( this.slides ).length
    this.showNextHeadline()
    this.changeNextArticle()
  },

  nextSlide : function( e )
  {
    this.$el.children(this.slides).last().fadeOut( this.rotateSlides )
  },

  rotateSlides : function()
  {
    var $this    = $( this )
    $this.insertBefore( $this.siblings(this.slides).first() ).fadeIn()
    UW.homepageslider.changeNextArticle()
  },

  showNextHeadline : function()
  {
    this.$el.find( this.headline ).show()
    this.$el.find( this.controls ).show()
  },

  changeNextArticle: function()
  {
    this.$el.find( this.headline).replaceWith( this.render )
  },

  render : function()
  {
    if (this.$el.hasClass('uwaa-communities-slider')) {

      var slide = this.$el.children( this.slides ).eq( this.count - 1 )

    } else {

      var slide = this.$el.children( this.slides ).eq( this.count - 2 )

    }
    var templateReturn = $( _.template( this.template )({ title: slide.find('h2').text(), slide: slide.data().id} ) );
    return templateReturn
  }

})

UW.HomepageSlider.initialize = function() {
  console.log($('.uw-homepage-slider').length);
  if ( $('.uw-homepage-slider').length  > 1 )
    UW.homepageslider = new UW.HomepageSlider();
}

$(document).ready( UW.HomepageSlider.initialize )
