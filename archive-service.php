<?php get_header(); ?>

<main role="main" id="container" class="mw">

	<div class="topicpath w">
		<ul>
			<li><a href="<?php  echo site_url(); ?>/">ホーム</a></li>
			<li>サービス</li>
		</ul>
	<!-- /.topicpath --></div>

<?php
$args = array(
  'posts_per_page'=> -1,
  'post_type' => 'service',
  'orderby' => 'rand', // ランダムに記事を選ぶ
);
$query = new WP_Query($args);
?>

	<div class="index_main">
		<div class="slide">
			<ul>
<?php if( $query -> have_posts() ): while ($query -> have_posts()) : $query -> the_post();	?>
				<li>
					<a href="<?php the_permalink(); ?>"><img src="<?php the_post_thumbnail_url() ?>" width="645" height="386"></a>
				</li>
<?php endwhile; endif; ?>
			</ul>

			<a href="#" class="slide_arrow l"></a>
			<a href="#" class="slide_arrow r"></a>
		</div>
	<!-- --></div>

	<section class="index_nav1 com_title01">
		<h1><span>サービス</span><br>service</h1>
		<div class="w">
			<ul class="local_nav">
<?php if( $query -> have_posts() ): while ($query -> have_posts()) : $query -> the_post();	?>
				<li><a href="<?php the_permalink(); ?>">
					<img src="<?php the_post_thumbnail_url() ?>" width="464" alt="<?php the_title(); ?>">
					<dl>
						<dt><?php the_title(); ?></dt>
						<dd><?php echo str_replace( "\n", '<br class="pc">', get_the_excerpt() ); ?></dd>
					</dl>
				</a></li>
<?php endwhile; endif; ?>
<?php wp_reset_postdata(); ?>
			</ul>
		</div>
	</section>

<!-- /#container --></main>

<?php get_footer(); ?>
