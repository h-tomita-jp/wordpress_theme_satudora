	<section>
		<h1 class="page_title">店舗・チラシ検索<br><span class="en">Shop Information</span></h1>

		<div class="search_main bg_light6"><div class="w">
			<div class="lead">
				<p class="logo"><img src="<?php  echo get_template_directory_uri(); ?>/img/oldnew_logo.png" width="160" height="90" alt="ブランドロゴ"></p>
				<p>わたしたちはこの度、ドラッグストアー事業のストアブランドを変更いたしました。<br>
					店舗外観の看板等に関しては順次設置変更を実施してまいります。<br>
					親しみやすく、より愛されるお店を目指して。皆様のご来店を心よりお待ちしております。</p>
			<!-- /.lead --></div>

			<!--<nav class="sp location">-->
			<!--	<h1 class="sp_search_title">現在地から探す</h1>-->
			<!--	<p><a href="<?php  echo site_url(); ?>/shop/location/"><span>現在地からお店を探す<span class="s">(GPS設定をONにしてご利用ください)</span></span></a></p>-->
			<!--</nav>-->

			<nav>
				<h1 class="sp sp_search_title">エリア・条件から探す</h1>
				<ul>
					<li class="current"><a class="satudora"><span class="l">サツドラ</span><span class="pc">をさがす</span></a><span></span></li>
					<li><a href="<?php  echo site_url(); ?>/shop/dispensing/" class="dispensing"><span class="l">調剤薬局</span><span class="pc">をさがす</span></a><span></span></li>
				</ul>
			</nav>

<?php
$shop_page_id = get_page_by_path('shop')->ID;
$areas = get_field_object('area', $shop_page_id)['sub_fields'];
$area_list = [];
foreach ( $areas as $key => $value ) {
	$area_list += array( $value['name'] => $value['label'] );
}

function count_area($search_area){
	$args = array(
		'posts_per_page' => -1,
	  'post_type' => 'shop',
	  'meta_query' => array(
			array(
	  		'key' => 'address',
	  		'value' => $search_area,
	  		'compare' => 'LIKE'
			),
			array(
	  		'key' => 'drag_service',
	  		'value' => '',
	  		'compare' => '='
			)
	  )
	);
	$query = new WP_Query($args);
	return $query->found_posts;
}

$area_count = [];
$area_total = [];
foreach ( $area_list as $area_name => $area_label ) :
	foreach ( get_field('area', $shop_page_id)[$area_name] as $key => $value ) :
		if($key != 'query_key' && $key != 'coords') :
			foreach ( $value as $index => $list ) :
				if($index == 'query_key') :
					foreach ( $list as $small_area ) :
						$small_area_count = 0;
						foreach ( explode ( '・', $small_area ) as $small_area_part ) :
							$small_area_count += count_area($key.$small_area_part);
						endforeach;
						$area_count[$area_name][$key][$small_area] = $small_area_count;
						$area_total[$area_name] += $small_area_count;
					endforeach;
				endif;
			endforeach;
		endif;
		if($key == 'query_key') :
			foreach ( $value as $area ) :
				$area_count[$area_name][$area] = count_area($area);
				$area_total[$area_name] += count_area($area);
			endforeach;
		endif;
	endforeach;
endforeach;

foreach ( $area_list as $area_name => $area_label ) {
	if(get_field('area', $shop_page_id)[$area_name]['coords']){
		$coords_list[] = str_repeat("\t", 6) . '<area shape="poly" coords="' . get_field('area', $shop_page_id)[$area_name]['coords'] . '" data-area="' . $area_name . '">';
		if($area_total[$area_name] >0){
			$hover_list[] = str_repeat("\t", 6) . '<li class="' . $area_name . '" data-area="' . $area_name . '"><img src="' . get_template_directory_uri() . '/img/map_hokkaido_' . $area_name . '.png"></li>';
		}
	}
	if($area_total[$area_name] >0){
		$btn_list[] = str_repeat("\t", 6) . '<li class="' . $area_name . '"><a class="has_area" data-area="' . $area_name . '"><span>' . $area_label . '</span></a></li>';
	}else{
		$btn_list[] = str_repeat("\t", 6) . '<li class="' . $area_name . '"><a data-area="' . $area_name . '"><span>' . $area_label . '</span></a></li>';
	}
	if($area_total[$area_name] >0){
		$sp_area_select[] = str_repeat("\t", 6) . '<option value="' . $area_name . '">' . $area_label . '</option>';
	}
}

?>

			<div class="map pc">
				<div class="hokkaido_map">
					<img src="<?php  echo get_template_directory_uri(); ?>/img/map_hokkaido.png" width="550" height="480" alt="" class="base">
					<img src="<?php  echo get_template_directory_uri(); ?>/img/map_hokkaido_line.png" width="550" height="480" alt="">
					<img src="<?php  echo get_template_directory_uri(); ?>/img/s.png" width="550" height="480" alt="" class="cover" usemap="#hokkaido_area">
					<map name="hokkaido_area">
<?php foreach ( $coords_list as $coords ){ echo $coords, "\n"; } ?>
					</map>
					<img src="<?php  echo get_template_directory_uri(); ?>/img/map_city.png" width="550" height="480" alt="">

					<ul class="hover">
<?php foreach ( $hover_list as $hover ){ echo $hover, "\n"; } ?>
					</ul>

					<ul class="btn">
<?php foreach ( $btn_list as $btn ){ echo $btn, "\n"; } ?>
					</ul>

				<!-- /.hokkaido_map --></div>

				<div class="area">
					<p class="non show"><span>エリアを選ぶと<br>市区町村が表示されます</span></p>

<?php foreach ( $area_list as $area_name => $area_label ) : ?>
<?php 	if ($area_total[$area_name] > 0): ?>
					<ul data-area-list="<?php echo $area_label ?>" class="<?php echo $area_name ?>">
<?php 		foreach($area_count[$area_name] as $location => $value): ?>
<?php 			if (is_array($value) && array_sum($area_count[$area_name][$location]) > 0): ?>
						<li>
							<?php echo "$location\n" ?>
							<ul>
<?php 				foreach($value as $small_area => $count): ?>
<?php 					if ($area_count[$area_name][$location][$small_area] > 0): ?>
								<li><a href="<?php echo site_url(); ?>/shop/?area=<?php echo $small_area ?>#result"><?php echo $small_area ?> (<?php echo $count ?>件)</a></li>
<?php 					endif; ?>
<?php 				endforeach; ?>
							</ul>
						</li>
<?php 			else: ?>
<?php 				if ($area_count[$area_name][$location] > 0): ?>
						<li>
							<a href="<?php echo site_url(); ?>/shop/?area=<?php echo $location ?>#result"><?php echo $location ?> (<?php echo $value ?>件)</a>
						</li>
<?php 				endif; ?>
<?php 			endif; ?>
<?php 		endforeach; ?>
					</ul>
<?php 	endif; ?>
<?php endforeach; ?>

				<!-- /.area --></div>
			<!-- /.map --></div>

			<form class="search sp">
				<p class="select">
					<select class="sp_area_select">
						<option value="">-エリアを選択-</option>
<?php foreach ( $sp_area_select as $sp_area ){ echo $sp_area, "\n"; } ?>
					</select><br>

					<select name="area" class="sp_area_area" disabled>
						<option value="">-市区町村を選択-</option>
					</select>

<?php foreach ( $area_list as $area_name => $area_label ) : ?>
<?php 	if ($area_total[$area_name] > 0): ?>
					<select name="area" data-sp-select="<?php echo $area_name ?>" class="sp_area_area" disabled>
<?php 		foreach($area_count[$area_name] as $location => $value): ?>
<?php 			if (is_array($value) && array_sum($area_count[$area_name][$location]) > 0): ?>
<?php 				foreach($value as $small_area => $count): ?>
<?php 					if ($area_count[$area_name][$location][$small_area] > 0): ?>
						<option value="<?php echo $small_area ?>"><?php echo $location ?> <?php echo $small_area ?></option>
<?php 					endif; ?>
<?php 				endforeach; ?>
<?php 			else: ?>
<?php 				if ($area_count[$area_name][$location] > 0): ?>
						<option value="<?php echo $location ?>"><?php echo $location ?></option>
<?php 				endif; ?>
<?php 			endif; ?>
<?php 		endforeach; ?>
<?php 	endif; ?>
					</select>
<?php endforeach; ?>

				<!-- /.select --></p>

<?php
function service_checked($value){
	echo in_array($value, $_GET['search']) ? ' checked' : '';
}
?>

				<div class="search_narrow">
					<p class="title">条件を追加する<span>（複数選択可）</span></p>

					<dl>
						<dt>施設・サービス</dt>
						<dd>

							<ul>
								<li class="sp_w"><input type="checkbox" name="search[]" value="手ぶら便対応" id="service01main"<?php service_checked("手ぶら便対応"); ?>>
									<label for="service01main">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service01.png" width="40" height="40" alt="手ぶら便対応"></span>
										<span class="txt">手ぶら便対応<br><span>※道内定額配送サービス</span></span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="調剤併設" id="service02main"<?php service_checked("調剤併設"); ?>>
									<label for="service02main">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service03.png" width="40" height="40" alt="調剤併設"></span>
										<span class="txt">調剤併設</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="第一種医薬品取扱" id="service03main"<?php service_checked("第一種医薬品取扱"); ?>>
									<label for="service03main">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service04.png" width="40" height="40" alt="第一種医薬品取扱"></span>
										<span class="txt">第一種医薬品取扱</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="於併設調剤薬局" id="service10main"<?php service_checked("於併設調剤薬局"); ?>>
									<label for="service10main">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service17.png" width="40" height="40" alt="於併設調剤薬局"></span>
										<span class="txt">於 併設調剤薬局</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="免税対応" id="service04main"<?php service_checked("免税対応"); ?>>
									<label for="service04main">
										<span class="checkbox"><span></span></span>
										<span class="img taxfree"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service07.png" width="80" height="40" alt="免税対応"></span>
										<span class="txt">免税対応</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="食品取扱店" id="service05main"<?php service_checked("食品取扱店"); ?>>
									<label for="service05main">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_item01.png" width="40" height="40" alt="食品取扱店"></span>
										<span class="txt">食品取扱店</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="電子マネー対応" id="service06main"<?php service_checked("電子マネー対応"); ?>>
									<label for="service06main">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service10.png" width="40" height="40" alt="電子マネー対応"></span>
										<span class="txt">電子マネー対応</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="深夜営業店" id="service07main"<?php service_checked("深夜営業店"); ?>>
									<label for="service07main">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_late.png" width="40" height="40" alt="深夜営業店"></span>
										<span class="txt">深夜営業店<br><span>※22時以降</span></span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="アルカリイオン水" id="service08main"<?php service_checked("アルカリイオン水"); ?>>
									<label for="service08main">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service13.png" width="40" height="40" alt="アルカリイオン水"></span>
										<span class="txt">アルカリイオン水</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="マルチコピー行政サービス" id="service09main"<?php service_checked("マルチコピー行政サービス"); ?>>
									<label for="service09main">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service18.png" width="71" height="40" alt="マルチコピー行政サービス"></span>
										<span class="txt">ﾏﾙﾁｺﾋﾟｰ<br>行政ｻｰﾋﾞｽ</span></span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="PUDOstation" id="service11main"<?php service_checked("PUDOstation"); ?>>
									<label for="service11main">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service15.png" width="71" height="40" alt="PUDOstation"></span>
										<span class="txt">PUDOstation<br><span style="font-size:10px;">(宅配便ロッカー)</span></span></span>
									</label>
								</li>
							</ul>

						</dd>
					</dl>
				<!-- /.search_narrow --></div>

				<p class="btn"><button class="box_link">検索</button></p>

				<input type="hidden" name="device" value="sp">
			<!-- /.search --></form>
		<!-- /.search_main --></div></div>

		<a class="target" id="result"></a>
		<section class="search_result bg_light3"><div class="w">
			<h1>検索結果</h1>
			<div class="search_narrow bg_light6">
				<p class="title"><a href="#" class="hv_wh"><span>条件で絞り込む<i></i></span></a></p>
				<form action="<?php echo site_url(); ?>/shop/#result" method="get">
<?php if(isset($_GET['area'])) : ?>
					<input type="hidden" name="area" value="<?php echo $_GET['area']; ?>">
<?php endif;?>

					<dl>
						<dt>施設・サービス</dt>
						<dd>

							<ul>
								<li class="sp_w"><input type="checkbox" name="search[]" value="手ぶら便対応" id="service01result"<?php service_checked("手ぶら便対応"); ?>>
									<label for="service01result">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service01.png" width="40" height="40" alt="手ぶら便対応"></span>
										<span class="txt">手ぶら便対応<br><span>※道内定額配送サービス</span></span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="調剤併設" id="service02result"<?php service_checked("調剤併設"); ?>>
									<label for="service02result">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service03.png" width="40" height="40" alt="調剤併設"></span>
										<span class="txt">調剤併設</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="第一種医薬品取扱" id="service03result"<?php service_checked("第一種医薬品取扱"); ?>>
									<label for="service03result">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service04.png" width="40" height="40" alt="第一種医薬品取扱"></span>
										<span class="txt">第一種医薬品取扱</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="於併設調剤薬局" id="service10result"<?php service_checked("於併設調剤薬局"); ?>>
									<label for="service10result">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service17.png" width="40" height="40" alt="於併設調剤薬局"></span>
										<span class="txt">於 併設調剤薬局</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="免税対応" id="service04result"<?php service_checked("免税対応"); ?>>
									<label for="service04result">
										<span class="checkbox"><span></span></span>
										<span class="img taxfree"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service07.png" width="80" height="40" alt="免税対応"></span>
										<span class="txt">免税対応</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="食品取扱店" id="service05result"<?php service_checked("食品取扱店"); ?>>
									<label for="service05result">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_item01.png" width="40" height="40" alt="食品取扱店"></span>
										<span class="txt">食品取扱店</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="電子マネー対応" id="service06result"<?php service_checked("電子マネー対応"); ?>>
									<label for="service06result">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service10.png" width="40" height="40" alt="電子マネー対応"></span>
										<span class="txt">電子マネー対応</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="深夜営業店" id="service07result"<?php service_checked("深夜営業店"); ?>>
									<label for="service07result">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_late.png" width="40" height="40" alt="深夜営業店"></span>
										<span class="txt">深夜営業店<br><span>※22時以降</span></span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="アルカリイオン水" id="service08result"<?php service_checked("アルカリイオン水"); ?>>
									<label for="service08result">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service13.png" width="40" height="40" alt="アルカリイオン水"></span>
										<span class="txt">アルカリイオン水</span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="マルチコピー行政サービス" id="service09result"<?php service_checked("マルチコピー行政サービス"); ?>>
									<label for="service09result">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service18.png" width="71" height="40" alt="マルチコピー行政サービス"></span>
										<span class="txt">ﾏﾙﾁｺﾋﾟｰ<br>行政ｻｰﾋﾞｽ</span></span>
									</label>
								</li>
								<li><input type="checkbox" name="search[]" value="PUDOstation" id="service11result"<?php service_checked("PUDOstation"); ?>>
									<label for="service11result">
										<span class="checkbox"><span></span></span>
										<span class="img"><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service15.png" width="71" height="40" alt="PUDOstation"></span>
										<span class="txt">PUDOstation<br><span style="font-size:10px;">(宅配便ロッカー)</span></span></span>
									</label>
								</li>
							</ul>

							<p class="btn"><button class="box_link">絞り込む</button></p>
						</dd>
					</dl>				</form>
			<!-- /.search_narrow --></div>

<?php
$drag_service_args = array(
	'key' => 'drag_service',
	'value' => '',
	'compare' => '='
);
if(isset($_GET['area'])) {
	$area_args = [ 'relation' => 'OR' ];
	foreach ( explode ( '・', $_GET['area'] ) as $area_part ) :
		$area_args[] = ['key' => 'address', 'value' => $area_part, 'compare' => 'LIKE'];
	endforeach;
};
$e_money_search = [ 'relation' => 'OR' ];
foreach ( range(2, 19) as $key ) :
	$e_money_search[] = ['key' => 'payment', 'value' => sprintf('%02d', $key), 'compare' => 'LIKE'];
endforeach;
$service_search = [
	'PUDOstation'								=> [ 'key' => 'facility_service', 'value' => '15', 'compare' => 'LIKE' ],
	'アルカリイオン水'					=> [ 'key' => 'facility_service', 'value' => '13', 'compare' => 'LIKE' ],
	'マルチコピー行政サービス'	=> [ 'key' => 'facility_service', 'value' => '18', 'compare' => 'LIKE' ],
	'免税対応'									=> [ 'key' => 'facility_service', 'value' => '07', 'compare' => 'LIKE' ],
	'手ぶら便対応'							=> [ 'key' => 'facility_service', 'value' => '01', 'compare' => 'LIKE' ],
	'於併設調剤薬局'						=> [ 'key' => 'facility_service', 'value' => '17', 'compare' => 'LIKE' ],
	'第一種医薬品取扱'					=> [ 'key' => 'facility_service', 'value' => '04', 'compare' => 'LIKE' ],
	'調剤併設'									=> [ 'key' => 'facility_service', 'value' => '03', 'compare' => 'LIKE' ],
	'食品取扱店'								=> [ 'key' => 'item', 'value' => '01', 'compare' => 'LIKE' ],
	'深夜営業店'								=> [ 'key' => 'late', 'value' => '深夜', 'compare' => 'LIKE' ],
	'電子マネー対応'						=> $e_money_search,
];
if(isset($_GET['search'])) {
	$service_args = [ 'relation' => 'AND' ];
	foreach($_GET['search'] as $service){
		$service_args[] = $service_search[$service];
	}
};

$args = array(
  'paged' => get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1,
	'posts_per_page' => 3,
  'post_type' => 'shop',
  'meta_query' => array( $drag_service_args, $area_args, $service_args ),
);
$the_query = new WP_Query($args);
?>

<?php if ( $the_query->have_posts() ) : ?>
			<div class="shop">
<?php 	while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<article><a href="<?php the_permalink() ?>">
					<p class="img hv_wh" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></p>
					<div>
						<h1><?php the_title(); ?></h1>
						<p>〒<?php the_field('zip'); ?><span class="sp_break">　</span><?php the_field('address'); ?></p>
						<dl>
							<dt>TEL</dt>
							<dd><?php the_field('telephone'); ?></dd>
						</dl>
						<dl>
							<dt>通常営業時間</dt>
							<dd><?php echo str_replace('通常営業時間 ', '', get_field('service_time')); ?></dd>
						</dl>
						<ul class="cat sp">
							<li class="satudora">サツドラ</li>
						<!-- /.cat --></ul>
						<p class="box_link"><span>店舗詳細はこちら</span></p>
					</div>
				</a></article>
<?php 	endwhile;?>
			<!-- /.shop --></div>
<?php else : ?>
			<p class="non_shop">条件に該当する店舗はありませんでした</p>
<?php endif; ?>

<?php
if($the_query->found_posts > $the_query->post_count){
	wp_pagenavi(array('query'=>$the_query));
}
?>


		<!-- /.search_result --></div></section>
	</section>
