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
      this.deleteLike(currentLikeBox);
    } else {
      this.createLike(currentLikeBox);
    }
  }

  createLike(currentLikeBox) {
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', wuniverseData.nonce);
      },
      url: wuniverseData.root_url + '/wp-json/wuniverse/v1/manageLike',
      type: 'POST',
      data: {
        'professorId': currentLikeBox.data('professor')
      },
      success: (response) => {
        console.log(response)
      },
      error: (response) => {
        console.log(response)
      }
    })
  }

  deleteLike() {
    $.ajax({
      beforeSend: (xhr) => {
        xhr.setRequestHeader('X-WP-Nonce', wuniverseData.nonce);
      },
      url: wuniverseData.root_url + '/wp-json/wuniverse/v1/manageLike',
      type: 'DELETE',
      success: (response) => {
        console.log(response)
      },
      error: (response) => {
        console.log(response)
      }
    })
  }
}

export default Like;
