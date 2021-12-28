<?php
/**
 * Plugin name: WPZoomUP Sponsor Banner 追加プラグイン
 * Plugin URI: https://github.com/wpzoomup/wpz-sponsor-banners
 * Description: Snow Monkey テーマで作られた WPZoomUP サイトのフッター部分にスポンサーバナーを追加
 * Version: 0.1.2
 * Author: WPZoomUP
 * Author URI: https://wpzoomup.com/
 * Text Domain: wpz-sponsor-banner
 * License: GPL-2.0+
 *
 * @package wpz-sponsor-banner
 */

/**
 * 定数を宣言
 */
define( 'WPZ_SB_PLUGIN_URL', plugins_url( '', __FILE__ ) );  // このプラグインのURL.
define( 'WPZ_SB_PLUGIN_PATH', plugin_dir_path( __FILE__ ) ); // このプラグインのパス.

/**
 * Snow Monkey 以外のテーマを利用している場合は有効化してもカスタマイズが反映されないようにする
 */
$theme = wp_get_theme();
if ( 'snow-monkey' !== $theme->template && 'snow-monkey/resources' !== $theme->template ) {
	return;
}

// 表示用の CSS 読み込み
function wpz_sb_enqueue_styles() {
	wp_enqueue_style( 'wpz-sponsor-banner', WPZ_SB_PLUGIN_URL . '/css/style.css', array( Framework\Helper::get_main_style_handle() ), filemtime( WPZ_SB_PLUGIN_PATH . '/css/style.css' ) );
}
add_action( 'wp_enqueue_scripts', 'wpz_sb_enqueue_styles' );

/**
 * 外部ファイルの読み込み /inc
 */
require_once WPZ_SB_PLUGIN_PATH . 'inc/display-sponsor-banners.php';
require_once WPZ_SB_PLUGIN_PATH . 'inc/sponsor-custom_posts_column.php';
