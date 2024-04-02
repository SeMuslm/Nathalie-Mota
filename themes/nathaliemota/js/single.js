document.addEventListener("DOMContentLoaded", function(){

    var modal = document.getElementById('myModal');
    var btn = document.getElementById("menu-item-28");
    var btnphoto = document.querySelector(".bouton-contact")
    
    btn.onclick = function() {
        modal.style.visibility = "visible";
        modal.style.animation = "fadeIn 1s ease-in-out forwards"
    }
    window.addEventListener('click', function(event){
        if (event.target == modal) {
            modal.style.animation = "fadeOut 1s ease-in-out forwards";
            modal.addEventListener('animationend', function onAnimationEnd(){
                modal.style.visibility = "hidden";
                modal.removeEventListener('animationend', onAnimationEnd);
              });
        }
    });
    
    btnphoto.onclick = function(){
        modal.style.visibility = "visible";
        modal.style.animation = "fadeIn 1s ease-in-out forwards"
        var reference = this.getAttribute('data-reference'); // La variable récupère la valeur de la référence qui est stocké dans le bouton 
        $("#referencephoto").val(reference);
    }
    

    
    });