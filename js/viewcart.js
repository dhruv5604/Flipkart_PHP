$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: "fetch-addToCart.php",
        dataType: "json",
        success: function (response) {
            const container = document.getElementById("inside-cart");

            response.forEach((product) => {
                let offer = product.offer;
                let discount = (product.price * offer) / 100;
                let discounted_price = product.price - discount;

                let div_cartItem = document.createElement("div");
                div_cartItem.classList.add("cart-item");
                div_cartItem.id = product.cart_id;

                let img = document.createElement("img");
                img.src = product.image;

                let div_itemDetails = document.createElement("div");
                div_itemDetails.classList.add("item-details");

                let h5 = document.createElement("h5");
                h5.innerText = product.name;

                let div = document.createElement("div");

                let span = document.createElement("span");
                span.innerHTML = "&#8377;";

                let p = document.createElement("span");
                p.classList.add("price");
                p.innerText = discounted_price;
                p.setAttribute("data-price", discounted_price);

                div.appendChild(span);
                div.appendChild(p);

                div_itemDetails.appendChild(h5);
                div_itemDetails.appendChild(div);

                let div_quantity = document.createElement("div");
                div_quantity.classList.add("quantity");

                let btn_minus = document.createElement("button");
                btn_minus.innerText = "-";
                btn_minus.classList.add("minus");

                let ip = document.createElement("input");
                ip.type = "text";
                ip.value = product.quantity;
                ip.id = "quantity-input-" + product.cart_id;
                ip.classList.add("quantity-input");

                let btn_plus = document.createElement("button");
                btn_plus.innerText = "+";
                btn_plus.classList.add("plus");

                let btn_delete = document.createElement("button");
                btn_delete.classList.add("btn", "btn-danger")
                btn_delete.innerHTML = '<i class="fa-solid fa-trash"></i>';
                btn_delete.addEventListener("click", () => removeItem(product.cart_id, product.product_id));

                div_quantity.appendChild(btn_minus);
                div_quantity.appendChild(ip);
                div_quantity.appendChild(btn_plus);
                div_quantity.appendChild(btn_delete);

                div_cartItem.appendChild(img);
                div_cartItem.appendChild(div_itemDetails);
                div_cartItem.appendChild(div_quantity);

                container.appendChild(div_cartItem);

                let form = document.getElementById("form1");

            });

            updateTotalPrice();
        },
    });

    $(document).on("click", ".minus", function () {
        let inputField = $(this).siblings(".quantity-input");
        let priceElement = $(this).closest(".cart-item").find(".price");
        let originalPrice = parseFloat(priceElement.attr("data-price"));

        let currentValue = parseInt(inputField.val());
        if (currentValue > 1) {
            let newQuantity = currentValue - 1;
            inputField.val(newQuantity);
            priceElement.text(originalPrice * newQuantity);
            updateTotalPrice();

            let cart_id = $(this).closest(".cart-item").attr("id");

            $.ajax({
                type: "POST",
                url: "../update-inventory.php",
                data: { "cart_id": cart_id, "action": "minus" },
                dataType: "json",
                success: function (response) {

                }
            });
        }
    });

    $(document).on("click", ".plus", function () {
        let inputField = $(this).siblings(".quantity-input");
        let priceElement = $(this).closest(".cart-item").find(".price");
        let originalPrice = parseFloat(priceElement.attr("data-price"));

        let newQuantity = parseInt(inputField.val()) + 1;
        inputField.val(newQuantity);
        priceElement.text(originalPrice * newQuantity);
        updateTotalPrice();

        let cart_id = $(this).closest(".cart-item").attr("id");

        $.ajax({
            type: "POST",
            url: "../update-inventory.php",
            data: { "cart_id": cart_id, "action": "plus" },
            dataType: "json",
            success: function (response) {

            }
        });

    });

    function updateTotalPrice() {
        let total = 0;

        $(".cart-item").each(function () {
            let itemPrice = parseInt($(this).find(".price").text());
            total += itemPrice;
        })
        let span = document.createElement("span");
        span.innerHTML = "&#8377";

        let total_amount = document.createElement("span");
        total_amount.innerText = total;

        let total_amount_rupee = document.createElement("div");
        total_amount_rupee.appendChild(span);
        total_amount_rupee.appendChild(total_amount);

        $('.subtotal').html(total_amount_rupee);

        let publishKey = "pk_test_51R8c7MPWmXkqaxc5vcsnss7f5jpSNOEre8ckqjiiVt7U0MiOOCzWPlzHwKgMmg8vBiqL6khXqfXoAwBQtM5z4r6g00XluWR2Eu"

        let content = `
        <input type="hidden" id="total_amount" name="total_amount" value=${total * 100}>
        <script
        src="https://checkout.stripe.com/checkout.js"
        class="stripe-button"
        id="stripe-button"
        data-key="${publishKey}"
        data-amount=${total * 100}
        data-name="Flipkart"
        data-image="./img/flipkartlogo.svg"
        data-currency="inr"
        data-email="flipkart.payment@gmail.com"></script>`

        $('#form1').html(content);
    }

    function removeItem(cart_id, product_id) {
        let inputField_id = "quantity-input-" + cart_id;
        let inputField = document.getElementById(inputField_id).value;
        $.ajax({
            type: "POST",
            url: "../remove-cart-item.php",
            data: { "cart_id": cart_id, "product_id": product_id, "quantity": inputField },
            dataType: "json",
            success: function (response) {
                if (response.success) {
                    alert(response.message);
                }
                location.reload();
            }
        });
    }
});
