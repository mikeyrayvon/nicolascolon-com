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
    $open = get_post_meta($post->ID, '_igv_date_open', true);
    $close = get_post_meta($post->ID, '_igv_date_close', true);
    $format = 'j M Y';
    $documentation = get_post_meta($post->ID, '_igv_documentation', true);
?>
        <article <?php post_class('grid-row'); ?> id="post-<?php the_ID(); ?>">
          <div class="grid-item item-s-12">
            <h1 class="font-size-large margin-bottom-basic"><?php the_title(); ?></h1>
          </div>

          <div id="exhibition-content" class="grid-item item-s-12 item-l-8">

            <p>
              <?php echo !empty($venue) ? $venue . '<br>' : ''; ?>
              <?php
                echo !empty($open) ? date($format, $open) : '';
                echo !empty($close) ? ' — ' . date($format, $close) : '';
              ?>
            </p>

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
