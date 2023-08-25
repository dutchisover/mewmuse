<?php get_header(); ?>
<?php
// カスタム投稿のslug
$archive_slug = esc_html(get_post_type_object(get_post_type())->name);
// タームのslug
// カスタム投稿のタイトル
$single_title = esc_html(get_post_type_object(get_post_type())->labels->singular_name);
?>

<main class="single <?= $archive_slug; ?>">
	<article class="wrapper">
		<h1 class="single_title"><?php the_title(); ?></h1>

		<!-- 記事内容 -->
		<div class="single_content schedule_content">

			<?php
			// $schedule_mv = get_post_meta($post->ID, 'schedule_mv', true);
			// $schedule_mv = wp_get_attachment_url($schedule_mv);

			// if ($schedule_mv) {
			// 	echo '<div class="schedule_mv"><img src="' . $schedule_mv . '"></div>
			// 			';
			// }
			?>

			<?php
			// アイキャッチ画像情報を取得
			$schedule_image = get_the_post_thumbnail($post->ID, 'full');
			if ($schedule_image) {
				echo '<div class="schedule_mv">' . $schedule_image . '</div>';
			}
			?>

			<div class="schedule_text">
				<?php
				the_content();
				?>
			</div>
		</div>
		<div class="button_area">
			<div class="button">
				<a href="../" class="button_link" onclick="window.history.back(); return false;">back</a>
			</div>
		</div>


	</article>
</main>


<?php get_footer(); ?>
