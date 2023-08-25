<?php get_header(); ?>


<main class="single">

	<article class="single_wrapper wrapper">

		<?php
		if (have_posts()) {
			while (have_posts()) : the_post();
				// カスタム投稿のslug
				$archive_slug = esc_html(get_post_type_object(get_post_type())->name);
				// タームのslug
				// カスタム投稿のタイトル
				$single_title = esc_html(get_post_type_object(get_post_type())->label);
				// 投稿日
				$single_date = get_the_date('Y.m.d');
				// アイキャッチ画像情報を取得
				$single_image = get_the_post_thumbnail($post->ID, 'full', array('class' => 'single_image'));
				if (!$single_image) {
					$single_image = '';
				}
		?>

				<div class="single_date">
					<time data-time="<?= $single_date; ?>"><?= $single_date; ?></time>
				</div>

				<h1 class="single_title"><?php the_title(); ?></h1>
				<?php
				// アイキャッチ画像
				echo $single_image;

				// 投稿内容

				?>
				<!-- 記事内容 -->
				<div class="single_content">
					<?php
					the_content();
					?>
				</div>

				<div class="button_area">
					<div class="button">
						<a href="../" class="button_link" onclick="window.history.back(); return false;">back</a>
					</div>
				</div>
		<?php
			endwhile;
		}
		?>

	</article>
</main>


<?php get_footer(); ?>
