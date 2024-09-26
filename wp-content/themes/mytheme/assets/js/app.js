/* this is all js using for cart */
//update price per item in cart
function updatePrice(itemId, quantity) {
    itemPriceElement = document.getElementById('get-item-price-' + itemId);
    itemPriceSpan = document.getElementById('item-price-' + itemId);
    unitPrice = parseFloat(itemPriceElement.value);
    totalPrice = unitPrice * quantity;
    itemPriceSpan.innerText = totalPrice.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    updateTotalPrice();
}
//call update right moment load cart
window.onload = function () {
    totalItems = document.getElementById('total-item').value;
    for (let i = 1; i <= totalItems; i++) {
        quantityInput = document.getElementById('typeNumber-' + i);
        if (quantityInput.value) {
            currentQuantity = quantityInput.value;
            updatePrice(i, currentQuantity);
        }
    }
    updateTotalPrice();
};
//update the total price in cart
function updateTotalPrice() {
    totalItems = document.getElementById('total-item').value;
    let totalPrice = 0;
    for (let i = 1; i <= totalItems; i++) {
        itemPriceElement = document.getElementById('get-item-price-' + i);
        quantityInput = document.getElementById('typeNumber-' + i);
        unitPrice = parseFloat(itemPriceElement.value);
        quantity = parseFloat(quantityInput.value);
        totalPrice += unitPrice * quantity;
    }
    totalPriceSpan = document.getElementById('total-price');
    if (totalPriceSpan) {
        totalPriceSpan.innerText = totalPrice.toLocaleString('en-US', { style: 'currency', currency: 'USD' });
    }
}
new Glide('.glide').mount();

