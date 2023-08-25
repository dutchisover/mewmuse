<?php get_header(); ?>

<?php
// カスタム投稿のslug
$archive_slug = esc_html(get_post_type_object(get_post_type())->name);
// タームの名前を取得
$category_terms = wp_get_object_terms($post->ID, 'schedule_cat'); // タームの情報を取得
$termname = $category_terms[0]->name;
$taxonomy_slug = $category_terms[0]->slug;
// カスタム投稿のタイトル
$single_title = esc_html(get_post_type_object(get_post_type())->labels->singular_name);
?>


<main class="post <?= $archive_slug; ?>">
	<div class="wrapper">
		<h1 class="post_title page_title"><?= $single_title; ?></h1>

		<div class="<?= $archive_slug; ?>_container">


			<div>
				<ul class="schedule_category">
					<?php
					$terms = get_terms('schedule_cat');
					foreach ($terms as $term) {
						$term_bg = get_field('cat_color_bg', 'schedule_cat_' . $term->term_id);
						$term_text = get_field('cat_color_text', 'schedule_cat_' . $term->term_id);
						$term_border = get_field('cat_color_border', 'schedule_cat_' . $term->term_id);
						$term_slug = $term->slug;
						if ($term_slug === $taxonomy_slug) {
							$current = "current";
						} else {
							$current = "";
						}

						echo '<li><a class="schedule_category_item ' . $current . '" href="' . get_term_link($term->term_id) . '" style="background-color:' . $term_bg . '; color:' . $term_text . ';border:1px solid ' . $term_border . '">' . $term->name . '</a></li>';
					}
					?>
				</ul>
			</div>

			<div class="schedule_list">

				<?php
				// タームの名前を取得
				$category_terms = wp_get_object_terms($post->ID, 'schedule_cat'); // タームの情報を取得
				$termname = $category_terms[0]->name;
				$term = $category_terms[0]->slug;

				//記事 取得
				$tax_posts = get_posts(
					array(
						'post_type' => 'schedule',
						'posts_per_page' => 6,
						'orderby' => 'date',
						'paged' => get_query_var('paged'),
						'tax_query'      => array(
							array(
								'taxonomy' => 'schedule_cat',
								'field'    => 'slug',
								'terms'    => $term
							)
						)
					)
				);


				if ($tax_posts) :
					foreach ($tax_posts as $i => $tax_post) :
						setup_postdata($tax_post);
						$tax_id = $tax_post->ID;

						// 日付取得
						$schedule_date = esc_html($tax_post->post_date_gmt);
						$schedule_date = mysql2date('Y.n.j D', $schedule_date);

						// タイトルを取得
						$tax_title = get_the_title($tax_post->ID);

						// アイキャッチ画像情報を取得
						$schedule_image = get_the_post_thumbnail($tax_id, 'full', array('class' => 'schedule_image'));
						if (!$schedule_image) {
							$schedule_image = '<img src="' . get_template_directory_uri() .  '/image/noimage.jpg" alt="" class="schedule_image">';
						}
						// 書き出し
				?>
						<div class="schedule_item">
							<time class="post_date" data-time="<?php echo $schedule_date; ?>"><?php echo $schedule_date; ?></time>
							<a href="<?php echo get_permalink($tax_post->ID); ?>" class="schedule_link image_link">
								<div class="schedule_image_box"><?php echo $schedule_image; ?></div>
								<p class="schedule_title"><?php echo $tax_title; ?></p>
							</a>
						</div>
				<?php
					endforeach;
				endif;
				wp_reset_postdata();
				?>

			</div>

			<div class="pagenation <?= $archive_slug; ?>_pagenation">
				<?php wp_pagenavi(); ?>
			</div>

		</div>
	</div>

</main>


<?php get_footer(); ?>
