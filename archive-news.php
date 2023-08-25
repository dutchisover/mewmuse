<?php get_header(); ?>

<main class="post news">
	<h1 class="post_title page_title wrapper">News</h1>
	<div class="news_container wrapper">


		<?php
		// カテゴリー取得
		$terms = get_terms('news_cat');
		//記事 取得
		$tax_posts = get_posts(
			array(
				'post_type' => 'news',
				'posts_per_page' => 5,
				'paged' => get_query_var('paged'),
				'orderby' => 'post_date',
				'order' => 'DESC',
			)
		);

		if ($tax_posts) {
			echo '<ul class="news_category">
				<li class="current"><a class="news_category_item" href="">All</a></li>';

			foreach ($terms as $term) {
				echo '<li><a class="new_category_item" href="' . get_term_link($term->term_id) . '">' . $term->name . '</a></li>';
			}
			echo '</ul>';
			echo '<div class="news_list">';
			foreach ($tax_posts as $i => $tax_post) {
				setup_postdata($tax_post);
				$tax_id = $tax_post->ID;

				// 日付取得
				$news_date = esc_html($tax_post->post_date_gmt);
				$news_date = mysql2date('Y.n.j', $news_date);

				// タイトルを取得
				$tax_title = get_the_title($tax_post->ID);

				//カテゴリー（タクソノミー）の取得
				$cat = get_the_terms($tax_id, 'news_cat');
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
				// 書き出し
				echo '
					
					<div class="news_list_item">
					<a href="' . get_permalink($tax_post->ID) . '">
					<div class="news_list_label">
					<time class="news_list_date" data-time="' . $news_date . '">' . $news_date . '</time>'
					. $cat_html .
					'</div>
						<h2 class="news_list_title">' . $tax_title . '</h2>
						</a>
					</div>
					
				';
			}

			echo '</div>';
		} else {
			// 投稿がない場合はComing soon表示
			echo
			'<div class="comingsoon">Coming soon…</div>';
		}

		?>

		<!-- ページネーション -->
		<div class="pagenation news_pagenation">
			<?php wp_pagenavi(); ?>
		</div>

	</div>

</main>


<?php get_footer(); ?>