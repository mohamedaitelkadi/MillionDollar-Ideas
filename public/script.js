let inputimagefire = document.querySelector("#imageBtn");
const imagediv = document.querySelector("#imagePost");
const likeNumber = document.querySelector("#like_number");
const hearts = document.querySelectorAll(".heart_icon");


let comment_icon = document.querySelector(".comment_icon");

let like=Number.parseInt(likeNumber.textContent, 10);


let isLiked = false;


const likeClick = (idheart) => {

  const heart = document.querySelector("#"+idheart);

  if (!isLiked) {

    heart.classList.add('isLiked');
    like++;
    likeNumber.textContent = like;
    heart.style.color = "red";
    isLiked = !isLiked;

  } else {

    heart.classList.remove('isLiked');
    like--;
    likeNumber.textContent = like ;
    heart.style.color = "white";
    isLiked = !isLiked;
    
  }

};

// Event Listeners
for(let i=0;i<hearts.length;i++){
hearts[i].addEventListener('click', function(event) {
  console.log(event.target.id); 
  likeClick(event.target.id);
});
// document.getElementById("myButton").addEventListener("click", );

}



inputimagefire.addEventListener("change", () => {
  if (inputimagefire.files.length != 0) {
    imagediv.src = "";
    imagediv.src = URL.createObjectURL(imageBtn.files[0]);

  }
});





