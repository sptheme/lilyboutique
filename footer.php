 
    <footer id="footer" role="contentinfo" class="clearfix">
    	<div class="copyright">
            <?php if ( ot_get_option( 'copyright' ) ): ?>
                <?php echo ot_get_option( 'copyright' ); ?>
            <?php else: ?>
                <?php bloginfo(); ?> &copy; <?php echo date( 'Y' ); ?>. <?php _e( 'All Rights Reserved.', SP_TEXT_DOMAIN ); ?>
            <?php endif; ?>
        </div><!--/#copyright-->
    </footer><!-- #footer -->

    </div> <!-- #content-container -->
</div> <!-- #wrapper -->

<?php wp_footer(); ?>

</body>
</html>