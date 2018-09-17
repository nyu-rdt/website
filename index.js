function getFacebookPosts() {
  $.ajax({
    url: "http://rdt.engineering.nyu.edu/api/twitter.php"
    , dataType: "json"
    , type: "GET"
    , success: function (posts) {
      for (var i = 0; i < posts.length; i++) {
        if (posts[i]["picture"] == "false") {
          if (posts[i].type == "twitter") {
            var str = posts[i].message;
            var matches = str.match(/\bhttps?:\/\/\S+/gi);
            if (posts[i].link == null && matches != null && matches.length > 0) {
              posts[i].link = matches[0]
            }
          }
          $(".news-div").append($(`
            <div onclick="location='${posts[i].link}'" class="small-card flex col" style="cursor:pointer; background: #CCB4DC; padding-top: 0px;">
              <div style="margin-top: 10px; padding-bottom: 10px; display: flex; flex-direction: column; justify-content: center">
                <div style="padding-left: 20px; padding-bottom: 5px;display: flex; flex-direction: row; align-items: center;">
                  <i class="fab fa-${posts[i].type}"></i>
                  <h4 style="margin-left: 8px; font-weight: normal; color: #444">${posts[i].time}</h4>
                </div>
                <div class="card-body-div">
                  <h4 style="font-weight: normal;">${posts[i].message}</h4>
                </div>
              </div>
            </div>`));
        }
        else {
          if (posts[i].type == "twitter") {
            var str = posts[i].message;
            var matches = str.match(/\bhttps?:\/\/\S+/gi);
            if (posts[i].link == null && matches != null && matches.length > 0) {
              posts[i].link = matches[0];
            }
          }
          $(".news-div").append($(`
            <div onclick="location='${posts[i].link}'" class="small-card flex col" style="cursor:pointer; background: #CCB4DC; padding-top: 0px;">
              <div class="img-container">
                <img src="${posts[i].picture}" class="profile">
              </div>
              <div style="flex-grow:1; margin-top: 10px; display: flex; flex-direction: column; justify-content: center">
                <div style="padding-left: 20px; margin-bottom: 10px;display: flex; flex-direction: row; align-items: center;">
                  <i class="fab fa-${posts[i].type}"></i>
                  <h4 style="margin-left: 8px; font-weight: normal; color: #444">${posts[i].time}</h4>
                </div>
                <div class="card-body-div">
                  <h4 style="font-weight: normal;">${posts[i].message}</h4>
                </div>
              </div>
            </div>`));
        }
      }
    }
  });
}

$(function () {
  getFacebookPosts();
});