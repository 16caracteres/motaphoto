console.log("on me récupère bien");

const modale = document.getElementById('modale-contact');
const modalePopup = document.querySelector(".contact__popup");
const bouton = document.getElementById('menu-item-20');

console.log(modale);
console.log(bouton);

bouton.addEventListener("click", () => {
    modale.classList.add("active");
    //modale.style.display = "flex";
})

modale.addEventListener("click", (event) => {
    if (event.target == modale) {
        modale.classList.remove("active");
    }
    
})