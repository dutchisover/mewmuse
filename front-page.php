<?php get_header(); ?>


<main class="top">
	<div class="mv">
		<div class="mv_inner">
			<h1 class="mv_title"></h1>
		</div>
	</div>

	<section class="top_ section">
		<h2 class="section_title"></h2>

		<div class="button_area">
			<a href="<?= home_url(); ?>/" class="button">ボタン</a>
		</div>
	</section>


	<section class="top_news">
		<div class="top_news_inner">
			<div class="top_news_head">
				<h2 class="top_news_title section_title-sub"></h2>
				<a href="<?= home_url('news'); ?>" class="top_news_link">お知らせ一覧</a>
			</div>

			<?php
			//お知らせ記事 取得
			$tax_posts = get_posts(
				array(
					'post_type' => 'news',
					'posts_per_page' => 5,
					'paged' => get_query_var('paged'),
				)
			);

			if ($tax_posts) {

				echo '<div class="top_news_list">';

				foreach ($tax_posts as $i => $tax_post) {
					setup_postdata($tax_post);

					// 日付取得
					$tax_date = esc_html($tax_post->post_date_gmt);
					$tax_date = mysql2date('Y.m.d', $tax_date);

					// タイトル
					$tax_title = get_the_title($tax_post->ID);

					// 書き出し
					echo '
						<a href="' . get_permalink($tax_post->ID) . '">
							<dl>
								<dt>' . $tax_date . '</dt>
								<dd>' . $tax_title . '</dd>
							</dl>
						</a>
					';
				}

				echo '</div>';
			}
			?>

		</div>
	</section>

</main>


<?php get_footer(); ?>
