<?php wp_footer(); ?>

<?php get_template_part( 'parts/contact' ); ?>

<footer class="footer">
        <?php
            wp_nav_menu([
                'theme_location' => 'footer-menu',
                ]);
        ?>
</footer>

    </body>
</html>