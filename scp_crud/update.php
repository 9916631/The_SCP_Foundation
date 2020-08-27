<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/main.css">

    <title>Update SCP Subject Record</title>
  </head>
  <body class="container">
    <div class="body">
    <h1 class="page-header">Update SCP Subject Record</h1>

<!--php code to select desired record-->
<?php
//check if id value was sent to this page via get method(?=) from a link
$id = isset($_GET['id']) ? $_GET['id'] : die("ERROR: Record ID not found");

//connect to database
include 'config/database.php';

//get the current record frm the db based id value
try{
    $query = "select * from subject where id = ? limit 0,1";

    //bind our id
    $read = $conn->prepare($query);
    $read->bindParam(1, $id);
    $read->execute();

   $row = $read->fetch(PDO::FETCH_ASSOC);

    $item = $row['item'];
    $class = $row['class'];
   
    $containment = $row['containment'];
    $description = $row['description'];
    $image = $row['image'];
}
catch(PDOException $exception){
    die('ERROR: ' . $exception->getMessage());
}

if($_POST){
    try{
        //update sequql query
        $query = "update subject set item=:item, class=:class, containment=:containment, description=:description, image=:image where id=:id";
        //prepare the query
        $update = $conn->prepare($query);
        //save post values from form to stop hackewrs with special chars.
        $id = htmlspecialchars(strip_tags($_POST['id']));
        $item = htmlspecialchars(strip_tags($_POST['item']));
        $class = htmlspecialchars(strip_tags($_POST['class']));
        
        $containment = htmlspecialchars(strip_tags($_POST['containment']));
        $description = htmlspecialchars(strip_tags($_POST['description']));
        $image = htmlspecialchars(strip_tags($_POST['image']));

        //bind the placeholder to actial parameteres to stop fields inserted
        $update->bindParam(':id', $id);
        $update->bindParam(':item', $item);
        $update->bindParam(':class', $class);
        
        $update->bindParam(':containment', $containment);
        $update->bindParam(':description', $description);
        $update->bindParam(':image', $image);

        //execute the query update
        if($update->execute()){
            echo "<div class='alert alert-success'>Record {$id} was updated.</div>";
        }
        else{
            echo "<div class='alert alert-danger'>Unable to update record, please try again</div>";
        }

    }
    catch(PDOException $exception){
        die('ERROR: ' . $exception->getMessage());
    }
}
else{
    echo "<div class='alert alert-danger'>Record is ready to be updated</div>";
}
?>

<h2>Use this form to update the selected record</h2>

<form class="form-group" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?id={$id}'); ?>" method="post">

<label>Record ID:<?php echo $id; ?></label>
<br>
<input type="hidden" name="id" value="<?php echo htmlspecialchars($id, ENT_QUOTES); ?>">
<br>

<label>SCP Item No:</label>
<br>
<input class="form-control" type="text" name="item" value="<?php echo htmlspecialchars($item, ENT_QUOTES); ?>">
<br>
<label>Class:</label>
<br>
<input class="form-control" type="text" name="class" value="<?php echo htmlspecialchars($class, ENT_QUOTES); ?>">
<br>
<!-- <label>Brief Description:</label>
<br>
<input class="form-control" type="text" name="blurb" value="<?php echo htmlspecialchars($blurb, ENT_QUOTES); ?>">
<br> -->

<label>Containment:</label>
<br>
<input class="form-control" type="text" name="containment" value="<?php echo htmlspecialchars($containment, ENT_QUOTES); ?>">
<br>

<label>Description:</label>
<br>
<input class="form-control" type="text" name="description" value="<?php echo htmlspecialchars($description, ENT_QUOTES); ?>">
<br>

<label>Image:</label>
<br>
<input class="form-control" type="text" name="image" value="<?php echo htmlspecialchars($image, ENT_QUOTES); ?>">
<br>

<input type="submit" value="Save Changes" name="update" class="btn btn-primary">
</form>

<p><a href="index.php" class="btn btn-info">Back to index page</a></p>



<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
    </div>
  </body>
</html>