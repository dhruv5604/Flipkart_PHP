document.getElementById("form1").addEventListener("submit", function (e) {
  e.preventDefault();

  let formData = new FormData(this);

  $.ajax({
    type: "POST",
    url: "../add-products.php",
    data: formData,
    processData: false,
    contentType: false,
    dataType: "json",
    success: function (response) {
      console.log(response);
      if (response.success) {
        alert(response.message || "Product updated successfully");
        location.reload();
      } else {
        alert(response.error || "Something went wrong.");
      }
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error:", status, error, xhr.responseText);
      alert("An error occurred. Check console for details.");
    },
  });
});

function editProduct(id) {
  $.ajax({
    type: "POST",
    url: "../fetch-product.php",
    data: { id: id },
    dataType: "json",
    success: function (response) {
      console.log(response);
      document.getElementById("productPrice").value = response['products'][0]["price"];
      document.getElementById("productDescription").value =
        response['products'][0]["name"];
      document.getElementById("categoryList").selected = response['category'];
      document.getElementById("productId").value = response['products'][0]["id"];
      document.getElementById("productImage").src = response['products'][0]["image"];
      document.getElementById("existingImage").value = response['products'][0]["image"];
      document.getElementById("productOffer").value = response['products'][0]["offer"];
      document.getElementById("productStock").value = response['stock'][0]['stock'];
      document.getElementById("productImage").removeAttribute("required");
    },
    error: function (xhr, status, error) {
      console.error("AJAX Error:", status, error);
      console.error("Response Text:", xhr.responseText);
    },
  });
}

function deleteProduct(id) {
  $.ajax({
    type: "POST",
    url: "../delete-product.php",
    data: { id: id },
    dataType: "json",
    success: function (response) {
      window.location.href = "products.php";
     },
  });

}

$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "../fetch-all-category.php",
    dataType: "json",
    success: function (response) {
      let categoryList = document.getElementById("categoryList");
      response.forEach((category) => {
        let option = document.createElement("option");
        option.value = category.category;
        option.innerText = category.category;
        categoryList.appendChild(option);
      });
    },
  });

  $.ajax({
    type: "GET",
    url: "../fetch-all-products.php",
    dataType: "json",
    success: function (response) {
      const tbody = document.getElementById("product-list");

      response.forEach((product) => {
        let tr = document.createElement("tr");

        let td_id = document.createElement("td");
        td_id.innerHTML = product["id"];

        let td_img = document.createElement("td");
        let img = document.createElement("img");
        img.src = product["image"];
        td_img.appendChild(img);

        let td_price = document.createElement("td");
        td_price.innerText = product["price"];

        let td_desc = document.createElement("td");
        td_desc.innerText = product["name"];

        let td_category = document.createElement("td");
        td_category.innerText = product["category_id"];

        let td_offer = document.createElement("td");
        td_offer.innerHTML = product['offer'];

        let td_status = document.createElement("td");
        td_status.innerHTML = product['stock'];

        let td_btn = document.createElement("td");

        let btn_edit = document.createElement("button");
        btn_edit.innerHTML = '<i class="fa-solid fa-pen"></i>';
        btn_edit.addEventListener("click", () => editProduct(product.id));

        let btn_delete = document.createElement("button");
        btn_delete.innerHTML = '<i class="fa-solid fa-trash"></i>';
        btn_delete.addEventListener("click", () => deleteProduct(product.id));
        td_btn.appendChild(btn_edit);
        td_btn.appendChild(btn_delete);

        tr.appendChild(td_id);
        tr.appendChild(td_img);
        tr.appendChild(td_price);
        tr.appendChild(td_desc);
        tr.appendChild(td_category);
        tr.appendChild(td_offer);
        tr.appendChild(td_status);
        tr.appendChild(td_btn);

        tbody.appendChild(tr);
      });
    },
  });
});
