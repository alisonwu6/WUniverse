import $ from 'jquery'

class Search {
  // 1. describe and create/initiate our object
  constructor() {
    this.openButton = $('.js-search-trigger');
    this.closeButton = $('.search-overlay__close');
    this.searchOverlay = $('.search-overlay');
    this.events();
  }
  // 2. events
  events() {
    // jquery on click function 
    this.openButton.on('click', this.openOverlay.bind(this)); 
    this.closeButton.on('click', this.closeOverlay.bind(this));
  }

  // 3. methods (functions, action...)
  // open up and reveal itself
  openOverlay() {
    this.searchOverlay.addClass("search-overlay--active");
  }
  // close down or hide itself
  closeOverlay() {
    this.searchOverlay.removeClass("search-overlay--active");
  }
}

export default Search
