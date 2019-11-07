<?php $cat_bgcolor_list = array('お知らせ'=>'#d1904f', 'キャンペーン'=>'#eea2f2'); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<main role="main" id="container" class="mw">

	<div class="topicpath w">
		<ul>
			<li><a href="<?php  echo site_url(); ?>/">ホーム</a></li>
			<li><a href="<?php  echo site_url(); ?>/service/">サービス</a></li>
			<li><?php the_title(); ?></li>
		</ul>
	<!-- /.topicpath --></div>

<?php the_content('Read more'); ?>

<?php
$args = array(
  'post__not_in' => array(get_the_ID()), // 今読んでいる記事を除く
  'posts_per_page'=> 10,
  'post_type' => 'service',
  'orderby' => 'rand', // ランダムに記事を選ぶ
);
$query = new WP_Query($args);
?>

	<div class="service_under">
		<div class="c1">
			<ul class="col_4 w">
<?php if( $query -> have_posts() ): while ($query -> have_posts()) : $query -> the_post();	?>
				<li><a href="<?php the_permalink(); ?>">
					<img src="<?php the_post_thumbnail_url() ?>" width="246" height="148" alt="<?php the_title(); ?>">
					<p class="c_black"><?php the_title(); ?></p>
				</a></li>
<?php endwhile; endif; ?>
<?php wp_reset_postdata(); ?>
			</ul>
		<!-- /.c1 --></div>
	<!-- /.service_under --></div>


<!-- /#container --></main>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
