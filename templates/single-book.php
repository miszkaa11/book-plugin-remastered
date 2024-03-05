<?php
/*
    Template Name: Single Book
*/

get_header();
?>

<div class="single-book">
    <div class="book-container">
        <div class="books-title content-box">
            <div class="book-title__content">
                <h1 class="book-title__header header-l"><?php echo get_the_title(); ?></h1>
            </div>
        </div>
        <div class="single-book__items">
            <div class="single-book__item">
                <h2 class="header-m"><span>Author:</span><?php echo get_field('fld_author'); ?></h2>
            </div>
            <div class="single-book__item">
                <h2 class="header-m"><span>Year:</span><?php echo get_field('fld_year'); ?></h2>
            </div>
            <div class="single-book__item">
                <h2 class="header-m"><span>Genre:</span><?php echo get_field('fld_genre'); ?></h2>
            </div>
        </div>
    </div>
</div>

<?php
get_footer();
?>
