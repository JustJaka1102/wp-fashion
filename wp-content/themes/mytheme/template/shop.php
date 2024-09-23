<?php
/*
 Template Name: Shop
 */
get_header(); ?>

<main>
    <div class="container">
        <div class="product-filter-wrap">
            <form class="" method="GET" action="">
                <div class="row mb-4 product-filter">
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="min_price" placeholder="min price" min="0"
                            step="0.01">
                    </div>
                    <div class="col-md-2">
                        <input type="number" class="form-control" name="max_price" placeholder="max price" min="0"
                            step="0.01">
                    </div>
                    <div class="col-md-3">
                        <select class="form-control" name="category">
                            <?php
                            $terms = get_terms(array(
                                'taxonomy' => 'product-category', // Replace with your taxonomy slug
                                'hide_empty' => false, // Set to true if you want to hide terms with no posts
                            ));
                            $term_slugs = wp_list_pluck($terms, 'slug');
                            //echo $terms;
                            ?>
                            <option value="">select catagory</option>
                            <?php foreach ($terms as $term): ?>
                                <option value="<?php echo esc_html($term->slug) ?>"><?php echo esc_html($term->name); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <input type="text" class="form-control" name="keyword" placeholder="find by keyword">
                    </div>
                    <button type="submit" class="btn btn-primary col-md-1">Filter</button>
                </div>
            </form>
        </div>
    </div>
    <div class="container" style="margin:100px auto">
        <div class="card-hodder">
            <ul class="card-list">
                <?php
                $min_price = $_GET['min_price'] ?? 0 ?: 0;
                $max_price = $_GET['max_price'] ?? 999999999 ?: 999999999;
                $category = $_GET['category'] ?? $term_slugs ?: $term_slugs ;
                $keyword = $_GET['keyword'] ?? '' ?: '';
                $args = array( //selector array
                    'post_type' => 'product',
                    'posts_per_page' => 8,
                    'paged' => $paged,  // Pagination parameter
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product-category',
                            'field' => 'slug',
                            'terms' => $category //choose product-category
                        ),
                    ),
                    'meta_query' => array(
                        'relation' => 'AND',
                        array(
                            'key' => 'product_price',
                            'value' => $min_price,
                            'compare' => '>',
                        ),
                        array(
                            'key' => 'product_price',
                            'value' => $max_price,
                            'compare' => '<',
                        ),
                    ),
                    's' => $keyword,
                );
                // query post type product
                $paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
                $loop = new WP_Query($args);
                if ($loop->have_posts()):
                    while ($loop->have_posts()):
                        $loop->the_post();
                        ?>
                        <li class="card">
                            <a href="<?php the_permalink($post) ?>" class="card-img"><img
                                    src="<?php $image = get_field('product_image');
                                    echo $image ? esc_url($image['url']) : get_template_directory_uri() . '\assets\image\image-not-found.png'; ?>"></a>
                            <div class="card-des">
                                <p class="card-cata"><a href="<?php the_permalink($post) ?>">
                                        <?php the_field('manufacturer', $post->ID); ?></a></p>
                                <h4 class="card-title"><a
                                        href="<?php echo the_permalink($post) ?>"><?php the_field('product_name', $post->ID); ?></a>
                                </h4>
                                <div class="card-price">
                                    <?php
                                    $check = get_field('product_sale_price', $post->ID);
                                    if ($check) { ?>
                                        <p class="card-old-price"><span>$</span><?php the_field('product_price', $post->ID); ?></p>
                                        <p class="card-new-price"><span>$</span><?php the_field('product_sale_price', $post->ID); ?>
                                        </p>
                                        <?php
                                    } else { ?>
                                        <p class="card-old-price" style="text-decoration-line:none;">
                                            <span>$</span><?php the_field('product_price', $post->ID); ?>
                                        </p>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
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
                        'total' => $loop->max_num_pages,  // The total number of pages
                        'current' => max(1, get_query_var('paged')),  // The current page
                        'format' => '?paged=%#%',  // URL format
                        'prev_text' => __('&laquo; Previous', 'textdomain'),  // Text for "Previous" button
                        'next_text' => __('Next &raquo;', 'textdomain')  // Text for "Next" button
                    ));
                    ?>
                </div>
                <?php
                else:
                    echo '<p>No product found with this filter</p>';
                endif;
                // Reset post data
            wp_reset_postdata();
            ?>
        </div>
    </div>
</main>

<?php get_footer(); ?>