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

    if ($("#pass").val().trim() === "") {
        $("#span-password").text("Please Enter Password");
        return;
    }
});
