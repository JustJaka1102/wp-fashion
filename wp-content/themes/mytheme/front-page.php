<?php
get_header();
?>
<main>
    <div class="glide" style="position: relative;">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                <?php
                $siteOption = get_option("site_theme_option");
                //print_r($siteOption['opt-gallery']);
                $gallery_opt = $siteOption['opt-gallery'];
                $gallery_ids = explode(',', $gallery_opt);
                if (!empty($gallery_ids[0])) {
                    foreach ($gallery_ids as $gallery_item_id) {
                        ?>
                        <li class="glide__slide"><img style="width: 100%;object-fit: fill;height: 100%;"
                                src="<?php echo wp_get_attachment_url($gallery_item_id); ?>"></li>
                        <?php
                    }
                } 
                else {
                    ?>
                        <li class="glide__slide">
                        <img style="width: 100%;object-fit: fill;height: 100%;"
                        src="<?php echo get_template_directory_uri().'\assets\image\image-not-found.png' ?>">
                        </li>
                        <?php
                }
                ?>
                
            </ul>
        </div>
        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left" data-glide-dir="<" style="color:black">prev</button>
            <div class="glide">
                <div class="glide__track" data-glide-el="track"></div>
                <div class="glide__bullets" data-glide-el="controls[nav]">
                    <?php
                    $i = 0;
                    if (!empty($gallery_ids)) {
                        foreach ($gallery_ids as $gallery_item_id) {
                            ?>
                            <button class="glide__bullet" data-glide-dir="= <?php echo $i ?>"></button>
                            <?php
                            $i++;
                        }
                    } ?>
                </div>
            </div>
            <button class="glide__arrow glide__arrow--right" data-glide-dir=">" style="color:black">next</button>
        </div>
    </div>
    <!-- category list -->
    <?php
    //print_r($siteOption['opt-img-1']);
    ?>
    <div class="container category-list">
        <div class="" style="display: flex;gap:20px;flex-wrap: wrap;justify-content: center;">
            <div style="display: flex;flex-direction: column;gap:23px;width: 41.2%;justify-content: space-between;">
                <div class="catagory-container">
                    <img class="darker" style="height:100%; width:100%; object-fit:fill;"
                        src="<?php echo $siteOption['opt-img-1']['url'] ?: get_template_directory_uri().'\assets\image\image-not-found.png' ?>">
                    <a href="<?php echo get_term_link(get_term($siteOption['opt-select-1'], 'product-category')); ?>"
                        class="btn btn-light cata-btn" style="margin-top: 35%;">
                        <?php echo get_term($siteOption['opt-select-1'], 'product-category')->name ?></a>
                </div>
                <div style="display: flex;justify-content: space-between;gap:20px">
                    <div class="catagory-container">
                        <img class="darker" style="height:100%; width:100%; object-fit:fill;"
                            src="<?php echo $siteOption['opt-img-2']['url'] ?: get_template_directory_uri().'\assets\image\image-not-found.png' ?>">
                        <a href="<?php echo get_term_link(get_term($siteOption['opt-select-2'], 'product-category')); ?>"
                            class="btn btn-light cata-btn"><?php echo get_term($siteOption['opt-select-2'], 'product-category')->name ?></a>
                    </div>
                    <div class="catagory-container">
                        <img class="darker" style="height:100%; width:100%; object-fit:fill;"
                            src="<?php echo $siteOption['opt-img-3']['url'] ?: get_template_directory_uri().'\assets\image\image-not-found.png' ?>">
                        <a href="<?php echo get_term_link(get_term($siteOption['opt-select-3'], 'product-category')); ?>"
                            class="btn btn-light cata-btn"><?php echo get_term($siteOption['opt-select-3'], 'product-category')->name ?></a>
                    </div>
                </div>
            </div>
            <div style="width: 32.1%;">
                <div class="catagory-container">
                    <img class="darker" style="height:100%; width:100%; object-fit:fill;"
                        src="<?php echo $siteOption['opt-img-4']['url'] ?: get_template_directory_uri().'\assets\image\image-not-found.png' ?>">
                    <a href="<?php echo get_term_link(get_term($siteOption['opt-select-1'], 'product-category')); ?>"
                        class="btn btn-light cata-btn"><?php echo get_term($siteOption['opt-select-4'], 'product-category')->name ?></a>
                </div>
            </div>
        </div>
    </div>
    <!-- woman list -->
    <div class="container content-list">
        <div class="product-title">
            <h3 class="h3-main">WOMEN'S FASHION</h3>
            <p class="p-main">Shop our new arrivals from established brands</p>
        </div>
        <div class="card-hodder">
            <ul class="card-list">
                <?php
                $args = array( //selector array
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product-category',
                            'field' => 'slug',
                            'terms' => 'woman' //choose product-category
                        ),
                    ),
                    'orderby' => 'date',
                    'order' => 'ASC',
                );
                // query post type product
                $loop = new WP_Query($args);
                while ($loop->have_posts()) {
                    $loop->the_post();
                    ?>
                    <li class="card">
                        <a href="<?php the_permalink($post) ?>" class="card-img"><img src="<?php $image = get_field('product_image');
                           echo $image ? esc_url($image['url']) : get_template_directory_uri().'\assets\image\image-not-found.png'; ?>"></a>
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
                }
                ?>
            </ul>
        </div>
    </div>
    <!-- man list -->
    <div class="container content-list">
        <div class="product-title">
            <h3 class="h3-main">MAN'S FASHION</h3>
            <p class="p-main">Shop our new arrivals from established brands</p>
        </div>
        <div class="card-hodder">
            <ul class="card-list">
                <?php
                $args = array( //selector array
                    'post_type' => 'product',
                    'posts_per_page' => 4,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product-category',
                            'field' => 'slug',
                            'terms' => 'man' //choose product-category
                        ),
                    ),
                    'orderby' => 'date',
                    'order' => 'ASC',
                );
                // query post type product
                $loop = new WP_Query($args);
                while ($loop->have_posts()) {
                    $loop->the_post();
                    ?>
                    <li class="card">
                        <a href="<?php the_permalink($post) ?>" class="card-img"><img src="<?php $image = get_field('product_image');
                           echo $image ? esc_url($image['url']) : get_template_directory_uri().'\assets\image\image-not-found.png';  ?>"></a>
                        <div class="card-des">
                            <p class="card-cata"><a href="<?php the_permalink($post) ?>">
                                    <?php the_field('manufacturer', $post->ID); ?></a></p>
                            <h4 class="card-title"><a
                                    href="<?php the_permalink($post) ?>"><?php the_field('product_name', $post->ID); ?></a>
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
                }
                ?>
            </ul>
        </div>
    </div>
    <div class="container content-list">
        <div class="product-title">
            <h3 class="h3-main">AVONE STYLES</h3>
            <p class="p-main">Choose Your Favorite Color</p>
        </div>
        <div style="display:flex;flex-wrap:wrap;gap:28px;margin-top: 50px;justify-content: center;">
            <div style="padding-top: 87px; width:40%">
                <img style="height:100%; width:100%; object-fit:fill;"
                    src="<?php echo $siteOption['avone-banner-img-1']['url'] ?: get_template_directory_uri() . '\assets\image\image-not-found.png';?>">
            </div>
            <div style="position: relative;width:40%">
                <img style="height:70%; width:100%; object-fit:fill;padding-right: 5%;"
                    src="<?php echo $siteOption['avone-banner-img-3']['url'] ?: get_template_directory_uri() . '\assets\image\image-not-found.png';?>" style="padding-right: 27px;">
                <div class="avone-second-img">
                    <img style="height:100%; width:100%; object-fit:fill;"
                        src="<?php echo $siteOption['avone-banner-img-2']['url'] ?: get_template_directory_uri() . '\assets\image\image-not-found.png';?>">
                </div>  
                <div style="position: absolute;bottom: 5%;right: 40%;"><a href="#"
                        class="avone-banner poppins-regular">SHOW WOMEN'S DRESS</a></div>
            </div>
        </div>
    </div>
    <div class="containertest" id="banner2">
        <img style="height:100%; width:100%; object-fit:fill;"
            src="<?php echo $siteOption['under-banner-img']['url'] ?: get_template_directory_uri() . '\assets\image\image-not-found.png'; ?>">
        <div class="" id="banner-des2">
            <p style="font-size: 18px;" class="poppins-medium banner2-des">OWN THE DAY</p>
            <p style="font-size:80px;" class="poppins-medium banner2-title">TACHEN 19</p>
            </P>
            <div class="banner-btn poppins-medium" style="display: flex;">
                <button class="btn btn-dark btn-banner" id="" onclick="">SHOP COLLECTION</button>
            </div>
        </div>
    </div>
</main>
<?php
get_footer();
?>