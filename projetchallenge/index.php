<?php

session_start();
$connect= mysqli_connect("localhost","root","","product_details");

 if (isset($_POST["like"])) {
   # code...
     if(isset($_SESSION["my_prefered_shop"])){
      $item_array_id = array_column($_SESSION["my_prefered_shop"],"item_id");
       if(!in_array($_GET["id"], $item_array_id)){
         $count = count($_SESSION["my_prefered_shop"]);
         $item_array = array (
                          'item_id' => $_GET["id"],
                          'item_pnom' => $_POST["hidden-name"],  
                          'item_prix' => $_POST["hidden-prix"]

                        );
         $_SESSION["my_prefered_shop"][$count] = $item_array;
      }
      else{
        echo '<script>alert("le produit est déja liké") </script>';
        echo '<script>window.location="index.php" </script>';

      }

     
  }
  else
  {
    $item_array = array (
                          'item_id' => $_GET["id"],
                          'item_pnom' => $_POST["hidden-name"],  
                          'item_prix' => $_POST["hidden-prix"]

                        );
         $_SESSION["my_prefered_shop"][0] = $item_array;
    
   }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Bienvenue dans la page </title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	  <link rel="stylesheet" type="text/css" href="style2.css">
</head>
<body>

	<div class="p-welcome">
 <?php echo ' <a id="li1" href="preferedshop.php" > My Prefered Shops </a>' ; ?> &nbsp &nbsp

 <?php echo '<a id="li2" href="nearbyshop.php"> Nearby Shops </a>'; ?>
  
</div>

</br>
</br>
</br>
<?php
   $query = "SELECT * FROM produit ORDER BY id ASC";
   $result= mysqli_query($connect, $query);
   if(mysqli_num_rows($result)> 0){
   	while($row=mysqli_fetch_array($result))
   	{
   
?>
  <div class="col-md-4">
    <form method="post" action="index.php?action=add&id=<?php echo $row["id"]; ?>">
      <div style="border: 1px solid #333; background-color: #f1f1f1; border-radius: 5px; padding: 16px;" align="center">
        <img src="<?php echo $row["image"];?>" class="img-responsive" /></br>
        <h4 class="text-info"><?php echo $row["pnom"]; ?></h4>
        <h4 class="text-danger">$ <?php echo $row["prix"];?> </h4>
        <input type="hidden" name="hidden-name" value="<?php echo $row["pnom"]; ?>">
        <input type="hidden" name="hidden-prix" value="<?php echo $row["prix"]; ?>">
        <input type="submit" name="dislike" style="margin-top: 5px;" class="btn btn-danger" value="dislike"/> 
        <input type="submit" name="like" style="margin-top: 5px;"class="btn btn-success" value="like"/> 
      </div>
      
    </form>
  	
  </div>
  <?php
      }

    }
  ?>

<?php

 if (isset($_POST["dislike"])) {
   # code...
     if(isset($_SESSION["my_nearby_shop"])){
      $item_array_id = array_column($_SESSION["my_nearby_shop"],"item_id");
       if(!in_array($_GET["id"], $item_array_id)){
         $count = count($_SESSION["my_nearby_shop"]);
         $item_array = array (
                          'item_id' => $_GET["id"],
                          'item_pnom' => $_POST["hidden-name"],  
                          'item_prix' => $_POST["hidden-prix"]

                        );
         $_SESSION["my_nearby_shop"][$count] = $item_array;
      }
      else{
        echo '<script>alert("le produit est déja disliké") </script>';
        echo '<script>window.location="index.php" </script>';

      }

     
  }
  else
  {
    $item_array = array (
                          'item_id' => $_GET["id"],
                          'item_pnom' => $_POST["hidden-name"],  
                          'item_prix' => $_POST["hidden-prix"]

                        );
         $_SESSION["my_nearby_shop"][0] = $item_array;
    
   }
}
?>

  

  
</body>
</html>