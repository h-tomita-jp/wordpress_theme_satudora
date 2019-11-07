<!doctype html>
<html lang="ja">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Font Awesome CSS -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">

  <!-- slick CSS -->
  <link rel="stylesheet" href="<?php  echo get_template_directory_uri(); ?>/css/slick.css" type="text/css">

  <!-- Original CSS -->
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/template.css">
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/base.css">
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/index.css">
<?php if ( !is_front_page() && ( in_category('news') || get_post_type() === 'event' || is_page('event') ) ) : ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/news.css">
<?php endif ?>
<?php if ( !is_front_page() && in_category('column') ) : ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/column.css">
<?php endif ?>
<?php if ( !is_front_page() && ( get_post_type() === 'shop' || is_page('shop') ) ) : ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/shop.css">
<?php endif ?>
<?php if ( !is_front_page() && get_post_type() === 'service' && !(is_archive()) ) : ?>
  <link rel="stylesheet" type="text/css" href="../css/service_common.css">
  <link rel="stylesheet" type="text/css" href="css/<?php echo get_post( get_the_ID() )->post_name; ?>.css">
<?php endif ?>
<?php if ( !is_front_page() && get_post_type() === 'service' && is_archive() ) : ?>
  <link href="css/service.css" rel="stylesheet">
<?php endif ?>
<?php if ( is_page('contact') ) : ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/contact.css">
<?php endif ?>
<?php if ( is_page('mail') || is_page('entry') ) : ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/form.css">
<?php endif ?>
<?php if ( is_page('member') || is_page('entry') || is_page('agreement') || is_page('faq') || is_page('migration') ) : ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/member.css">
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/member_form.css">
<?php endif ?>
<?php if ( is_page('privacy') || is_page('antisocial') ) : ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/privacy.css">
<?php endif ?>
<?php if ( is_page('smpolicy') ) : ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/smpolicy.css">
<?php endif ?>
<?php if ( is_page('faq') ) : ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/faq.css">
<?php endif ?>
<?php if ( is_page('sitemap') ) : ?>
  <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/sitemap.css">
<?php endif ?>

  <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">

  <?php wp_head(); ?>

</head>

<body>

  <header id="header" class="mw">
    <div class="w">
      <h1><a href="<?php  echo site_url(); ?>/"><img src="<?php  echo get_template_directory_uri(); ?>/img/logo.png" alt="サツドラ SAPPORO DRUG STORE" width="210" height="50"></a></h1>

      <p class="sp_nav"><a href="#"></a></p>
      <nav>
        <ul class="gnav">
          <li><a href="<?php  echo site_url(); ?>/news/"<?php if ( !is_front_page() && in_category('news') ) { echo ' class="current"'; } ?>><span>お知らせ</span></a></li>
          <li><a href="<?php  echo site_url(); ?>/shop/"<?php if ( !is_front_page() && get_post_type() === 'shop' || is_page('shop') ) { echo ' class="current"'; } ?>><span>店舗・チラシ検索</span></a></li>
          <li class="event"><a href="<?php  echo site_url(); ?>/event/"<?php if ( !is_front_page() && get_post_type() === 'event' || is_page('event') ) { echo ' class="current"'; } ?>><span>イベント・キャンペーン</span></a></li>
          <li><a href="<?php  echo site_url(); ?>/column/"<?php if ( !is_front_page() && in_category('column') ) { echo ' class="current"'; } ?>><span>コラム</span></a></li>
          <li><a href="<?php  echo site_url(); ?>/service/"<?php if ( !is_front_page() && ( get_post_type() === 'service' ) ) { echo ' class="current"'; } ?>><span>サービス</span></a></li>
          <li><a href="<?php  echo site_url(); ?>/member/"><span>サツドラ会員</span></a></li>
          <!-- /.gnav -->
        </ul>
        <ul class="snav">
          <li><a href="<?php  echo site_url(); ?>/contact/">お問い合わせ</a></li>
          <!-- /.snav -->
        </ul>
      </nav>
      <!-- /#header -->
    </div>
  </header>
