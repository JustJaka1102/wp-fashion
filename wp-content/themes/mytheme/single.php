<?php
get_header();

if (have_posts()) {
    while (have_posts()) {
        setPostViews(get_the_ID());
        the_post();
        the_content();
    }
}
get_footer();
