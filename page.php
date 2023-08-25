<?php get_header(); ?>

<?php
// カスタム投稿のslug
global $post;
$post_slug = $post->post_name;
// タームのslug
// カスタム投稿のタイトル
$single_title = esc_html(get_post_type_object(get_post_type())->labels->singular_name);
?>

<main class="page <?= $post_slug; ?>">
	<section class="page_section <?= $post_slug; ?>_section wrapper">
		<h1 class="page_title"><?= get_the_title(); ?></h1>

		<div class="page_content">
			<?php
			if (have_posts()) :
				while (have_posts()) : the_post();
					the_content();
				endwhile;
			endif;
			?>
		</div>

	</section>
</main>


<?php get_footer(); ?>
