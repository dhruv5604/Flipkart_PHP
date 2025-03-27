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
        if (product.status == 0) {
            return;
        }
    
        let categoryId = product.category_id;
        let cardWrapper = document.getElementById(categoryId);
    
        if (cardWrapper) {
            let offer = product.offer;
            let discount = (product.price * offer) / 100;
            let discounted_price = product.price - discount;
    
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
    
            let delTag = document.createElement("del");
            delTag.innerText = product.price;
    
            let strongTag_discount = document.createElement("strong");
            strongTag_discount.innerText = discounted_price.toFixed(2);

            let offer_p = document.createElement("strong");
            offer_p.innerText = '(' + product.offer + '% off) ' ;

            let div_price = document.createElement("p");
            div_price.appendChild(delTag);
            div_price.appendChild(document.createTextNode(" "));
            div_price.appendChild(strongTag_discount);
            div_price.appendChild(document.createTextNode(" "));
            div_price.appendChild(offer_p);
    
            card_body.appendChild(ptag);
            card_body.appendChild(div_price);
            card.appendChild(img);
            card.appendChild(card_body);
    
            cardWrapper.appendChild(card);
        }
    });
    
    },
  });
});
