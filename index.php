<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">

<?php
$args = array(
	'post_type' => array( 'exhibition' ),
	'posts_per_page' => '-1',
  'orderby' => 'meta_value',
  'meta_key' => '_igv_date_open',
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
  $current_year = 0;

?>
        <ul id="exhibition-list" class="grid-item item-s-12 item-m-9 margin-bottom-small">
<?php
	while ( $query->have_posts() ) {
		$query->the_post();

    $open = get_post_meta($post->ID, '_igv_date_open', true);
    $year = date('Y', $open);

    if ($year !== $current_year) {
      $current_year = $year;
?>
          <li class="margin-bottom-small">
            <div class="margin-bottom-tiny font-sans"><?php echo $year; ?></div>
<?php
    }
?>
            <h2 <?php post_class('margin-bottom-small font-size-large font-leading-tighter'); ?> id="post-<?php the_ID(); ?>">
              <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
            </h2>
<?php
  }
?>
        </ul>
<?php
}

wp_reset_postdata();

$args = array(
	'post_type' => array( 'page' ),
	'posts_per_page' => '-1',
);

$query = new WP_Query( $args );

if ( $query->have_posts() ) {
?>
        <div class="grid-item item-s-12 item-m-3 item-m-3">
          <div class="margin-bottom-tiny">&nbsp;</div>
<?php
	while ( $query->have_posts() ) {
		$query->the_post();
?>
          <h2 class="font-size-large margin-bottom-tiny font-leading-tighter"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
<?php
  }
?>
        </div>
<?php
}
?>
      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
