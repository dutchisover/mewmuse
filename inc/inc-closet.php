<?php
// クローゼット データ取得
$closet_data = get_field('closet');

if ($closet_data) :
?>

	<div class="artist_closet">
		<?php
		// ロゴ画像の取得と出力
		$logoimage = get_field('logo');
		if (!empty($logoimage)) : ?>
			<div class="artist_closet_title_area">
				<img src="<?php echo esc_url($logoimage['url']); ?>" alt="<?php echo esc_attr($logoimage['alt']); ?>" class="artist_closet_logo">
				<p class="artist_closet_title">Closet</p>
			</div>
		<?php endif; ?>


		<?php
		foreach ($closet_data as $data) {
			$closet_title = $data['title'];

			$count_item = count($data['set']);
			if ($count_item > 4) {
				$column_items = ceil(count($data['set']) / 2);
			} else {
				$column_items = 4;
			}

			echo '<div class="artist_closet_container">';
			echo '<div class="artist_closet_content item-' . count($data['set']) . '">';

			foreach ($data['set'] as $set) {
				$image_url = $set['image']["url"];
				$costume_name = $set['costume_name'];
				$member_name = $set['member_name'];

				echo '<div class="artist_closet_item" style="width:calc(100% / ' . $column_items . ');">';
				echo '<img src="' . $image_url . '" class="artist_closet_image" alt="' . $costume_name . '｜' . $member_name . '">';
				echo '</div>';
			}

			echo '</div>'; //artist_closet_content
			echo '<div class="artist_closet_name"><p>' . $closet_title . '</p></div>';
			echo '</div>'; //artist_closet_container
		}

		?>
	</div>

<?php endif; ?>
