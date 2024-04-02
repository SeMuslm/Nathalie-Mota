jQuery(document).ready(function($) {

        var page = 1; // ON DÉFINIT A 1 CAR LES 8 PREMIERS ARTICLES SONT SUR LA PREMIERE PAGE
        $('.bouton-contact').on('click', function() {
            page++;
            $.ajax({ // REQUÊTE AJAX
                url: ajaxurl,
                type: 'POST', // MÉTHODE DE RÉCUPÉRATION
                data: { // LES DONNÉES + LE DESTINATAIRE
                    action: 'pagination',
                    page: page,
                },
                success: function(response) {
                    $('#liste_photos').append(response); // AJOUT DES RÉPONSES
                },

            });
        });


});