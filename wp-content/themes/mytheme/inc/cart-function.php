<?php 
//this file hold all func about cart
//check session 
function start_session() {
    if (!session_id()) {
        session_start();
    }
}
add_action('init', 'start_session');

//add a cart
function add_to_cart($product_id,$quantity) {
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    if (isset($_SESSION['cart'][$product_id])) {
        $_SESSION['cart'][$product_id]['quantity'] = $quantity;
        if($_SESSION['cart'][$product_id]['quantity']>get_field("quantity", $product_id)){
            $_SESSION['cart'][$product_id]['quantity']=get_field("quantity", $product_id);
        }
    } else {
        $_SESSION['cart'][$product_id] = [
            'product_id' => $product_id,
            'quantity' => $quantity,
        ];
    }
}

function remove_from_cart($product_id) {
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
    }
}
function clear_cart() {
    if (isset($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}
//to check out

//display_cart() was only using for testing, the real display is on cart.php
function display_cart() {
    if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $item) {
            echo 'Product ID: ' . $item['product_id'] . '<br>';
            echo 'Quantity: ' . $item['quantity'] . '<br><br>';
        }
        echo count($_SESSION['cart']) .'<br>';
    } else {
        echo 'Your cart is empty.';
    }
}

add_shortcode('show_cart', 'display_cart');
