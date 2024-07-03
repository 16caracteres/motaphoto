console.log("on me récupère bien");

const modale = document.getElementById('modale-contact');
const boutonContact = document.getElementById('menu-item-20');
const boutonBurger = document.querySelector('.menu__burger');
const menu = document.querySelector('.menu__list');

// Modale Contact
boutonContact.addEventListener("click", () => {
    modale.classList.add("active");
})

modale.addEventListener("click", (event) => {
    if (event.target == modale) {
        modale.classList.remove("active");
    }
    
})

// Menu Burger
boutonBurger.addEventListener("click", () => {
    menu.classList.toggle("active");
})