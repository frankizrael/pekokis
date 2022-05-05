<footer>
    <div class="x-container">
        <div class="footer-flex">
            <?php
                $footer = get_field('footer','options');
                if ($footer) {
                    foreach ($footer as $ff) {
                        ?>
                <div class="footer-item">
                    <h2>
                        <i><img src="<?php echo $ff['img']; ?>"></i>
                        <span><?php echo $ff['text']; ?></span>
                    </h2>
                    <div>
                        <?php echo $ff['content']; ?>
                    </div>
                </div>
                        <?php
                    }
                }
            ?>
        </div>
    </div>
</footer>

<script>
    var ajaxUrl = '<?php echo site_url()?>/wp-admin/admin-ajax.php';
</script>
<?php wp_footer() ?>
</body>
</html>