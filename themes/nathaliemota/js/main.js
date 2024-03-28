document.addEventListener("DOMContentLoaded", function(){

var modal = document.getElementById('myModal');
var menucheckbox = document.getElementById("menu_checkbox");
var menuicon = document.getElementById("menu_icon");
var menulist = document.querySelector(".menu_list");
var section = document.getElementById("post-page");
var btns = document.querySelectorAll(".contact-btn");
var footer = document.querySelector(".menu-footer-container");

btns.forEach(function(btn) {
    btn.addEventListener('click', function() {
        modal.style.visibility = "visible";
        modal.style.animation = "fadeIn 1s ease-in-out forwards";
        if(menucheckbox && menulist){
            menulist.style.display = 'none';
            menucheckbox.checked=false;
            menuicon.src = burger;
            if(section){
                section.style.display = 'block';
            }
            footer.style.display = 'block';
        }
    });
});

window.addEventListener('click', function(event){
    if (event.target == modal) {
        modal.style.animation = "fadeOut 1s ease-in-out forwards";
        modal.addEventListener('animationend', function onAnimationEnd(){
            modal.style.visibility = "hidden";
            modal.removeEventListener('animationend', onAnimationEnd);
          });
    }
});


// MENU BURGER //

menucheckbox.addEventListener('change', function(){
    if(menucheckbox.checked){
        menuicon.src = cross;
        menulist.style.animation = 'menu_opening 1s forwards';
        menulist.style.display = 'flex';
        footer.style.display = 'none';
        if(section){
            section.style.display = 'none';
        }
    }
    else{
        menuicon.src = burger;
        menulist.style.animation = 'menu_closing 1s forwards';
            menulist.addEventListener('animationend', function onAnimationEnd(){
                menulist.style.display = 'none';
                footer.style.display = 'block';
                if(section){
                section.style.display = 'block';                    
                }
            menulist.removeEventListener('animationend', onAnimationEnd);
            });
    }
})


});