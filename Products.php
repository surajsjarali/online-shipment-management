<?php
	session_start();
    header("X-XSS-Protection: 1; mode=block");
    require('config.php');
    include('header.php');
  ?>
  <!DOCTYPE html>
  <html>
  <head>
  	<title>Products</title>
  	<style>
		body{
		  /*box-sizing: border-box;*/
		  background-image: url("showcase.jpg");
		  background-repeat: no-repeat;
		}
		.container {
			border: 100px;
		}

		#Input {
		  background-image: url('/css/searchicon.png');
		  background-position: 10px 10px;
		  background-repeat: no-repeat;
		  width: 100%;
		  font-size: 16px;
		  padding: 12px 20px 12px 40px;
		  border: 1px solid #ddd;
		  margin-bottom: 12px;
		}

		#Prod {
		  border-collapse: collapse;
		  width: 100%;
		  border: 1px solid #ddd;
		  font-size: 18px;
		  background-color: white;
		}

		#Prod th, #Prod td {
		  text-align: center;
		  padding: 12px;
		  /*background-color: #f8f9fa;*/

		}

		#Prod tr {
		  border-bottom: 1px solid #ddd;

		}

		#Prod tr.header, #Prod tr:hover {
		  background-color: #f8f9fa;
		  box-sizing: border-box;

		  }
	</style>
  </head>
  <body>
  	<?php
  	$query = "SELECT * FROM `product` ORDER by prod_id";
  	$result = mysqli_query($conn,$query);
  	?>
  	<div class="container" align="center">
  		<input type="text" id="Input" name="search" placeholder="Search for products" onkeyup="myFunction()">
	  	<table class="Product-table" id="Prod">
	  		<tr class="header">
	  			<th>Product ID</th>
	  			<th>Product Name</th>
	  			<th>Product Price</th>
	  			<th>Product Rating</th>
	  			<th>Product Avialable</th>
	  			
	  		</tr>
	  		<?php while ($row = mysqli_fetch_assoc($result)) {
	  		?>
	  		<tr>
			  		<td><?php echo $row['prod_id']; ?></td>
			  		<td><?php echo $row['prod_name']; ?></td>
			  		<td><?php echo $row['prod_price']; ?></td>
			  		<td><?php echo $row['prod_rating']; ?></td>
			  		<td><?php echo $row['prod_avl']; ?></td>
			  		
	  		</tr>
	  		<?php 
	  		}
	  		?>
	  	</table>
	</div>
	<script>
			$(document).ready(function(){
  $("#Input").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#Prod tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
		</script>
		</script>
 	</body>
  </html>