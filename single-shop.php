<?php $cat_bgcolor_list = array('お知らせ'=>'#d1904f', 'キャンペーン'=>'#eea2f2'); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<main role="main" id="container" class="mw">

	<div class="topicpath w">
		<ul>
			<li><a href="<?php  echo site_url(); ?>/">ホーム</a></li>
			<li><a href="<?php  echo site_url(); ?>/shop/">店舗・チラシ検索</a></li>
			<li><?php the_title(); ?></li>
		</ul>
	<!-- /.topicpath --></div>

	<p class="page_title">店舗・チラシ検索<br><span class="en">Shop Information</span></p>

	<article id="shopDetail">
		<header>
			<h1 class="dot_line_title pt_w"><span><?php the_title(); ?></span></h1>

			<nav class="w">
				<ul>
					
				</ul>
			</nav>
		</header>

		<div class="w">
			<table class="shop_info">
				<tbody>
					<tr>
						<th>住所</th>
						<td>〒<?php the_field('zip'); ?><span class="sp_break">　</span><?php the_field('address'); ?></td>
					</tr>
					<tr>
						<th>電話<br class="sp">番号</th>
						<td><a href="tel:<?php the_field('telephone'); ?>"><?php the_field('telephone'); ?></a></td>
					</tr>
<?php if(get_field('fax')) : ?>
					<tr>
						<th>FAX<br class="sp">番号</th>
						<td><?php the_field('fax'); ?></td>
					</tr>
<?php endif; ?>
					<tr>
						<th>営業<br class="sp">時間</th>
						<td><?php the_field('service_time'); if(get_field('late')){ echo '<br class="sp"><span class="late">', the_field('late'), '</span>'; }?></td>
					</tr>
<?php if(get_field('close')) : ?>
					<tr>
						<th>休診</th>
						<td><?php the_field('close'); ?></td>
					</tr>
<?php endif; ?>
				</tbody>
			<!-- /.shop_info --></table>

			<div class="detail">
<?php if(get_field('tokubai_number')) : ?>
<?php if(in_array('チラシ', get_field('tokubai_cat'))) : ?>
				<dl>
					<dt class="title">チラシ</dt>
					<dd class="tac">
						<p class="pc"><iframe frameborder="0" width="940" height="220" scrolling="no" src="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/leaflet_widget?background_color=FFFFFF&color=3C3C3C&count=4&direction=horizontal&main_height=200&main_width=200&type=pc&widget_height=220&widget_width=940" title="<?php the_title(); ?>のチラシ・特売情報"><a href="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/leaflet_widget?background_color=FFFFFF&color=3C3C3C&count=4&direction=horizontal&main_height=200&main_width=200&type=pc&widget_height=220&widget_width=940"><?php the_title(); ?>のチラシ・特売情報</a></iframe></p>
						<p class="sp"><iframe frameborder="0" height="270" scrolling="no" src="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/leaflet_widget?count=3&type=spweb" title="<?php the_title(); ?>のチラシ・特売情報" style="width: 100%;"><a href="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/leaflet_widget?count=3&type=spweb"><?php the_title(); ?>のチラシ・特売情報</a></iframe></p>
					</dd>
				</dl>
<?php endif; ?>
<?php if(in_array('お得情報', get_field('tokubai_cat'))) : ?>
				<dl>
					<dt class="title">お得情報</dt>
					<dd class="tac">
						<p class="pc"><iframe width="600" height="250" title="<?php the_title(); ?>のチラシ・特売情報" src="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/widget?height=250&width=600" frameborder="0"><a href="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/widget?height=250&width=600"><?php the_title(); ?>のチラシ・特売情報</a></iframe></p>
						<p class="sp"><iframe width="300" height="250" title="<?php the_title(); ?>のチラシ・特売情報" src="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/widget?height=250&width=300" frameborder="0"><a href="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/widget?height=250&width=300"><?php the_title(); ?>のチラシ・特売情報</a></iframe></p>
					</dd>
				</dl>
<?php endif; ?>
<?php if(in_array('サツドラマンスリー', get_field('tokubai_cat'))) : ?>
				<dl>
					<dt class="title">サツドラマンスリー</dt>
					<dd class="tac">
						<p class="pc"><iframe frameborder="0" width="280" height="220" scrolling="no" src="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/booklet_widget?background_color=FFFFFF&color=3C3C3C&count=1&direction=horizontal&main_height=200&main_width=200&type=pc&widget_height=220&widget_width=280" title="<?php the_title(); ?>のパンフレット・特売情報"><a href="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/booklet_widget?background_color=FFFFFF&color=3C3C3C&count=1&direction=horizontal&main_height=200&main_width=200&type=pc&widget_height=220&widget_width=280"><?php the_title(); ?>のパンフレット・特売情報</a></iframe></p>
						<p class="sp"><iframe frameborder="0" height="90" scrolling="no" src="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/booklet_widget?count=1&type=spweb" title="<?php the_title(); ?>のパンフレット・特売情報" style="width: 100%;"><a href="https://widgets.tokubai.co.jp/<?php the_field('tokubai_number'); ?>/booklet_widget?count=1&type=spweb"><?php the_title(); ?>のパンフレット・特売情報</a></iframe></p>
					</dd>
				</dl>
<?php endif; ?>
<?php endif; ?>
<?php if(get_field('facility_service')) : ?>
				<dl class="service">
					<dt class="title">施設・サービス</dt>
					<dd>
						<ul>
<?php
foreach(get_field('facility_service') as $fd) :
$dd = str_replace(' ', '<br>', $fd['label']);
?>
							<li class="service<?php echo $fd['value'] ?>"><dl>
								<dt><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service<?php echo $fd['value'] ?>.png" alt="<?php echo $fd['label'] ?>"></dt>
								<dd><?php echo $dd ?></dd>
							</dl></li>
<?php endforeach; ?>
						</ul>
<?php if(get_field('note')) : ?>
<?php $note = str_replace("\n", '<br>', get_field('note')); ?>
						<p class="notes"><?php echo $note; ?></p>
<?php endif; ?>
<?php if(get_field('online_order_url')) : ?>
						<p class="ezoca"><a href="<?php the_field('online_order_url'); ?>" target="_blank" class="box_link">処方箋のネット予約（無料）<br class="sp">はこちら</a></p>
<?php endif; ?>
<?php if(get_field('ezoca_url')) : ?>
						<p class="ezoca"><a href="<?php the_field('ezoca_url'); ?>" target="_blank" class="box_link">利用できるEZOCAサービスに<br class="sp">ついてはこちら</a></p>
<?php endif; ?>
					</dd>
				</dl>
<?php endif; ?>
<?php if(get_field('drag_service')) : ?>
				<dl class="service_dispensing2">
					<dt class="title">施設・サービス</dt>
					<dd>
						<ul>
<?php
foreach(get_field('drag_service') as $fd) :
$dd = str_replace(' ', '<br>', $fd['label']);
?>
							<li class="service_d<?php echo $fd['value'] ?>"><dl>
								<dt><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_service_d<?php echo $fd['value'] ?>.png" alt="<?php echo $fd['label'] ?>"></dt>
								<dd><?php echo $dd ?></dd>
							</dl></li>
<?php endforeach; ?>
						</ul>
					</dd>
				</dl>
<?php endif; ?>
<?php if(get_field('drag_service')) : ?>
				<dl class="service_dispensing2">
					<dt class="title">施設・サービス</dt>
					<dd>
						<ul>
<?php
foreach(get_field('dispensing') as $fd) :
$dd = str_replace(' ', '<br>', $fd['label']);
?>
							<li class="dispensing<?php echo $fd['value'] ?>"><dl>
								<dt><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_dispensing<?php echo $fd['value'] ?>.png" alt="<?php echo $fd['label'] ?>"></dt>
								<dd><?php echo $dd ?></dd>
							</dl></li>
<?php endforeach; ?>
						</ul>
					</dd>
				</dl>
<?php endif; ?>
<?php if(get_field('item')) : ?>
				<dl class="items">
					<dt class="title">取扱商品</dt>
					<dd>
						<ul>
<?php
foreach(get_field('item') as $fd) :
$dd = str_replace(' ', '<br>', $fd['label']);
?>
							<li class="item<?php echo $fd['value'] ?>"><dl>
								<dt><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_item<?php echo $fd['value'] ?>.png" alt="<?php echo $fd['label'] ?>"></dt>
								<dd><?php echo $dd ?></dd>
							</dl></li>
<?php endforeach; ?>
						</ul>
					</dd>
				</dl>
<?php endif; ?>
				<dl class="payment">
					<dt class="title">支払方法</dt>
					<dd>
						<ul>
<?php
foreach(get_field('payment') as $fd) :
$dd = str_replace(' ', '<br>', $fd['label']);
?>
							<li class="payment<?php echo $fd['value'] ?>"><dl>
								<dt><img src="<?php  echo get_template_directory_uri(); ?>/img/ico_payment<?php echo $fd['value'] ?>.png" alt="<?php echo $fd['label'] ?>"></dt>
								<dd><?php echo $dd ?></dd>
							</dl></li>
<?php endforeach; ?>
						</ul>
					</dd>
				</dl>
			<!-- /.detail --></div>

			<a id="map" class="target"></a>
			<div class="map">
				<figure style="background-image: url(<?php the_post_thumbnail_url(); ?>);"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></figure>
				<div id="map_canvas"><iframe src="<?php the_field('googleMapUrl'); ?>" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" width="100%" height="100%"></iframe></div>
			<!-- /.map --></div>

		<!-- /.w --></div>

	<!-- /#shopDetail --></article>

<!-- /#container --></main>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
