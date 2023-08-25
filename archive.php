<?php get_header(); ?>

<?php
// カスタム投稿のslug
$archive_slug = esc_html(get_post_type_object(get_post_type())->name);
// タームのslug
// カスタム投稿のタイトル
$single_title = esc_html(get_post_type_object(get_post_type())->labels->singular_name);
?>


<main class="post <?= $archive_slug; ?> wrapper">
	<h2 class="post_title page_title"><?= $single_title; ?></h2>

	<div class="post_inner">

		<?php
		//お知らせ記事 取得
		$tax_posts = get_posts(
			array(
				'post_type' => 'news',
				'posts_per_page' => -1,
				'paged' => get_query_var('paged'),
			)
		);

		if ($tax_posts) {
			foreach ($tax_posts as $i => $tax_post) {
				setup_postdata($tax_post);

				// 日付取得
				$tax_date = esc_html($tax_post->post_date_gmt);
				$tax_date = mysql2date('Y.m.d', $tax_date);

				// タイトル
				$tax_title = get_the_title($tax_post->ID);

				// 書き出し
				echo '
					<div class="post_item">
						<a href="' . get_permalink($tax_post->ID) . '" class="post_link">
							<time class="post_date" data-time="' . $tax_date . '">' . $tax_date . '</time>
							<p class="post_text">' . $tax_title . '</p>
						</a>
					</div>
				';
			}
		}
		?>

	</div>


</main>


<?php get_footer(); ?>