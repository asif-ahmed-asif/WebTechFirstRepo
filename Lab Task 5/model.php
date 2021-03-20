<?php 
require_once 'dbConnection.php';

function addProduct($data)
{
	$conn = db_conn();
    $selectQuery = "INSERT INTO products (name, bprice, sprice, profit, display) VALUES(:name, :bprice, :sprice, :profit, :display)";
    try
    {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
        	':name'   => $data['name'],
        	':bprice' => $data['bprice'],
        	':sprice' => $data['sprice'],
            ':profit' => $data['profit'],
            ':display' => $data['display'],
        ]);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    
    $conn = null;
    return true;
}

function showAllProducts()
{
	$conn = db_conn();
    $selectQuery = 'SELECT * FROM products';
    try
    {
        $stmt = $conn->query($selectQuery);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

function showProduct($id)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM products WHERE id = ?";

    try
    {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    }
    catch (PDOException $e)
    {
        echo $e->getMessage();
    }
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    return $row;
}

function updateProduct($id, $data)
{
    $conn = db_conn();
    $selectQuery = "UPDATE products set name = ?, bprice = ?, sprice = ?, profit = ?, display= ? WHERE id = ?";
    try
    {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([
            $data['name'], $data['bprice'],$data['sprice'],$data['profit'],$data['display'], $id
        ]);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    
    $conn = null;
    return true;
}

function deleteProduct($id)
{
    $conn = db_conn();
    $selectQuery = "DELETE FROM products WHERE id = ?";
    try
    {
        $stmt = $conn->prepare($selectQuery);
        $stmt->execute([$id]);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    $conn = null;
    return true;
}

function searchProduct($valueToSearch)
{
    $conn = db_conn();
    $selectQuery = "SELECT * FROM products WHERE name LIKE '%".$valueToSearch."%'";
    try
    {
        $stmt = $conn->query($selectQuery);
    }
    catch(PDOException $e)
    {
        echo $e->getMessage();
    }
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}
?>