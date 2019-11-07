<?php get_header(); ?>

<main role="main" id="container" class="mw">

	<div class="topicpath w">
		<ul>
			<li><a href="<?php  echo site_url(); ?>/">ホーム</a></li>
			<li><a href="<?php  echo site_url(); ?>/shop/">店舗・チラシ検索</a></li>
<?php if (strpos(esc_url($_SERVER['REQUEST_URI']), 'dispensing')) : ?>
			<li>サツドラ調剤薬局・ファミリー薬局一覧</li>
<?php else : ?>
			<li>サツドラ店舗一覧</li>
<?php endif; ?>
		</ul>
	<!-- /.topicpath --></div>

<?php
if (strpos(esc_url($_SERVER['REQUEST_URI']), 'dispensing')) :
	get_template_part('inc-dispensing-list');
else :
	get_template_part('inc-shop-list');
endif;
?>

<!-- /#container --></main>

<?php get_footer(); ?>
