<?php
/**
 * Template part for displaying a message that posts cannot be found.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Newsmag
 */

?>

<section class="no-results col-xs-12 not-found">
	<header class="page-header">
		<h3 class="page-title"><span>Ничего не найдено</span></h3>
	</header><!-- .page-header -->

	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) :
		?>

			<p><?php printf( wp_kses( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'newsmag' ), array( 'a' => array( 'href' => array() ) ) ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php esc_html_e( 'Извините, но ничего не соответствует вашим условиям поиска. Пожалуйста, попытайтесь снова с другими ключевыми словами.', 'newsmag' ); ?></p>
			<?php
			get_search_form();

		else :
		?>

			<p><?php esc_html_e( 'Кажется, мы не можем найти то, что вы ищете. Возможно, поиск может помочь.', 'newsmag' ); ?></p>
			<?php
			get_search_form();

		endif;
		?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
