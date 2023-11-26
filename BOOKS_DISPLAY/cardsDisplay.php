<?php
function getFilteredBooks($pdo, $categories)
{
    $sql = "SELECT 
                b.id AS book_id,
                b.title AS book_title,
                b.year_of_publication,
                b.number_of_pages,
                b.image_url,
                a.id AS author_id,
                a.first_name AS author_first_name,
                a.last_name AS author_last_name,
                c.id AS category_id,
                c.title AS category_title
            FROM 
                book b
            JOIN 
                author a ON b.author_id = a.id
            JOIN 
                category c ON b.category_id = c.id
            WHERE 
                b.deleted_at IS NULL
                AND a.deleted_at IS NULL
                AND c.deleted_at IS NULL";

    if (!empty($categories)) {
        $sql .= " AND c.id IN (" . implode(',', $categories) . ")";
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}



