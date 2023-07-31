	<!DOCTYPE html>
	<html lang="ja" prefix="og: http://ogp.me/ns#">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- Web Fonts -->
		<!-- <link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
		<link href="https://fonts.googleapis.com/css2?family=Zen+Kaku+Gothic+Antique:wght@400;500;700&display=swap" rel="stylesheet"> -->

		<!-- ファビコン -->
		<!-- <link rel="icon" href="<?= get_template_directory_uri(); ?>/image/favicon.ico"> -->

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
				<a href="<?= home_url(); ?>" class="header_logo">
					<img src="<?= get_template_directory_uri(); ?>/image/logo.svg" alt="" class="header_logo_image">
				</a>

				<nav class="header_nav">
					<ul class="header_nav_list">
						<li><a href="<?= home_url(); ?>" data-current="">テスト</a></li>
						<li><a href="<?= home_url(); ?>/news" data-current="news">お知らせ</a></li>
					</ul>

					<button class="header_nav_button-close pc_none">
						<img src="<?= get_template_directory_uri(); ?>/image/sp_button_close.svg" alt="メニューを閉じる" width="20" height="20">
					</button>

					<div class="header_nav_bg pc_none"></div>
				</nav>

				<button class="header_nav_button pc_none">
					<img src="<?= get_template_directory_uri(); ?>/image/sp_button.svg" alt="メニューを開く" width="20" height="18">
				</button>
			</div>
		</header>


		<div class="cv">
			<div class="cv_inner">
				<a href="" class="cv_button" target="_blank" rel="noopener noreferrer"></a>
			</div>
		</div>
