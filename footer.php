<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package justg
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

$container = get_theme_mod( 'justg_container_type' );
?>

<?php do_action('justg_do_footer'); ?>

</div><!-- #page we need this extra closing tag here -->

<div class="footbar">contoh saja</div>

<?php wp_footer(); ?>

</body>

</html>

