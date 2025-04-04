<?php
require('config.php');
require('connection.php');
require('vendor/autoload.php');

use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;


\Stripe\Stripe::setVerifySslCerts(false);
session_start();

$token = $_POST['stripeToken'];
$amount = isset($_POST['total_amount']) ? intval($_POST['total_amount']) : 0;

if ($amount < 1) {
    die("Error: Total amount must be at least ₹0.01.");
}

try {
    $data = \Stripe\Charge::create([
        "amount" => $amount,
        "currency" => "inr",
        "description" => "Flipkart",
        "source" => $token
    ]);

    $order_id = null;
    $txn_id = $data->balance_transaction;
    $paid_amount = $data->amount / 100;

    $user_id = $_SESSION['user_id'];
    $query_insert_order = "insert into Orders(user_id, total_amount, transaction_id) values (?, ?, ?)";
    $stmt = $con->prepare($query_insert_order);
    $stmt->bind_param("iis", $user_id, $paid_amount, $txn_id);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    $query_select_cart = "select * from cart where user_id = ?";
    $stmt = $con->prepare($query_select_cart);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();

    $products = $result->fetch_all(MYSQLI_ASSOC);

    $query_insert_orderItems = "insert into Order_Item(order_id, product_name, product_price, product_img, quantity, product_offer) values (?, ?, ?, ?, ?, ?)";
    $stmt = $con->prepare($query_insert_orderItems);

    foreach ($products as $product) {
        $product_id = $product['product_id'];
        $quantity = $product['quantity'];

        $query_product = "select name,image,price,offer from products where id = ?";
        $stmt_product = $con->prepare($query_product);
        $stmt_product->bind_param("i", $product_id);
        $stmt_product->execute();
        $stmt_product->bind_result($product_name, $product_img, $product_price, $product_offer);
        $stmt_product->fetch();
        $stmt_product->close();

        $stmt->bind_param("isisii", $order_id, $product_name, $product_price, $product_img, $quantity, $product_offer);
        $stmt->execute();
    }

    $query_delete_cart = "delete from cart where user_id = ?";
    $stmt = $con->prepare($query_delete_cart);
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
    exit();
}


$query = 'SELECT o.id, o.total_amount, o.user_id, o.order_status, o.order_date, o.transaction_id,
                 oi.quantity, oi.product_offer, oi.product_price, oi.product_name, oi.product_img
          FROM Orders o
          JOIN Order_Item oi ON o.id = oi.order_id
          WHERE o.id = ?';

$stmt_order = $con->prepare($query);
$stmt_order->bind_param("i", $order_id);
$stmt_order->execute();
$result = $stmt_order->get_result();

$order_items = [];
$order_info = null;

while ($row = $result->fetch_assoc()) {
    if (!$order_info) {
        $order_info = $row;
    }
    $order_items[] = $row;
}

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'dhruvsolanki5604@gmail.com';
    $mail->Password = 'pyui erkp ktfh vhji';
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('dhruvsolanki5604@gmail.com', 'Dhruv');
    $mail->addAddress($_SESSION['email']);

    $mail->isHTML(true);
    $mail->Subject = 'Order Confirmation - Order #' . $order_info['id'];

    $product_rows = "";

    foreach ($order_items as $item) {
        $img_path = __DIR__ . "/static/uploaded-img/" . basename($item['product_img']);

        if (file_exists($img_path)) {
            $mail->addEmbeddedImage($img_path, 'product_image', basename($img_path));
            $img_tag = "<img src='cid:product_image' width='60' height='60' style='object-fit:cover;'>";        
        } else {
            $img_tag = "<span>Image not found</span>";
        }
        
        $product_rows .= "
        <tr>
            <td>$img_tag</td>
            <td>{$item['product_name']}</td>
            <td>{$item['quantity']}</td>
            <td>₹{$item['product_price']}</td>
        </tr>
    ";
    }

    $username = $_SESSION['uname'];
    $order_id = $order_info['id'];
    $txn_id = $order_info['transaction_id'];
    $amount = $order_info['total_amount'];
    $order_date = date("d-m-Y", strtotime($order_info['order_date']));

    $mail->Body = "
    <html>
    <head>
      <style>
        body { font-family: Arial, sans-serif; background: #f4f4f4; margin: 0; padding: 20px; }
        .container { background: #fff; padding: 20px; border-radius: 8px; }
        h2 { color: #333; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 10px; text-align: left; }
        th { background: #007bff; color: white; }
        .footer { margin-top: 30px; font-size: 14px; color: #888; text-align: center; }
      </style>
    </head>
    <body>
      <div class='container'>
        <h2>Hello $username,</h2>
        <p>Thank you for your order! Here are your details:</p>
        <p><strong>Order ID:</strong> $order_id</p>
        <p><strong>Transaction ID:</strong> $txn_id</p>
        <p><strong>Amount Paid:</strong> ₹$amount</p>
        <p><strong>Order Date:</strong> $order_date</p>

        <table>
          <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Price</th>
          </tr>
          $product_rows
        </table>

        <div class='footer'>
          <p>Need help? Email us at support@flipkart-clone.com</p>
          <p>&copy; " . date("Y") . " Flipkart Clone</p>
        </div>
      </div>
    </body>
    </html>";

    $mail->send();
} catch (Exception $exception) {
    echo "Error : {$mail->ErrorInfo}";
}
