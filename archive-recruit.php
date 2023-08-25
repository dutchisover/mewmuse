<?php get_header(); ?>

<?php
//記事 取得
$tax_posts = get_posts(
	array(
		'post_type' => 'recruit',
		'posts_per_page' => -1,
		'paged' => get_query_var('paged'),
	)
);
?>

<main class="post recruit">
	<h1 class="post_title page_title wrapper">Recruit</h1>

	<?php if ($tax_posts) : ?>
		<p class="recruit_copy">
			一人ひとりがより豊かな人生を<br class="pc_none">歩めるようにお手伝いをする<br>
			<span>mew museでは新たなメンバーを募集しております。</span>
		</p>
	<?php endif; ?>

	<div class="recruit_container wrapper">

		<div class="recruit_list">
			<?php
			if ($tax_posts) {
				foreach ($tax_posts as $i => $tax_post) {
					setup_postdata($tax_post);
					$tax_id = $tax_post->ID;

					// タイトルを取得
					$tax_title = get_the_title($tax_post->ID);

					// 書き出し
					echo '
					<div class="recruit_list_item">
					<a href="' . get_permalink($tax_post->ID) . '">
						<h2 class="recruit_list_title">' . $tax_title . '</h2>
						</a>
					</div>
				';
				}
			} else {
				echo '<div class="comingsoon">Coming soon…</div>';
			}
			?>

		</div>
	</div>

	<?php if ($tax_posts) : ?>
		<div class="button_area">
			<div class="button button-recruit">
				<a href="<?= home_url('entry'); ?>" class="button_link">Entry</a>
			</div>
		</div>
	<?php endif; ?>

</main>


<?php get_footer(); ?>
