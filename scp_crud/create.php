<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <title>Enter a new product</title>
  </head>
  <body class="container">
    <div class="body">
    <h1 class="page_header">Enter a new subject</h1>

<?php
if($_POST){
    //connect to the databse and if quessed have no clue
    include 'config/database.php';
    try{
        //run insert query
        $query = "insert into subject set item=:item, class=:class, containment=:containment, description=:description, image=:image";

        //prepare query for killing/execute
        $statement = $conn->prepare($query);

        $item = htmlspecialchars(strip_tags($_POST['item']));
        $class = htmlspecialchars(strip_tags($_POST['class']));
        
        $containment = htmlspecialchars(strip_tags($_POST['containment']));
        $description = htmlspecialchars(strip_tags($_POST['description']));
        $image = htmlspecialchars(strip_tags($_POST['image']));
    

        //bind parameters to our query
        $statement->bindParam(':item', $item);
        $statement->bindParam(':class', $class);
        
        $statement->bindParam(':containment', $containment);
        $statement->bindParam(':description', $description);
        $statement->bindParam(':image', $image);

        //execute query
        if($statement->execute()){
            echo "<div class='alert alert-success'>Record Was created</div>";
        }else{
            echo "<div class='alert alert-danger'>Unable to save reocrd</div>";
        }

    }catch(PDOException $exception){
        die('ERROR' . $exception->getMessage());
    }
}
?>

<h2>Please enter a new product using the form below....</h2>
<form class="form-group" method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

<label for="">Item:</label>
<br>
<input type="text" name="item" class="form-control">
<br>
<label for="">Class:</label>
<br>
<input type="text" name="class" class="form-control">
<br>    
<!-- <label for="">Brief Description:</label>
<br>
<input type="text" name="blurb" class="form-control">
<br>     -->
<label for="">Containment:</label>
<br>
<input type="text" name="containment" class="form-control">
<br>
<label for="">Description:</label>
<br>
<input type="text" name="description" class="form-control">
<br>
<label for="">Image:</label>
<br>
<input type="text" name="image" class="form-control">
<br>
<input type="submit" value="Save" class="btn btn-primary">

</form>

<p><a href="index.php" class="btn btn-warning">Back to index page.</a></p>

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </div>
  </body>
</html>