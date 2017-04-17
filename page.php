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
?>
        <article <?php post_class('grid-row'); ?> id="post-<?php the_ID(); ?>">
          <div class="grid-item item-s-12">
            <h1 class="font-size-large margin-bottom-basic"><?php the_title(); ?></h1>
          </div>
          <div class="grid-item item-s-12 item-m-10 item-l-6">
            <?php the_content(); ?>
          </div>
        </article>
<?php
  }
} else {
?>
        <article class="u-alert grid-row">
          <div class="grid-item item-s-12">
            <?php _e('This page doesn\'t exist.'); ?>
          </div>
        </article>
<?php
} ?>

    </div>
  </section>
</main>

<?php
get_footer();
?>
