console.log("on me récupère bien");

const modale = document.getElementById('modale-contact');
const boutonContact = document.getElementById('menu-item-20');
const boutonContactSite = document.querySelector('.btn__contact');

// Ajout Ref Input
const inputRef = document.getElementById('reference');
const reference = document.querySelector('.photo__reference');

// Modale Contact
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
const boutonBurger = document.querySelector('.menu__burger');
const menu = document.querySelector('.menu__list');

boutonBurger.addEventListener("click", () => {
    menu.classList.toggle("active");
})

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


// Bouton Charger plus
jQuery(document).ready(function($) {

    function loadMore(paged, nonce) {
        $.ajax({
          type: 'POST',
          url: '/wp-admin/admin-ajax.php',
          dataType: 'json',
          data: {
            action: 'motaphoto_loadmore',
            paged: paged,
            nonce: nonce
          },
          success: function (response) {
            if(paged >= response.max) {
              $('.js__loadmore').hide();
            }
            $('.photo__list').append(response.html);
          }
        });
      }

    let newPage = 1;
        $('.js__loadmore').on('click', function(){
            const nonce = $(this).data('nonce');
            loadMore(newPage + 1, nonce);
            newPage++;
    });

    /*let currentPage = 1;
    $('.js__loadmore').on('click', function() {
            console.log('click btn charger plus');

            currentPage++;

            $.ajax({
                type: 'POST',
                url: '/wp-admin/admin-ajax.php',
                dataType: 'json',
                data: {
                    action: 'motaphoto_loadmore',
                    paged: currentPage,
                },
                success: function (response) {
                    if(paged >= response.max) {
                        $('.js__loadmore').hide();
                    }
                    $('.photo__list').append(response);
                }
            });
      });*/
});

/*const boutonLoadMore = document.querySelector('.js__loadmore');
let page = 2;

boutonLoadMore.addEventListener("click", (event) => {
    event.preventDefault();

    const ajaxurl = event.currentTarget.getAttribute('data-ajaxurl');
    console.log(ajaxurl);

    const data = {
        action: event.currentTarget.getAttribute('data-action'),
        nonce: event.currentTarget.getAttribute('data-nonce'),
        postid: event.currentTarget.getAttribute('data-postid')
    }
    console.log(data);

    fetch(ajaxurl, {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
            'Cache-Control': 'no-cache',
        },
        body: new URLSearchParams(data),
    })
    .then(response => response.json())
    .then(body => {
})*/

// Filtres
/*jQuery(document).ready(function($) {
    $('.categories__value-item').on('click', function() {

        console.log("plop plop");
    
        $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',
        data: {
            action: 'motaphoto_filter_categories',
            category: $(this).data('slug'),
        },
        success: function(response) {
            $('.photo__list').html(response);
        }
        })
    })
});*/