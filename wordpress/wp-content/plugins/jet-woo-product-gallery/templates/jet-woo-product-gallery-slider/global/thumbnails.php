<?php
/**
 * JetGallery Slider thumbnails template.
 */

$image_src = wp_get_attachment_image_src( $attachment_id, 'full' );
$image     = $this->get_gallery_image( $attachment_id, $settings['image_size'], $image_src, false );
?>

<div class="jet-woo-product-gallery__image-item swiper-slide">
	<div class="jet-woo-product-gallery__image <?php echo $zoom_class ?>">
		<?php
		if ( $enable_gallery && 'button' === $gallery_trigger ) {
			$this->get_gallery_trigger_button( $this->render_icon( 'gallery_button_icon', '%s', '', false ) );
		}

		printf(
			'<a class="jet-woo-product-gallery__image-link %s" href="%s" itemprop="image" title="%s" rel="prettyPhoto%s">%s</a>',
			$trigger_class,
			esc_url( $image_src[0] ),
			get_post_field( 'post_title', $attachment_id ),
			'[jet-gallery]',
			$image
		);
		?>
	</div>
</div>