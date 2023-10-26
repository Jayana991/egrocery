function validateEmail(email) {
    const regex = /^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/;
    return regex.test(email);
}

function signin() {
    const email = document.getElementById("emailSignIn").value;
    const pass = document.getElementById("passwordSignIn").value;


    if (validateEmail(email)) {
        const form = new FormData();

        form.append('email', email);
        form.append('pass', pass);

        fetch('../process/signInUp/signIn.pro.php', {
            method: "POST",
            body: form,
        })
            .then((response) => {
                //return response.text();
                return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
            })
            .then((data) => {
                if (!(data.isSetPost)) {
                    alert("Somthing went worng ! Plaese try againg later");
                } else if (!(data.idDataValied)) {
                    alert("Please insert a valied data")
                } else if (data.errors && data.errors.length > 0) {
                    var errorMessage = "Errors:\n" + data.errors.join("\n");
                    alert(errorMessage);
                } else if (data.isUserLogIn) {
                    alert("Loging successfull.");
                    if(data.userPost == 1){
                        location.href = "./home.php";
                    }else{
                        location.href = "./admin/admin.php";
                    } 
                }else if(!(data.isUserLogIn)) {
                    alert("Incorrect user name or password")
                }else {
                    alert("Somthing went worng ! Plaese try againg later=")
                }
                //console.log(data)
            })
            .catch((error) => {
                console.log(error);
            });
    } else {
        alert("Invalid email address. Please try again.");
    }
}

function signup() {
    const fullName = document.getElementById("nameSignUp").value;
    const email = document.getElementById("emailSignUp").value;
    const address = document.getElementById("addressSignUp").value;
    const password = document.getElementById("passwordSignUp").value;
    const confirmPassword = document.getElementById("confirmPasswordSignUp").value;
    const contact = document.getElementById("contact").value;

    if (fullName.trim() === "") {
        alert("Please enter your full name.");
    } else if (!validateEmail(email)) {
        alert("Please enter a valid email address.");
    } else if (address.trim() === "") {
        alert("Please enter your address.");
    } else if (!(contact.length == 10 || contact.length >= 13)) {
        alert("Please enter a valid phone number.");
    } else if (password.length < 6) {
        alert("Password should be at least 6 characters long.");
    } else if (password !== confirmPassword) {
        alert("Passwords do not match.");
    } else {
        const form = new FormData();

        form.append('name', fullName);
        form.append('email', email);
        form.append('address', address);
        form.append('pass', password);
        form.append('contact', contact);

        fetch('../process/signInUp/signUp.pro.php', {
            method: "POST",
            body: form,
        })
            .then((response) => {
                //return response.text();
                return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
            })
            .then((data) => {
                if (!(data.isSetPost)) {
                    alert("Somthing went worng ! Plaese try againg later--");
                } else if (!(data.idDataValied)) {
                    alert("Please insert a valied data")
                } else if (data.errors && data.errors.length > 0) {
                    var errorMessage = "Errors:\n" + data.errors.join("\n");
                    alert(errorMessage);
                } else if (!(data.isNotUserAlreadyExists)) {
                    alert("You are Already exists.");
                } else if (data.isUserAdded) {
                    alert("Registation is successfull.");
                    location.href = "./home.php";
                } else {
                    alert("Somthing went worng ! Plaese try againg later")
                }
                //  console.log(data)
            })
            .catch((error) => {
                console.log(error);
            });
    }
}

function signOut(){

        fetch('../../process/signInUp/signOut.pro.php', {
            method: "GET",
        })
            .then((response) => {
                //return response.text();
                return response.status === 200 ? response.json() : (window.location = "../view/error_page.php");
            })
            .then((data) => {
                if(data.logout){
                    location.reload();
                }
            })
            .catch((error) => {
                console.log(error);
            });
}