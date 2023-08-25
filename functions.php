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

	// Swiper読み込み（CSS、JS）
	wp_enqueue_style('swiper', '//cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css', "", $cache);
	wp_enqueue_script('swiper', '//cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js', array(), $cache, true);


	// inview読み込み
	// wp_enqueue_script('inview', get_template_directory_uri() . '/js/jquery.inview.min.js', array(), $cache, true);

	// スクロール固定読み込み
	wp_enqueue_script('bodyScrollLock', get_template_directory_uri() . '/js/bodyScrollLock.min.js', array(), $cache, true);

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
acf_add_options_page(
	array(
		'page_title' => '404音源', // ページで表示されるタイトル
		'menu_title' => '404音源', // メニューで表示されるタイトル
		'menu_slug'  => 'music404', // 管理画面のメニュースラッグ
		'capability' => 'edit_posts', // このメニューが表示されるユーザーの権限
		'redirect'   => true, // メニュークリック時、sub_pageにリダイレクトするか（デフォルトはtrue）
		'position' => 5,
		'icon_url' => 'dashicons-welcome-write-blog'
	)
);




// 投稿画面にCSSを当てる
function add_admin_style()
{
	$path_css = get_template_directory_uri() . '/css/editor.css';
	wp_enqueue_style('admin_style', $path_css);
	// $path_js = get_template_directory_uri() . '/assets/js/admin.js';
	// wp_enqueue_script('admin_script', $path_css);
}
add_action('admin_enqueue_scripts', 'add_admin_style');



// カスタム投稿名recruitの投稿を全て取得し、各投稿のタイトルをuser_workのプルダウンの値として挿入する
function set_select_children($children, $atts)
{
	if ($atts['name'] == 'user_work') {
		$args = array(
			'post_type' => 'recruit',
			'posts_per_page' => -1,
			'post_status' => 'publish'
		);
		$posts = get_posts($args);
		foreach ($posts as $post) {
			$children[$post->post_title] = $post->post_title;
		}
	}
	return $children;
}
add_filter('mwform_choices_mw-wp-form-124', 'set_select_children', 10, 2);



// タグ一覧のURL正規化

// add_filter('user_trailingslashit', 'rem_cat_func');
// function rem_cat_func($link)
// {
// 	return str_replace("/schedule_cat/", "schedule/", $link);
// }
// add_action('init', 'rem_cat_flush_rules');
// function rem_cat_flush_rules()
// {
// 	global $wp_rewrite;
// 	$wp_rewrite->flush_rules();
// }
// add_filter('generate_rewrite_rules', 'rem_cat_rewrite');
// function rem_cat_rewrite($wp_rewrite)
// {
// 	$new_rules = array('(.+)/page/(.+)/?' => 'index.php?category_name=' . $wp_rewrite->preg_index(1) . '&paged=' . $wp_rewrite->preg_index(2));
// 	$wp_rewrite->rules = $new_rules + $wp_rewrite->rules;
// }
