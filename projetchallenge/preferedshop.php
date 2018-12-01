<?php

session_start();
$connect= mysqli_connect("localhost","root","","product_details");

 if (isset($_POST["dislike"])) {
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
        echo '<script>window.location="index.php" </script>';}

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
<?php
 if(isset($_GET["action"])) {
    if($_GET["action"]=="delete"){
        foreach ($_SESSION["my_prefered_shop"] as $keys => $values) {
            if($values["item_id"] ==$_GET["id"]){
                unset($_SESSION["my_prefered_shop"][$keys]);
                   echo '<script>alert("Vous voulez supprimer le produit de la liste") </script>';
        echo '<script>window.location="index.php" </script>';
            }
            
        }
    }
 }

?>

<!DOCTYPE html>
<html>
<head>
	<title> My Prefered Shop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>
	<h2 style="font-size:6vw" "font-style: oblique";> <center> My prefered Shops </center> </h2>
	<div class="clear:both"></div>
     </br>
     <div class="table-responsive">
     	<table class="table table-bordred">
     		<tr>
     			<th width="40%">Nom de produit </th>
     			<th width="20%">Prix</th>
     			<th width="20%">Action</th>
     				
     			</th>
     		</tr>
     		<?php
     		   if (!empty($_SESSION["my_prefered_shop"])) {

     		      foreach ($_SESSION["my_prefered_shop"] as $keys => $values) 
     		      {
     		     ?>
             
            <tr>
            	<td><?php echo $values["item_pnom"]; ?></td>
            	<td><?php echo $values["item_prix"]; ?></td>
            	<td><a href="preferedshop.php?action=delete&id=<?php echo $values["item_id"]; ?>"><button type="submit" class="btn btn-danger">Supprimer</button></a></td>
            </tr>
            
     		    <?php  	
     		      }
     		   }
     		  ?>
     		
     	</table>
     	
     </div>



</body>
</html>