<?php //fetchrow.php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

require_once 'login.php';
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die($conn->connect_error);
}

$query = "SELECT * FROM classics";
$result = $conn->query($query);
if (!$result) {
    die($conn->error);
}

$rows = $result->num_rows;

for ($j = 0; $j < $rows; $j++) {
    $result->data_seek($j);
    $row = $result->fetch_array(MYSQLI_ASSOC);
    
    echo 'Author: '   .$row['author']   .'<br>';
    echo 'Title: '    .$row['title']    .'<br>';
    echo 'Category: ' .$row['category'] .'<br>';
    echo 'Year: '     .$row['year']     .'<br>';
    echo 'ISBN: '     .$row['isbn']     .'<br><br>';
}

$result->close();
$conn->close();
?>