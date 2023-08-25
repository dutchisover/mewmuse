<?php get_header(); ?>

<?php
// カスタム投稿のslug
$archive_slug = esc_html(get_post_type_object(get_post_type())->name);

// カスタム投稿のタイトル
$single_title = esc_html(get_post_type_object(get_post_type())->labels->singular_name);

// タームの名前を取得
$category_terms = wp_get_object_terms($post->ID, 'news_cat'); // タームの情報を取得
$termname = $category_terms[0]->name;
$term = $category_terms[0]->slug;

//記事 取得
$tax_posts = get_posts(
	array(
		'post_type' => 'news',
		'posts_per_page' => 5,
		'orderby' => 'date',
		'paged' => get_query_var('paged'),
		'tax_query'      => array(
			array(
				'taxonomy' => 'news_cat',
				'field'    => 'slug',
				'terms'    => $term
			)
		)
	)
);
?>


<main class="post <?= $archive_slug; ?>">
	<div class="wrapper">
		<h1 class="post_title page_title"><?= $single_title; ?></h1>

		<div class="<?= $archive_slug; ?>_container">


			<div>
				<ul class="news_category">
					<li><a class="news_category_item" href="<?= home_url(); ?>/news">All</a></li>
					<?php
					// $args = array(
					// 	'post_type' => 'schedule',
					// );
					$terms = get_terms('news_cat');

					foreach ($terms as $value) {
						$current = "";
						if (stristr($value->name, $term)) {
							$current = ' class="current"';
						}
						echo '<li' . $current . '><a class="new_category_item" href="' . get_term_link($value->term_id) . '">' . $value->name . '</a></li>';
					}
					?>
				</ul>
			</div>

			<div class="news_list">
				<?php
				if ($tax_posts) {
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
				}
				?>

			</div>

			<div class="pagenation <?= $archive_slug; ?>_pagenation">
				<?php wp_pagenavi(); ?>
			</div>

		</div>
	</div>
</main>


<?php get_footer(); ?>