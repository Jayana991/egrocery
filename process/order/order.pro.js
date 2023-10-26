function placeOrder(total){
    
    fetch('../process/order/order.pro.php?total='+total, {
        method: "GET",
    })
        .then((response) => {
            //return response.text();
            return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
        })
        .then((data) => {
          if(data.isCartSet){
            alert("Your order is complete. Order Id : "+data.orderId);
            location.reload();
            location.href = './invoice.php?oid='+data.orderId;
          }else{
            alert("Somthing went wong !")
          }
        })
        .catch((error) => {
            console.log(error);
        });
}

function deliveryorder(id){
  fetch('../../process/order/orderStatus.pro.php?id='+id, {
    method: "GET",
    })
    .then((response) => {
        //return response.text();
        return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
    })
    .then((data) => {
      if(data.isidSet){
        alert("Order status update !")
        location.reload();
      }else{
        alert("Somthing went wong !")
      }
    })
    .catch((error) => {
        console.log(error);
    });


}