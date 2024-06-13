// Sélectionner l'élément de chargement
var preloader = document.querySelector('.cssload-loader');

// Fonction pour afficher l'élément de chargement
function showPreloader() {
    preloader.style.display = 'block';
    // Ajouter une classe "loading" à l'élément body
    document.body.classList.add('loading');
}

// Fonction pour masquer l'élément de chargement
function hidePreloader() {
    preloader.style.display = 'none';
    // Supprimer la classe "loading" de l'élément body
    document.body.classList.remove('loading');
}


// Exemple d'utilisation des fonctions
showPreloader();
setTimeout(hidePreloader, 3000); // Masquer l'élément de chargement après 3 secondes
