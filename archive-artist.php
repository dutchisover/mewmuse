<?php get_header(); ?>

<?php
// カスタム投稿のslug
// $archive_slug = esc_html(get_post_type_object(get_post_type())->name);
?>


<main class="post artist">
	<h1 class="post_title page_title wrapper">Artist</h1>

	<div class="artist_container wrapper">

		<?php
		//記事 取得
		$tax_posts = get_posts(
			array(
				'post_type' => 'artist',
				'posts_per_page' => -1,
				'paged' => get_query_var('paged'),
			)
		);

		if ($tax_posts) {
			foreach ($tax_posts as $i => $tax_post) {
				setup_postdata($tax_post);
				$tax_id = $tax_post->ID;

				// タイトルを取得
				$tax_title = get_the_title($tax_post->ID);

				// アイキャッチ画像情報を取得
				$artist_photo = get_the_post_thumbnail($tax_id, 'full', array('class' => 'artist_photo'));

				// 書き出し
				echo '
					<div class="artist_item">
						<a href="' . get_permalink($tax_post->ID) . '" class="post_link image_link">
					<div class="artist_photo_box">' . $artist_photo . '</div>
					<p class="artist_name">' . $tax_title . '</p>
						</a>
					</div>
				';
			}
		} else {
			echo
			'<div class="comingsoon">Coming soon…</div>';
		}
		?>

	</div>


</main>


<?php get_footer(); ?>