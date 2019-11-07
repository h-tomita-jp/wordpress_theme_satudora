<?php $cat_bgcolor_list = array('お知らせ'=>'#d1904f', 'キャンペーン'=>'#eea2f2'); ?>

<?php get_header(); ?>

<?php
//記事の取得条件
$article_args = array(
  'paged' => get_query_var('paged') ?: 1,
  'posts_per_page' => 3,
  'post_type' => 'event',
  'meta_key' => 'list-order',
  'orderby' => 'meta_value_num',
  'order' => 'DESC'
);

$article_query = new WP_Query( $article_args );
?>

<main role="main" id="container" class="mw">

	<div class="topicpath w">
		<ul>
			<li><a href="<?php  echo site_url(); ?>/">ホーム</a></li>
			<li>イベント・キャンペーン</li>
		</ul>
	<!-- /.topicpath --></div>

	<section>
		<h1 class="page_title event">イベント・キャンペーン<br><span class="en">Event &amp; Campaign</span></h1>

		<div class="p_box bg_light6">
			<div class="contents_box w">
				<div id="eventList">
					<ul>
<?php if( $article_query ) : ?>
<?php while ( $article_query->have_posts() ) : $article_query->the_post(); ?>
						<li><a href="<?php the_permalink() ?>">
							<span class="img hv_wh"><img src="<?php the_post_thumbnail_url(); ?>" alt="<?php the_title(); ?>"></span>
							<span class="content">
								<?php
								/* 子カテゴリーのみを表示する */
								$categories = get_the_category();
								foreach ($categories as $category) {
								    if ($category->parent) {
									    $cat_name = $category->name;
											$cat_bgcolor = $cat_bgcolor_list[$cat_name];
								      echo sprintf("<span class='event_category' style='background-color: %s;color: #fff;'>%s</span>\n", $cat_bgcolor, $cat_name);
								    }
								}
								$sub_title = get_field('sub_title') ?: get_the_title();
								?>
								<span class="sub"><?php echo $sub_title ?></span>
								<span class="title"><?php the_title(); ?></span>
							</span>
						</a></li>
<?php endwhile; endif; ?>
					</ul>
				<!-- /#eventList --></div>

<?php wp_pagenavi(array('query'=>$article_query)); ?>

			<!-- /.contents_box --></div>
		</div>
	</section>

<!-- /#container --></main>

<?php get_footer(); ?>
