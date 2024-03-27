document.addEventListener('DOMContentLoaded', function() {
    const flechegauche = document.getElementById('fleche-gauche');
    const flechedroite = document.getElementById('fleche-droite');
    const previousPostId = flechegauche.getAttribute('data-post-id');
    const nextPostId = flechedroite.getAttribute('data-post-id');

    const previousPostThumbnail = document.querySelector('img[data-post-id="' + previousPostId + '"]');
    const nextPostThumbnail = document.querySelector('img[data-post-id="' + nextPostId + '"]');

    flechegauche.addEventListener('mouseover', function(){
        if (previousPostThumbnail) {
            previousPostThumbnail.style.opacity = "1";
            
        }
    });
    flechegauche.addEventListener('mouseout', function(){
        if (previousPostThumbnail) {
            previousPostThumbnail.style.opacity = "0";
        }
    });

    flechedroite.addEventListener('mouseover', function(){
        if (nextPostThumbnail) {
            nextPostThumbnail.style.opacity = "1";
        }
    });
    flechedroite.addEventListener('mouseout', function(){
        if (nextPostThumbnail) {
            nextPostThumbnail.style.opacity = "0";
        }
    });
});
