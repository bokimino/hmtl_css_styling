<?php
session_start();
include __DIR__ . '/../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];
    
    $sql = "SELECT id, email, password, role_id FROM users WHERE email = ?";
    $query = $pdo->prepare($sql);
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user) {
        if (($user['role_id'] == 1 && $password == $user['password']) || 
            ($user['role_id'] == 2 && password_verify($password, $user['password']))) {
            
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];  
            $_SESSION['user_role'] = $user['role_id'];  
            $_SESSION['login_success'] = true;

            if ($user['role_id'] == 1) {
                header('Location: ../admin_dashboard.php');
            } elseif ($user['role_id'] == 2) {
                header('Location: ../main.php?login=success');
            }

            exit();
        }
    }

    $_SESSION['loginError'] = 'Invalid credentials. Please insert valid credentials.';
    header('Location: ../main.php?login=error');
    exit();
} else {
    header('Location: login.php');
    exit();
}