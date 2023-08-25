<?php get_header(); ?>

<main class="post schedule">
	<h1 class="post_title page_title wrapper">Schedule</h1>

	<div class="schedule_container wrapper">

		<?php
		// カテゴリー取得
		$terms = get_terms('schedule_cat');

		//記事 取得
		$tax_posts = get_posts(
			array(
				'post_type' => 'schedule',
				'posts_per_page' => 6,
				'paged' => get_query_var('paged'),
				'orderby' => 'post_date',
				'order' => 'DESC',
			)
		);

		if ($tax_posts) {
			echo '<ul class="schedule_category">';

			foreach ($terms as $term) {
				$term_bg = get_field('cat_color_bg', 'schedule_cat_' . $term->term_id);
				$term_text = get_field('cat_color_text', 'schedule_cat_' . $term->term_id);
				$term_border = get_field('cat_color_border', 'schedule_cat_' . $term->term_id);

				echo '<li><a class="schedule_category_item" href="' . get_term_link($term->term_id) . '" style="background-color:' . $term_bg . '; color:' . $term_text . ';border:1px solid ' . $term_border . '">' . $term->name . '</a></li>';
			}
			echo '</ul>';

			echo '<div class="schedule_list">';
			foreach ($tax_posts as $i => $tax_post) {
				setup_postdata($tax_post);
				$tax_id = $tax_post->ID;

				// 日付取得
				$post_date = esc_html($tax_post->post_date_gmt);
				$week_num = mysql2date('N', $post_date) - 1;
				$schedule_week = ['Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat', 'Sun'];
				$schedule_date = mysql2date('Y.n.j', $post_date);

				// タイトルを取得
				$tax_title = get_the_title($tax_post->ID);

				// アイキャッチ画像情報を取得
				$schedule_image = get_the_post_thumbnail($tax_id, 'full', array('class' => 'schedule_image'));
				if (!$schedule_image) {
					$schedule_image = '<img src="' . get_template_directory_uri() .  '/image/noimage.jpg" alt="" class="schedule_image">';
				}
				// 書き出し
				echo '
					<div class="schedule_item">
					<time class="post_date" data-time="' . $schedule_date . '">' . $schedule_date . '<span>' . $schedule_week[$week_num] . '</span></time>
						<a href="' . get_permalink($tax_post->ID) . '" class="schedule_link image_link">
						<div class="schedule_image_box">' . $schedule_image . '</div>
						<p class="schedule_title">' . $tax_title . '</p>
						</a>
					</div>';
			}

			echo '</div>';
		} else {
			// 投稿がない場合はComing soon表示
			echo
			'<div class="comingsoon">Coming soon…</div>';
		}
		?>


		<!-- ページネーション -->
		<div class="pagenation schedule_pagenation">
			<?php wp_pagenavi(); ?>
		</div>


	</div>

</main>


<?php get_footer(); ?>