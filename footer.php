  <footer id="footer" class="mw">
    <script>
      (function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/ja_JP/sdk.js#xfbml=1&version=v2.6";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, 'script', 'facebook-jssdk'));
    </script>
    <div class="w">
      <div class="social">
        <dl class="fb">
          <dt>Facebook公式ページ</dt>
          <dd>
            <div class="fb-page" data-href="https://www.facebook.com/sapporodrug/" data-tabs="timeline" data-width="330" data-height="520" data-small-header="true" data-adapt-container-width="true" data-hide-cover="true" data-show-facepile="true">
              <blockquote cite="https://www.facebook.com/sapporodrug/" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/sapporodrug/">サツドラ</a></blockquote>
            </div>
          </dd>
        </dl>
        <dl class="tw">
          <dt>Twitter公式アカウント</dt>
          <dd>
            <a class="twitter-timeline" href="https://twitter.com/satsu_dora" data-widget-id="344696789041033216" height="520" lang="ja">@satsu_dora からのツイート</a>
            <script>
              ! function(d, s, id) { var js, fjs = d.getElementsByTagName(s)[0],
                  p = /^http:/.test(d.location) ? 'http' : 'https'; if (!d.getElementById(id)) { js = d.createElement(s);
                  js.id = id;
                  js.src = p + "://platform.twitter.com/widgets.js";
                  fjs.parentNode.insertBefore(js, fjs); } }(document, "script", "twitter-wjs");
            </script>
          </dd>
        </dl>
        <div class="hv_wh">
          <dl class="ig">
            <dt>Instagram公式アカウント</dt>
            <dd><a href="https://www.instagram.com/satudora_official/" target="_blank"><img src="<?php  echo get_template_directory_uri(); ?>/img/bnr_instagram.png" alt="Instagram公式アカウント キャンペーン情報やおすすめ商品情報をお届け" width="330" height="140"></a></dd>
          </dl>
          <dl class="yt">
            <dt>Youtube公式チャンネル</dt>
            <dd><a href="https://www.youtube.com/channel/UC_m8Uo3FdRvV2577ak3TM-Q" target="_blank"><img src="<?php  echo get_template_directory_uri(); ?>/img/bnr_youtube.png" alt="Youtube公式チャンネル テレビCMをはじめ商品紹介ムービー等公開中！" width="330" height="140"></a></dd>
          </dl>
          <dl class="line">
            <dt>公式LINE@</dt>
            <dd><a href="https://page.line.me/satsudora/" target="_blank"><img src="<?php  echo get_template_directory_uri(); ?>/img/bnr_line.png" alt="公式LINE@ LINEの友だち追加からQRコードを読み込んで登録！" width="330" height="140"></a></dd>
          </dl>
        </div>
        <!-- /.social -->
      </div>
      <nav>
        <ul>
          <li><a href="<?php  echo site_url(); ?>/sitemap/">サイトマップ</a></li>
          <li><a href="<?php  echo site_url(); ?>/privacy/">個人情報保護方針</a></li>
          <li><a href="<?php  echo site_url(); ?>/antisocial/">反社会的勢力排除宣言</a></li>
          <li><a href="<?php  echo site_url(); ?>/smpolicy/">ソーシャルメディアポリシー</a></li>
        </ul>
      </nav>

      <p id="pagetop"><a href="#container">Page Top</a></p>

      <p><small>&copy; 2016 SAPPORO DRUG STORE CO.,LTD.</small></p>
    </div>
    <!-- /#footer -->
  </footer>


  <!-- Optional JavaScript -->
  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>

  <!-- slick JavaScript -->
  <script src="<?php  echo get_template_directory_uri(); ?>/js/slick.min.js"></script>

  <!-- Original JavaScript -->
  <script src="<?php  echo get_template_directory_uri(); ?>/js/script.js"></script>
<?php if ( is_front_page() ) : ?>
  <script src="<?php  echo get_template_directory_uri(); ?>/js/index.js"></script>
<?php endif ?>
<?php if ( !is_front_page() && ( in_category('news') || get_post_type() === 'event' ) ) : ?>
  <script src="<?php  echo get_template_directory_uri(); ?>/js/news.js"></script>
<?php endif ?>
<?php if ( !is_front_page() && in_category('column') ) : ?>
  <script src="<?php  echo get_template_directory_uri(); ?>/js/column.js"></script>
<?php endif ?>
<?php if ( get_post_type() === 'shop' || is_page('shop') ) : ?>
  <script src="<?php  echo get_template_directory_uri(); ?>/js/shop.js"></script>
<?php endif ?>
<?php if ( !is_front_page() && get_post_type() === 'service' && !(is_archive()) ) : ?>
<?php   if (file_exists('js/' . get_post( get_the_ID() )->post_name . '.js')) : ?>
  <script src="js/<?php echo get_post( get_the_ID() )->post_name; ?>.js"></script>
<?php   endif ?>
<?php endif ?>
<?php if ( !is_front_page() && get_post_type() === 'service' && is_archive() ) : ?>
  <script src="js/index.js"></script>
<?php endif ?>
<?php if ( is_page('faq') ) : ?>
  <script src="<?php  echo get_template_directory_uri(); ?>/js/faq.js"></script>
<?php endif ?>

<?php if ( is_page('entry') ) : ?>
<?php include locate_template( 'inc-page-entry-js-create-list.php' ); ?>
<?php endif ?>

<?php wp_footer(); ?>

<?php if ( is_page('entry') ) : ?>
<?php include locate_template( 'inc-page-entry-js.php' ); ?>
<?php endif ?>

</body>

</html>
