<?php
// Entryフォームのリダイレクト設定（Recruit募集が0の場合はトップへリダイレクト）
global $post;
if ($post) {
	$post_slug = $post->post_name;
	if ($post_slug === "entry") {
		//Recruitの記事 取得
		$tax_posts = get_posts(
			array(
				'post_type' => 'recruit',
				'posts_per_page' => -1,
				'paged' => get_query_var('paged'),
			)
		);
		if (!$tax_posts) {
			$domain = $_SERVER['HTTP_HOST'];
			header('Location: https://' . $domain);
			exit;
		}
	}
}
?>
<!DOCTYPE html>
<html lang="ja" prefix="og: http://ogp.me/ns#">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<!-- Web Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Marcellus&family=Noto+Sans+JP&family=Zen+Maru+Gothic:wght@500;700&family=Zen+Old+Mincho:wght@400;500;700&display=swap" rel="stylesheet">

	<!-- ファビコン -->
	<link rel="icon" href="<?= get_template_directory_uri(); ?>/image/favicon.ico">

	<?php get_template_part('inc/inc-tag-head'); ?>
	<?php get_template_part('inc/inc-style'); ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<?php get_template_part('inc/inc-tag-body'); ?>

	<div class="loading">
		<div class="loader">Loading...</div>
	</div>

	<header class="header">
		<div class="header_inner">
			<?php if (is_home() || is_front_page()) : ?>
				<h1 class="header_logo">
					<a href="<?= home_url(); ?>"><img src="<?= get_template_directory_uri(); ?>/image/logo_mewmuse.svg" alt="mew museロゴ" class="header_logo_image" width="200" height="63">
					</a>
				</h1>
			<?php else : ?>
				<div class="header_logo">
					<a href="<?= home_url(); ?>"><img src="<?= get_template_directory_uri(); ?>/image/logo_mewmuse.svg" alt="mew museロゴ" class="header_logo_image" width="200" height="63">
					</a>
				</div>
			<?php endif; ?>

			<nav class="header_nav">
				<ul class="header_nav_list">
					<li><a href="<?= home_url(); ?>/artist" data-current="">Artist</a></li>
					<li><a href="<?= home_url(); ?>/faq" data-current="">Q＆A</a></li>
					<li><a href="<?= home_url(); ?>/schedule" data-current="">Schedule</a></li>
					<li><a href="<?= home_url(); ?>/news" data-current="">News</a></li>
					<li><a href="<?= home_url(); ?>/company" data-current="">Company</a></li>
					<li><a href="<?= home_url(); ?>/recruit" data-current="">Recruit</a></li>
					<li><a href="<?= home_url(); ?>/contact" data-current="">Contact</a></li>
					<li class="pc_none">
						<ul class="header_link">
							<!-- <li><a href="" target="_blank" rel="noopener noreferrer"><img src="<?= get_template_directory_uri(); ?>/image/icon_twitter.svg" alt="twitter" class="header_link-twitter" width="50" height="40"></a></li>
							<li><a href="" target="_blank" rel="noopener noreferrer"><img src="<?= get_template_directory_uri(); ?>/image/icon_ticket.svg" alt="ticket" class="header_link-ticket" width="70" height="40"></a></li> -->

							<li><a href="https://t.livepocket.jp/event/search?word=mewmuse株式会社" target="_blank" rel="noopener noreferrer"><img src="<?= get_template_directory_uri(); ?>/image/icon_ticket.svg" alt="ticket" class="header_link-ticket" width="50" height="40"></a></li>
							<li><a href="<?= home_url(); ?>/contact"><img src="<?= get_template_directory_uri(); ?>/image/icon_contact.svg" alt="contact" class="header_link-contact" width="70" height="40"></a></li>
							<li><a href="https://mewmuse.stores.jp" target="_blank" rel="noopener noreferrer"><img src="<?= get_template_directory_uri(); ?>/image/icon_store.svg" alt="store" class="header_link-store" width="50" height="50"></a></li>
						</ul>
					</li>
				</ul>
			</nav>

			<button class="nav_button pc_none">
				<img src="<?= get_template_directory_uri(); ?>/image/nav_button.svg" alt="メニューを開く" width="17" height="17" class="header_nav_button_image">
			</button>
			<button class="nav_button-close pc_none">
				<img src="<?= get_template_directory_uri(); ?>/image/nav_button-close.svg" alt="メニューを閉じる" width="17" height="17" class="header_nav_button_image">
			</button>

		</div>
	</header>