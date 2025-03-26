// let categories = JSON.parse(localStorage.getItem("flipkartCategories")) || [];
// let products = JSON.parse(localStorage.getItem("flipkartProducts")) || [];

// showCategories(categories);

// function showCategories(categories) {
//     const container = document.getElementById("category-container");
//     container.innerHTML = "";

//     categories.forEach((category) => {
//         let categoryHTML = `
//         <div class="container mt-3 p-2">
//             <div class="row ms-2">
//                 <h4>${category.newCategory} Category</h4>
//             </div>
//         </div>
//         <div class="container instruments mb-3">
//             <div class="d-flex">
//                 <div class="cards-wrapper" id="cards-wrapper-${category.newCategory.toLowerCase()}"></div>
//             </div>
//         </div>`;

//         container.innerHTML += categoryHTML;
//     });

//     showProducts(products);
// }

// function showProducts(products) {
//     categories.forEach((category) => {
//         let cardWrapper = document.getElementById(`cards-wrapper-${category.newCategory.toLowerCase()}`);
//         if (cardWrapper) {
//             cardWrapper.innerHTML = "";
//         }
//     });

//     products.forEach((product) => {
//         let categoryId = `cards-wrapper-${product.category.toLowerCase()}`;
//         let cardWrapper = document.getElementById(categoryId);

//         if (cardWrapper) {
//             let card = document.createElement("div");
//             card.classList.add("card");

//             let img = document.createElement("img");
//             img.classList.add("card-img-top", "img-fluid");
//             img.src = product.image;

//             let card_body = document.createElement("div");
//             card_body.classList.add("card-body");

//             let ptag = document.createElement("p");
//             ptag.classList.add("card-text");
//             ptag.innerText = product.description;

//             let strongTag = document.createElement("strong");
//             strongTag.classList.add("card-text");
//             strongTag.innerText = product.price;

//             card_body.appendChild(ptag);
//             card_body.appendChild(strongTag);
//             card.appendChild(img);
//             card.appendChild(card_body);

//             cardWrapper.appendChild(card);
//         }
//     });
// }

$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "../fetch-category.php",
    dataType: "json",
    success: function (response) {

      const container = document.getElementById("category-container");
      container.innerHTML = "";

      response.forEach((category) => {
        let categoryHTML = `
        <div class="container mt-3 p-2">
            <div class="row ms-2">
                <h4>${category.category} Category</h4>
            </div>
        </div>
        <div class="container instruments mb-3">
            <div class="d-flex">
                <div class="cards-wrapper" id="${category.id}"></div>
            </div>
        </div>`;

        container.innerHTML += categoryHTML;
      });
    },
  });

  $.ajax({
    type: "GET",
    url: "../fetch-products.php",
    dataType: "json",
    success: function (response) {
      response.forEach((product) => {
        if(product.status == 0){
            return;
        }
        let categoryId = product.category_id;
        let cardWrapper = document.getElementById(categoryId);

        if (cardWrapper) {
          let card = document.createElement("div");
          card.classList.add("card");

          let img = document.createElement("img");
          img.classList.add("card-img-top", "img-fluid");
          img.src = product.image;

          let card_body = document.createElement("div");
          card_body.classList.add("card-body");

          let ptag = document.createElement("p");
          ptag.classList.add("card-text");
          ptag.innerText = product.name;

          let strongTag = document.createElement("strong");
          strongTag.classList.add("card-text");
          strongTag.innerText = product.price;

          card_body.appendChild(ptag);
          card_body.appendChild(strongTag);
          card.appendChild(img);
          card.appendChild(card_body);

          cardWrapper.appendChild(card);
        }
      });
    },
  });
});
