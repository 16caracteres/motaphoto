//Mouse over sur les images
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

//Affichage lightbox