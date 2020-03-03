<?php

//get all products
function getAllProducts($db)
    {
    $sql = 'Select b.genre, b.title, b.author from book';
    $stmt = $db->prepare ($sql);
    $stmt ->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
//get book by id
function getBook($db, $bookGenre)
    {
    $sql = 'Select id, title, author from book';
    $sql .= ' Where genre = :genre'; 
    $stmt = $db->prepare ($sql);
    $id = $bookGenre;
    $stmt->bindParam(':genre', $id, PDO::PARAM_STR);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
function createBook($db, $form_data) 
    {
    $sql = 'Insert into book (genre, title, author, start_date) ';
    $sql .= 'values (:genre, :title, :author, :start_date)';
    $stmt = $db->prepare ($sql);
    $stmt->bindParam(':genre', $form_data['genre']);
    $stmt->bindParam(':title', $form_data['title']);
    $stmt->bindParam(':author', $form_data['author']);
    $stmt->bindParam(':start_date', $form_data['start_date']);
    $stmt->execute();
    return $db->lastInsertID();//insert last number.. continue
    }

//delete book by id
function deleteBook($db,$bookGenre) 
    {
    $sql = ' Delete from book where genre = :genre';
    $stmt = $db->prepare($sql);
    $id = $bookGenre;
    $stmt->bindParam(':genre', $id, PDO::PARAM_STR);
    $stmt->execute();
    }
    
//update book by id
function updateBook($db,$form_data,$bookGenre,$date) 
    {
    $sql = 'UPDATE book SET id = :id, genre = :genre, title = :title, author = :author , start_date = :start_date , end_date = :end_date';
    $sql .=' WHERE genre = :genre';
    
    $stmt = $db->prepare ($sql);
    $id = $bookGenre;
    $mod = $date;
    
        $stmt->bindParam(':id', $form_data['id']);
        $stmt->bindParam(':genre', $id, PDO::PARAM_STR);
        $stmt->bindParam(':title', $form_data['title']);
        $stmt->bindParam(':author', $form_data['author']);
        $stmt->bindParam(':start_date', $form_data['start_date']);
        $stmt->bindParam(':end_date', $mod , PDO::PARAM_STR);
        $stmt->execute();
      
        $sql1 = 'Select id, genre, title, author, start_date, end_date from book';
        $sql1 .= ' Where genre = :genre'; 
        $stmt1 = $db->prepare ($sql1);
        $stmt1->bindParam(':genre', $id, PDO::PARAM_STR);
        $stmt1->execute();
        return $stmt1->fetchAll(PDO::FETCH_ASSOC);
    }
    
?>
    