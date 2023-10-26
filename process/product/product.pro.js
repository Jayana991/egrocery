function crudProductdata() {
  //page topic change
  let statusElement = document.getElementById("productDataProcessType");
  let currentStatus = statusElement.innerText;
  if (currentStatus === "Add") {
    statusElement.innerText = "Update/Delete";
  } else if (currentStatus === "Update/Delete") {
    statusElement.innerText = "Add";
  }

  //change btn status
  let btnStatsElemet = document.getElementById("btnStatus");
  let currentbtnStats = btnStatsElemet.innerText;
  if (currentbtnStats === "Update") {
    btnStatsElemet.innerText = "Add";
  } else if (currentbtnStats === "Add") {
    btnStatsElemet.innerText = "Update";
  }


  //student selet tage (for update and delete)
  let studentSelect = document.getElementById("selectProcutForUD");
  studentSelect.classList.toggle("d-none");

  //toggle CRUD btn in addstudent
  let studentAddbtnSection = document.getElementById("productAddBtnSection");
  studentAddbtnSection.classList.toggle("d-none");

  let studentUDbtnSection = document.getElementById("productUDbtnSection");
  studentUDbtnSection.classList.toggle("d-none");

}

function addProductimage() {
  var image = document.getElementById("addproduct_imageSelect");

  image.onchange = function () {
    var file_count = image.files.length;

    if (file_count <= 4) {
      for (var x = 0; x < file_count; x++) {
        var file = this.files[x];
        var url = window.URL.createObjectURL(file);

        document.getElementById("addProductimg").src = url;
      }
    } else {
      alert("Please select 4 or less than 4 images.");
    }

  };
}

function productIdForUpdate(id) {

  fetch('../../process/product/updateProductSet.pro.php?id=' + id, {
    method: "GET",
  })
    .then((response) => {
      //return response.text();
      return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
    })
    .then((data) => {

      if (data.isSetPost) {
        //get input data
        const idArray = [
          "productName",
          "productcategory",
          "productSampleDiscription",
          "productDiscription",
          "productPrice",
          "productPriceQty",
          "productUnit",
        ];

        //set Id data
        idArray.forEach(elementId => {
          const elementValue = document.getElementById(elementId).value;
        });

        productName.value = data.productData.name;
        productcategory.value = data.productData.category_id;
        productSampleDiscription.value = data.productData.smapleDis;
        productDiscription.value = data.productData.discription;
        productPrice.value = data.productData.price;
        productPriceQty.value = data.productData.priceQty;
        productUnit.value = data.productData.unit_id;

        document.getElementById("addProductimg").src = "../../document/" + data.productData.img_path;
      } else {
        alert("Somthing went wrong !")
      }

    })
    .catch((error) => {
      console.log(error);
    });
}

function addProduct() {

  const img = document.getElementById("addproduct_imageSelect").files;
  const name = document.getElementById("productName").value;
  const cat = document.getElementById("productcategory").value;
  const sdis = document.getElementById("productSampleDiscription").value;
  const dis = document.getElementById("productDiscription").value;
  const price = document.getElementById("productPrice").value;
  const priceQty = document.getElementById("productPriceQty").value;
  const unit = document.getElementById("productUnit").value;

  const form = new FormData();
  if (img.length >= 1) {
    for (let i = 0; i < img.length; i++) {
      const file = img[i];
      form.append('images[]', file);
    }
    form.append('name', name);
    form.append('cat', cat);
    form.append('sdis', sdis);
    form.append('dis', dis);
    form.append('price', price);
    form.append('priceQty', priceQty);
    form.append('unit', unit);

    fetch('../../process/product/productAdd.pro.php', {
      method: "POST",
      body: form,
    })
      .then((response) => {
        return response.text();
        //return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
      })
      .then((data) => {
        // if (data.isPost) {
        //   if (data.upOrAdd) {
        //     //data added
        //     alert("Product added successful");
        //   }
        // } else {
        //   alert("fill all");
        // }
        console.log(data)
      })
      .catch((error) => {
        console.log(error);
      });


  }
}

function UpdateProduct() {
  let id = document.getElementById("selecteProduct").value;

  if (id > 0) {
    const img = document.getElementById("addproduct_imageSelect").files;
    const name = document.getElementById("productName").value;
    const cat = document.getElementById("productcategory").value;
    const sdis = document.getElementById("productSampleDiscription").value;
    const dis = document.getElementById("productDiscription").value;
    const price = document.getElementById("productPrice").value;
    const priceQty = document.getElementById("productPriceQty").value;
    const unit = document.getElementById("productUnit").value;

    const form = new FormData();

      for (let i = 0; i < img.length; i++) {
        const file = img[i];
        form.append('images[]', file);
      }
      form.append('name', name);
      form.append('cat', cat);
      form.append('sdis', sdis);
      form.append('dis', dis);
      form.append('price', price);
      form.append('priceQty', priceQty);
      form.append('unit', unit);
      form.append('updateId', id);

      fetch('../../process/product/productAdd.pro.php?id=' + id, {
        method: "POST",
        body: form,
      })
        .then((response) => {
          //return response.text();
          return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
          if (data.isPost) {
            if (!(data.upOrAdd)) {
              //data updated
              alert("Product update successful")
            }
          } else {
            alert("fill all");
          }
          console.log(data)
        })
        .catch((error) => {
          console.log(error);
        });

  }

}

function deleteProduct() {
  let id = document.getElementById("selecteProduct").value;

  if (id > 0) {

    var confirmation = confirm("Are you sure you want to delete this Product's information? (it can't be undone)");

    if (confirmation) {
      fetch('../../process/product/deleteProductSet.pro.php?id=' + id, {
        method: "GET",
      })
        .then((response) => {
          //return response.text();
          return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
          // console.log(data);
          if (data.isSetPost && data.productDelete) {
            alert("product is deleted !");
            location.reload();
          } else {
            alert("Somthing went wrong !")
          }
        })
        .catch((error) => {
          console.log(error);
        });
    } else {
      alert("Process canceled.");
    }

  } else {
    alert("Please select the student")
  }

}