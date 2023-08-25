<?php get_header(); ?>

<main class="page page404">
	<section class="page404_section">
		<h2 class="page404_title page_title">
			404 Not Found
			<span>お探しのページが見つかりません。</span>
		</h2>

		<p class="section_text page_text page404_text">ページが「移動」もしくは「削除」されたか<br class="pc_none">「一時的にアクセスできない」可能性があります。</p>
		<p class="section_text page_text page404_text">恐れ入りますが、再度トップページから<br class="pc_none">アクセスをお願いいたします。</p>

		<!-- <div class="button_area">
			<div class="button">
				<a href="<?= home_url(); ?>" class="button_link">トップページへ戻る</a>
			</div>
		</div> -->

		<div class="page404_music">
			<?php
			$music = get_field('music', "option");
			$volume = get_field('volume', "option");
			?>
			<audio id="music404" controls="controls" preload="auto" autoplay="autoplay" loop="loop">
				<source src="<?= $music["url"]; ?>">
			</audio>

			<script>
				const audioElement = document.querySelector("#music404");
				audioElement.volume = <?= $volume; ?>;
			</script>
		</div>
	</section>
</main>


<?php get_footer(); ?>
