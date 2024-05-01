document.addEventListener("DOMContentLoaded", function(){

var modal = document.getElementById('myModal');
var menucheckbox = document.getElementById("menu_checkbox");
var menuicon = document.getElementById("menu_icon");
var menulist = document.querySelector(".menu_list");
var btns = document.querySelectorAll(".contact-btn");
var body = document.querySelector("body");

// CONTACT //

btns.forEach(function(btn) { // AFFICHER LE MODAL CONTACT
    btn.addEventListener('click', function() {
        body.style.overflow = "hidden";
        modal.style.visibility = "visible";
        modal.style.animation = "fadeIn 0.8s ease-in-out forwards";
        if(menucheckbox && menulist){        
            menulist.style.display = 'none';
            menucheckbox.checked=false;
            menuicon.src = burger;
        }
    });
});

window.addEventListener('click', function(event){ // FERMETURE LE MODAL CONTACT
    if (event.target == modal) {
        body.style.overflow = "auto";
        modal.style.animation = "fadeOut 1s ease-in-out forwards";
        modal.addEventListener('animationend', function onAnimationEnd(){
            modal.style.visibility = "hidden";
            modal.removeEventListener('animationend', onAnimationEnd);
          });
    }
});

// MENU BURGER //

var AnimationEnd = function(){
    if(menucheckbox.checked){
        menulist.style.display = 'flex';
        body.style.overflow = 'hidden';
    }
    else{
        menulist.style.display = 'none';
        body.style.overflow = 'auto';
    }
    menucheckbox.disabled = false;
    menulist.removeEventListener('animationend', AnimationEnd);
}

menucheckbox.addEventListener('change', function(){ // NAVBAR RESPONSIVE
    if(menucheckbox.checked){ // SI LE BURGER EST COCHÉ
        menuicon.src = cross;
        menulist.style.animation = 'menu_opening 1s forwards';
        menulist.style.display = 'flex';
        menucheckbox.disabled = true;
        menulist.addEventListener('animationend', AnimationEnd);
    }
    else{
        menuicon.src = burger;
        menulist.style.animation = 'menu_closing 1s forwards';
        menulist.addEventListener('animationend', AnimationEnd);
    }
})
})

$(document).ready(function() {

    if ($('#categories-select').length > 0 && $('#formats-select').length > 0 && $('#tri-select').length > 0) {
        $('#categories-select, #formats-select, #tri-select').select2();
    }

});