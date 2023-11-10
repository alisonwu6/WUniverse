import $ from "jquery";

class Like {
  constructor() {
    this.events();
  }

  events() {
    $(".like-box").on("click", this.ourClickDispatcher.bind(this));
  }

  // methods
  ourClickDispatcher(e) {
    var currentLikeBox = $(e.target).closest(".like-box");

    if (currentLikeBox.data("exists") == "yes") {
      this.deleteLike();
    } else {
      this.createLike();
    }
  }

  createLike() {
    $.ajax({
      url: wuniverseData.root_url + '/wp-json/wuniverse/v1/manageLike',
      type: 'POST',
      success: (response) => {
        console.log('success', response)
      },
      error: (response) => {
        console.log('error', response)
      }
    })
  }

  deleteLike() {
    $.ajax({
      url: wuniverseData.root_url + '/wp-json/wuniverse/v1/manageLike',
      type: 'DELETE',
      success: (response) => {
        console.log('success', response)
      },
      error: (response) => {
        console.log('error', response)
      }
    })
  }
}

export default Like;
