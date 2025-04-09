<?php
ini_set('display_errors', 1);
require('config.php');
require('connection.php');
session_start();

$user_id = $_SESSION['user_id'];

$query_select_cart = "select c.*,p.name as name,p.offer as offer,p.price as price from cart c join products p on c.product_id = p.id where user_id = ?";
$stmt = $con->prepare($query_select_cart);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

$products = $result->fetch_all(MYSQLI_ASSOC);
print_r($products);
function createStripeSession($products)
{
    $line_items = [];
    $total_amount = 0;
    foreach ($products as $product) {
        $discounted_price = $product['price'] - ($product['price'] * $product['offer']) / 100;

        $line_items[] = [
            'price_data' => [
                'currency' => 'inr',
                'product_data' => ['name' => $product['name']],
                'unit_amount' => intval($discounted_price * 100),
            ],
            'quantity' => intval($product['quantity']),
        ];
        $total_amount += $discounted_price * $product['quantity'];
    }
    try {
        $session = \Stripe\Checkout\Session::create([
            'payment_method_types' => ['card'],
            'line_items' => $line_items,
            'mode' => 'payment',
            'success_url' => 'http://myflipkart.com/process-checkout.php?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => 'http://myflipkart.com/view-cart.php',
        ]);
        return ['sessionUrl' => $session->url, 'totalAmount' => $total_amount];
    } catch (Exception $e) {
        return ['error' => $e->getMessage()];
    }
}

$response = createStripeSession($products);
echo "<pre>";
print_r($response);
echo $response['sessionUrl'];
if ($response) {
    header("Location: " . $response['sessionUrl']);
}
