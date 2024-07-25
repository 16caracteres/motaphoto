// Modale Contact
const modale = document.getElementById('modale-contact');
const boutonContact = document.getElementById('menu-item-20');
const boutonContactSite = document.querySelector('.btn__contact');

// Ajout Ref Input
const inputRef = document.getElementById('reference');
const reference = document.querySelector('.photo__reference');

boutonContact.addEventListener("click", () => {
    modale.classList.add("active");
})


if (boutonContactSite) {
    boutonContactSite.addEventListener("click", () => {
        modale.classList.add("active");
        inputRef.value = reference.innerHTML;
    })
}

modale.addEventListener("click", (event) => {
    if (event.target == modale) {
        modale.classList.remove("active");
    }
    
})

// Menu Burger
const body = document.body;
const boutonBurger = document.querySelector('.menu__burger');
const menu = document.querySelector('.menu__list-burger');
const boutonContactBurger = document.querySelector('.menu__list-burger .menu-item-20');

boutonBurger.addEventListener("click", () => {
    menu.classList.toggle("active");
    boutonBurger.classList.toggle("active");
    body.classList.toggle("no-scroll");
})


boutonContactBurger.addEventListener("touchend", () => {
    modale.classList.add("active");
})

/*************/

// Pagination Single.php
const previousPhoto = document.querySelector('.photo__preview-previous');
const nextPhoto = document.querySelector('.photo__preview-next');
const arrowLeft = document.querySelector('.arrow_left');
const arrowRight = document.querySelector('.arrow_right');

if (previousPhoto && nextPhoto) {
    arrowLeft.addEventListener("mouseover", () => {
        previousPhoto.classList.add("visible");
    })
    
    arrowLeft.addEventListener("mouseout", () => {
        previousPhoto.classList.remove("visible");
    })
    
    arrowRight.addEventListener("mouseover", () => {
        nextPhoto.classList.add("visible");
    })
    
    arrowRight.addEventListener("mouseout", () => {
        nextPhoto.classList.remove("visible");
    })
}