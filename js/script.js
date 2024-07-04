console.log("on me récupère bien");

const modale = document.getElementById('modale-contact');
const boutonContact = document.getElementById('menu-item-20');
const boutonContactSite = document.querySelector('.btn__contact');
const boutonBurger = document.querySelector('.menu__burger');
const menu = document.querySelector('.menu__list');
// Ajout Ref Input
const inputRef = document.getElementById('reference');
const reference = document.querySelector('.photo__reference');

// Modale Contact
boutonContact.addEventListener("click", () => {
    modale.classList.add("active");
})

boutonContactSite.addEventListener("click", () => {
    modale.classList.add("active");
    inputRef.value = reference.innerHTML;
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

console.log(inputRef);
console.log(reference);