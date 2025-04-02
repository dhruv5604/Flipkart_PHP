$(document).ready(function () {
    let amount = $('#amount').data('amount');

    $.ajax({
        type: "POST",
        url: "../empty-cart.php",
        data: { "amount": amount },
        dataType: "json",
        success: function (response) {
            console.log(response);
        }
    });
});