<?php
/*
 Template Name: Checkout
 */
if(!is_user_logged_in()){ //check user is login or not
    wp_redirect(home_url().'/wp-login.php');
    exit;
};
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['pay-now'])) { //check 
    $information = array(
        'name'=> $_POST['namecustom'],
        'emailaddress'=> $_POST['emailaddress'],
        'phonenumber'=> $_POST['phonenumber'],
        'city'=> $_POST['city'],
        'state'=> $_POST['state'],
        'zipcode'=> $_POST['zipcode'],
    );
    foreach ($_SESSION['cart'] as $product) {
        $products[$product['product_id']] = $product['quantity'];
    }
    if (save_bill_with_items($information,$products)) {
        clear_cart();
        wp_redirect(home_url().'/cart/checkout/payment');
        exit;
    } else {
        echo "<script type='text/javascript'>alert('fail: something wrong happen');</script>";
    }
}
get_header(); ?>

<main>
    <div class="container" style="margin: 50px auto;">
        <h2 class="poppins-bold" style="text-align: center; margin: 30px auto;">CHECK OUT</h2>
        <form class="row" method="POST">
            <?php if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) { ?>
                <div class="col-6" style="display: flex;flex-direction: column;gap: 20px;">
                    <label for="namecustom" class="form-label poppins-regular">Full name:</label>
                    <input type="text" name="namecustom" required>
                    <label for="emailaddress" class="form-label poppins-regular">Email address:</label>
                    <input type="email" name="emailaddress" required>
                    <label for="phonenumber" class="form-label poppins-regular">Phone number:</label>
                    <input type="tel" name="phonenumber" pattern="[0-9]{4}[0-9]{3}[0-9]{3}" required>
                    <div class="row" style="display:flex">
                        <div class="col">
                            <label for="city" class="form-label" poppins-regular>city</label>
                            <input type="text" name="city" required>
                        </div>
                        <div class="col">
                            <label for="state" class="form-label poppins-regular">state</label>
                            <input type="text" name="state" required>
                        </div>
                        <div class="col">
                            <label for="zipcode" class="form-label poppins-regular">zipcode</label>
                            <input type="text" name="zipcode" required>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <h4 class="poppins-semibold" >Review your cart</h4>
                    <div class="checkout-cart">
                        <?php
                        $cnt = 0;
                        foreach ($_SESSION['cart'] as $item) {
                            $cnt++;
                            ?>
                            <input type="hidden" id="total-item" value="<?php echo count($_SESSION['cart']) ?>">
                            <input type="hidden" id="get-item-price-<?php echo $cnt ?>" value="<?php
                               echo get_field("product_sale_price", $item['product_id']) ?: get_field("product_price", $item['product_id'])
                                   ?>">
                            <input min="1" max="<?php echo get_field("quantity", $item['product_id']) ?>" type="hidden"
                                    id="typeNumber-<?php echo $cnt ?>" name="typeNumber-<?php echo $cnt ?>" class="form-control"
                                    data-id="<?php echo $cnt ?>" value="<?php echo $item['quantity'] ?>">
                            <p class="poppins-semibold"><?php echo get_field("product_name", $item['product_id']); ?></p>
                            <div>
                                <span style="color:grey">x<?php echo $item['quantity'] ?>=</span>
                                <span id="item-price-<?php echo $cnt ?>"></span>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                    <div class="payment">
                        <p class="poppins-semibold" style="margin-bottom:50px">Total price : <span id="total-price"></span></p>
                        <input class="btn btn-dark" style="width: 100%;" type="submit" name="pay-now" value="PAY NOW"></input>
                    </div>
                </div>
            <?php } else {
                echo '<h3 class="poppins-semibold" style="text-align: center; margin: 30px auto;"> Your cart is empty ! </h2>';
            }
            ?>
        </form>
    </div>
</main>

<?php
get_footer();