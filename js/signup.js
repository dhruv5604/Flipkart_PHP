$("#uname").change(function () {
    $("#span-username").text("");
    const username_regex = /^[A-Za-z]{1}[A-Za-z0-9]+$/;

    if ($("#uname").val().trim() === "") {
        $("#span-username").text("Please Enter username");
        return;
    }

    if (!username_regex.test($("#uname").val().trim())) {
        $("#span-username").text(
            "Username must start with letter and followed by letter or digit"
        );
        return;
    }
});

$("#email").change(function () {
    $("#span-email").text("");
    const email_regex = /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/;

    if ($("#email").val().trim() === "") {
        $("#span-email").text("Please Enter Email");
        return;
    }

    if (!email_regex.test($("#email").val().trim())) {
        $("#span-email").text("Enter valid email address");
        return;
    }
});

$("#pass").change(function () {
    $("#span-password").text("");
    const pass_regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[\W_]).{8,}$/;

    if ($("#pass").val().trim() === "") {
        $("#span-password").text("Please Enter Password");
        return;
    }

    if (!pass_regex.test($("#pass").val().trim())) {
        $("#span-password").text(
            "Password should contain minimum 8 letters, 1 Uppercase, 1 lowercase, 1 special character and 1 digit"
        );
        return;
    }
});

$("#cpass").change(function () {
    $("#span-cpassword").text("");
    if ($("#cpass").val().trim() === "") {
        $("#span-cpassword").text("Please Enter Password");
        return;
    }
});

$("#num").change(function () {
    $("#span-phone").text("");
    const num_regex = /^[6-9]{1}[0-9]{9}$/;

    if ($('#num').val().trim() === "") {
        $('#span-phone').text('Please Enter Phone Number');
        return;
    }

    if (!num_regex.test($('#num').val().trim())) {
        $('#span-phone').text('Number should contain 10 digits and start with 6-9');
        return;
    }
});