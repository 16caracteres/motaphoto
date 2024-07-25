//Lightbox
function initLightbox() {
    const lightbox = document.getElementById('lightbox'); 
    const lightboxPhoto = document.querySelector('.lightbox__photo'); 
    const lightboxTitle = document.querySelector('.lightbox__info-title');
    const lightboxCat = document.querySelector('.lightbox__info-cat');
    const closeLightbox = document.querySelector('.lightbox__close');
    const prevLightbox = document.querySelector('.lightbox__prev');
    const nextLightbox = document.querySelector('.lightbox__next');


    let gallery = [];
    // Crée une varible contenant un tableau avec les éléments de la galerie photo
    let currentIndex = 0;
    // Crée une variable contenant l'index de l'image en cours


    // Pour chaque photo affichée, on implémente les valeurs de chacune d'elles dans la variable gallery
    photoList = document.querySelectorAll('.photo__list-item');
    photoList.forEach((item, index) => {
        const photoLink = item.querySelector('.photo__link img');
        const photoTitle = item.querySelector('.photo__title').innerHTML;
        const photoCat = item.querySelector('.photo__cat').innerHTML;
        
        // Implémente les valeurs récupérées sur chaque image dans la variable tableau gallery
        gallery.push({
            imageURL: photoLink.getAttribute('data-src'),
            title: photoTitle,
            category: photoCat,
            element: item // Utile pour accéder à l'élément HTML original
        });

        // Crée un écouteur au clic sur l'icône fullscreen, qui récupèrera le bon index et exécutera la fonction openLightbox
        const icon = item.querySelector('.fullscreen__icon');
        icon.addEventListener("click", () => {
            currentIndex = index;
            openLightbox(currentIndex);
        });

        // Écouteurs pour afficher le hover sur les images
        const photoLinkHover = item.querySelector(".photo__link-hover");
        item.addEventListener("mouseenter", () => {
            photoLinkHover.classList.add("visible");
        });
        item.addEventListener("mouseleave", () => {
            photoLinkHover.classList.remove("visible");
        });
    });

    // Ouvre la lightbox en se référent à l'image en cours (clic ou nav prev next)
    function openLightbox(index) {
        const photo = gallery[index];
        lightbox.classList.add('visible');
        lightboxPhoto.innerHTML = '';
        // Création d'une variable qui contiendra la balise de l'image en cours
        const imageLightbox = document.createElement("img");
        imageLightbox.src = photo.imageURL;
        lightboxPhoto.appendChild(imageLightbox);
        lightboxTitle.innerHTML = photo.title;
        lightboxCat.innerHTML = photo.category;
        // Annule scroll du body
        bodyScrollLock.disableBodyScroll(lightbox);
    }

    // Evènement au clic sur le bouton Fermer qui supprimera la classe "visible" de la Lightbox
    closeLightbox.addEventListener("click", () => {
        lightbox.classList.remove('visible');
        // Remet le scroll du body
        bodyScrollLock.enableBodyScroll(lightbox);
    });

    // Evènement qui affichera l'image précédent au clic sur le bouton Précédent
    prevLightbox.addEventListener("click", () => {
        currentIndex = (currentIndex > 0) ? currentIndex - 1 : gallery.length - 1;
        openLightbox(currentIndex);
    });

    // Evènement qui affichera l'image suivante au clic sur le bouton Suivant
    nextLightbox.addEventListener("click", () => {
        currentIndex = (currentIndex < gallery.length - 1) ? currentIndex + 1 : 0;
        openLightbox(currentIndex);
    });
}

// Rendre initLightbox accessible globalement
window.initLightbox = initLightbox;

// Initialiser la lightbox au chargement de la page
document.addEventListener("DOMContentLoaded", () => {
    initLightbox();
});