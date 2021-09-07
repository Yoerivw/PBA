<?php 

include_once ('application/config/config.php');

try{
    $sql = "DELETE FROM transaction_list WHERE id = :id";

    $id = $_GET['id'];

$query = $pdo->prepare($sql);

$query->bindParam(':id',$id, PDO::PARAM_INT);
$query->execute();

echo "query successful";

header("location: index.php");


} 
catch(PDOException $e){
    echo $e->getMessage();

}







