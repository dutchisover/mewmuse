<?php get_header(); ?>

<?php
// カスタム投稿のslug
$archive_slug = esc_html(get_post_type_object(get_post_type())->name);
// タームのslug
// カスタム投稿のタイトル
$single_title = esc_html(get_post_type_object(get_post_type())->labels->singular_name);
?>


<main class="post <?= $archive_slug; ?>">
	<h1 class="post_title page_title wrapper"><?= $single_title; ?></h1>

	<div class="<?= $archive_slug; ?>_container wrapper">

		<div class="faq_list">
			<?php
			//記事 取得
			$faq_posts = get_posts(
				array(
					'post_type' => 'faq',
					'posts_per_page' => -1,
					'paged' => get_query_var('paged'),
				)
			);

			if ($faq_posts) :
				foreach ($faq_posts as $i => $faq_post) :
					setup_postdata($faq_post);
					$faq_id = $faq_post->ID;

					// タイトルを取得
					$faq_title = get_the_title($faq_post->ID);

					// 初回判定
					$open = "";
					if ($faq_post === reset($faq_posts)) {
						$open = "open";
					}

					// 書き出し
			?>
					<dl class="faq_item <?= $open; ?>">
						<dt class="faq_question js-ac">
							<span class="faq_label">Q</span>
							<p><?php echo $faq_title; ?></p>
						</dt>
						<dd class="faq_answer">
							<span class="faq_label">A</span><?php echo the_content(); ?>
						</dd>
					</dl>
			<?php
				endforeach;
			endif;
			?>
		</div>
	</div>
</main>


<?php get_footer(); ?>
