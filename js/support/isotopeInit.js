//TODO Make a UWAA object and clear bind this there?.
Isotope = Backbone.View.extend({
    el: '#isotope-canvas',


  events: {
    "click .filter-button" : "filterByButton",
    "keyup #quicksearch" : "filterBySearch",
    "click .list-button" : "listView",
    "click .grid-button" : "tileView",
    "click .print-button" : "print",

  },

  initialize: function() {
    this.$('.isotope').isotope({
      itemSelector: '.post-thumbnail-slide',
      layoutMode: 'fitRows'
    });
  },


  filterByButton: function(e) {
    var $target = $(e.target);
    this.$('#quicksearch').val('');
    var filterValue = $target.attr('data-filter'); 
    this.$('.isotope').isotope({filter: filterValue});    
    this.toggleButtonClass($target);
  },

  toggleButtonClass: function(target) {
    // this.$('.button-group').find('.is-checked').removeClass('is-checked');
    target.siblings().removeClass('is-checked');
    target.addClass('is-checked');


  },

  filterBySearch: _.debounce(function() {
        var qsRegex = new RegExp( this.$('#quicksearch').val(), 'gi' );
        this.$('.isotope').isotope({
          filter: function() {
          return qsRegex ? $(this).text().match( qsRegex ) : true;
          }
         });
    }, 200
    ),

  listView: function() {
    this.$('.isotope')
    .addClass('list').removeClass('tile')
    .isotope({
    layoutMode: 'vertical'
    });
  },

  tileView: function() {
    this.$('.isotope')
    .addClass('tile').removeClass('list')
    .isotope({
    layoutMode: 'fitRows'
    });    
  },

  print: function() {
    this.listView();
    window.print();
  }


});

isotopeInit = new Isotope();

