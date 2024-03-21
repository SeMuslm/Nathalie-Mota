document.addEventListener("DOMContentLoaded", function(){

var modal = document.getElementById('myModal');
var btn = document.getElementById("menu-item-28");

btn.onclick = function() {
    modal.style.display = "grid";
    modal.style.alignItems = "center";
    modal.style.justifyContent = "center";
    modal.style.animation = "fadeIn 1s ease-in-out forwards"
}

window.addEventListener('click', function(event){
    if (event.target == modal) {
        modal.style.animation = "fadeOut 1s ease-in-out forwards";
        modal.addEventListener('animationend', function onAnimationEnd(){
            modal.style.display = "none";
            modal.removeEventListener('animationend', onAnimationEnd);
          });
    }
});

});

// window.onclick = function(event) {
//     if (event.target == modal) {
//         modal.style.animation = "fadeOut 1s ease-in-out forwards"
//         modal.addEventListener('animationend', function onAnimationEnd(){
//             modal.style.display = "none";
//             modal.removeEventListener('animationend', onAnimationEnd);
//           });
//     }

// }
    



