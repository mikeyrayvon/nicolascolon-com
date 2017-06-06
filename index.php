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

  $types = get_terms('exhibition_type');
?>
        <ul id="exhibition-list" class="grid-item item-s-12 item-m-9 margin-bottom-small">
<?php
	while ( $query->have_posts() ) {
		$query->the_post();

    $open = get_post_meta($post->ID, '_igv_date_open', true);
    $year = date('Y', $open);

    $expo_types = get_the_terms($post->ID, 'exhibition_type');

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
<?php
    if (!empty($expo_types)) {
?>
              <span class="u-inline-block font-size-small font-sans">
<?php
      $types_list = '';
      foreach ($expo_types as $type) {
        $abbr = get_term_meta($type->term_id, '_igv_type_abbr', true);
        $types_list .= $abbr . ', ';
      }
?>
                (<?php echo (rtrim($types_list, ', ')); ?>)</span>

<?php
    }
?>
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
  if (!empty($types)) {
?>
        <ul id="exhibition-type-key" class="margin-bottom-small font-sans list-style-none font-size-small">
<?php
    foreach ($types as $type) {
      $abbr = get_term_meta($type->term_id, '_igv_type_abbr', true);
?>
          <li>(<?php echo ($abbr); ?>) <?php echo $type->name; ?></li>
<?php
    }
?>
        </ul>
<?php
  }

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
