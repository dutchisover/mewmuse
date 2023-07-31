<?php


// SSLリダイレクト
// if (empty($_SERVER['HTTPS'])) {
// 	header("HTTP/1.1 301 Moved Permanently");
// 	header("Location: https://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}");
// 	exit;
// }



////////////////// JS・CSSファイルを読み込む //////////////////
function add_files()
{
	//キャッシュ無効（開発時はこちらをコメント解除）
	// $cache = date('YmdHis');
	//キャッシュ有効（公開後はこちらをコメント解除）
	$cache = 1.0;

	// WordPress提供のjquery.jsを読み込まない
	wp_deregister_script('jquery');
	// jQueryの読み込み
	wp_enqueue_script('jquery', '//ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js', "", $cache, false);

	// slick読み込み（CSS、JS）
	// wp_enqueue_style('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', "", $cache);
	// wp_enqueue_style('slick-theme', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css', "", $cache);
	// wp_enqueue_script('slick', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), $cache, false);

	// inview読み込み
	// wp_enqueue_script('inview', get_template_directory_uri() . '/js/jquery.inview.min.js', array(), $cache, true);

	// スクロール固定読み込み
	// wp_enqueue_script('bodyScrollLock', get_template_directory_uri() . '/js/bodyScrollLock.min.js', array(), $cache, true);

	// AOS読み込み（CSS、JS）
	// wp_enqueue_style('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.css', "", $cache);
	// wp_enqueue_script('aos', 'https://unpkg.com/aos@2.3.1/dist/aos.js', "", $cache, false);

	// Googleアイコン
	// wp_enqueue_style('googleicon', 'https://fonts.googleapis.com/css2?family=Material+Icons', "", $cache);
	// wp_enqueue_style('fontawesome', 'https://use.fontawesome.com/releases/v5.15.3/css/all.css', "", $cache);

	// サイト共通（CSS、JS）
	wp_enqueue_style('style', get_template_directory_uri() . '/css/style.css', "", $cache);
	wp_enqueue_script('main-script', get_template_directory_uri() . '/js/script.js', array(), $cache, true);
}
add_action('wp_enqueue_scripts', 'add_files');




////////////////// titleタグの出力 //////////////////
// function insert_title()
// {
// 	add_theme_support('title-tag');
// }
// add_action('after_setup_theme', 'insert_title');

add_theme_support('title-tag');
function change_title_separator($sep)
{
	$sep = ' | ';
	return $sep;
}
add_filter('document_title_separator', 'change_title_separator');




////////////////// 投稿アーカイブページの作成 //////////////////
function post_has_archive($args, $post_type)
{

	if ('post' == $post_type) {
		$args['rewrite'] = true;
		$args['has_archive'] = 'news'; //任意のスラッグ名
	}
	return $args;
}
add_filter('register_post_type_args', 'post_has_archive', 10, 2);




////////////////// 【表示カスタマイズ】 //////////////////

// descrpition自動化
add_post_type_support('page', 'excerpt');
remove_filter('the_excerpt', 'wpautop');
remove_filter('term_description', 'wpautop');

// アイキャッチ画像の有効化
add_theme_support('post-thumbnails');

// 段落で行間追加
add_theme_support('custom-line-height');

// 画像カバーで単位追加
add_theme_support('custom-units', 'px', 'em', 'rem', 'vh', 'vw');






////////////////// ACFプロ用 オプションページ //////////////////
// acf_add_options_page(
// 	array(
// 		'page_title' => 'バナー登録', // ページで表示されるタイトル
// 		'menu_title' => 'バナー登録', // メニューで表示されるタイトル
// 		'menu_slug'  => 'top-banner', // 管理画面のメニュースラッグ
// 		'capability' => 'edit_posts', // このメニューが表示されるユーザーの権限
// 		'redirect'   => true, // メニュークリック時、sub_pageにリダイレクトするか（デフォルトはtrue）
// 		'position' => 5,
// 		'icon_url' => 'dashicons-welcome-write-blog'
// 	)
// );




////////////////// OGPタグ/Twitterカード設定を出力 //////////////////
function my_meta_ogp()
{
	//設定
	$ogp_image_url = get_stylesheet_directory_uri() . '/image/ogp.jpg';
	$twitter_id = "@" . "";
	$facebook_id = "";
	//設定ここまで

	if (is_front_page() || is_home() || is_singular()) {
		global $post;
		$ogp_title = '';
		$ogp_descr = '';
		$ogp_url = '';
		$ogp_img = '';
		$insert = '';

		if (is_singular()) { //記事＆固定ページ
			setup_postdata($post);
			$ogp_title = $post->post_title;
			$ogp_descr = mb_substr(get_the_excerpt(), 0, 100);
			$ogp_url = get_permalink();
			wp_reset_postdata();
		} elseif (is_front_page() || is_home()) { //トップページ
			$ogp_title = get_bloginfo('name');
			$ogp_descr = get_bloginfo('description');
			$ogp_url = home_url();
		}

		//og:type
		$ogp_type = (is_front_page() || is_home()) ? 'website' : 'article';

		//og:image
		if (is_singular() && has_post_thumbnail()) {
			$ps_thumb = wp_get_attachment_image_src(get_post_thumbnail_id(), 'full');
			$ogp_img = $ps_thumb[0];
		} else {
			$ogp_img = $ogp_image_url;
		}

		//出力するOGPタグをまとめる
		$insert .= '<meta property="og:title" content="' . esc_attr($ogp_title) . '" />' . "\n";
		$insert .= '<meta property="og:description" content="' . esc_attr($ogp_descr) . '" />' . "\n";
		$insert .= '<meta property="og:type" content="' . $ogp_type . '" />' . "\n";
		$insert .= '<meta property="og:url" content="' . esc_url($ogp_url) . '" />' . "\n";
		$insert .= '<meta property="og:image" content="' . esc_url($ogp_img) . '" />' . "\n";
		$insert .= '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
		$insert .= '<meta name="twitter:card" content="summary_large_image" />' . "\n";
		$insert .= '<meta name="twitter:site" content="' . $twitter_id . '" />' . "\n";
		$insert .= '<meta property="og:locale" content="ja_JP" />' . "\n";

		//facebookのapp_id（設定する場合）
		$insert .= '<meta property="fb:app_id" content="' . $facebook_id . '">' . "\n";
		//app_idを設定しない場合ここまで消す

		echo $insert;
	}
} //END my_meta_ogp
add_action('wp_head', 'my_meta_ogp'); //headにOGPを出力
