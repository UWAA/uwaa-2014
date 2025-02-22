//TODO Make a UWAA object and clear bind this there?.
Isotope = Backbone.View.extend({
    el: '#isotope-canvas',


  events: {
    "click .filter-button" : "filterByButton",
    "keyup #quicksearch" : "filterBySearch",
    "click .list-button" : "listView",
    "click .grid-button" : "tileView",
    "click .print-button" : "print",
    "click #email-signup": "makeSignupFormFrameVisible",
    "click #iframe-emphasis-background": "closeEmphasizedSignup"

  },

  initialize: function() {


    var isotopeQueryFilter = this.getURLParameterByName('filter');
    var iFrameActivationFilter = this.getURLParameterByName('lectureSignup')
    var isotopeQueryCookie = this.getCookie('UWAA_' + document.location.pathname);

    if (isotopeQueryFilter.length === 0 && isotopeQueryCookie != null) {
     var isotopeQueryFilter = isotopeQueryCookie;
     history.pushState("UWAAFILTER", "", "?filter=" + isotopeQueryFilter);
    }



    $canvas = this.$('.isotope').isotope({
      itemSelector: '.post-thumbnail-slide',
      layoutMode: 'fitRows',
      getSortData : {
        date : '[data-sort]',
        title : '.title',
        order : '[data-order]'
      }
    });

    var filterValue = '.' + isotopeQueryFilter.toLowerCase();
    

    $canvas.imagesLoaded(function() {
    if (isotopeQueryFilter != '') {     
      

      if (filterValue === '.live-stream') {        
        $canvas.isotope('layout');
        $canvas.isotope({ sortBy: 'date', filter: filterValue });
                
      } else {
        $canvas.isotope('layout');
        $canvas.isotope({ filter: filterValue });
      }
      // console.log(this);

      isotopeInit.signupFormCheck(filterValue);
      

      var buttonToToggleFromParam = $('[data-filter="' + filterValue + '"]');      
      buttonToToggleFromParam.siblings().removeClass('is-checked');
      buttonToToggleFromParam.addClass('is-checked');

    } else {      
      // console.log('no filter');  //debug
      $canvas.isotope('layout');      
    }

    if (iFrameActivationFilter === "true") {
      isotopeInit.addSignupFormEmphasis();
    }

    })    

    
  },


  filterByButton: function(e) {
    var $target = $(e.target);
    this.$('#quicksearch').val('');
    var filterValue = $target.attr('data-filter');
    this.$('.isotope').isotope({
      filter: filterValue,
      sortBy: 'original-order'
    
    });    
    history.pushState("UWAAFILTER", "", "?filter=" + filterValue.replace(/\./gi, ''));
    this.toggleButtonClass($target);
    this.signupFormCheck(filterValue);
    

    if(filterValue === '') {
      this.eraseCookie('UWAA_' + document.location.pathname);
      history.pushState("UWAAFILTER", "", document.location.pathname);      
      return;
    }

    if(filterValue === '.live-stream'){      
      this.$('.isotope').isotope({ sortBy: 'date' });
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
    this.$("a[href^='https://www.washington.edu/alumni/travel/tours']")
      .each(function () {
        this.href = this.href.replace(/^https\:\/\/www\.washington\.edu\/alumni\/travel/g,
          "http://uwalum.com");
      });
    

      var $elems = $([])
        .pushStack($canvas.isotope('getFilteredItemElements'))
      this.$(".post-thumbnail-slide").not($elems).addClass('no-print');
      $elems.removeClass('no-print');
      
    
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
  },

  signupFormCheck: function(filterValue) {    
    switch (filterValue) {
      case ".arts-and-lectures":        
        this.makeSignupFormButtonVisible("Lectures");        
        
        break;
    
      default: 
        this.$("#email-signup").addClass('button-hidden');
        $("#lecture-signup-wrapper").removeClass('iframe-opened');
        return;
        break;
    }
  },

  makeSignupFormButtonVisible: function(label) {
    this.$('#email-signup > div > span').html(label);
    this.$('#email-signup').toggleClass('button-hidden');    
  },

  makeSignupFormFrameVisible: function() {
    $("#lecture-signup-wrapper").toggleClass('iframe-opened').removeClass('special-emphasis');    
    $('#email-signup').siblings().toggleClass('invisible');
    $('#email-signup').toggleClass('iframe-active');
    $('#isotope-search').toggleClass('invisible');
    
  },
 
  addSignupFormEmphasis: function() {
    this.makeSignupFormFrameVisible();
    $("#lecture-signup-wrapper").addClass('special-emphasis');    
    $("#iframe-emphasis-background").addClass('signup-has-emphasis');
  },

  closeEmphasizedSignup: function() {
    $("#iframe-emphasis-background").removeClass("signup-has-emphasis");
    $("#lecture-signup-wrapper").removeClass("special-emphasis");
    this.makeSignupFormFrameVisible();
  }



});

isotopeInit = new Isotope();


