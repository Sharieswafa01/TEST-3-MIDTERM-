<?php

class Auth {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // Login method
    public function login($username, $password) {
        // Check user in the database
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            // Verify password
            if (password_verify($password, $user['password'])) {
                return $user['username']; // Login successful
            }
        }
        
        return false; // Login failed
    }

    // Register method
    public function register($username, $password) {
        // Hash the password before saving it to the database
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Check if the username already exists
        $stmt = $this->conn->prepare("SELECT * FROM users WHERE username = ?");
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            // Username already exists
            return false;
        } else {
            // Insert new user into the database
            $stmt = $this->conn->prepare("INSERT INTO users (username, password) VALUES (?, ?)");
            $stmt->bind_param("ss", $username, $hashed_password);
            $stmt->execute();

            return true; // Registration successful
        }
    }
}
?>
