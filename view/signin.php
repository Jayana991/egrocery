<?php
//header
$title = "SIGNIN/SIGNUP PAGE"; //page title
require_once('./Header.php');
?>

<div class="row" style="margin-top: 100px;">

    <!-- Sign In Form -->
    <div class="col-md-6 mx-auto " id="signInSection">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Sign In</h4>
                <div id="signInForm">
                    <div class="mb-3">
                        <label for="emailSignIn" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="emailSignIn" value="saha@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordSignIn" class="form-label">Password</label>
                        <input type="password" class="form-control" id="passwordSignIn" value="123123#" required>
                    </div>
                    <button type="submit" class="btn btn-primary" onclick="signin()">Sign In</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Sign Up Form (Initially Hidden) -->
    <div class="col-md-6 mx-auto d-none " id="signUpSection">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title fw-bold my-3">Sign Up</h4>
                <div id="signUpForm">
                    <div class="mb-3">
                        <label for="nameSignUp" class="form-label">Full Name</label>
                        <input type="text" placeholder="Full Name" class="form-control" id="nameSignUp" value="sahan" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailSignUp" class="form-label">Email address</label>
                        <input type="email" placeholder="Email address" class="form-control" id="emailSignUp" value="saha@gmail.com" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailSignUp" class="form-label">Contact number</label>
                        <input type="email" placeholder="Contact number" class="form-control" id="contact" value="0771617400" required>
                    </div>
                    <div class="mb-3">
                        <label for="nameSignUp" class="form-label">Address</label>
                        <input type="text" placeholder="Address" class="form-control" id="addressSignUp" value="sahan kandy" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordSignUp" class="form-label">Password</label>
                        <input type="password" placeholder="password" class="form-control" id="passwordSignUp" value="123123#" required>
                    </div>
                    <div class="mb-3">
                        <label for="passwordSignUp" class="form-label">Re Enter Password</label>
                        <input type="password" placeholder="Re-enter password" class="form-control" id="confirmPasswordSignUp" value="123123#" required>
                    </div>
                    <button type="submit" class="btn btn-success float-center w-100 mt-4" onclick="signup()">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Toggle Button -->
    <div class="col-12 text-center my-3">
        <p id="toggleTextsignup" class="">Don't have an account? <span id="logToggleButtonSignup" class="btn text-decoration-underline text-primary text-underline">Create an account</span></p>
    </div>
    <div class="col-12 text-center my-3 ">
        <p id="toggleTextsignin" class="d-none">Already have an account? <a id="logToggleButtonSignin" class="btn text-decoration-underline text-primary text-underline">Log in</a></p>
    </div>

</div>


<?php
//footer
require_once('./Footer.php');
?>