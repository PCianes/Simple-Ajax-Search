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
<div class="search">
	<input type="text" name="search" id="search" placeholder="Realiza una busqueda...">
	<div id="category">
		<?php foreach ( $categories as $category ) : ?>
			<input class="pc-custom-check" id="<?php echo (int) $category->term_id; ?>" type="checkbox" checked/>
			<label class="pc-custom-check-label" for="<?php echo (int) $category->term_id; ?>" title="Haz click para seleccionar"><?php echo esc_html( $category->name ); ?></label>
		<?php endforeach; ?>
	</div>
</div>

<div id="result"></div>
