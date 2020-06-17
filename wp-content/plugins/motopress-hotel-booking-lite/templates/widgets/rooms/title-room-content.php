<?php
/**
 * Available varialbes
 * - bool $isShowTitle
 *
 * @version 2.0.0
 */
if ( !defined( 'ABSPATH' ) ) {
	exit;
}
if ( post_password_required() ) {
	$isShowImage = $isShowDetails = $isShowPrice = $isShowBookButton = false;
}
$wrapperClass = apply_filters( 'mphb_widget_rooms_item_class', join( ' ', mphb_tmpl_get_filtered_post_class( '' ) ) );
?>
<li>
    <div class="<?php echo esc_attr( $wrapperClass ); ?>">
        <?php do_action( 'mphb_widget_rooms_item_top' ); ?>
        <?php if ( $isShowTitle ) : ?>
            <a href="<?php esc_url( the_permalink() ); ?>">
                <?php the_title(); ?>
            </a>
        <?php endif; ?>
    </>
</li>