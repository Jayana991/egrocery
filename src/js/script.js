// // singleProduct qty up/down
// function decreaseQuantity(unitPrice) {
//     const quantityInput = document.getElementById('quantity');
//     let currentValue = parseInt(quantityInput.value, 10);

//     if (currentValue > 1) {
//         currentValue--;
//         quantityInput.value = currentValue;
//     }

//     totalPriceSinglePage(currentValue,unitPrice)
//     totalPriceSinglePageVisibility()
// }
// function increaseQuantity(unitPrice) {
//     const quantityInput = document.getElementById('quantity');
//     let currentValue = parseInt(quantityInput.value, 10);

//     currentValue++;
//     quantityInput.value = currentValue;
//     totalPriceSinglePage(currentValue,unitPrice)
//     totalPriceSinglePageVisibility()
// }
// function totalPriceSinglePage(qty,unitPrice){
//     document.getElementById("totalPriceSinglePage").innerText = qty*unitPrice
// }
// function totalPriceSinglePageVisibility() {
//     const totalPriceVisibility = document.getElementById('totalPriceSinglePageVisibility');
//     if (totalPriceVisibility.classList.contains('d-none')) {
//         totalPriceVisibility.classList.remove('d-none');
//         totalPriceVisibility.classList.add('d-block');
//     }
// }

// Sign-in page toggle

const toggleButtonSignup = document.getElementById('logToggleButtonSignup');
const toggleButtonSignin = document.getElementById('logToggleButtonSignin');
const signUpSection = document.getElementById('signUpSection');
const signInSection = document.getElementById('signInSection');
const toggleTextSignup = document.getElementById('toggleTextsignup');
const toggleTextSignin = document.getElementById('toggleTextsignin');

// Toggle function for switching to Sign Up
toggleButtonSignup.addEventListener('click', function () {
    signInSection.classList.add("d-none");
    signUpSection.classList.remove("d-none");
    toggleTextSignup.classList.add("d-none");
    toggleTextSignin.classList.remove("d-none");
});

// Toggle function for switching to Sign In
toggleButtonSignin.addEventListener('click', function () {
    signUpSection.classList.add("d-none");
    signInSection.classList.remove("d-none");
    toggleTextSignin.classList.add("d-none");
    toggleTextSignup.classList.remove("d-none");
});

//cart btn color
function cartitems(){
    fetch('../process/cart/checkCartitem.pro.php', {
        method: "GET",
    })
        .then((response) => {
            //return response.text();
            return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
            
            if (data.setCart) {

                data.cartArr.forEach(element => {
                    const productId = element;
                    const crtBtn = document.getElementById("cart-"+productId);
                    crtBtn.classList.remove('btn-primary');
                    crtBtn.classList.add('btn-danger');
                });
                
            }

            // console.log(data)
        })
        .catch((error) => {
            console.log(error);
        });
}

//check Product Status
function checkProductStatus(){
    const id = document.getElementById("checkProductStatus").value;
    if(id.length>5){
         location.href = "./myOrderStatus.php?id=" +id;
    }else{
        alert("Please add corect order id")
    }
}