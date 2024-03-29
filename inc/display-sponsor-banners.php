<?php
add_action( 'snow_monkey_append_contents', 'display_sponsor_banners' );
function display_sponsor_banners() {
	global $post;

	$today = (int) date( 'Ymd' );

	$args = array(
		'post_type'      => 'sponsor',
		'posts_per_page' => 99,
		'meta_key'       => 'ruby',
		'orderby'        => 'meta_value',
		'order'          => 'ASC',
		'meta_query'     => array(
			'relation' => 'AND',
			array(
				'key'     => 'showdate',
				'value'   => $today,
				'compare' => '<=',
				'type'    => 'NUMERIC',
			),
			array(
				'key'     => 'hidedate',
				'value'   => $today,
				'compare' => '>',
				'type'    => 'NUMERIC',
			),
		),
	);

	$banner_posts = get_posts( $args );
	if ( $banner_posts ) :
		?>
<aside class="wpz-footer-banner c-container">
	<h2 class="smb-section__title">スポンサー各社さま<br class="block-min-40em"><span>（敬称略・50音順）</span></h2>
	<ul class="wpz-footer-banner__box">
		<?php
		foreach ( $banner_posts as $post ) :
			$sponsor_name = $post->post_title;
			$logo_url     = get_the_post_thumbnail_url( get_the_ID(), 'medium' );
			$page_link    = get_post_meta( get_the_ID(), 'pagelink', true );
			?>
		<li>
			<a href="<?php echo esc_url( $page_link ); ?>" target="_blank" rel="noreferrer noopener">
				<figure>
					<img src="<?php echo esc_url( $logo_url ); ?>" alt="<?php echo esc_html( $sponsor_name . 'さまロゴマーク' ); ?>">
				</figure>
				<h3><?php echo esc_html( $sponsor_name ); ?></h3>
			</a>
		</li>
			<?php
		endforeach;
		?>
	</ul>
</aside>
		<?php
	endif;
	wp_reset_postdata();
};
