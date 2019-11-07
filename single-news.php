<?php get_header(); ?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

<main role="main" id="container" class="mw">

	<div class="topicpath w">
		<ul>
			<li><a href="<?php  echo site_url(); ?>/">ホーム</a></li>
			<li><a href="<?php  echo site_url(); ?>/news/">お知らせ</a></li>
			<li><?php the_title(); ?></li>
		</ul>
	<!-- /.topicpath --></div>

	<p class="page_title news">お知らせ<br><span class="en">News &amp; Topics</span></p>

	<div class="p_box bg_light6">
		<div class="contents_box w">
			<article class="contents_area" id="entry">
				<header>
					<time><?php the_time('Y.m.d'); ?></time>
					<?php
					/* 子カテゴリーのみを表示する */
					$categories = get_the_category();
					foreach ($categories as $category) {
					    $cat_name = $category->name;
					    $cat_link = esc_url(site_url() . '/news/' . $cat_name . '/');
					    if ($category->parent) {
					      echo sprintf("｜<a href='%s'>%s</a>", $cat_link, $cat_name);
					    }
					}
					?>

					<h1><?php the_title(); ?></h1>
				</header>


				<div class="body">
					<?php the_content('Read more'); ?>
				<!-- /.body --></div>

				<div class="news_pager">
<?php if (get_previous_post(true)):?>
					<p class="next"><a href="<?php echo get_permalink( get_previous_post(true)->ID ); ?>" class="box_link light">次の記事</a></p>
<?php endif; ?>
<?php if (get_next_post(true)):?>
					<p class="prev"><a href="<?php echo get_permalink( get_next_post(true)->ID ); ?>" class="box_link light">前の記事</a></p>
<?php endif; ?>
					<p class="list"><a href="<?php  echo site_url(); ?>/news/" class="box_link light">記事一覧</a></p>
				</div>

			<!-- /.contents_area --></article>

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
		<!-- /#entry --></div>

	<!-- /.bg_light6 --></div>

<!-- /#container --></main>
<?php endwhile; endif; ?>

<?php get_footer(); ?>
