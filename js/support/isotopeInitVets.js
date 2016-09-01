//TODO Make a UWAA object and clear bind this there?.
Isotope = Backbone.View.extend({
    el: '#isotope-canvas-vets-events',


  events: {
    "click .filter-button" : "filterByButton",
    "keyup #quicksearch" : "filterBySearch",
    "click .list-button" : "listView",
    "click .grid-button" : "tileView",
    "click .print-button" : "print",

  },

  initialize: function() {
    



    var isotopeQueryFilter = this.getURLParameterByName('filter');
    var isotopeQueryCookie = this.getCookie('UWAA_' + document.location.pathname);

    if (isotopeQueryFilter.length === 0 && isotopeQueryCookie != null) {
     var isotopeQueryFilter = isotopeQueryCookie;
     history.pushState("UWAAFILTER", "", "?filter=" + isotopeQueryFilter);
    }    

    $canvas = this.$('.isotope').isotope({
      itemSelector: '.post-thumbnail-slide',
      layoutMode: 'fitRows'
    });

    var filterValue = '.' + isotopeQueryFilter.toLowerCase();
    var ButtonToggle = this.toggleButtonClass;

    


    
    
    $canvas.imagesLoaded(function() {
    if (isotopeQueryFilter != '') {            
      $canvas.isotope('layout');      
      $canvas.isotope({filter: filterValue});
      
      var buttonToToggleFromParam = $('[data-filter="' + filterValue + '"]');
      buttonToToggleFromParam.siblings().removeClass('is-checked');
      buttonToToggleFromParam.addClass('is-checked');

    } else {
      $canvas.isotope('layout');
    }

    })

    
  },


  filterByButton: function(e) {
    var $target = $(e.target);
    this.$('#quicksearch').val('');
    var filterValue = $target.attr('data-filter');         
    this.$('.isotope').isotope({filter: filterValue});    
    history.pushState("UWAAFILTER", "", "?filter=" + filterValue.replace(/\./gi, ''));
    this.toggleButtonClass($target);

    if(filterValue === '') {
      this.eraseCookie('UWAA_' + document.location.pathname);
      history.pushState("UWAAFILTER", "", document.location.pathname);      
      return;
    }

    this.createCookie('UWAA_' + document.location.pathname, filterValue.replace(/\./gi, ''), 1);


  },

  toggleButtonClass: function(target) {    
    target.siblings().removeClass('is-checked');
    target.addClass('is-checked');
  },

  toggleParentButtonClass: function(target) {
    target.parent().siblings().removeClass('is-checked');
    target.parent().addClass('is-checked');
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

  listView: function(e) {
    var $target = $(e.target);    
    this.$('.isotope')
    .addClass('list').removeClass('tile')
    .isotope({
    layoutMode: 'vertical'
    });
    this.toggleButtonClass($target);
    this.toggleParentButtonClass($target);
  },

  tileView: function(e) {
    var $target = $(e.target);
    this.$('.isotope')
    .addClass('tile').removeClass('list')
    .isotope({
    layoutMode: 'fitRows'    
    });
    this.toggleButtonClass($target);
    this.toggleParentButtonClass($target);
  },

  print: function(e) {    
    $listButton = $('.list-button');
    this.listView(e);
    _.delay(function(){window.print();},  500);
    

    //@TODO- Pull out this toggle code to its own function
    this.toggleButtonClass($listButton);
    this.toggleParentButtonClass($listButton);


  },

  getURLParameterByName: function(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
  },

  createCookie: function (name, value, days) {
     if (days) {
        var date = new Date();
        date.setTime(date.getTime()+(days*24*60*60*1000));
        var expires = "; expires="+date.toUTCString();
    }
    else var expires = "";
    document.cookie = name+"="+value+expires+"; path=/";
  },

  getCookie: function(name) {
    var value = "; " + document.cookie;
    var parts = value.split("; " + name + "=");
    if (parts.length == 2) return parts.pop().split(";").shift();    
    return null;
  },

  eraseCookie: function(name) {
    this.createCookie(name, "", -1);
  }


});

isotopeInit = new Isotope();

