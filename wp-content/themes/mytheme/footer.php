<footer style="background-color: #F2F8FC;">
    <div class="container footer-container">
        <div style="display:flex;flex-direction:column;gap:20px;" id="footer-left">
            <?php
            if (is_active_sidebar('footer_left'))
                dynamic_sidebar('footer_left');
            else {
                echo '<p> widget not found </p>';
            }
            ?>
        </div>
        <div style="display:flex;flex-direction: column;gap:20px;">
            <?php dynamic_sidebar('footer_form'); ?>
            <div class="menu-footer-wrap">
                <?php
                for ($i = 1; $i <= 3; $i++) {
                    if (is_active_sidebar("footer_menu_$i")) {
                        echo '<div class="footer-menu text-footer">';
                             dynamic_sidebar("footer_menu_$i");
                        echo '</div>';
                    } else {
                        echo '<p> widget not found </p>';
                    }
                }
                ?>
            </div>
        </div>
    </div>
    <div style="background-color: #E7F5F8;display: flex;justify-content: center;">
        <?php $footerOption = get_option("footer_theme_option") ?>
        <p class="text-footer" style="padding:35px 0px;"><?php echo $footerOption['copyright_text'] ?: '<p>no copy right</p>' ?></p>
    </div>
</footer>
</body>

<?php
wp_footer();
?>
<script>
    new Glide('.glide').mount()
</script>

</html>