function addCardItem(pid){
    fetch('../process/cart/cart.pro.php?pid='+pid, {
        method: "GET",
    })
        .then((response) => {
            //return response.text();
            return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
            if(data.isSet){
                const crtBtn = document.getElementById("cart-"+pid);
                if(crtBtn.classList.contains('btn-primary')){
                    crtBtn.classList.remove('btn-primary');
                    crtBtn.classList.add('btn-danger');
                }else{
                    crtBtn.classList.remove('btn-danger');
                    crtBtn.classList.add('btn-primary');
                }
            }else{
                alert("Please logged in")
                location.href = "../../view/signin.php";
            }

        })
        .catch((error) => {
            console.log(error);
        });
}



function fuc(){
    console.log("work")
}