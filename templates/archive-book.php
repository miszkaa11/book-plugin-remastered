<?php
/*
    Template Name: Archive Book
*/

get_header();
?>

<div class="archive-book">
    <div class="book-container">
        <div class="archive-book__content">
            <header class="page-header books-title">
                <h1 class="page-title book-title__header"><?php post_type_archive_title(); ?></h1>
            </header>
            <?php if ( have_posts() ) : ?>
                <div class="archive-posts">
                    <?php while ( have_posts() ) : the_post(); ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <header class="entry-header">
                                <h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
                            </header>
                            <div class="entry-content">
                                <?php the_excerpt(); ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php else : ?>
                <p><?php _e( 'Sorry, no posts found.', 'textdomain' ); ?></p>
            <?php endif; ?>
        </div>
    </div>
</div>
<?php
get_footer();
?>
