<?php
/**
 * 管理画面に表示開始日時・表示終了日時を表示
 */
add_filter(
	'manage_sponsor_posts_columns',
	function ( $columns ) {
		$columns['showdate'] = '表示開始日時';
		$columns['hidedate'] = '表示終了日時';
		return $columns;
	}
);
add_action(
	'manage_sponsor_posts_custom_column',
	function ( $column_name, $post_id ) {
		if ( $column_name == 'showdate' ) {
			$cf_showdate = get_post_meta( $post_id, 'showdate', true );
			$showdate    = DateTime::createFromFormat( 'Ymd', $cf_showdate );
			echo ( $cf_showdate ) ? $showdate->format( 'Y年m月d日' ) : '－';
		}
		if ( $column_name == 'hidedate' ) {
			$cf_hidedate = get_post_meta( $post_id, 'hidedate', true );
			$hidedate    = DateTime::createFromFormat( 'Ymd', $cf_hidedate );
			echo ( $cf_hidedate ) ? $hidedate->format( 'Y年m月d日' ) : '－';
		}
	},
	10,
	2
);