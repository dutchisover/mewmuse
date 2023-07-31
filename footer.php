<footer class="footer">
	<div class="footer_inner">
		<a href="<?= home_url(); ?>" class="footer_logo">
			<img src="<?= get_template_directory_uri(); ?>/image/footer_logo.svg" alt="" class="footer_logo_image">
		</a>

		<div class="footer_nav">
			<ul class="footer_nav_list">
				<li><a href="<?= home_url(); ?>/news">お知らせ</a></li>
			</ul>
		</div>

	</div>

	<div class="footer_bottom">
		<small class="footer_copyright"></small>
	</div>
</footer>


<?php wp_footer(); ?>
</body>

</html>
