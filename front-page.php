<?php get_header(); ?>


<main class="top">
	<!-- MV -->
	<div class="mv">
		<div class="swiper">
			<div class="swiper-wrapper">
				<?php
				$slide_posts = get_posts(
					array(
						'post_type' => 'artist',
						'posts_per_page' => -1,
						'paged' => get_query_var('page'),
					)
				);

				if ($slide_posts) {
					// 投稿があれば出力
					foreach ($slide_posts as $i => $slide_post) {
						setup_postdata($slide_post);
						$slide_id = $slide_post->ID;
						$slide_name = $slide_post->title;

						// アイキャッチ画像情報を取得
						$slide_photo = get_the_post_thumbnail($slide_id, 'full', array('class' => 'slide_artist_photo'));

						// 書き出し
						echo '<div class="swiper-slide">
					<div class="slide_photo_box">' . $slide_photo . '</div>';

						$slide_logo = get_post_meta($slide_id, 'logo', true);
						$slide_logo = wp_get_attachment_url($slide_logo);

						echo '<div class="slide_logo_box"><img src="' . $slide_logo . '" alt="' . get_the_title($slide_id) . '"></div>
						</div>';
					}
				}
				wp_reset_postdata();
				?>
			</div>
		</div>
	</div>

	<?php
	$logo = get_field('logo');
	if (!empty($logo)) {
	?>
		<img src="<?php echo $logo['url']; ?>" alt="<?php echo $logo['alt']; ?>" />
	<?php } ?>


	<!-- 企業理念 -->
	<section class="top_concept wrapper-large">
		<?php /*
		<!-- テスト3 -->
		<!-- <svg viewBox="0 0 400 300" xmlns="http://www.w3.org/2000/svg" class="fluid">
			<path fill="#ffffff" d="m179.756,32c7.5,25.6,3.3,42.6-21,60-24.4,17.4-111.4,18.2-134,3C2.256,79.8-5.344,61.7,3.756,34,12.756,6.3,68.456.1,98.756,0c30.4,0,73.5,6.5,81,32Z" transform="translate(100 100)">
				<animate attributeType="XML" attributeName="d" dur="8s" repeatCount="indefinite" values="
                    m179.756,32c7.5,25.6,3.3,42.6-21,60-24.4,17.4-111.4,18.2-134,3C2.256,79.8-5.344,61.7,3.756,34,12.756,6.3,68.456.1,98.756,0c30.4,0,73.5,6.5,81,32Z;
                    m178.204,13.484c7.5,25.6-.7,43.6-25,61-24.4,17.4-94.4,15.2-117,0C13.704,59.284-6.896,43.184,2.204,15.484,11.204-12.216,65.904,6.584,96.204,6.484c30.4,0,74.5-18.5,82,7Z;
                    m179.576,30c7.5,25.6-15.7,41.6-40,59-24.4,17.4-91.4,17.2-114,2C3.076,75.8-5.524,59.7,3.576,32,12.576,4.3,63.276.1,93.576,0c30.4,0,78.5,4.5,86,30Z;
                    m179.756,32c7.5,25.6,3.3,42.6-21,60-24.4,17.4-111.4,18.2-134,3C2.256,79.8-5.344,61.7,3.756,34,12.756,6.3,68.456.1,98.756,0c30.4,0,73.5,6.5,81,32Z
                    " />
			</path>
		</svg> -->


		<!-- テスト2 -->
		<!-- <svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="fluid01">
			<path fill="#ffffff" d="M32,-41.6C36.6,-27.4,32.1,-13.7,32.8,0.7C33.5,15.1,39.4,30.2,34.8,37.2C30.2,44.1,15.1,43,1.1,41.9C-12.9,40.7,-25.7,39.7,-41.8,32.7C-57.8,25.7,-77.1,12.9,-74.4,2.7C-71.7,-7.5,-47,-14.9,-31,-29.1C-14.9,-43.2,-7.5,-64,3.1,-67.2C13.7,-70.3,27.4,-55.7,32,-41.6Z" transform="translate(100 100)">
				<animate attributeType="XML" attributeName="d" dur="8s" repeatCount="indefinite" values="
                    M32,-41.6C36.6,-27.4,32.1,-13.7,32.8,0.7C33.5,15.1,39.4,30.2,34.8,37.2C30.2,44.1,15.1,43,1.1,41.9C-12.9,40.7,-25.7,39.7,-41.8,32.7C-57.8,25.7,-77.1,12.9,-74.4,2.7C-71.7,-7.5,-47,-14.9,-31,-29.1C-14.9,-43.2,-7.5,-64,3.1,-67.2C13.7,-70.3,27.4,-55.7,32,-41.6Z;
                    M26.1,-28.1C36.7,-15.5,50.2,-7.7,55,4.8C59.8,17.3,55.9,34.7,45.3,47.9C34.7,61.2,17.3,70.4,1.4,69.1C-14.6,67.7,-29.2,55.8,-45,42.5C-60.7,29.2,-77.5,14.6,-81.4,-4C-85.4,-22.5,-76.5,-45.1,-60.8,-57.7C-45.1,-70.3,-22.5,-73.1,-7.4,-65.7C7.7,-58.3,15.5,-40.7,26.1,-28.1Z;
                    M58.6,-59C73.3,-43.9,80.9,-21.9,78,-2.9C75.1,16.2,61.8,32.4,47.1,46.3C32.4,60.3,16.2,72,1.5,70.5C-13.2,69,-26.4,54.3,-30.7,40.3C-34.9,26.4,-30.3,13.2,-33,-2.7C-35.6,-18.5,-45.6,-37,-41.3,-52.1C-37,-67.2,-18.5,-78.8,1.7,-80.5C21.9,-82.2,43.9,-74,58.6,-59Z;
                    M50.5,-46.4C61.4,-39.6,63.5,-19.8,62.7,-0.7C62,18.3,58.5,36.7,47.6,50.7C36.7,64.6,18.3,74.2,-2.3,76.4C-22.9,78.7,-45.8,73.7,-61.3,59.8C-76.8,45.8,-84.8,22.9,-80,4.8C-75.2,-13.3,-57.6,-26.7,-42.2,-33.5C-26.7,-40.2,-13.3,-40.4,3.2,-43.7C19.8,-46.9,39.6,-53.2,50.5,-46.4Z;
                    M32,-41.6C36.6,-27.4,32.1,-13.7,32.8,0.7C33.5,15.1,39.4,30.2,34.8,37.2C30.2,44.1,15.1,43,1.1,41.9C-12.9,40.7,-25.7,39.7,-41.8,32.7C-57.8,25.7,-77.1,12.9,-74.4,2.7C-71.7,-7.5,-47,-14.9,-31,-29.1C-14.9,-43.2,-7.5,-64,3.1,-67.2C13.7,-70.3,27.4,-55.7,32,-41.6Z
                    " />
			</path>
		</svg>

		<svg viewBox="0 0 200 200" xmlns="http://www.w3.org/2000/svg" class="fluid02">
			<path fill="#c7c7c7" d="M25.5,-27.6C33.5,-17.6,40.7,-8.8,43.4,2.7C46.2,14.2,44.4,28.5,36.4,35.9C28.5,43.3,14.2,43.9,-0.2,44.1C-14.6,44.2,-29.2,44,-38.9,36.6C-48.7,29.2,-53.5,14.6,-55.3,-1.8C-57,-18.1,-55.7,-36.2,-45.9,-46.2C-36.2,-56.3,-18.1,-58.2,-4.7,-53.5C8.8,-48.9,17.6,-37.6,25.5,-27.6Z" transform="translate(100 100)">
				<animate attributeType="XML" attributeName="d" dur="8s" repeatCount="indefinite" values="
                    M25.5,-27.6C33.5,-17.6,40.7,-8.8,43.4,2.7C46.2,14.2,44.4,28.5,36.4,35.9C28.5,43.3,14.2,43.9,-0.2,44.1C-14.6,44.2,-29.2,44,-38.9,36.6C-48.7,29.2,-53.5,14.6,-55.3,-1.8C-57,-18.1,-55.7,-36.2,-45.9,-46.2C-36.2,-56.3,-18.1,-58.2,-4.7,-53.5C8.8,-48.9,17.6,-37.6,25.5,-27.6Z;
                    M37.5,-29.5C54,-20.9,76.8,-10.4,76.4,-0.4C76,9.7,52.5,19.3,35.9,30C19.3,40.6,9.7,52.2,-2.6,54.9C-15,57.5,-29.9,51.2,-44.5,40.5C-59.1,29.9,-73.3,15,-77,-3.7C-80.6,-22.3,-73.7,-44.6,-59.2,-53.2C-44.6,-61.8,-22.3,-56.8,-5.9,-50.9C10.4,-45,20.9,-38.1,37.5,-29.5Z;
                    M31,-33.9C44,-17.9,61.2,-9,66.9,5.7C72.6,20.4,67,40.8,53.9,50.2C40.8,59.5,20.4,57.6,-0.5,58.1C-21.4,58.6,-42.7,61.3,-53.6,52C-64.5,42.7,-65,21.4,-61.6,3.3C-58.3,-14.7,-51.1,-29.3,-40.2,-45.3C-29.3,-61.3,-14.7,-78.7,-2.8,-75.8C9,-73,17.9,-49.9,31,-33.9Z;
                    M44.7,-34.8C60,-29.3,76,-14.7,77.5,1.5C79.1,17.7,66.1,35.4,50.8,45.5C35.4,55.7,17.7,58.2,0.2,58C-17.3,57.8,-34.6,54.9,-46.7,44.8C-58.7,34.6,-65.4,17.3,-62.5,2.9C-59.6,-11.6,-47.2,-23.2,-35.2,-28.7C-23.2,-34.2,-11.6,-33.6,1.5,-35.2C14.7,-36.7,29.3,-40.4,44.7,-34.8Z;
                    M25.5,-27.6C33.5,-17.6,40.7,-8.8,43.4,2.7C46.2,14.2,44.4,28.5,36.4,35.9C28.5,43.3,14.2,43.9,-0.2,44.1C-14.6,44.2,-29.2,44,-38.9,36.6C-48.7,29.2,-53.5,14.6,-55.3,-1.8C-57,-18.1,-55.7,-36.2,-45.9,-46.2C-36.2,-56.3,-18.1,-58.2,-4.7,-53.5C8.8,-48.9,17.6,-37.6,25.5,-27.6Z
                    " />
			</path>
		</svg> -->

		<!-- テスト1 -->
		<!-- <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="80%" height="30%" id="blobSvg">
			<defs>
				<linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
					<stop offset="0%" style="stop-color: rgb(256,256,256);"></stop>
					<stop offset="100%" style="stop-color: rgb(256,256,256);"></stop>
				</linearGradient>
			</defs>
			<path id="blob" fill="url(#gradient)">
				<animate attributeName="d" dur="10000ms" repeatCount="indefinite" values="M440.5,320.5Q418,391,355.5,442.5Q293,494,226,450.5Q159,407,99,367Q39,327,31.5,247.5Q24,168,89,125.5Q154,83,219.5,68Q285,53,335.5,94.5Q386,136,424.5,193Q463,250,440.5,320.5Z;M453.78747,319.98894Q416.97789,389.97789,353.96683,436.87838Q290.95577,483.77887,223.95577,447.43366Q156.95577,411.08845,105.64373,365.97789Q54.33169,320.86732,62.67444,252.61056Q71.01719,184.3538,113.01965,135.21007Q155.02211,86.06634,220.52211,66.46683Q286.02211,46.86732,335.5,91.94472Q384.97789,137.02211,437.78747,193.51106Q490.59704,250,453.78747,319.98894Z;M411.39826,313.90633Q402.59677,377.81265,342.92059,407.63957Q283.24442,437.46649,215.13648,432.5428Q147.02853,427.61911,82.23325,380.9572Q17.43796,334.29529,20.45223,250.83809Q23.46649,167.38089,82.5856,115.05707Q141.70471,62.73325,212.19045,63.73015Q282.67618,64.72705,352.67308,84.79839Q422.66998,104.86972,421.43486,177.43486Q420.19974,250,411.39826,313.90633Z;M440.5,320.5Q418,391,355.5,442.5Q293,494,226,450.5Q159,407,99,367Q39,327,31.5,247.5Q24,168,89,125.5Q154,83,219.5,68Q285,53,335.5,94.5Q386,136,424.5,193Q463,250,440.5,320.5Z;"></animate>
			</path>
		</svg>
		<svg class="fluid" version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" width="100%" height="100%" id="blobSvg" style="opacity: 1;">
			<defs>
				<linearGradient id="gradient" x1="0%" y1="0%" x2="0%" y2="100%">
					<stop offset="0%" style="stop-color: rgb(199, 199, 199);"></stop>
					<stop offset="100%" style="stop-color: rgb(199, 199, 199);"></stop>
				</linearGradient>
			</defs>
			<path id="blob" fill="url(#gradient)" style="opacity: 0.76;">
				<animate attributeName="d" dur="10s" repeatCount="indefinite" values="M429,328Q437,406,362,433Q287,460,218,442Q149,424,122.5,365Q96,306,74.5,242Q53,178,94.5,115Q136,52,206.5,73Q277,94,347.5,101.5Q418,109,419.5,179.5Q421,250,429,328Z;M404.21696,312.89783Q400.5999,375.79567,344.18719,420.60848Q287.77447,465.42129,222.25959,438.51488Q156.7447,411.60848,114.36806,363.06382Q71.99143,314.51917,65.98083,247.80853Q59.97023,181.09788,105.72982,130.10217Q151.4894,79.10645,216.18088,77.25959Q280.87235,75.41272,335.88295,103.82341Q390.89355,132.2341,399.36378,191.11705Q407.83401,250,404.21696,312.89783Z;M433.0232,309.9192Q393.01281,369.83841,338.3352,406.40881Q283.6576,442.97921,221.7752,424.49281Q159.8928,406.0064,119.2384,358.9864Q78.584,311.9664,70.5304,246.7752Q62.4768,181.584,97.7552,114.4464Q133.0336,47.3088,206.208,64.61119Q279.3824,81.91359,342.208,100.8192Q405.0336,119.7248,439.0336,184.8624Q473.0336,250,433.0232,309.9192Z;M429,328Q437,406,362,433Q287,460,218,442Q149,424,122.5,365Q96,306,74.5,242Q53,178,94.5,115Q136,52,206.5,73Q277,94,347.5,101.5Q418,109,419.5,179.5Q421,250,429,328Z"></animate>
			</path>
		</svg> -->
*/ ?>
		<div class="top_concept_content">
			<h2 class="top_concept_title">Inspire Dreaming</h2>
			<p class="top_concept_subtitle">夢のままで終わらせない<br>毎日が特別な日になりますように</p>
			<p class="top_concept_text">夢や希望に溢れた世界の実現を<br class="pc_none">使命としています。<br>理念である『inspire dreaming』は、<br class="pc_none">人々の夢を刺激することを意味しています。<br>我々は常に挑戦し続け、<br class="pc_none">変革する社会の中で<br class="pc_none">夢や希望をお届けし続けることで、<br>人々の幸福を実現し、<br class="pc_none">社会の発展に貢献していきます。</p>
		</div>
	</section>


	<!-- Artist -->
	<section class="top_artist">
		<div class="top_artist_container wrapper">
			<h2 class="top_artist_title section_title-large">Artist</h2>
			<?php
			//Artist一覧取得
			$artist_posts = get_posts(
				array(
					'post_type' => 'artist',
					'posts_per_page' => -1,
					'paged' => get_query_var('paged'),
				)
			);

			if ($artist_posts) {
				echo '<div class="top_artist_list">';
				foreach ($artist_posts as $i => $artist_post) {
					setup_postdata($artist_post);
					$artist_id = $artist_post->ID;

					// アイキャッチ画像情報を取得
					$artist_photo = get_the_post_thumbnail($artist_id, 'full', array('class' => 'top_artist_photo'));

					// 書き出し
					echo '<div class="top_artist_box">
				<a href="' . get_permalink($artist_id) . '" class="image_link">
						<div class="top_artist_photo_box">' . $artist_photo . '</div>
						<img src="' . get_template_directory_uri() . '/image/top_more_button.svg" alt="もっと見る" class="top_more_button"></a></div>
					';
				}
				echo '</div>';
			} else {
				// 投稿がない場合はComing soon表示
				echo
				'<div class="comingsoon">Coming soon…</div>';
			}
			wp_reset_postdata();
			?>
		</div>
	</section>

	<!-- Event Schedule -->
	<section class="top_schedule">
		<div class="top_schedule_content wrapper">
			<h2 class="section_title top_schedule_title">Event Schedule</h2>
			<?php
			//スケジュール記事 取得
			$schedule_posts = get_posts(
				array(
					'post_type' => 'schedule',
					'posts_per_page' => 4,
					'paged' => get_query_var('page'),
				)
			);

			if ($schedule_posts) {
				// 投稿があれば出力
				echo '
		<a href="' . home_url() . '/schedule" class="top_link">View All</a>
		<div class="top_schedule_list">';
				foreach ($schedule_posts as $i => $schedule_post) {
					setup_postdata($schedule_post);
					$schedule_id = $schedule_post->ID;

					// 日付取得
					$schedule_date = esc_html($schedule_post->post_date_gmt);
					$schedule_date = mysql2date('Y.n.j', $schedule_date);
					// タイトル
					$schedule_title = get_the_title($schedule_post->ID);

					// アイキャッチ画像情報を取得
					$schedule_image = get_the_post_thumbnail($schedule_id, 'full', array('class' => 'top_schedule_image'));
					if (!$schedule_image) {
						$schedule_image = '<img src="' . get_template_directory_uri() .  '/image/noimage.jpg" alt="" class="top_schedule_image">';
					}

					//カテゴリー（タクソノミー）の取得
					$cat = get_the_terms($schedule_id, 'schedule_cat');
					// print_r($cat);
					$cat_html = '';
					if ($cat) {
						$cat_data = $cat[0];

						// カテゴリーカラーの取得
						$cat_bg = get_field('cat_color_bg', 'schedule_cat_' . $cat_data->term_id);
						$cat_text = get_field('cat_color_text', 'schedule_cat_' . $cat_data->term_id);

						// カテゴリー名とHTML出力
						$cat_name = $cat_data->name;
						if ($cat_name) {
							$cat_html = '<div class="top_schedule_list_cat" style="background-color:' . $cat_bg . '; color:' . $cat_text . ';">' . esc_html($cat_name) . '</div>';
						}
					}
					// 書き出し
					echo '
					<div class="top_schedule_list_item">
					<a href="' . get_permalink($schedule_id) . '" class="top_schedule_item image_link">
					<div class="top_schedule_image_box">' . $schedule_image . '</div>
					<div class="top_schedule_text_box"><div class="top_schedule_list_label">
					<time class="top_schedule_list_date" data-time="' . $schedule_date . '">' . $schedule_date . '</time>'
						. $cat_html .
						'</div>
						<h3 class="top_schedule_list_title">' . $schedule_title . '</h3>
						</div></a>
					</div>
				';
				}
			} else {
				// 投稿がない場合はComing soon表示
				echo
				'<div class="comingsoon">Coming soon…</div>';
			}
			wp_reset_postdata();
			?>
		</div>
		</div>
	</section>
	<!-- News -->
	<section class="top_news">
		<div class="top_mews_content wrapper">
			<h2 class="section_title top_news_title">News</h2>
			<?php
			//ニュース記事 取得
			$news_posts = get_posts(
				array(
					'post_type' => 'news',
					'posts_per_page' => 4,
					'paged' => get_query_var('page'),
				)
			);

			if ($news_posts) {
				// 投稿があれば出力
				echo '
		<div class="top_news_list">';
				foreach ($news_posts as $i => $news_post) {
					setup_postdata($news_post);
					$news_id = $news_post->ID;

					// 日付取得
					$news_date = esc_html($news_post->post_date_gmt);
					$news_date = mysql2date('Y.n.j', $news_date);
					// タイトル
					$news_title = get_the_title($news_post->ID);

					//カテゴリー（タクソノミー）の取得
					$cat = get_the_terms($news_id, 'news_cat');
					// print_r($cat);
					$cat_html = '';
					if ($cat) {
						$cat_data = $cat[0];

						// カテゴリーカラーの取得
						$cat_bg = get_field('cat_color_bg', 'news_cat_' . $cat_data->term_id);
						$cat_text = get_field('cat_color_text', 'news_cat_' . $cat_data->term_id);

						// カテゴリー名とHTML出力
						$cat_name = $cat_data->name;
						if ($cat_name) {
							$cat_html = '<div class="news_list_cat" style="background-color:' . $cat_bg . '; color:' . $cat_text . ';">' . esc_html($cat_name) . '</div>';
						}

						// 書き出し
						echo '
					<div class="top_news_list_item">
					<a href="' . get_permalink($news_id) . '" class="top_news_item">
					<div class="news_list_label">
					<time class="news_list_date" data-time="' . $news_date . '">' . $news_date . '</time>'
							. $cat_html .
							'</div>
						<h3 class="top_news_list_title">' . $news_title . '</h3>
						</a>
					</div>
				';
					}
				}
				echo '</div><a href="' . home_url() . '/news" class="top_link">View All</a>';
			} else {
				// 投稿がない場合はComing soon表示
				echo
				'<div class="comingsoon">Coming soon…</div>';
			}
			wp_reset_postdata();
			?>
		</div>
	</section>
</main>


<?php get_footer(); ?>
