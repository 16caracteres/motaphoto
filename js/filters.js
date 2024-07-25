jQuery(document).ready(function($) {

    // Fonction pour réinitialiser les sélecteurs au chargement de la page
    function resetSelects() {
        $('#filter__categories option:selected').removeAttr('selected');
        $('#filter__formats option:selected').removeAttr('selected');
        $('#filters__trier-par option:selected').removeAttr('selected');
        $('#filter__categories').niceSelect('update');
        $('#filter__formats').niceSelect('update');
        $('#filters__trier-par').niceSelect('update');
    }
    // On appelle la fonction nouvellement créée
    resetSelects();

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
            // On réinitialise la lightbox après modification du DOM
            if (typeof initLightbox === 'function') {
                initLightbox();
            }
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

    });

    $('#filters__form select').on('change', function(){
        newPage = 1;
        const nonce = $('.js__loadmore').data('nonce');
        const categorie = $('#filter__categories').val();
        const format = $('#filter__formats').val();
        const order = $('#filters__trier-par').val() === 'plus-anciennes' ? 'ASC' : 'DESC';
        
        loadMore(newPage, nonce, categorie, format, order);

    });

    // Nice Select
    $('#filter__categories').niceSelect();
    $('#filter__formats').niceSelect();
    $('#filters__trier-par').niceSelect();

});
