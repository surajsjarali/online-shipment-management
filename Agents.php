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
		* {
		  box-sizing: border-box;
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
		}

		#Prod tr {
		  border-bottom: 1px solid #ddd;
		}

		#Prod tr.header, #Prod tr:hover {
		  background-color: #f8f9fa;
		  /*box-sizing: border-box;*/
		  }
		  #Input {
		  	border-bottom: 1px solid #ddd;
		  	/*border-width: 20px;*/
		  	width: 100%;
		  }
	</style>
  </head>
  <body>
  	<?php
  	$query = "SELECT * FROM `agents` ORDER by order_id";
  	$result = mysqli_query($conn,$query);
  	?>
  	<div class="container" align="center">
  		<input type="text" id="Input" name="search" placeholder="Search for products" onkeyup="myFunction()">
	  	<table class="Product-table" id="Prod">
	  		<tr class="header">
	  			<th>Agent Name</th>
	  			<th>Agent id</th>
	  			<th>Agent Location</th>
	  			<th>Order ID</th>
	  			<th>Product ID</th>
	  			<th>Delivery Address</th>
	  			<th>Order Status</th>
	  			
	  		</tr>
	  		<?php while ($row = mysqli_fetch_assoc($result)) {
	  		?>
	  		<tr>
			  		<td><?php echo $row['agent_name']; ?></td>
			  		<td><?php echo $row['agent_id']; ?></td>
			  		<td><?php echo $row['agent_loc']; ?></td>
			  		<td><?php echo $row['order_id']; ?></td>
			  		<td><?php echo $row['prod_id']; ?></td>
			  		<td><?php echo $row['recv_add']; ?></td>
			  		<td><?php echo $row['order_status']; ?></td>
			  		
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
 	</body>
  </html>