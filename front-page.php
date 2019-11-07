<?php get_header(); ?>

  <main role="main" id="container" class="mw">

<?php $cat_bgcolor_list = array('お知らせ'=>'#d1904f', 'キャンペーン'=>'#eea2f2'); ?>
<?php
//記事の取得条件
$article_args = array(
  'posts_per_page' => -1,
  'post_type' => 'event',
  'orderby' => 'rand',
);

$event_query = new WP_Query( $article_args );
?>
    <div class="index_main">
      <div class="slide">
        <ul>
<?php if( $event_query ) : ?>
<?php while ( $event_query->have_posts() ) : $event_query->the_post(); ?>
<?php
/* 子カテゴリーのみを取得し、カテゴリー名、background-colorをセットする */
$categories = get_the_category();
foreach ($categories as $category) {
    if ($category->parent) {
	    $cat_name = $category->name;
			$cat_bgcolor = $cat_bgcolor_list[$cat_name];
    }
}
?>
          <li>
            <a href="<?php the_permalink() ?>">
						<span class="img"><img src="<?php the_post_thumbnail_url(); ?>" width="645" alt="<?php the_title(); ?>"></span>
						<span class="txt"><span><span class="event_category" style="background-color: <?php echo $cat_bgcolor; ?>;color: #fff;"><?php echo $cat_name; ?></span></span><span class="title"><?php the_title(); ?></span></span>
					</a>
          </li>
<?php endwhile; endif; ?>
        </ul>

        <a href="#" class="slide_arrow l"></a>
        <a href="#" class="slide_arrow r"></a>
      </div>
      <!-- /.index_main -->
    </div>
    

    <div class="index_search">
      <ul class="wt">
        <li class="wide"><a href="<?php  echo site_url(); ?>/shop/" class="search01"><span>サツドラ</span>をさがす</a></li>
        <li class="wide"><a href="<?php  echo site_url(); ?>/shop/dispensing/" class="search02"><span>調剤薬局</span>をさがす</a></li>
        <li class="taxFree"><a href="<?php  echo site_url(); ?>/shop/?search[]=免税対応#result" class="search03"><span>免税店</span>をさがす</a></li>
        <!-- /.wt -->
      </ul>
      <!-- /.index_search -->
    </div>


<?php
//記事の取得条件
$article_args = array(
  'category_name' => 'news',
  'posts_per_page' => 5,
);

$news_query = new WP_Query( $article_args );
?>
    <section class="index_news index_section w">
      <h1 class="dot_line_title"><span>お知らせ</span></h1>

      <div class="row">
        <ul>
<?php if( $news_query ) : ?>
<?php while ( $news_query->have_posts() ) : $news_query->the_post(); ?>
          <li><a href="<?php the_permalink() ?>">
					<span class="date"><?php the_time('Y.m.d'); ?></span>
					<span class="title"><?php the_title(); ?></span>
  				</a></li>
<?php endwhile; endif; ?>
        </ul>
        <!-- /.row -->
      </div>

      <p class="btn"><a href="<?php  echo site_url(); ?>/news/" class="box_link">お知らせ一覧</a></p>
    </section>


    <section class="index_event">
      <h1>イベント・キャンペーン</h1>

      <div class="slide">
        <ul class="hv_wh">
<?php if( $event_query ) : ?>
<?php while ( $event_query->have_posts() ) : $event_query->the_post(); ?>
<?php $sub_title = get_field('sub_title') ?: get_the_title(); ?>
          <li><a href="<?php the_permalink() ?>">
					<span class="img"><img src="<?php the_post_thumbnail_url(); ?>" width="308" alt="<?php the_title(); ?>"></span>
					<span class="txt"><?php echo $sub_title ?></span>
					<span class="title"><?php the_title(); ?></span>
				  </a></li>
<?php endwhile; endif; ?>
        </ul>

        <a href="#" class="slide_arrow l"></a>
        <a href="#" class="slide_arrow r"></a>
      </div>
    </section>


    <div class="index_section bg_light">
      <div class="w">
        <section class="index_otoku_info">
          <h1 class="green_slash_title">お得な情報</h1>

          <div class="column">
            <ul>
              <li class="shop"><a href="<?php  echo site_url(); ?>/shop/"><img src="<?php  echo get_template_directory_uri(); ?>/img/otoku_info_shop.png" alt="店舗からチラシを探す" width="170" height="100"></a></li>
              <li class="flyer"><a href="https://tokubai.co.jp/search?utf8=%E2%9C%93&latitude=&longitude=&from=&bargain_keyword=%E3%82%B5%E3%83%84%E3%83%89%E3%83%A9" target="_blank"><img src="<?php  echo get_template_directory_uri(); ?>/img/otoku_info_flyer.png" alt="チラシ一覧" width="100" height="30"></a></li>
            </ul>

            <p class="mailmaga"><a href="<?php  echo site_url(); ?>/member/">
						<img src="<?php  echo get_template_directory_uri(); ?>/img/otoku_info_mailmaga.png" alt="メルマガ会員募集中" width="180" height="70">
						<span>注目の新商品やオトクなセール情報、<br>お買い物がもっと楽しくなる<br class="sp">クーポンをお届け！</span>
					</a></p>

            <div class="viewer pc">
              <iframe width="300" frameborder="0" width="300" height="300" scrolling="no" src="https://widgets.tokubai.co.jp/offices/894/booklet_widget?background_color=FFFFFF&color=3C3C3C&horizontal_count=1&show_target_shops=false&type=pc&widget_height=300&widget_width=300"
                title="サッポロドラッグストアー全店舗のパンフレット・特売情報"><a href="https://widgets.tokubai.co.jp/offices/894/booklet_widget?background_color=FFFFFF&color=3C3C3C&horizontal_count=1&show_target_shops=false&type=pc&widget_height=300&widget_width=300">サッポロドラッグストアー全店舗のパンフレット・特売情報</a></iframe>
            </div>
            <iframe class="sp" frameborder="0" height="400" scrolling="no" src="https://widgets.tokubai.co.jp/offices/894/booklet_widget?show_target_shops=false&type=spweb&widget_height=400" title="サッポロドラッグストアー全店舗のパンフレット・特売情報" style="width: 100%;"><a href="https://widgets.tokubai.co.jp/offices/894/booklet_widget?show_target_shops=false&type=spweb&widget_height=400">サッポロドラッグストアー全店舗のパンフレット・特売情報</a></iframe>

            <!-- /.column -->
          </div>
          <!-- /.index_otoku_info -->
        </section>
      </div>
      <!-- /.index_section -->
    </div>

<?php
$args = array(
  'posts_per_page'=> -1,
  'post_type' => 'service',
  'orderby' => 'rand', // ランダムに記事を選ぶ
);
$service_query = new WP_Query($args);
?>
    <section class="index_section bg_light">
      <h1 class="dot_line_title"><span>サービス</span></h1>
      <div class="w">
<?php $caption_bnrs = 0; ?>
<?php if( $service_query -> have_posts() ): while ($service_query -> have_posts()) : $service_query -> the_post();	?>
<?php   $caption_bnrs++; ?>
<?php   if($caption_bnrs % 3 == 1) : ?>
        <ul class="caption_bnrs sp_m">
<?php   endif; ?>
          <li><a href="<?php the_permalink(); ?>">
					<span class="img"><img src="<?php the_post_thumbnail_url() ?>" alt="<?php the_field('short_exp'); ?> <?php the_title(); ?>" width="332" height="187" class="bnr_img"></span>
					<span class="sub"><?php the_field('short_exp'); ?></span>
					<span class="title"><?php the_title(); ?></span>
  				</a></li>
<?php   if($caption_bnrs % 3 == 0) : ?>
        </ul>
<?php   endif; ?>
<?php endwhile; endif; ?>
<?php if($caption_bnrs % 3 != 0) : ?>
        </ul>
<?php endif; ?>
      </div>
      <!-- /.index_section -->
    </section>


<?php
$args = array(
	'posts_per_page' => 5,
  'post_type' => 'shop',
);
$shop_query = new WP_Query($args);
?>
    <section class="index_newshop index_section">
      <h1 class="dot_line_title"><span>新店舗オープン情報</span></h1>
      <div class="slide">
        <div class="slidewrap">
<?php if ( $shop_query->have_posts() ) : ?>
<?php 	while ( $shop_query->have_posts() ) : $shop_query->the_post(); ?>
          <section class="shop">
            <div class="inner">
              <p class="img" style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></p>
              <div class="contents">
                <p class="date"><?php the_time('Y.m.d'); ?></p>
                <h1>「<?php the_title(); ?>」オープン！</h1>
                <p>〒<?php the_field('zip'); ?>　<?php the_field('address'); ?><br>TEL：<?php the_field('telephone'); ?><span class="sp_break"> / </span><?php the_field('service_time'); ?></p>
                <ul>
                  <li><a href="<?php the_permalink() ?>#map" class="box_link light">MAP</a></li>
                  <li><a href="<?php the_permalink() ?>" class="box_link light">店舗情報</a></li>
                </ul>
                <!-- /.contents -->
              </div>
            </div>
          </section>
<?php 	endwhile;?>
<?php endif; ?>
          <!-- /.slidewrap -->
        </div>

        <a href="#" class="slide_arrow l"></a>
        <a href="#" class="slide_arrow r"></a>
      </div>

      <p class="btn"><a href="<?php  echo site_url(); ?>/shop/" class="box_link">店舗一覧</a></p>
      <!-- /.index_newshop -->
    </section>

  </main>

<?php get_footer(); ?>
