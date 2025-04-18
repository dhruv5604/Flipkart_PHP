$('#newCategory').change(function () {
  if ($('#newCategory').val() === "") {
    $('#span-category').text('Enter Category name');
  }
});

function editCategory(id) {
  $.ajax({
    type: "POST",
    url: "../fetch-category.php",
    data: { id: id },
    dataType: "json",
    success: function (response) {
      if (Array.isArray(response) && response.length > 0) {
        response.forEach((category) => {
          document.getElementById("newCategory").value = category.category;
          document.getElementById("categoryId").value = id;
        });
      }
    },
  });
}

function deleteCategory(id) {
  $.ajax({
    type: "POST",
    url: "../delete-category.php",
    data: { id: id },
    dataType: "json",
    success: function (response) {
      window.location.href = "category";
    },
    error: function (e) {
      alert("Error in deleting category");
    },
  });
}

$(document).ready(function () {
  $.ajax({
    type: "GET",
    url: "../fetch-all-category.php",
    dataType: "json",
    success: function (response) {
      response.forEach((category) => {
        const categoryList = document.getElementById("category-list");
        let tr = document.createElement("tr");
        let td_id = document.createElement("td");
        td_id.innerHTML = category.id;

        let td_name = document.createElement("td");
        td_name.innerHTML = category.category;

        let td_btn = document.createElement("td");

        let btn_edit = document.createElement("button");
        btn_edit.innerHTML = '<i class="fa-solid fa-pen"></i>';
        btn_edit.addEventListener("click", () => editCategory(category.id));

        let btn_delete = document.createElement("button");
        btn_delete.innerHTML = '<i class="fa-solid fa-trash"></i>';
        btn_delete.addEventListener("click", () => deleteCategory(category.id));

        td_btn.appendChild(btn_edit);
        td_btn.appendChild(btn_delete);

        tr.appendChild(td_id);
        tr.appendChild(td_name);
        tr.appendChild(td_btn);

        categoryList.appendChild(tr);
      });
    },
  });
});
