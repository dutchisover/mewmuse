<?php get_header(); ?>


<main class="recruit single">

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
				// $single_date = get_the_date('Y.m.d');
				// アイキャッチ画像情報を取得
				$single_image = get_the_post_thumbnail($post->ID, 'full', array('class' => 'single_image'));
				if (!$single_image) {
					$single_image = '';
				}
		?>

				<!-- <div class="single_date">
					<time data-time="<?= $single_date; ?>"><?= $single_date; ?></time>
				</div> -->

				<p class="page_title">Recruit</p>
				<?php
				// アイキャッチ画像
				echo $single_image;

				// 投稿内容

				?>
				<!-- 記事内容 -->
				<div class="single_content recruit_container">
					<h2 class="recruit_title"><?php the_title(); ?></h2>

					<?php
					the_content();
					?>

				</div>

				<div class="button_area">
					<div class="button button-recruit">
						<a href="<?= home_url('entry'); ?>" class="button_link">Entry</a>
					</div>
				</div>
		<?php
			endwhile;
		}
		?>

	</article>
</main>


<?php get_footer(); ?>
