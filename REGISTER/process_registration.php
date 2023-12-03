<?php
include __DIR__ . '/../connection.php';

session_start(); 

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    $password = $_POST['password'];
    
    if (empty($email)) {
        $_SESSION['emailError'] = 'Email is required';
        header('Location: ../REGISTER/register.php');
        exit();
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION['emailError'] = 'Invalid email format';
        header('Location: ../REGISTER/register.php');
        exit();
    }

    if (empty($password)) {
        $_SESSION['passwordError'] = 'Password is required';
        header('Location: ../REGISTER/register.php');
        exit();
    }

    if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]{8,}$/', $password)) {
        $_SESSION['passwordError'] = 'Invalid password format. It must be at least 8 characters long and contain at least one letter and one number.';
        
        header('Location: ../REGISTER/register.php');
        exit();
    }

    $sqlCheckEmail = "SELECT id FROM users WHERE email = ?";
    $queryCheckEmail = $pdo->prepare($sqlCheckEmail);
    $queryCheckEmail->execute([$email]);

    if ($queryCheckEmail->fetchColumn()) {
        $_SESSION['emailError'] = 'Email has already been taken';
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
        unset($_SESSION['emailError']);
        unset($_SESSION['passwordError']);

        header('Location: ../main.php');
        exit();
    } catch (PDOException $e) {
        echo 'Error: ' . $e->getMessage();
    }
} else {
    header('Location: ../REGISTER/register.php');
    exit();
}
