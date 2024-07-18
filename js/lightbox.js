//Hover sur les images
const photoListItems = document.querySelectorAll('.photo__list-item');

photoListItems.forEach((item) => {
    const photoLinkHover = item.querySelector('.photo__link-hover');

    item.addEventListener("mouseenter", () => {
        photoLinkHover.classList.add('visible');
    })

    item.addEventListener("mouseleave", () => {
        photoLinkHover.classList.remove('visible');
    })
});

//Lightbox
const lightbox = document.getElementById('lightbox'); 
// Récupère la div de la Lightbox
const iconFullscreen = document.querySelectorAll('.fullscreen__icon'); 
// Récupère toutes les icônes fullscreen
const lightboxPhoto = document.querySelector('.lightbox__photo'); 
// Récupère la div contenant la photo dans la Lightbox

iconFullscreen.forEach((icon) => {
    icon.addEventListener("click", (event) => {
        const photoLink = event.target.closest('.photo__list-item').querySelector('.photo__link img');
        // Récupère l'image contenu dans la div photo__link sur laquelle se situe l'icône fullscreen
        const imageURL = photoLink.getAttribute('data-src');
        // La variable prend la valeur data-src soit l'URL de l'image sur laquelle on clique
        
        lightbox.classList.add('visible'); // Ouverture de la lightbox

        lightboxPhoto.innerHTML = ''; // On vide la div contenant la photo

        const imageLightbox = document.createElement("img");
        // Création d'un élément image

        imageLightbox.src = imageURL;
        lightboxPhoto.appendChild(imageLightbox);

        // Récupération des infos de titre et de catégorie
        const lightboxTitle = document.querySelector('.lightbox__info-title');
        const lightboxCat = document.querySelector('.lightbox__info-cat');

        lightboxTitle.innerHTML = '';
        lightboxCat.innerHTML = '';

        const photoTitle = event.target.closest('.photo__list-item').querySelector('.photo__title');
        const photoCat = event.target.closest('.photo__list-item').querySelector('.photo__cat');

        lightboxTitle.innerHTML = photoTitle.innerHTML;
        lightboxCat.innerHTML = photoCat.innerHTML;

        const currentPhoto = document.querySelector('.lightbox__photo img');
        console.log(currentPhoto);
    });
});

const closeLightbox = document.querySelector('.lightbox__close');

closeLightbox.addEventListener("click", () => {
    lightbox.classList.remove('visible');
})

const links = document.querySelectorAll('.photo__link');
const gallery = Array.from(links);
console.log(links);
console.log(gallery);

const prevLightbox = document.querySelector('.lightbox__prev');
const nextLightbox = document.querySelector('.lightbox__next');
