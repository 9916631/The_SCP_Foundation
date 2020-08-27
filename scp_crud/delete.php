<?php
    include 'config/database.php';

    try{

        $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: Record ID not found');

        //delete query
        $query = "delete from subject where id = ?";
        $statement = $conn->prepare($query);
        $statement ->bindParam(1, $id);

        if($statement->execute()){
            header('Location: index.php?action=deleted');
        }
        else{
            die('Unable to delete record');
        }
    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
?>