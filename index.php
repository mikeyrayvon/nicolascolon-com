<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">
      <div class="grid-row">

<?php
// WP_Query arguments
$args = array(
	'post_type' => array( 'exhibition' ),
	'posts_per_page' => '-1',
  'orderby' => 'meta_value',
  'meta_key' => '_igv_date_open',
);

// The Query
$query = new WP_Query( $args );

// The Loop
if ( $query->have_posts() ) {
  $current_year = 0;

?>
        <div class="grid-item item-s-12 item-m-9">
<?php
	while ( $query->have_posts() ) {
		$query->the_post();

    $open = get_post_meta($post->ID, '_igv_date_open', true);
    $year = date('Y', $open);

    if ($year !== $current_year) {
      $current_year = $year;
      echo '<div class="margin-bottom-small">' . $current_year . '</div>';
    }
?>
          <h2 <?php post_class('margin-bottom-small font-size-large'); ?> id="post-<?php the_ID(); ?>">
            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
          </h2>
<?php
  }
?>
      </div>
<?php
}

// Restore original Post Data
wp_reset_postdata();
?>

      </div>
    </div>
  </section>
</main>

<?php
get_footer();
?>
