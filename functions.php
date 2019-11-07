<?php
function my_change_title_separator( $sep ) {
	// WordPress 4.4 以上でのタイトルセパレーターの設定
	$sep = '|';
	return $sep;
}
add_filter( 'document_title_separator', 'my_change_title_separator' );

add_theme_support( 'title-tag' );

add_theme_support('post-thumbnails');

function custom_single_popular_post( $content, $p, $instance ){
    return '<a href="' .  get_the_permalink($p->id) . '"><article><div class="ph"><p><span style="background-image: url(' . get_the_post_thumbnail_url($p->id) . ');"></span></p></div><div><p class="rank"></p><h1>' .  esc_attr($p->title) . '</h1></div></article></a>'."\n";
}
add_filter( 'wpp_post', 'custom_single_popular_post', 10, 3 );

function my_add_columns($columns) {
  $columns['list-order'] = '一覧表示順';
  return $columns;
}
add_filter( 'manage_edit-event_columns', 'my_add_columns' );

function my_add_columns_content($column_name, $post_id) {
  if ( $column_name == 'list-order' ) {
    $cf_listOrder = get_post_meta( $post_id , 'list-order' , true );
    echo ( $cf_listOrder ) ? $cf_listOrder : '－';
  }
}
add_action( 'manage_event_posts_custom_column', 'my_add_columns_content', 10, 2 );

function my_add_sort($columns){
  $columns['list-order'] = '一覧表示順';
  return $columns;
}
function my_add_sort_by_meta( $query ) {
  if ( $query->is_main_query() && ( $orderby = $query->get( 'orderby' ) ) ) {
    switch( $orderby ) {
      case '一覧表示順':
        $query->set( 'meta_key', 'list-order' );
        $query->set( 'orderby', 'meta_value_num' );
        break;
    }
  }
}
add_filter( 'manage_edit-event_sortable_columns', 'my_add_sort');
add_action( 'pre_get_posts', 'my_add_sort_by_meta', 1 );

function custom_rewrite_basic() {
    add_rewrite_rule( 'shop/dispensing/?$', 'index.php?post_type=shop', 'top' );
    add_rewrite_rule( 'shop/dispensing/page/([0-9]{1,})/?$', 'index.php?post_type=shop&paged=$matches[1]', 'top' );
}
add_action('init', 'custom_rewrite_basic');
// 重要: リライトルールの変更後は、忘れずにリライトルールデータベースの内容をフラッシュし、再作成してください。
// 具体的には WordPress の 管理画面から、「設定」->「パーマリンク設定」を選択し、何も変更せずに「変更を保存」をクリックしてください。
// 参考: 現状のルール確認 var_dump( get_option( 'rewrite_rules' ) );

function shortcode_templateurl() {
    return get_bloginfo('template_url');
}
add_shortcode('template_url', 'shortcode_templateurl');

// site_url = http://site.com/wp の場合 "wp/" を返却、 http://site.com の場合 "" を返却
function shortcode_surlend() {
	return substr(wp_make_link_relative(site_url()), 1) ? substr(wp_make_link_relative(site_url()), 1) . '/' : "";
}
add_shortcode('surlend', 'shortcode_surlend');

?>
