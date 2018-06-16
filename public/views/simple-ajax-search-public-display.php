<?php
/**
 * Provide a public-facing view for the plugin
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://pablocianes.com
 * @since      1.0.0
 *
 * @package    Simple_Ajax_Search
 * @subpackage Simple_Ajax_Search/public/views
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div id="sas-input" class="sas-input">
	<input type="text" name="search" id="search" placeholder="<?php echo esc_html( $content ); ?>">
	<div class="sas-categories">
		<?php foreach ( $categories as $category ) : ?>
			<input class="sas-custom-check" id="<?php echo (int) $category->term_id; ?>" type="checkbox" checked/>
			<label class="sas-custom-check-label" style="background: <?php echo esc_html( $color_label_checked ); ?>;" for="<?php echo (int) $category->term_id; ?>" title="<?php esc_html_e( 'Click to select', 'simple-ajax-search' ); ?>"><?php echo esc_html( $category->name ); ?></label>
		<?php endforeach; ?>
	</div>
</div>
