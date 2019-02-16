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
		  /*box-sizing: border-box;*/
		/* background-image: url("showcase.jpg");*/
		  background-repeat: no-repeat;
		}
		.container {
			border: 100px;
			background-image: url("showcase.jpg");
			background-color: white;
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
  	$query = "SELECT * FROM `status` ORDER by due_date";
  	$result = mysqli_query($conn,$query);
  	?>
  	<div class="container" align="center">
  		<input type="text" id="Input" name="search" placeholder="Search for products" onkeyup="myFunction()">
	  	<table class="Product-table" id="Prod">
	  		<thead>
	  		<tr class="header">
	  			<th>Order ID</th>
	  			<th>Due Date</th>
	  			<th>Product ID</th>
	  			<th>Order Date</th>
	  			<th>Agent ID</th>
	  			<th>Order Status</th>
	  		</thead>
	  		</tr>
	  		
	  		<?php while ($row = mysqli_fetch_assoc($result)) {
	  		?>
	  		<tr>
			  		<td><?php echo $row['order_id']; ?></td>
			  		<td><?php echo $row['due_date']; ?></td>
			  		<td><?php echo $row['prod_id']; ?></td>
			  		<td><?php echo $row['order_date']; ?></td>
			  		<td><?php echo $row['agent_id']; ?></td>
			  		<td><?php echo $row['order_status']; ?></td>
			  		
	  		</tr>
	  		<?php 
	  		}
	  		?>
	  	</tbody>
	  	</table>
	</div>
	  	<script>
			  
// function myFunction() {
//     var input, filter, table, tr, td, i;
//     input = document.getElementById("Input");
//     filter = input.value.toUpperCase();
//     table = document.getElementById("Prod");
//     tr = table.getElementsByTagName("tr");
//     for (i = 0; i < tr.length; i++) {
//         td = tr[i].getElementsByTagName("td")[0];
//         if(td) {
//         	if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
//             tr[i].style.display = "";
//         } else {
//             tr[i].style.display = "none";
//         }
//     }
// }

// }

		</script>
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