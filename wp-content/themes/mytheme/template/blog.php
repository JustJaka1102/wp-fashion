<?php
/*
 Template Name: Blog
 */
get_header(); ?>
<main>
    <ul class="container category-posts-container">
        <div style="display:flex;justify-content: center;">
            <h1 style="text-transform: uppercase;font-size: 50px;">Most views post</h1>
        </div>
        <ul class="post-category-item-wrap-gridview row">
            <?php
            // Arguments for WP_Query
            $args = array(
                'post_type' => 'post',  // Default post type
                'post_status' => 'publish',
                'posts_per_page' => 5,  // Number of posts per page
                'meta_key' => 'post_views_count',
                'orderby' => 'meta_value_num',
                'order' => 'DESC',
            );
            // Custom WP_Query
            $query = new WP_Query($args);
            $postNotIn = []; //set up post not in 
            // Start the Loop
            if ($query->have_posts()):
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <li class="col-sm-2" style="flex-direction: column;">
                        <a href="<?php the_permalink(); ?>" class="post-category-item" >
                            <?php if (get_the_post_thumbnail_url()) {
                                the_post_thumbnail('thumbnail');
                            } else {
                                ?>
                                <img src="<?php echo get_template_directory_uri() . '\assets\image\image-not-found.png' ?>"
                                    style="width:150px;height:150px">
                                <?php
                            }
                            ?>
                            <div class="text-post-category-item">
                                <h5 class="poppins-semibold" style="overflow: hidden;white-space:nowrap;text-overflow: ellipsis;"><?php the_title(); ?></h5>
                                <div class="poppins-regular post-excerpt " style="line-break:anywhere">
                                    <?php echo excerpt(20); // Display the excerpt ?>
                                </div>
                                <span class="poppins-regular" style="font-size:small">Views: <?php echo getPostViews(get_the_ID()) ?></span>
                            </div>
                        </a>
                        <?php $postNotIn[] = get_the_ID() ?>
                    </li>
                    <?php
                endwhile;
            endif;
            wp_reset_postdata();
            ?>
        </ul>
        <div style="display:flex;justify-content: center;">
            <h1 style="text-transform: uppercase;font-size: 50px;margin-top:50px;margin-bottom:50px">Other post</h1>
        </div>
        <ul class="post-category-item-wrap">
            <?php
            // Set up pagination parameters
            $paged = (get_query_var('paged')) ? absint(get_query_var('paged')) : 1;

            // Arguments for WP_Query
            $args = array(
                'post_type' => 'post',  // Default post type
                'posts_per_page' => 3,  // Number of posts per page
                'paged' => $paged,  // Pagination parameter
                'post__not_in' => $postNotIn,
            );
            $query = new WP_Query($args);
            if ($query->have_posts()):
                while ($query->have_posts()):
                    $query->the_post();
                    ?>
                    <li>
                        <a href="<?php the_permalink(); ?>" class="post-category-item" style="display: inline-grid;">
                            <?php if(get_the_post_thumbnail_url()){
                                the_post_thumbnail('thumbnail');
                            } 
                            else{
                            ?>
                                <img src="<?php echo get_template_directory_uri().'\assets\image\image-not-found.png' ?>" style="width:150px;height:150px">
                                <?php
                            }
                            ?>
                            <div class="text-post-category-item">
                                <h3 class="poppins-semibold" style="overflow: hidden;white-space:nowrap;text-overflow: ellipsis;"><?php the_title(); ?></h3>
                                <div class="poppins-regular post-excerpt " style="line-break:anywhere"><?php echo excerpt(200); // Display the excerpt ?></div>
                            </div>
                        </a>
                    </li>
                    <?php
                endwhile;
                ?>
            </ul>
            <!-- Pagination -->
            <div class="category-pagination">
                <?php
                // Display pagination links
                echo paginate_links(array(
                    'total' => $query->max_num_pages,  // The total number of pages
                    'current' => max(1, get_query_var('paged')),  // The current page
                    'format' => '?paged=%#%',  // URL format
                    'prev_text' => __('&laquo; Previous', 'textdomain'),  // Text for "Previous" button
                    'next_text' => __('Next &raquo;', 'textdomain')  // Text for "Next" button
                ));
                ?>
            </div>
            <?php
            else:
                echo '<p>No posts found in this category.</p>';
            endif;
            // Reset post data
            wp_reset_postdata();
            ?>
</main>

<?php get_footer(); ?>