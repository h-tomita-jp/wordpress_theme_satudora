<?php $cat_bgcolor_list = array('beauty'=>'#e86ca6', 'sports'=>'#3e82de', 'parenting'=>'#f5972c', 'health'=>'#23ba92', 'housework'=>'#e85656'); ?>

<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<main role="main" id="container" class="mw">

	<div class="topicpath w">
		<ul>
			<li><a href="<?php  echo site_url(); ?>/">ホーム</a></li>
			<li><a href="<?php  echo site_url(); ?>/column/">コラム</a></li>
			<li><?php the_title(); ?></li>
		</ul>
	<!-- /.topicpath --></div>

	<p class="page_title">コラム<br><span class="en">Column</span></p>

		<div class="p_box bg_light">
			<div class="w">
				<ul class="column_tab">
					<li><a href="<?php  echo site_url(); ?>/column/beauty/" class="beauty"><span>美容</span></a></li>
					<li><a href="<?php  echo site_url(); ?>/column/health/" class="health"><span>健康</span></a></li>
					<li><a href="<?php  echo site_url(); ?>/column/housework/" class="housework"><span>家事</span></a></li>
					<li><a href="<?php  echo site_url(); ?>/column/parenting/" class="parenting"><span>子育て</span></a></li>
					<li><a href="<?php  echo site_url(); ?>/column/sports/" class="sports"><span>スポーツ</span></a></li>
				<!-- /.column_tab --></ul>

				<div class="column_box row">
					<div class="column_left">
						<article class="column_detail">
							<header>
								<?php
								/* 子カテゴリーのみを表示する */
								$categories = get_the_category();
								foreach ($categories as $category) {
								    if ($category->parent) {
									    $cat_name = $category->name;
									    $cat_slug = $category->slug;
									    $cat_link = site_url() . '/column/' . $cat_slug . '/';
											$cat_bgcolor = $cat_bgcolor_list[$cat_slug];
								      echo sprintf("<a class='column_cat' href='%s' style='background-color: %s'>%s</a>", $cat_link, $cat_bgcolor, $cat_name);
								    }
								}
								?>

								<time><?php the_time('Y.m.d'); ?></time>
								<h1><?php the_title(); ?></h1>
							</header>

							<div class="entry_body">
								<?php the_content('Read more'); ?>
							<!-- /.entry_body --></div>
						</article>

			      <?php //前後の投稿を取得しておく
			      $prev_post = get_next_post(true);
			      $next_post = get_previous_post(true);
			      ?>

						<?php	// 同じカテゴリから記事を10件呼び出し保存しておく
						$categories = get_the_category();
						$category_ID = array();
						foreach ($categories as $category) {
						    if ($category->parent) {
								  array_push( $category_ID, $category -> cat_ID);
						    }
						}
						$args = array(
						  'post__not_in' => array(get_the_ID()), // 今読んでいる記事を除く
						  'posts_per_page'=> 10,
						  'category__in' => $category_ID,
						  'orderby' => 'rand', // ランダムに記事を選ぶ
						);
						$same_cat_query = new WP_Query($args);
						?>

						<div id="sp_clone" class="sp"></div>
					<!-- /.column_left --></div>

<?php endwhile; endif; ?>

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
										<div class="ph"><p><span style="background-image: url(<?php the_post_thumbnail_url(); ?>)"></span></p></div>
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
				<!-- /.column_box --></div>

				<div class="column_prev_next pc">
					<ul class="row">
<?php if ($prev_post): ?>
						<li class="prev"><a href="<?php echo get_permalink( $prev_post->ID ); ?>">
							<span class="arrow"></span>
							<span class="ph"><span><span style="background-image: url(<?php echo get_the_post_thumbnail_url( $prev_post->ID ); ?>);"></span></span></span>
							<span class="title"><span><?php echo $prev_post->post_title; ?></span></span>
						</a></li>
<?php endif; ?>
	
<?php if ($next_post): ?>
						<li class="next"><a href="<?php echo get_permalink( $next_post->ID ); ?>">
							<span class="arrow"></span>
							<span class="ph"><span><span style="background-image: url(<?php echo get_the_post_thumbnail_url( $next_post->ID ); ?>);"></span></span></span>
							<span class="title"><span><?php echo $next_post->post_title; ?></span></span>
						</a></li>
<?php endif; ?>
					</ul>
				<!-- /.column_prev_next --></div>

			<!-- /.w --></div>


			<aside class="column_relation pc">
				<h1 class="dot_line_title"><span>こちらの記事もオススメです</span></h1>

				<div class="w">
					<div class="slide">
						<ul class="column_list">
<?php if( $same_cat_query -> have_posts() ): while ($same_cat_query -> have_posts()) : $same_cat_query -> the_post();	?>
							<li>
							<a href="<?php the_permalink(); ?>"><article>
								<div class="ph"><p><span style="background-image: url(<?php the_post_thumbnail_url() ?>);"></span></p></div>
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
									<p><?php echo wp_trim_words( get_the_content(), 38, '...' ); ?></p>
								</div>
							</article></a>
							</li>
<?php endwhile; endif; ?>
<?php wp_reset_postdata(); ?>
						</ul>

						<a href="#" class="slide_arrow l slick-arrow"></a>
						<a href="#" class="slide_arrow r slick-arrow"></a>
					</div>
				<!-- /.w --></div>
			<!-- /.column_relation --></aside>

			<div class="w">
				<p class="shop_search_btn"><a href="<?php  echo site_url(); ?>/shop/" class="box_link"><span>近くの店舗を探す</span></a></p>
			<!-- /.w --></div>
		<!-- /.bg_light --></div>

	</section>

<!-- /#container --></main>

<?php get_footer(); ?>
