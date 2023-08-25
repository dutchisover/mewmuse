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

		<?php
		if (have_posts()) {
			while (have_posts()) : the_post();
				// カスタム投稿のslug
				$archive_slug = esc_html(get_post_type_object(get_post_type())->name);
				// タームのslug
				// カスタム投稿のタイトル
				$single_title = esc_html(get_post_type_object(get_post_type())->label);
				// 投稿日
				$single_date = get_the_date('Y.n.j');

				//カテゴリー（タクソノミー）の取得
				$cat = get_the_terms(get_the_ID(), 'news_cat');
				// print_r($cat);
				$cat_html = '';
				if ($cat) {
					$cat_data = $cat[0];

					// カテゴリーカラーの取得
					$cat_bg = get_field('cat_color_bg', 'news_cat_' . $cat_data->term_id);
					$cat_text = get_field('cat_color_text', 'news_cat_' . $cat_data->term_id);

					// カテゴリー名とHTML出力
					$cat_name = $cat_data->name;
					if ($cat_name) {
						$cat_html = '<div class="news_list_cat" style="background-color:' . $cat_bg . '; color:' . $cat_text . ';">' . esc_html($cat_name) . '</div>';
					}
				}

		?>
				<div class="news_list_label">
					<time class="news_list_date" data-time="<?= $single_date ?>"><?= $single_date ?></time>
					<?= $cat_html ?>
				</div>
				<h1 class="single_title news_single_title"><?php the_title(); ?></h1>

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
