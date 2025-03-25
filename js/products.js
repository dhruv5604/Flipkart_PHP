// function addProduct() {
//     const price = document.getElementById("productPrice").value.trim();
//     const image = document.getElementById("productImage");
//     const description = document.getElementById("productDescription").value.trim();
//     const category = document.getElementById("categoryList").value.trim();
//     if(!category){
//         alert("No category!!");
//         window.location.href = "category.html";
//     }
//     const tempCategory = categories.find(c => c.newCategory == category);
//     const categoryId = tempCategory.id;

//     if (!price || !description) {
//         alert("Please fill in all details");
//         return;
//     }
//     let file = image.files[0];
//     let reader = new FileReader();
//     reader.onloadend = () => {
//         let imageBase64 = reader.result;
//         let lastId = products.length > 0 ? products[products.length - 1].id : 0;

//         products.push({
//             id: parseInt(lastId) + 1,
//             image: imageBase64,
//             price,
//             description,
//             categoryId,
//             category
//         });
//         localStorage.setItem("flipkartProducts", JSON.stringify(products));

//         showProducts(products);
//     }

//     document.getElementById("productImage").value = "";
//     document.getElementById("productPrice").value = "";
//     document.getElementById("productDescription").value = "";
//     document.getElementById("categoryList").value = "";

//     reader.readAsDataURL(file);
// }

// document.getElementById("form1").addEventListener("submit", (e) => {
//     e.preventDefault();
//     addProduct();
// })

// function editProduct(index) {
//     localStorage.setItem("editProductId", index);
//     window.location.href = "edit.html";
// }

// function deleteProduct(index) {
//     if (confirm("Are you sure you want to delete this product?")) {
//         products.splice(index, 1);
//         showProducts(products);
//         localStorage.setItem("flipkartProducts", JSON.stringify(products));
//     }
// }

// const sortMethods = {
//     id: (a, b) => a.id - b.id,
//     price: (a, b) => a.price - b.price
// };

// document.querySelectorAll(".sort-btn").forEach((sortBtn) => {
//     sortBtn.addEventListener("click", () => {
//         let tempProducts = [...products];
//         let sortType = sortBtn.dataset.sort;
//         let sortOrder = sortBtn.dataset.order || "asc";

//         if (sortOrder === "asc") {
//             tempProducts.sort(sortMethods[sortType]);
//             sortBtn.dataset.order = "desc";
//             sortBtn.innerHTML = `<i class="fas fa-sort-up"></i>`;
//         } else if (sortOrder === "desc") {
//             tempProducts.sort((a, b) => sortMethods[sortType](b, a));
//             sortBtn.dataset.order = "none";
//             sortBtn.innerHTML = `<i class="fas fa-sort-down"></i>`;
//         } else {
//             tempProducts = [...products];
//             sortBtn.dataset.order = "asc";
//             sortBtn.innerHTML = `<i class="fas fa-sort"></i>`;
//         }
//         showProducts(tempProducts);
//     });
// });

function editProduct(id) {
  $.ajax({
    type: "POST",
    url: "../update-product.php",
    data: { id: id },
    dataType: 'json',
    success: function (response) {
      document.getElementById("productPrice").value = response[0]["price"];
      document.getElementById("productDescription").value =
        response[0]["description"];
      document.getElementById("categoryList").value = response[0]["category"];
      document.getElementById("productId").value = response[0]["id"];
      document.getElementById("productImage").src = response[0]["image"];
      document.getElementById("existingImage").value = response[0]['image'];
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
    success: function (response) {},
  });

  window.location.href = "products.html";
}

$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "../fetch-category.php",
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
    url: "../fetch-products.php",
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
        td_desc.innerText = product["description"];

        let td_category = document.createElement("td");
        td_category.innerText = product["category"];

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
        tr.appendChild(td_btn);

        tbody.appendChild(tr);
      });
    },
  });

});
