<?php
    //php validate func 
    function validateUserSignUpData($data){
  
        $errors = [];
        // Validate email
        if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email address";
        }
        // Validate name
        if (empty($data["name"])) {
            $errors[] = "Name is required";
        }
        // Validate address
        if (empty($data["address"])) {
            $errors[] = "Address is required";
        }
        // Validate password
        if (strlen($data["pass"]) < 6) {
            $errors[] = "Password should be at least 6 characters long";
        }
        // Check if password contains at least one special character (e.g., !@#$%^&*)
        if (!preg_match("/[^A-Za-z0-9]/", $data["pass"])) {
            $errors[] = "Password should contain at least one special character";
        }

        if (!validatePhoneNumber($data["contact"])) {
            $errors[] = "Invalid phone number";
        }
        return $errors;
    }

    function validateUserSignInData($data){
  
            $errors = [];
            // Validate email
            if (!filter_var($data["email"], FILTER_VALIDATE_EMAIL)) {
                $errors[] = "Invalid email address";
            }

            // Validate password
            if (strlen($data["pass"]) < 6) {
                $errors[] = "Password should be at least 6 characters long";
            }


            return $errors;
    }

    //php data validate func 
    function input_data_validate($data){
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
    }

    //user exists
    function isUserExistsSignIn($email, $pass){

        $check_user_exists_rs = Database::search("SELECT `email` , `pass` FROM user WHERE email = '".$email."'");
        
        if ($check_user_exists_rs->num_rows == 1) {
            $check_user_exists_data = $check_user_exists_rs->fetch_assoc();

            if (password_verify($pass, $check_user_exists_data["pass"])) {
                return true;
            }else{
                return false;
            }
        } else {
            return false;
        }
    }

    function isUserExistsSignUp($email, $contact){
        $check_user_exists_rs = Database::search("SELECT `email`,`contact` FROM user WHERE email = '".$email."' OR contact = '".$contact."'");
        if ($check_user_exists_rs->num_rows > 1) {
            return false;
        } else {
            return true;
        }
    } 
    
    //php mobile validate func 
    function validatePhoneNumber($phone){
            $phone = preg_replace('/\s+|-/', '', $phone);
            $pattern = '/^(0|\+94)([1-2689]\d{9})$/';
            if (!preg_match($pattern, $phone)) {
                return true;
            } else {
                return false;
            }
    }
