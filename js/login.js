$("#sign-in-form").submit(function (e) {
    e.preventDefault(); 

    $.ajax({
        type: "POST",
        url: "../login.php",
        data: $("#sign-in-form").serialize(), 
        dataType: "json",
        success: function (response) {
            if (response.success) {
                window.location.href = "/"; 
            } else {
                alert(response.message); 
            }
        },
        error: function () {
            alert("An error occurred. Please try again.");
        }
    });
});

$("#sign-up-form").submit(function (e) { 
    e.preventDefault();

    $.ajax({
        type: "POST",
        url: "../signup.php",
        data: $("#sign-up-form").serialize(), 
        dataType: "json",
        success: function (response) {
            if (response.success) {
                alert(response.message);
                window.location.href = "/"; 
            } else {
                alert(response.message); 
            }
        },
        error: function () {
            alert("An error occurred. Please try again.");
        }
    });
});



