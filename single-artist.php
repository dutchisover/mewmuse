<?php get_header(); ?>
<?php
$closet_params = "";
if (isset($_GET['closet'])) {
	$closet_params = $_GET['closet'];
}


if (have_posts()) {
	while (have_posts()) : the_post();
		// カスタム投稿のslug
		$archive_slug = esc_html(get_post_type_object(get_post_type())->name);
		// タームのslug
		// カスタム投稿のタイトル
		$single_title = esc_html(get_post_type_object(get_post_type())->label);
		// 投稿日
		$single_date = get_the_date('Y.m.d');
		// アイキャッチ画像情報を取得
		$single_image = get_the_post_thumbnail($post->ID, 'full', array('class' => 'single_artist_image'));
		if (!$single_image) {
			$single_image = '';
		}
		// ページのSlug
		global $post;
		$page_slug = $post->post_name;
?>
		<main class="single single_<?= $archive_slug; ?>">
			<article class="wrapper-large">

				<?php

				if (!$closet_params) :

					// アイキャッチ画像
					echo $single_image;
				?>
					<!-- 記事内容 -->
					<div class="single_content wrapper">
						<!-- 入力があった場合、入力内容を表示 -->
						<div class="artist_content">
							<div class="artist_data">
								<div class="artist_logo">
									<?php
									// ロゴ画像の取得と出力
									$logoimage = get_field('logo');
									if (!empty($logoimage)) : ?>
										<img src="<?php echo esc_url($logoimage['url']); ?>" alt="<?php echo esc_attr($logoimage['alt']); ?>" class="artist_logo_image">
									<?php endif; ?>
								</div>

								<div class="artist_sns">
									<?php
									// SNSリンクの取得
									$sns = get_field('sns');
									?>
									<?php if ($sns['twitter']) : ?>
										<div class="artist_sns_item artist_sns_item-twitter"><a href="<?php echo $sns['twitter']; ?>" target="_blank" rel="noopener noreferrer" class="artist_sns_link"><img src="<?= get_template_directory_uri(); ?>/image/sns_twitter.svg" alt="twitter"></a></div>
									<?php endif; ?>
									<?php if ($sns['instagram']) : ?>
										<div class="artist_sns_item artist_sns_item-instagram"><a href="<?php echo $sns['instagram']; ?>" target="_blank" rel="noopener noreferrer" class="artist_sns_link"><img src="<?= get_template_directory_uri(); ?>/image/sns_instagram.svg" alt="nstagram"></a></div>
									<?php endif; ?>
									<?php if ($sns['youtube']) : ?>
										<div class="artist_sns_item artist_sns_item-youtube"><a href="<?php echo $sns['youtube']; ?>" target="_blank" rel="noopener noreferrer" class="artist_sns_link"><img src="<?= get_template_directory_uri(); ?>/image/sns_youtube.svg" alt="youtube"></a></div>
									<?php endif; ?>
									<?php if ($sns['tiktok']) : ?>
										<div class="artist_sns_item artist_sns_item-tiktok"><a href="<?php echo $sns['tiktok']; ?>" target="_blank" rel="noopener noreferrer" class="artist_sns_link"><img src="<?= get_template_directory_uri(); ?>/image/sns_tiktok.svg" alt="tiktok"></a></div>
									<?php endif; ?>
								</div>
							</div>
							<div class="artist_concept">
								<p class="artist_title">Concept</p>
								<p class="artist_copy"><?php the_field('concept'); ?></p>
							</div>
						</div>
						<div class="artist_member">
							<!-- Repeater fileld in group -->
							<?php
							//グループの中に入っている繰り返しフィールドを変数に代入する
							$members = get_field('member'); ?>
							<?php
							$counter = 0; //カウンター
							if ($members) :
								foreach ($members as $member) :
									$counter++; //カウントを増加
							?>
									<!--繰り返しフィールドの内容-->
									<div class="member_box">

										<button class="modal-toggle js-modal-open" data-modal="modal<?php echo $counter ?>"><img src="<?php echo esc_url($member['image']['url']); ?>" class="member_photo" alt="<?php echo $member['name']; ?>"></button>
										<div class="member_data">
											<h2 class="member_name"><?php echo $member['name']; ?></h2>
											<div class="member_sns">
												<?php if ($member['member_twitter']) : ?>
													<div class="member_sns_item"><a href="<?php echo $member['member_twitter']; ?> " target="_blank" rel="noopener noreferrer" class="member_sns_link"><img src="<?= get_template_directory_uri(); ?>/image/sns_twitter.svg" alt=""></a></div>
												<?php endif; ?>
												<?php if ($member['member_instagram']) : ?>
													<div class="member_sns_item"><a href="<?php echo $member['member_instagram']; ?>" target="_blank" rel="noopener noreferrer" class="member_sns_link"><img src="<?= get_template_directory_uri(); ?>/image/sns_instagram.svg" alt=""></a></div>
												<?php endif; ?>
											</div>
										</div>
										<div id="modal<?php echo $counter ?>" class="modal js-modal">
											<!-- モーダル画面 -->
											<div class="modal_content">
												<div class="modal_inner">
													<!-- 閉じるボタン -->
													<div class="modal-close js-modal-close">
														<button class="modal-close_button"><img src="<?= get_template_directory_uri(); ?>/image/modal_button-close.svg" alt="閉じる">
														</button>
													</div>

													<div class="modal_image_area">
														<div class="modal_photo_base">
															<div class="modal_photo"><img src="<?php echo esc_url($member['image']['url']); ?>" alt="<?php echo $member['name']; ?>"></div>
														</div>
														<div class="modal_sign">
															<img src="<?php echo esc_url($member['sign']['url']); ?>" alt="<?php echo $member['name']; ?>サイン">
														</div>
													</div>
													<div class="modal_text_area">
														<p class="modal_member_name"><?php echo $member['name']; ?></p>
														<div class="modal_data">
															<div class="modal_data_item">
																<p class="modal_data_label">誕生日</p>
																<p class="modal_data_value"><?php echo $member['birthday']; ?></p>
															</div>
															<div class="modal_data_item">
																<p class="modal_data_label">血液型</p>
																<p class="modal_data_value"><?php echo $member['bloodtype']; ?></p>
															</div>
															<div class="modal_data_item">
																<p class="modal_data_label">出身</p>
																<p class="modal_data_value"><?php echo $member['birthplace']; ?></p>
															</div>
															<div class="modal_data_item">
																<p class="modal_data_label">MBTI</p>
																<p class="modal_data_value"><?php echo $member['mbti']; ?></p>
															</div>
															<div class="modal_data_item">
																<p class="modal_data_label">担当カラー</p>
																<p class="modal_data_value"><?php echo $member['color']; ?></p>
															</div>

															<p class="modal_data_label modal_data_message">メッセージ</p>
															<p class="modal_data_value modal_data_message"><?php echo $member['message']; ?></p>

														</div>
														<div class=" modal_sns_box">
															<?php if ($member['member_twitter']) : ?>
																<div class="member_sns_item member_sns_item-twitter"><a href="<?php echo $member['member_twitter']; ?>" target="_blank" rel="noopener noreferrer" class="member_sns_link"><img src="<?= get_template_directory_uri(); ?>/image/sns_twitter.svg" alt="twitter"></a></div>
															<?php endif; ?>
															<?php if ($member['member_instagram']) : ?>
																<div class="member_sns_item member_sns_item-instagram"><a href="<?php echo $member['member_instagram']; ?>" target="_blank" rel="noopener noreferrer" class="member_sns_link"><img src="<?= get_template_directory_uri(); ?>/image/sns_instagram.svg" alt="instagram"></a></div>
															<?php endif; ?>
															<?php if ($member['member_tiktok']) : ?>
																<div class="member_sns_item member_sns_item-tiktok"><a href="<?php echo $member['member_tiktok']; ?>" target="_blank" rel="noopener noreferrer" class="member_sns_link"><img src="<?= get_template_directory_uri(); ?>/image/sns_tiktok.svg" alt="tiktok"></a></div>
															<?php endif; ?>
														</div>
													</div>
												</div>
											</div>
											<!-- モーダル表示時の半透明黒背景 -->
											<div class="modal_bg"></div>
										</div>

									</div>
							<?php
								endforeach;
							endif;
							?>
						</div>

						<?php
						// クローゼットデータ取得
						$closet_data = get_field('closet');
						?>
						<?php if ($closet_data) : ?>
							<div class="artist_link_button-closet">
								<a href="./?closet=true">costume closet</a>
							</div>
						<?php endif; ?>


						<div class="artist_link_group">
							<?php
							// Scheduleの投稿を取得
							// $calendar_post = get_posts(
							// 	array(
							// 		'post_type' => 'schedule',
							// 		'posts_per_page' => -1,
							// 		'tax_query' => array(
							// 			array(
							// 				'taxonomy' => 'schedule_cat',
							// 				'field'    => 'slug',
							// 				'terms' => $page_slug
							// 			)
							// 		)
							// 	)
							// )
							?>

							<?php
							// カレンダーURL取得
							$calendar = get_field('calendar');
							// ストアURL取得
							$store = get_field('store');
							?>
							<?php if ($calendar) : ?>
								<div class="artist_link_calendar"><a href="<?= $calendar; ?>" class="artist_link" target="_blank" rel="noopener noreferrer">Calendar</a></div>
							<?php endif; ?>


							<?php if ($store) : ?>
								<div class="artist_link_store"><a href="<?= $store; ?>" class="artist_link" target="_blank" rel="noopener noreferrer">Official Store</a></div>
							<?php endif; ?>
						</div>
					</div>

				<?php else : ?>

					<!-- ここからCloset -->
					<?php get_template_part('inc/inc-closet'); ?>

				<?php endif; ?>

		<?php
	endwhile;
} ?>

			</article>
		</main>


		<?php get_footer(); ?>
