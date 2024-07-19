<?php wp_footer(); ?>

<?php 
get_template_part( 'parts/contact' ); 

get_template_part( 'parts/lightbox' ); 
?>

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