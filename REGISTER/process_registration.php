<?php
include __DIR__ . '/../connection.php';

session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die('Invalid email format');
    }
    $password = $_POST['password'];

    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
        $_SESSION['passwordError'] = 'Invalid password format. It must be at least 8 characters long and contain at least one letter and one number.';
        $_SESSION['validEmail'] = $email; 
        header('Location: ../REGISTER/register.php');
        exit();
    }

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $roleId = 2;

    try {
        $sql = "INSERT INTO users (email, password, role_id) VALUES (?, ?, ?)";
        $query = $pdo->prepare($sql);
        $query->execute([$email, $hashedPassword, $roleId]);

        unset($_SESSION['validEmail']);
        unset($_SESSION['passwordError']);

        header('Location: ../main.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    header('Location: ../main.php');
    exit();
}
