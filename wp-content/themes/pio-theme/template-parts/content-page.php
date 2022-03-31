<div class="q-pa-xl">
  <header class="entry-header">
    <?php
    if ( is_singular() ) :
      the_title( '<div class="entry-title text-h3 text-left">', '</div>' );
    else :
      the_title( '<div class="entry-title text-h3 text-left"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></div>' );
    endif; ?>
  </header>
  <div class="entry-content">
    <?php
    the_content(
      sprintf(
        wp_kses(
          /* translators: %s: Name of current post. Only visible to screen readers */
          __( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'pio' ),
          array(
            'span' => array(
              'class' => array(),
            ),
          )
        ),
        wp_kses_post( get_the_title() )
      )
    );

    // wp_link_pages(
    //   array(
    //     'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'pio' ),
    //     'after'  => '</div>',
    //   )
    // );
    ?>
  </div>
</div>
