let inputimagefire = document.querySelector("#imageBtn");
const imagediv = document.querySelector("#imagePost");

let inputimagefire_edit = document.querySelector("#imageBtn_edit");
const imagediv_edit = document.querySelector("#imagePost_edit");

const likeNumber = document.querySelector("#like_number");
const hearts = document.querySelectorAll(".heart_icon");

const comment_icon = document.querySelectorAll(".comment_icon");
const modal_comment_id = document.querySelector(".modal_comment_id");
const post_id = document.querySelector(".post_id");
const commentaires = document.querySelector(".commentaires");

// new post picture 
inputimagefire.addEventListener("change", () => {
  if (inputimagefire.files.length != 0) {
    imagediv.src = "";
    imagediv.src = URL.createObjectURL(inputimagefire.files[0]);
  }
});

// edit post picture 
inputimagefire_edit.addEventListener("change", () => {
  if (inputimagefire_edit.files.length != 0) {
    imagediv_edit.src = "";
    imagediv_edit.src = URL.createObjectURL(inputimagefire_edit.files[0]);
  }
});

// Comments
for(let i=0;i<comment_icon.length;i++){
  comment_icon[i].addEventListener('click',function(e){
    let id_post = e.target.id;
    modal_comment_id.value = id_post ;
    get_comments(id_post);
})
}


$(document).ready(function(){
  $.ajaxSetup({
    Headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
  // showComments();
  $('#newcomment').on('submit',function(e){
    e.preventDefault();
    var form = $(this).serialize();
    var url = $(this).attr('action');
    $.ajax({
      type : 'POST',
      url :url,
      data : form,
      dataType : 'json',
      success : function(){
        $('#comments').modal('hide');
        $('#newcomment')[0].reset();
        // get_comments();
      } 
    })
  });
})

function get_comments(id_post){

  $.ajaxSetup({
    Headers:{
      'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
  })
  $.ajax({
    url: "http://127.0.0.1:8000/comments?id_post="+id_post,
    type: "GET",
    success: function(commentss) {
      commentaires.innerHTML = "";
      let insertedComments =``;
      let comments = JSON.parse(commentss);
        comments.forEach(comment => {

          insertedComments += ` <div id="comments" class="col-md-12 ">
      <div class="d-flex media g-mb-30 media-comment">
          <div>
            <img class="d-flex g-width-50 g-height-50 rounded-circle g-mt-3 g-mr-15" src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Image Description">
          </div>
          <div class="media-body u-shadow-v18 g-bg-secondary g-pa-30">
            <div class="g-mb-15">
              <p class="g-color-gray-dark-v1 mb-0" style="font-weight:bold">`+comment.firstname+`</p>
            </div>
            <p class="mb-0">`+comment.comment+`</p>
              
            <ul class="list-inline d-sm-flex my-0">
              <li class="list-inline-item g-mr-20">
                <i class="bi bi-hand-thumbs-up"></i>
              </li>
            </ul>
          </div>
          </div>
      </div> `
          
        });
        commentaires.innerHTML = insertedComments;
    }
});
}

// *******************search*******************
document.querySelector('#search_input').addEventListener('input',filterList)
function filterList(){
  const searchInput = document.querySelector('#search_input')
  const filter = searchInput.value.toLowerCase()
  const listItems = document.querySelectorAll(".categories")
  listItems.forEach((item)=>{
    let text = item.textContent;
    if(text.toLowerCase().includes(filter)){
      //  item.parentElement.parentElement.style.display = '';
       item.style.display = '';
    }
    else{
      // item.parentElement.parentElement.style.display = 'none'; 
      item.style.display = 'none'; 
    }
  })
}

// edit post 

const id_post_input = document.querySelector('.id_post_input')
const editPost_btns = document.querySelectorAll('.editPost')
editPost_btns.forEach((edit_btn)=>{
  edit_btn.addEventListener('click',editing)
function editing(){
  id_post_input.value = edit_btn.id
}
})


