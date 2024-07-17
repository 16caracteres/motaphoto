<?php wp_footer(); ?>

<?php 
get_template_part( 'parts/contact' ); 
?>

<div id="lightbox" class="lightbox">
    <button class="lightbox__close"></button>

    <button class="lightbox__prev">Précédente</button>
    <button class="lightbox__next">Suivante</button>

    <div class="lightbox__photo">
        <img src="https://picsum.photos/1280/720" alt="">
        <div class="lightbox__info">
            <span class="lightbox__info-ref">fdlskjflksjdf</span>
            <span class="lightbox__info-cat">Mariage</span>
        </div>
    </div>  
</div>

<footer class="footer">
        <?php
            wp_nav_menu([
                'theme_location' => 'footer-menu',
                'container' => 'ul',
                'menu_class' => 'footer__menu',
                ]);
        ?>
</footer>

    </body>
</html>