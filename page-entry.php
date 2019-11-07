<?php get_header(); ?>

<main role="main" id="container" class="mw">

	<div class="topicpath w">
		<ul>
			<li><a href="<?php  echo site_url(); ?>/">ホーム</a></li>
			<li><a href="<?php  echo site_url(); ?>/member/">メールマガジン会員</a></li>
			<li>会員登録</li>
		</ul>
	<!-- /.topicpath --></div>

	<p class="page_title">メールマガジン会員<br><span class="en">Member</span></p>

	<section id="memberContents">
		<header>
			<h1 class="dot_line_title"><span>会員登録</span></h1>
		</header>

		<div class="bg_light3 p_box">
			<div class="w">
				<a id="form" class="target pt"></a>
				<div class="form_wrap">
<?php echo do_shortcode('[mwform_formkey key="352"]'); ?>
				<!-- /.form_wrap --></div>
			<!-- /.w --></div>
		<!-- /.bg_light3.p_box --></div>

		<aside class="member_bnr bg_light6">
			<ul class="w">
				<li><a href="<?php  echo site_url(); ?>/member/"><span><img src="<?php  echo get_template_directory_uri(); ?>/img/bnr_ico01.png" alt="" width="50" height="50"></span>メールマガジン会員特典</a></li>
				<li><a href="<?php  echo site_url(); ?>/member/entry/"><span><img src="<?php  echo get_template_directory_uri(); ?>/img/bnr_ico02.png" alt="" width="50" height="50"></span>会員登録</a></li>
			</ul>
		<!-- /.member_bnr --></aside>

		<aside class="member_nav a_reverse">
			<ul>
				<li><a href="<?php  echo site_url(); ?>/member/faq/">よくある質問</a></li>
				<li><a href="<?php  echo site_url(); ?>/member/agreement/">ご利用規約</a></li>
				<li><a href="<?php  echo site_url(); ?>/member/migration/">サツウェブ・サツドラNETショップ<br class="sp">会員移行について</a></li>
			</ul>
		<!-- /.member_nav --></aside>
	</section>

<!-- /#container --></main>

<?php get_footer(); ?>
