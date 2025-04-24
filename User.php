<?php
class User {
    private $pdo;

    // Constructor accepts PDO instance
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // Method to get all users (read-only, safe)
    public function getAllUsers() {
        $stmt = $this->pdo->query("SELECT id, username FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Method to register a new user with a hashed password
    public function registerUser($username, $password) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashedPassword);
        return $stmt->execute();
    }

    // Method to update user username (needs password confirmation)
    public function updateUser($id, $newUsername, $password) {
        // Check if password is correct (using password_verify for security)
        $stmt = $this->pdo->prepare("SELECT password FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['password'])) {
            // Update the username if password matches
            $stmt = $this->pdo->prepare("UPDATE users SET username = :username WHERE id = :id");
            $stmt->bindParam(':username', $newUsername);
            $stmt->bindParam(':id', $id);
            return $stmt->execute();
        }
        return false; // Password mismatch or user not found
    }

    // Method to delete user
    public function deleteUser($id) {
        $stmt = $this->pdo->prepare("DELETE FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // Method to check if username already exists
    public function checkUsernameExists($username) {
        $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->bindParam(':username', $username);
        $stmt->execute();
        return $stmt->fetchColumn() > 0;
    }
}
?>
