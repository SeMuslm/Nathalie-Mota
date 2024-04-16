jQuery(document).ready(function($) {

    var page = 1; // ON DÉFINIT A 1 CAR LES 8 PREMIERS ARTICLES SONT SUR LA PREMIERE PAGE

    $('.bouton-contact').on('click', function() {
        page++;
        var categorieSelectionne = $('#categories-select').val();
        var formatsSelectionne = $('#formats-select').val();
        var triSelectionne = $('#tri-select').val();
        $.ajax({ // REQUÊTE AJAX
            url: ajaxurl,
            type: 'POST', // MÉTHODE DE RÉCUPÉRATION
            data: { // LES DONNÉES + LE DESTINATAIRE
                action: 'pagination_terms',
                categorieSelectionne: categorieSelectionne,
                formatsSelectionne: formatsSelectionne,
                page: page,
                triSelectionne: triSelectionne,
            },
            success: function(response) {
                $('#liste_photos').append(response); // AJOUT DES RÉPONSES
            },

        });
    });

    $('#categories-select, #formats-select, #tri-select').on('change', function(){
        var categorieSelectionne = $('#categories-select').val();
        var formatsSelectionne = $('#formats-select').val();
        var triSelectionne = $('#tri-select').val();
        if(categorieSelectionne !== 'categories' || formatsSelectionne !== 'formats'){ // SI UNE CATÉGORIE DIFFÉRENTE DE "CATEGORIES" (PAR DÉFAUT) EST SÉLECTIONNÉE
            page = 1;
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'pagination_terms',
                    categorieSelectionne: categorieSelectionne,
                    formatsSelectionne: formatsSelectionne,
                    page: page,
                    triSelectionne: triSelectionne,
                },
                success: function(response){
                    $('#liste_photos').html(response);
                }
            })
        }
        else{ // SINON, SI LA CATÉGORIE SÉLECTIONNÉE EST "CATÉGORIES"
            page = 1;
            $.ajax({
                url: ajaxurl,
                type: 'POST',
                data: {
                    action: 'pagination_terms',
                    categorieSelectionne: categorieSelectionne,
                    formatsSelectionne: formatsSelectionne,
                    page: page,
                    triSelectionne: triSelectionne,
                },
                success: function(response){
                    $('#liste_photos').html(response);
                }
            })
        }
})
})