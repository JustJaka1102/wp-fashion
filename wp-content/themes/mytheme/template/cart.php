<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['to-checkout'])) { //check out time
    $cnt = 0;
    foreach ($_SESSION['cart'] as $item) {
        $cnt++;
        $_SESSION['cart'][$item['product_id']]['quantity'] = $_POST["typeNumber-$cnt"];
    }
    wp_redirect(home_url().'/cart/checkout');
    exit;
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete-item'])) { //check delete item if press x
    $product_id = $_POST['product_id'];
    remove_from_cart($product_id);
}
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['delete-cart'])) { //check delete all item
    clear_cart();
}
/*
 Template Name: Cart
 */
get_header(); ?>
<main>
    <div class="container">
        <h2 class="poppins-bold" style="text-align: center; margin: 30px auto;">YOUR SHOPING CART</h2>
        <form method="POST">
            <?php
            if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
                <table class="table">
                    <tr>
                        <th>IMAGE</th>
                        <th>NAME</th>
                        <th>QUANITY</th>
                        <th>PRICE</th>
                        <th>REMOVE</th>
                    </tr>
                    <?php
                    $checkEmpty = false;
                    $cnt = 0;
                    foreach ($_SESSION['cart'] as $item) {
                        $cnt++;
                        ?>
                        <tr>
                            <td>
                                <!-- get item img  -->
                                <img href="<?php the_permalink($item['product_id']) ?>"
                                    src="<?php echo get_field("product_image", $item['product_id'])['url']; ?>"
                                    class="product-cart-img">
                            </td>
                            <td>
                                <!-- get name and manufacturer -->
                                <h3 class="poppins-semibold"><a
                                        href="<?php the_permalink($item['product_id']) ?>"><?php echo get_field("product_name", $item['product_id']); ?></a>
                                </h3>
                                <p class="poppins-regular" style="color:darkgrey">
                                    <?php echo get_field("manufacturer", $item['product_id']); ?>
                                </p>
                            </td>
                            <td>
                                <!-- get the item quanity and caculated the price -->
                                <!-- send vaule to js -->
                                <input type="hidden" id="total-item" value="<?php echo count($_SESSION['cart']) ?>">
                                <input type="hidden" id="get-item-price-<?php echo $cnt ?>"
                                    value="<?php 
                                    echo get_field("product_sale_price", $item['product_id'])?:get_field("product_price", $item['product_id'])
                                    ?>">
                                <!-- show item quanity, the quanity get form add cart product is placeholder -->
                                <input min="1" max="<?php echo get_field("quantity", $item['product_id']) ?>" type="number"
                                    id="typeNumber-<?php echo $cnt ?>" name="typeNumber-<?php echo $cnt ?>" class="form-control"
                                    data-id="<?php echo $cnt ?>" value="<?php echo $item['quantity'] ?>"
                                    oninput="updatePrice(<?php echo $cnt ?>, this.value);">
                            </td>
                            <td>
                                <!-- send the total price pre item -->
                                <p class=""><span id="item-price-<?php echo $cnt ?>"></span></p>
                            </td>
                            <td>
                                <!-- remove item from cart -->
                                <form method="POST">
                                    <input type="hidden" name="product_id" value="<?php echo $item['product_id']; ?>">
                                    <input type="submit" class="btn btn-danger" name="delete-item" value="x">
                                </form>
                            </td>
                        </tr>
                        <?php
                    }
                    ?>
                    <tr>
                        <td></td>
                        <td></td>
                        <td class="poppins-semibold">TOTAL PRICE:</td>
                        <td>
                            <p class=""><span id="total-price"></span></p>
                        </td>
                        <td></td>
                    </tr>
                    <tr class="checkout-cart-space">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>
                            <input type="submit" class="btn btn-dark" name="to-checkout" value="CHECK OUT !">
                        </td>
                        <td>
                            <input type="submit" class="btn btn-danger" name="delete-cart" value="Delete cart">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            } else {
                echo '<h3 class="poppins-semibold" style="text-align: center; margin: 30px auto;"> Your cart is empty ! </h2>';
            }
            ?>
    </div>
</main>
<?php
get_footer();