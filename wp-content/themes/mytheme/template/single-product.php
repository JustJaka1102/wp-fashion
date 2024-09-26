<?php
/*
Template Name: product layout
Template Post Type: product
*/

get_header();
        $postID = get_the_ID();
        $productName = get_field("product_name", $postID);
        $productID = get_field("product_id", $postID);
        $productPrice = get_field("product_price", $postID);
        $productSalePrice = get_field("product_sale_price", $postID);
        $productImage = get_field("product_image", $postID);
        $productManufacturer = get_field("manufacturer", $postID);
        $productDescription = get_field("product_des", $postID);
        $propductQuantity = get_field("quantity", $postID);
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
                    <p class="card-old-price"><span>$</span><?php echo $productPrice; ?></p>
                    <p class="card-new-price"><span>$</span><?php echo $productSalePrice; ?>
                    </p>
                    <?php
                } else { ?>
                    <p class="card-old-price" style="text-decoration-line:none;">
                        <span>$</span><?php echo $productPrice; ?>
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
                $terms = get_object_term_cache($post->ID, $taxonomy);
                foreach ($terms as $term) {
                    if (!empty($term))
                        echo '<div class="col-md-4 product-list-category"><a href="' . get_category_link($term->term_id) . '">' . $term->name . '</a></div>';
                }
                ?>
            </div>
            <p class="poppins-semibold">stock: <span class="poppins-regular"><?php echo $propductQuantity ?></span></p>
            <form display="flex" method="POST">
                <div data-mdb-input-init class="form-outline" style="width: fit-content;margin-bottom: 20px;">
                    <label class="form-label" for="typeNumber">Quantity</label> 
                    <input min="1" max="<?php echo $propductQuantity ?>" type="number" id="typeNumber" name="typeNumber" class="form-control" placeholder="1" oninput="checkMaxValue()"> 
                </div>
                <button type="submit" class="btn btn-add-cart poppins-semibold">ADD TO CART</button>
            </form>
            <php>
                <?php
                $product_id = $postID;
                $quantity = $_POST['typeNumber'] ?? 1 ?: 1 ;
                add_to_cart($product_id,$quantity);
                ?>
            </php>
        </div>
    </div>
</main>

<?php
get_footer();
