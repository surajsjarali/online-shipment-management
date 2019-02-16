<?php
include('header.php');
include('config.php');
if($_SERVER["REQUEST_METHOD"] == "GET") {
        $sort = mysqli_real_escape_string($conn,$_GET['sor']);     
        // $query = "select * from orders where mop='$sort' xor recv_add='$sort'";
        $query = "select * from orders where mop='$sort' xor recv_add='$sort'";
        $result = mysqli_query($conn,$query);
        
        $_SESSION['qr'] = $sort;
    }
?>
<!DOCTYPE html>
<html>
<head>
	<title></title>
	 <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  

	<style>
		* {
		  /*box-sizing: border-box;*/
		   /*background-image: url("showcase.jpg");*/
		  background-repeat: no-repeat;
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
		  background-color: #f1f1f1;
		}
		 #Input {
		  	border-bottom: 1px solid #ddd;
		  	border-width: 20px;
		  	width: 50%;
		  }
		  #address {
		  	display: none;
		  	border-bottom: 1px solid #ddd;
		  	border-width: 20px;
		  	width: 50%;
		  }
		  #mop {
		  	display: none;
		  	border-bottom: 1px solid #ddd;
		  	border-width: 20px;
		  	width: 50%;
		  }
		  a {
		  	display: none;
		  }
	</style>
</head>
<body>
<div class="container" align="center">
	<table class="table table-bordered table-striped" id="Prod">
	  		<thead>
	  		<tr class="header">
	  			<th>Reciever Name</th>
	  			<th>Order ID</th>
	  			<th>Reciever Address</th>
	  			<th>Product ID</th>
	  			<th>Order Date</th>
	  			<th>Payment Method</th>	  			
	  		</tr>
	  		</thead>
	  		<tbody id="Prod1">
	  		<?php while ($row = mysqli_fetch_assoc($result)) {
	  		?>
	  		<tr>
	  				<td><?php echo $row['recv_name']; ?></td>
		  			<td><?php echo $row['order_id']; ?></td>
		  			<td><?php echo $row['recv_add']; ?></td>
		  			<td><?php echo $row['prod_id']; ?></td>
		  			<td><?php echo $row['order_date']; ?></td>
		  			<td><?php echo $row['mop']; ?></td>
		  			
	  		</tr>
	  		<?php 
	  		}
	  		?>
	  	</tbody>
	  	</table>
	  <!-- <form method="GET" action="excel.php">
	  	<button name="create_excel" id="create_excel" class="btn btn-success" >Generate Excel sheet</button>
</form> -->
	<button onclick="myFunction()" class="btn btn-success">Print </button>

	  </div>
</body>
</html>
<script>

function myFunction() {
    window.print();
}




	$(document).ready(function(){
		$('#create_excel').click(function(){
			var excel_data = $('#sort').html();
			var page = "excel.php?data=" + excel_data;
			window.location = page; 
		});
	});
</script>
