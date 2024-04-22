$(document).ready(function() {
    var lightbox = $('.lightbox');
    var close = $('.lightbox__close');
    var imageactuel;

    close.on('click', function(){ // FERMETURE DE LA LIGHTBOX
        lightbox.hide();
        $('body').css('overflow', 'auto');
    });


    $(document).on('click', '.fa-expand', function(){
        // RECUPERE LE SRC, LE TITRE, LA RÉFÉRENCE ET LA CATÉGORIE DE L'IMAGE 
        var imagesrc = this.getAttribute('data-post-src');
        var imagealt = this.getAttribute('data-post-alt');
        var imageref = this.getAttribute('data-post-ref');
        var imagecat = this.getAttribute('data-post-cat');
        var image = $('.lightbox__content--image').children();
        imageactuel = $(this).closest('.single-image').find('.photo_block');
        lightbox.css('display', 'grid');
        image.attr('src', imagesrc);
        image.attr('alt', imagealt);
        $('.lightbox__content--reference').html(imageref);
        $('.lightbox__content--categorie').html(imagecat);
        $('body').css('overflow', 'hidden');
    })
    $('.lightbox__next').on('click', function(){
        var nextImage = imageactuel.closest('.single-image').next('.single-image').find('.photo_block');
        if(nextImage.length > 0) {
            imageactuel = nextImage;
        } else {
            imageactuel = $('.photo_block').first(); // Si on est à la dernière image, revenir à la première
        }
            var imagesrc = imageactuel.attr('data-post-src-full');
            var imagealt = imageactuel.attr('alt');
            var imageref = imageactuel.closest('.single-image').find('.lightbox__preview--reference').text();
            var imagecat = imageactuel.closest('.single-image').find('.lightbox__preview--categorie').text();
            $('.lightbox__content--image img').attr('src', imagesrc);
            $('.lightbox__content--image img').attr('alt', imagealt);
            $('.lightbox__content--reference').html(imageref);
            $('.lightbox__content--categorie').html(imagecat);
    })
    $('.lightbox__prev').on('click', function(){
        var prevImage = imageactuel.closest('.single-image').prev('.single-image').find('.photo_block');
        if(prevImage.length > 0) {
            imageactuel = prevImage;
        } else {
            imageactuel = $('.photo_block').last(); // Si on est à la première image, passer à la dernière
        }
            var imagesrc = imageactuel.attr('data-post-src-full');
            var imagealt = imageactuel.attr('alt');
            var imageref = imageactuel.closest('.single-image').find('.lightbox__preview--reference').text();
            var imagecat = imageactuel.closest('.single-image').find('.lightbox__preview--categorie').text();

            $('.lightbox__content--image img').attr('src', imagesrc);
            $('.lightbox__content--image img').attr('alt', imagealt);
            $('.lightbox__content--reference').html(imageref);
            $('.lightbox__content--categorie').html(imagecat);
    });

});
