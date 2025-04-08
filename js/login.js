$("#sign-in-form").submit(function (e) {
    e.preventDefault(); 

    const email_regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    // if ($('#email').val().trim() === "") {
    //     $('#span-email').text('Please Enter Email');
    //     return;
    // }

    // if (!email_regex.test($('#email').val().trim())) {
    //     $('#span-email').text('Enter valid email address');
    //     return;
    // }

    // if ($('#pass').val().trim() === "") {
    //     console.log("hello")
    //     $('#span-password').text('Please Enter Password');
    //     return;
    // }

    $.ajax({
        type: "POST",
        url: "../login.php",
        data: $("#sign-in-form").serialize(), 
        dataType: "json",
        success: function (response) {
            if (response.success) {
                window.location.href = "/"; 
            } else {
                $('#' + response.error_block).text(response.message);
            }
        },
        error: function () {
            alert("An error occurred. Please try again.");
        }
    });
});

$("#sign-up-form").submit(function (e) { 
    e.preventDefault();

    $('.error').text('');
    
    const pass_regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;
    const username_regex = /^[A-Za-z]{1}[A-Za-z0-9]+$/;
    const num_regex = /^[6-9]{1}[0-9]{9}$/;
    const email_regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if ($('#uname').val().trim() === "") {
        $('#span-username').text('Please Enter username');
        return;
    }

    if (!username_regex.test($('#uname').val().trim())) {
        $('#span-username').text('Username must start with letter and followed by letter or digit');
        return;
    }

    if ($('#email').val().trim() === "") {
        $('#span-email').text('Please Enter Email');
        return;
    }

    if (!email_regex.test($('#email').val().trim())) {
        $('#span-email').text('Enter valid email address');
        return;
    }

    if ($('#pass').val().trim() === "") {
        console.log("hello")
        $('#span-password').text('Please Enter Password');
        return;
    }

    if (!pass_regex.test($('#pass').val().trim())) {
        $('#span-password').text('Password should contain minimum 8 letters, 1 Uppercase, 1 lowercase, 1 special character and 1 digit');
        return;
    }

    if ($('#cpass').val().trim() === "") {
        $('#span-cpassword').text('Please Enter Password');
        return;
    }

    if ($('#pass').val().trim().localeCompare($('#cpass').val().trim()) != 0) {
        $('#span-password').text('Password and Confirm Password doesn\'t match');
        return;
    }

    if ($('#num').val().trim() === "") {
        $('#span-phone').text('Please Enter Phone Number');
        return;
    }

    if (!num_regex.test($('#num').val().trim())) {
        $('#span-phone').text('Number should contain 10 digits and start with 6-9');
        return;
    }

    if (!$('#rememberme').is(':checked')) {
        $('#span-tnc').text('Please Accept term and conditions');
        return;
    }

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
                $('#' + response.error_block).text(response.message); 
            }
        },
        error: function () {
            alert("An error occurred. Please try again.");
        }
    });
});
