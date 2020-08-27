<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">
    
    <title>The SCP Foundation</title>
  </head>
  <body class="container">
    <div class="body">
    <h1>Welcome to the SCP Foundation</h1>    

<?php //database connection
include 'config/database.php';

//select record from database
$query = "select * from subject";
$statement = $conn->prepare($query);
$statement->execute();

//link to create new reocrd
echo "<p><a href='create.php' class='btn btn-primary'>Enter a new subject into the database</a></p>";

//write line to return number of records in database
$rows = $statement->rowCount();

//if there is more then 1 row in the databse then display it first echo displays headings
if($rows > 0){
    echo "
    <div class='row'>
    <div class='col-3 bg-dark text-light'>Id</div>
    <div class='col-3 bg-dark text-light'>Subject</div>
    <div class='col-3 bg-dark text-light'>Subject Class</div>
    <div class='col-3 bg-dark text-light'>Brief Description</div>
    </div> 
    ";

    //loop threw table to retrieve each record and display in bootstrap grid
    while($record = $statement->fetch(PDO::FETCH_ASSOC)){
        extract($record);

        echo "
        <div class='row'>
        <div class='col-3'><p>{$id}</p></div>
        <div class='col-3'><p>{$item}</p></div>
        <div class='col-3'><p>{$class}</p></div>
        
        </div>

        <p>
        <a href='read_one.php?id={$id}' class='btn btn-info'>Read</a> --
        <a href='update.php?id={$id}' class='btn btn-primary'>Edit</a> --
        <a href='#' onclick='delete_record({$id})' class='btn btn-danger'>Delete</a>
        </p>
        ";
    }
}else{
    echo "<div class='alert alert-danger'>No records found</div>";
}


?>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

<?php
$delete = isset($_GET['action']) ? $_GET['action'] : "";

//if directed from delete .php 
if($delete == 'deleted'){
    echo "<div class='alert alert-success'>Record was deleted</div>";
}
?>
<script>
    function delete_record(id){
        var answer = confirm('Ok to delete this record?');
        if(answer){
            window.location = 'delete.php?id=' + id;
        }
    }
</script>
    </div>

</body>
</html>