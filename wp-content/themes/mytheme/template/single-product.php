<?php
/*
Template Name: product layout
Template Post Type: product
*/

get_header();
if (have_posts()):
    while (have_posts()):
        the_post();
        $postID = get_the_ID();
        $productName = get_field("product_name", $postID);
        $productID = get_field("product_id", $postID);
        $productPrice = get_field("product_price", $postID);
        $productSalePrice = get_field("product_sale_price", $postID);
        $productImage = get_field("product_image", $postID);
        $productManufacturer = get_field("manufacturer", $postID);
        $productDescription = get_field("product_des", $postID);
    endwhile;
endif;
?>
<main style="justify-content: center; display: flex;">
    <div class="container row" style="margin-top: 100px;margin-bottom: 100px;">
        <div class="col-4">
            <img style="height:100pv; width:100%; object-fit:fill;" src="<?php echo $productImage["url"] ?>">
        </div>
        <div class="col-7" style="display: flex;flex-direction: column;gap: 20px;">
            <div class="">
                <h2 class="poppins-bold"><?php echo $productName ?></h2>
                <p class="poppins-regular" style="color:darkgrey"><?php echo $productManufacturer ?></p>
            </div>
            <div style="display:flex;gap:20px;">
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
            <p class="poppins-regular"><?php echo $productDescription ?></p>
            <p class="poppins-regular"> Product ID: <?php echo $productID ?></p>
            <p class="poppins-semibold">Categories:</p>
            <div style="display: flex; gap: 10px">          
                <?php
                 $taxonomy = 'product-category';
                 $terms = get_object_term_cache( $post->ID, $taxonomy );
                 foreach($terms as $term) {
                     if(!empty($term))
                    echo '<div class="col-md-4 product-list-category"><a href="' . get_category_link($term->term_id) . '">' . $term->name . '</a></div>'; 
                 }
                ?>
            </div>
            <div display="flex">
                <a href="#" class="btn btn-add-cart poppins-semibold">ADD TO CART</a>  
            </div>
        </div>
    </div>
</main>

<?php
get_footer();
