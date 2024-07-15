jQuery(document).ready(function($) {

    function loadMore(paged, nonce, categorie, format, order) {
        $.ajax({
          type: 'POST',
          url: '/wp-admin/admin-ajax.php',
          dataType: 'json',
          data: {
            action: 'motaphoto_loadmore',
            paged: paged,
            nonce: nonce,
            categorie: categorie,
            format: format,
            order: order
          },
          success: function (response) {
            console.log('AJAX Response:', response);
            if(paged >= response.max) {
                $('.js__loadmore').hide();
            } else {
                $('.js__loadmore').show();
            }
            if (paged === 1) {
                $('.photo__list').html(response.html);
            } else {
                $('.photo__list').append(response.html);
            }
          },
          error: function(jqXHR, textStatus, errorThrown) {
            console.log("Erreur AJAX : " + textStatus + ", " + errorThrown);
            }
        });
      }

    let newPage = 1;
    $('.js__loadmore').on('click', function(){
        const nonce = $(this).data('nonce');
        const categorie = $('#filter__categories').val();
        const format = $('#filter__formats').val();
        const order = $('#filters__trier-par').val() === 'plus-anciennes' ? 'ASC' : 'DESC';
        
        loadMore(newPage + 1, nonce, categorie, format, order);
        newPage++;

        console.log('clic sur le bouton charger plus');
    });

    $('#filters__form select').on('change', function(){
        newPage = 1;
        const nonce = $('.js__loadmore').data('nonce');
        const categorie = $('#filter__categories').val();
        const format = $('#filter__formats').val();
        const order = $('#filters__trier-par').val() === 'plus-anciennes' ? 'ASC' : 'DESC';
        
        //$('.photo__list').html('');
        loadMore(newPage, nonce, categorie, format, order);

        console.log('clic sur un filtre');
    });

    // Nice Select
    $('#filter__categories').niceSelect();
    $('#filter__formats').niceSelect();
    $('#filters__trier-par').niceSelect();

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