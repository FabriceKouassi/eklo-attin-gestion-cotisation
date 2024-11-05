$(document).ready(function() {
    // Initialiser Infinite Scroll
    $('#listeDocuments').infinitescroll({
        // Options du plugin
        navSelector: false, // Désactiver la pagination
        nextSelector: false, // Désactiver le lien suivant
        itemSelector: '.card', // Sélecteur pour les éléments de contenu à charger
        loading: {
            finishedMsg: 'Fin du contenu.', // Message affiché une fois que tout le contenu a été chargé
            img: '', // Lien vers une image de chargement (optionnel)
        },
        errorCallback: function() {
            // Fonction appelée en cas d'erreur de chargement
            console.log('Erreur lors du chargement du contenu.');
        }
    }, function(newElements) {
        // Fonction de callback appelée lorsque de nouveaux éléments de contenu sont chargés
        $(this).append(newElements);
    });
});
