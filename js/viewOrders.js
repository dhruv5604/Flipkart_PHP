$(document).ready(function() {
    function fetchOrders() {
        $.ajax({
            type: "POST",
            url: "../fetch-orders.php",
            dataType: "json",
            success: function (orders) {
                $("#order-list").empty();
                if (orders.length === 0) {
                    $("#order-list").html("<p>No orders found.</p>");
                    return;
                }
        
                orders.forEach(order => {
                    let statusClass = order.status.toLowerCase();
                    let orderHtml = `
                        <div class="order-card">
                            <div class="order-header">
                                <div>
                                    <strong>Order ID:</strong> ${order.order_id} <br>
                                    <strong>Date:</strong> ${order.date} <br>
                                    <strong>Status:</strong> <span class="status ${statusClass}">${order.status}</span> <br>
                                    <strong>Total:</strong> ₹${order.total}
                                </div>
                                <div>
                                    <span class="toggle-items" data-order="${order.order_id}">View Items</span>
                                </div>
                            </div>
                            <div class="order-items" id="items-${order.order_id}">
                                <hr>
                                ${order.items.map(item => {
                                    let discountedPrice = item.price - (item.price * item.offer / 100);
                                    return `
                                        <div>
                                            <img src="${item.image}" alt="${item.name}" width="50">
                                            <span>${item.name} (x${item.quantity}) - ₹${discountedPrice.toFixed(2)}
                                            /span>
                                        </div>
                                    `;
                                }).join('')}
                            </div>
                        </div>
                    `;
                    $("#order-list").append(orderHtml);
                });
        
                $(".toggle-items").click(function() {
                    let orderId = $(this).data("order");
                    $("#items-" + orderId).slideToggle();
                    $(this).text($(this).text() === "View Items" ? "Hide Items" : "View Items");
                });
            }
        });
        
    }

    fetchOrders();
});