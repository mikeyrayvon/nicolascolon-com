<?php
get_header();
?>

<main id="main-content">
  <section id="posts">
    <div class="container">

<?php
if( have_posts() ) {
  while( have_posts() ) {
    the_post();

    $venue = get_post_meta($post->ID, '_igv_venue', true);
    $venue_link = get_post_meta($post->ID, '_igv_venue_link', true);
    $open = get_post_meta($post->ID, '_igv_date_open', true);
    $close = get_post_meta($post->ID, '_igv_date_close', true);
    $format = 'j F Y';
    $documentation = get_post_meta($post->ID, '_igv_documentation', true);

    $expo_types = get_the_terms($post->ID, 'exhibition_type');
    if (!empty($expo_types)) {
      $types_list = '';
      foreach ($expo_types as $type) {
        $types_list .= $type->name . ', ';
      }
    }
?>
        <article <?php post_class('grid-row'); ?> id="post-<?php the_ID(); ?>">
          <div id="exhibition-details" class="grid-item item-s-12 margin-bottom-small">
            <p>
              <?php
                echo !empty($venue_link) ? '<a href="' . esc_url($venue_link) . '">' : '';
                echo !empty($venue) ? $venue . '<br>' : '';
                echo !empty($venue_link) ? '</a>' : '';
                echo !empty($open) ? date($format, $open) : '';
                echo !empty($close) ? ' — ' . date($format, $close) : '';
              ?>
              <?php
                if (!empty($expo_types)) {
                  echo '<br><span class="font-size-small font-sans">(' . rtrim($types_list, ', ') . ')</span>';
                }
              ?>
            </p>
          </div>

          <div id="exhibition-content" class="grid-item item-s-12 margin-bottom-basic">
            <?php the_content(); ?>
          </div>

<?php
      if (!empty($documentation)) {
?>
          <div class="grid-item item-s-12 item-l-10 offset-l-1">
            <?php echo apply_filters('the_content', $documentation); ?>
          </div>
<?php
      }
?>
        </article>
<?php
  }
} else {
?>
        <article class="u-alert grid-item item-s-12"><?php _e('Sorry, no posts matched your criteria :{'); ?></article>
<?php
} ?>

    </div>
  </section>

  <?php get_template_part('partials/pagination'); ?>

</main>

<?php
get_footer();
?>
