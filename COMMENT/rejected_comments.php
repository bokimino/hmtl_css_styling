<?php
require_once __DIR__ . '/../connection.php';

$sql = "SELECT 
            c.id AS comment_id,
            c.user_id,
            c.book_id,
            c.comment_text,
            c.is_approved,
            c.created_at,
            u.email AS user_email,
            b.title AS book_title
        FROM 
            comment c
        JOIN 
            users u ON c.user_id = u.id
        JOIN 
            book b ON c.book_id = b.id
        WHERE 
            c.is_approved = 0
            AND c.deleted_at IS NULL
        ORDER BY 
            c.created_at DESC";

$query = $pdo->query($sql);
$rejectedComments = $query->fetchAll(PDO::FETCH_ASSOC);
