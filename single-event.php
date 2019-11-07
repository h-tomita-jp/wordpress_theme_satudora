<?php $cat_bgcolor_list = array('お知らせ'=>'#d1904f', 'キャンペーン'=>'#eea2f2'); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
<main role="main" id="container" class="mw">

	<div class="topicpath w">
		<ul>
			<li><a href="<?php  echo site_url(); ?>/">ホーム</a></li>
			<li><a href="<?php  echo site_url(); ?>/event/">イベント・キャンペーン</a></li>
			<li><?php the_title(); ?></li>
		</ul>
	<!-- /.topicpath --></div>

	<p class="page_title event">イベント・キャンペーン<br><span class="en">Event &amp; Campaign</span></p>

	<div class="p_box bg_light6">
		<div class="contents_box w">
			<article id="entry">
				<header>
					<?php
					/* 子カテゴリーのみを表示する */
					$categories = get_the_category();
					foreach ($categories as $category) {
					    if ($category->parent) {
						    $cat_name = $category->name;
								$cat_bgcolor = $cat_bgcolor_list[$cat_name];
					      echo sprintf("<span class='event_category' style='background-color: %s;color: #fff;'>%s</span>", $cat_bgcolor, $cat_name);
					    }
					}
					$sub_title = get_field('sub_title') ? get_field('sub_title') : get_the_title();
					?>
					<p class="sub"><?php echo $sub_title ?></p>
					<h1><?php the_title(); ?></h1>
				</header>

				<div class="body">
					<?php the_content('Read more'); ?>
				<!-- /.body --></div>

				<div class="news_pager">
					<p class="list"><a href="<?php  echo site_url(); ?>/event/" class="box_link light event">イベント・キャンペーン一覧</a></p>
				</div>

			<!-- /.entry --></article>

		<!-- /#entry --></div>

	<!-- /.bg_light6 --></div>

<!-- /#container --></main>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
