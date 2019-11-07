<?php get_header(); ?>

<?php
$current_cat = get_queried_object();
$cat_name = $current_cat->name;
$page_title = $cat_name;
  
//記事の取得条件
$paged = get_query_var('paged') ? get_query_var('paged') : 1 ;
$article_args = array(
  'category_name' => $cat_name,
  'posts_per_page' => 2,
  'paged' => $paged
);

//年月の情報を持っていれば取得条件に追加します。
if( get_query_var('year') || get_query_var('monthnum') ) {
  $year = get_query_var('year');
  $month = get_query_var('monthnum');
  $archive_args = array(
    'year' => $year,
    'monthnum' => $month,
  );
  $article_args = array_merge( $article_args, $archive_args );
	$page_title = $year . '.' . $month;
}

$article_query = new WP_Query( $article_args );
?>

<main role="main" id="container" class="mw">

	<div class="topicpath w">
		<ul>
			<li><a href="<?php  echo site_url(); ?>/">ホーム</a></li>
			<li><a href="<?php  echo site_url(); ?>/news/">お知らせ</a></li>
			<li><?php echo $page_title; ?></li>
		</ul>
	<!-- /.topicpath --></div>

	<section>
		<h1 class="page_title news">お知らせ<br><span class="en">News &amp; Topics</span></h1>

		<div class="p_box bg_light6">
			<div class="contents_box w">
				<div class="contents_area" id="list">
					<p class="list_title"><?php echo $page_title; ?></p>

					<ul>
<?php if( $article_query ) : ?>
<?php while ( $article_query->have_posts() ) : $article_query->the_post(); ?>
						<li><a href="<?php the_permalink() ?>">
							<span class="date"><?php the_time('Y.m.d'); ?></span>
							<span class="title"><?php the_title(); ?></span>
						</a></li>
<?php endwhile; endif; ?>
					</ul>

<?php
if($article_query->found_posts > $article_query->post_count){
	wp_pagenavi(array('query'=>$article_query));
}
?>
				<!-- /.contents_area --></div>

<?php wp_reset_postdata(); ?>

<?php
$cat_slug = 'news';
$args = array(
	'category_name' => $cat_slug,
	'posts_per_page' => -1
);

$archive_query = new WP_Query( $args );

while ( $archive_query->have_posts() ) {
	$archive_query->the_post();
	//年月毎に記事情報を配列に格納
	$archive_list[ get_the_time( 'Y', $post->ID ) ][ get_the_time( 'n', $post->ID ) ][] = $post->ID;
	//カテゴリー毎に記事情報を配列に格納(親カテゴリーは除く)
	$categories = get_the_category();
	foreach ($categories as $category) {
	    $cat_name = $category->name;
	    if ($category->parent) {
				$cat_list[ $cat_name ][] = $post->ID;
	    }
	}
}
wp_reset_postdata();
?>

			<aside id="side" class="a_reverse">
				<dl>
					<dt>Archive</dt>
<?php if( $archive_list ) : ?>
					<dd>
						<div class="archive_wrap">
<?php foreach( $archive_list as $year => $year_list ) : ?>
							<div class="archive">
								<p class="year"><?php echo $year ?></p>
								<ul>
<?php foreach( $year_list as $month => $month_list ) : ?>
									<li>
										<a href="<?php echo esc_url( home_url( '/'.$cat_slug.'/'.$year.'/'.$month.'/' ) ) ?>">
											<?php echo $year.'.'.$month ?> (<?php echo count( $month_list ) ?>)
										</a>
									</li>
<?php endforeach; ?>
								</ul>
							</div>
<?php endforeach; ?>
						</div>
						<a href="#" class="arrow l hv_wh"></a>
						<a href="#" class="arrow r hv_wh"></a>
					</dd>
<?php endif; ?>
				</dl>

				<dl>
					<dt>Category</dt>
					<dd><ul>
<?php foreach( $cat_list as $catname => $title_list ) : ?>
						<li>
							<a href="<?php echo esc_url( home_url( '/'.$cat_slug.'/'.$catname.'/' ) ) ?>">
								<?php echo $catname ?> (<?php echo count( $title_list ) ?>)
							</a>
						</li>
<?php endforeach; ?>
					</ul></dd>
				</dl>

			<!-- /#side --></aside>
			<!-- /.contents_box --></div>
		</div>

	</section>

<!-- /#container --></main>

<?php get_footer(); ?>
