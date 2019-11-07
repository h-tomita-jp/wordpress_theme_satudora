<?php $cat_bgcolor_list = array('beauty'=>'#e86ca6', 'sports'=>'#3e82de', 'parenting'=>'#f5972c', 'health'=>'#23ba92', 'housework'=>'#e85656'); ?>

<?php get_header(); ?>

<?php
$current_cat = get_queried_object();
$cat_name = $current_cat->name;
$cat_slug = $current_cat->slug;
$page_title = $cat_name;

$column_flag = $cat_name === 'コラム' ? true : false;

//記事の取得条件
$paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
$posts_per_page = $column_flag ? 6 : 3;
$article_args = array(
  // 'category_name' => $category_name,
  'category_name' => $cat_slug,
  'posts_per_page' => $posts_per_page,
  'paged' => $paged
);

$article_query = new WP_Query( $article_args );
?>

<main role="main" id="container" class="mw">

	<div class="topicpath w">
		<ul>
			<li><a href="<?php  echo site_url(); ?>/">ホーム</a></li>
			<li><a href="<?php  echo site_url(); ?>/column/">コラム</a></li>
<?php if(!$column_flag) : ?>
				<li><?php echo $cat_name; ?></li>
<?php endif; ?>
		</ul>
	<!-- /.topicpath --></div>

	<p class="page_title">コラム<br><span class="en">Column</span></p>

		<div class="p_box bg_light">
			<div class="w">
				<ul class="column_tab">
<?php
$cat_list = array('beauty'=>'美容', 'health'=>'健康', 'housework'=>'家事', 'parenting'=>'子育て', 'sports'=>'スポーツ');
foreach ($cat_list as $key => $value){
	$class = $key == $cat_slug ? $key.' current' : $key;
  echo sprintf("\t\t\t\t\t".'<li><a href="%s" class="%s"><span>%s</span></a></li>'."\n", site_url().'/column/'.$key.'/', $class, $value);
}
?>
				<!-- /.column_tab --></ul>

				<div class="column_box row">
<?php if(!$column_flag) : ?>
					<div class="column_left">
<?php endif; ?>
						<?php $class = $column_flag ? 'column_list all_list' : 'column_list v_list'; ?>
						<div class="<?php echo $class ?>">
<?php if( $article_query ) : ?>
<?php while ( $article_query->have_posts() ) : $article_query->the_post(); ?>
							<a href="<?php the_permalink() ?>"><article>
								<div class="ph"><p><span style="background-image: url(<?php the_post_thumbnail_url(); ?>);"></span></p></div>
								<div>
									<?php
									/* 子カテゴリーのみを表示する */
									$categories = get_the_category();
									foreach ($categories as $category) {
										if ($category->parent) {
											$cat_bgcolor = $cat_bgcolor_list[$category->slug];
											$cat_name = $category->name;
											echo sprintf("<p class='column_cat' style='background-color: %s;'>%s</p>\n", $cat_bgcolor, $cat_name);
										}
									}
									?>
									<h1><?php the_title(); ?></h1>
									<p><?php echo wp_trim_words( get_the_content(), 40, '...' ); ?></p>
								</div>
							</article></a>
<?php endwhile; endif; ?>
						<!-- /.column_list --></div>
<?php wp_pagenavi(array('query'=>$article_query)); ?>
<?php if(!$column_flag) : ?>
					<!-- /.column_left --></div>
<?php endif; ?>
<?php wp_reset_postdata(); ?>

<?php if(!$column_flag) : ?>
					<div class="column_side">
						<div class="sp_box">
							<aside class="latest">
								<h1>最新のコラム</h1>

								<div class="column_list v_list">

<?php $the_query = new WP_Query( array(
        'posts_per_page' => 3,
        'category_name' => 'column',
) ); ?>
<?php if ( $the_query->have_posts() ) while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
									<a href="<?php the_permalink() ?>"><article>
										<div class="ph"><p><span style="background-image: url(<?php the_post_thumbnail_url() ?>)"></span></p></div>
										<div>
											<?php
											/* 子カテゴリーのみを表示する */
											$categories = get_the_category();
											foreach ($categories as $category) {
											    if ($category->parent) {
														$cat_bgcolor = $cat_bgcolor_list[$category->slug];
												    $cat_name = $category->name;
											      echo sprintf("<p class='column_cat' style='background-color: %s;'>%s</p>", $cat_bgcolor, $cat_name);
											    }
											}
											?>
											<h1><?php the_title(); ?></h1>
										</div>
									</article></a>
<?php endwhile;?>

								<!-- /.column_list --></div>
							</aside>

							<aside class="ranking">
								<h1>人気記事 TOP3</h1>
								<div class="column_list v_list">

									<?php
									if (function_exists('wpp_get_mostpopular')) {
									
									  $arg = array (
										'cat' => get_category_by_slug("column")->cat_ID,
									    'range' => 'all', //集計する期間（weekly,monthly,all）
									    'limit' => 3, //表示数
										);
										wpp_get_mostpopular($arg);//リストが出力される。
									}
									?>

								<!-- /.column_list --></div>
							</aside>
						<!-- /.sp_box --></div>
						<p class="side_bnr"><a href="<?php  echo site_url(); ?>/member/">サツドラ会員特典</a></p>
					<!-- /.column_side --></div>
<?php endif; ?>
				<!-- /.column_box --></div>

			<!-- /.w --></div>


			<div class="w">
				<p class="shop_search_btn"><a href="<?php  echo site_url(); ?>/shop/" class="box_link"><span>近くの店舗を探す</span></a></p>
			<!-- /.w --></div>
		<!-- /.bg_light --></div>

	</section>

<!-- /#container --></main>

<?php get_footer(); ?>
