

//TODO Make a UWAA object and clear space for these.
ToursView = Backbone.View.extend({
  className: "isotope",




  // isotopeContainer: '.isotope',
  // filterContainer: '#filter',

  // events: {
  //   'click #filters' : 'filter'

  // },

  initialize: function() {
    _.bindAll(this, 'render');
    // this.listenTo(this.collection, "reset sync add remove", this.render);
    // _bindAll(isotopeContainer, 'isotope');

  },

  // filter: function() {

  // },

  // isotope: function() {
  //   this.isotopeContainer.isotope({
  //     itemSelector: '.tour-thumbnail',
  //     layoutMode: 'fitRows'  
  //   })
  // },

render: function() {
    this.$el.html(this.template(this.model.attributes));
    console.log(this.collection.toJSON());

    // return this;
  }

});

var tours = new Tours();
toursView = new ToursView({collection: tours});
tours.fetch();



// TODO  MAKE THIS NOT HELL.
// $( function() {

//   var qsRegex;

//   // init Isotope
//   var $container = $('.isotope').isotope({
//     itemSelector: '.tour-thumbnail',
//     layoutMode: 'fitRows'
//   });

//   // filter functions
 

//     // use value of search field to filter
//  var $quicksearch = $('#quicksearch').keyup( debounce( function() {
//     qsRegex = new RegExp( $quicksearch.val(), 'gi' );
//     console.log(qsRegex);
//     $container.isotope({
//       filter: function() {
//       return qsRegex ? $(this).text().match( qsRegex ) : true;
//     }
//     });
//   }, 200 ) );

  
//   // bind filter button click
//   $('#filters').on( 'click', 'button', function() {

//     var filterValue = $(this).attr('data-filter');
    
//     $container.isotope({ filter: filterValue });
//     console.log(filterValue);
//   });
//   // change is-checked class on buttons
//   $('.button-group').each( function( i, buttonGroup ) {
//     var $buttonGroup = $( buttonGroup );
//     $buttonGroup.on( 'click', 'button', function() {
//       $quicksearch.val('');
//       $buttonGroup.find('.is-checked').removeClass('is-checked');
//       $( this ).addClass('is-checked');
//     });
//   });



  
  
// });

// // debounce so filtering doesn't happen every millisecond
// function debounce( fn, threshold ) {
//   var timeout;
//   return function debounced() {
//     if ( timeout ) {
//       clearTimeout( timeout );
//     }
//     function delayed() {
//       fn();
//       timeout = null;
//     }
//     timeout = setTimeout( delayed, threshold || 100 );
//   }
// }