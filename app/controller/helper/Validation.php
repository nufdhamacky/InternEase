<?php 

    class Validation {

        public function validateLogin($username, $password) {
            $errors = [];

            // Validate Username
            if (empty($username) || empty($password)) {
                $errors = "Username and password is required.";
            }

            return $errors;
        }

        public function validateSignup($company, $email, $password, $confirmPassword) {
            $errors = [];

            // Validate Company Name
            if (empty($company)) {
                $errors['companyName'] = "Company name is required.";
            }

            // Validate Email
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors['email'] = "Invalid email address.";
            }

            // Validate Password
            if (strlen($password) < 8 ||
                !preg_match("/[0-9]/", $password) ||
                !preg_match("/[A-Z]/", $password) ||
                !preg_match("/[^a-zA-Z0-9]/", $password)
            ) {
                $errors['password'] = "Password must be at least 8 characters.";
            }

            // Validate Confirm Password
            if ($password !== $confirmPassword) {
                $errors['confirmPassword'] = "Passwords do not match.";
            }

            return $errors;
        }

    }