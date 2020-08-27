<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="css/main.css">

  <title>Read a single record</title>
</head>

<body class="container">
  <div class="body">
    <h1>Read a single record</h1>

    <?php
    //first check if id value was sent to this page via get method (?id=) usual from link
    if (isset($_GET['id'])) {
      include 'config/database.php';
      $id = $_GET['id'];
    } else {
      die('Error: Record id not found');
    }

    try {
      $query = "select * from subject where id = ? limit 0,1";
      $statement = $conn->prepare(($query));

      //this is to bind the ? to id
      $statement->bindParam(1, $id);
      $statement->execute();

      //store retrieved reord into assoiciate array
      $row = $statement->fetch(PDO::FETCH_ASSOC);

      //values from the reocrd
      $item = $row['item'];
      $class = $row['class'];

      $containment = $row['containment'];
      $description = $row['description'];
      $image = $row['image'];
    } catch (PDOException $exception) {
      die('Error: ' . $exception->getMessage());
    }
    ?>

    <!-- <div class="row">
   <div class="col">
   <div class="col-4 bg dark text-light">Name</div>
    <div class="col-4 bg dark text-light">Description</div>
    <div class="col-4 bg dark text-light">Price</div>
   </div>
</div> -->


    <h1><?php echo htmlspecialchars($item, ENT_QUOTES); ?></h1>
    <h2><?php echo htmlspecialchars($class, ENT_QUOTES); ?></h2>

    <p><img class="img-fluid" src='<?php echo htmlspecialchars($image, ENT_QUOTES); ?>'></p>
    <p><?php echo htmlspecialchars($containment, ENT_QUOTES); ?></p>
    <p><?php echo htmlspecialchars($description, ENT_QUOTES); ?></p>
  
  <p><a href="index.php" class="btn btn-info">Back to index page</a></p>

  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  </div>
</body>

</html>