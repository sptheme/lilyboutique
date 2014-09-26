 
    <footer id="footer" role="contentinfo" class="clearfix">
    	<div class="copyright">
            <?php if ( ot_get_option( 'copyright' ) ): ?>
                <?php echo ot_get_option( 'copyright' ); ?>
            <?php else: ?>
                <?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', SP_TEXT_DOMAIN ); ?>
            <?php endif; ?>
        </div><!--/#copyright-->
    </footer><!-- #footer -->

    <?php if ( ot_get_option( 'credit' ) != 'off' ): ?>
    <p class="credit"><?php echo ot_get_option( 'credit-text' ); ?></p><!--/#credit-->
    <?php endif; ?><!--/#credit-->

    </div> <!-- #content-container -->
</div> <!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>