<?php
	session_start();
    header("X-XSS-Protection: 1; mode=block");
    require('config.php');
    include('header.php');
  ?>
  <!DOCTYPE html>
  <html>
  <head>
  	<title>Orders</title>
  	<style>
		body{
		  /*box-sizing: border-box;*/
		 /*background-image: url("showcase.jpg");*/
		  background-repeat: no-repeat;
		  /*color: none;*/
		}

		.container{
			 background-image: url("showcase.jpg");
			 /*margin-top: 10%;*/
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
		}

		#Prod th, #Prod td {
		  text-align: center;
		  padding: 12px;
		  /*background-color: #f8f9fa;*/
		}

		#Prod tr {
		  border-bottom: 1px solid #ddd;
		}
		.header{
			background-color: white;
		}
		#prod1{
			background-color: white;
			color: black;
		}
		.form-control{
			color: black;
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
		  form {
		  	float: right;
		  	border: 2px solid white ;
		  }
		  select{
		  	border: 1px solid black;
		  	background-color: white;
		  	font-size: 120%;
		  }
		  button{
		  	color: black;
		  	background-color: orange;
		  }
	</style>
  </head>
  <body>
  	<?php
  	$query = "SELECT * FROM `orders` ORDER by order_id";
  	$result = mysqli_query($conn,$query);
  	?>
  	<div class="container" align="center">
  		<!-- <form method="GET" action="sorted.php">
  			
  			<button class="form-control" type='submit' value="Sort by">Sort</button>
  		</form> -->
  		<!-- <input type="search" class="light-table-filter" data-table="order-table" placeholder="Filtrer" />
  
  
		  <select type="search" class="select-table-filter" data-table="order-table">
		    <option value="">Reset</option>  
		    <option value="Doe">Doe</option>  
		    <option value="Vanda">Vanda</option>  
		  </select> -->
		  <form method="GET" action="sort.php">
		  <select name="sor">
		  	<optgroup label="Address">
		  		<option>Mangalore</option>
		  		<option>Bengalore</option>
		  	</optgroup>
		  	<optgroup label="Mode Of Payment">
		  		<option>Online</option>
		  		<option>Cash On Delivery</option>
		  	</optgroup>
		  </select>
		<button type="submit" name="submit">Sort</button>
		</form>
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
	  			<input class="form-control" id="myInput" type="text" placeholder="Sort By">
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
	</div>
<!-- 	<script type="text/javascript">
		(function(document) {
	'use strict';

	var LightTableFilter = (function(Arr) {

		var _input;
    var _select;

		function _onInputEvent(e) {
			_input = e.target;
			var tables = document.getElementsByClassName(_input.getAttribute('data-table'));
			Arr.forEach.call(tables, function(table) {
				Arr.forEach.call(table.tBodies, function(tbody) {
					Arr.forEach.call(tbody.rows, _filter);
				});
			});
		}
    
		function _onSelectEvent(e) {
			_select = e.target;
			var tables = document.getElementsByClassName(_select.getAttribute('data-table'));
			Arr.forEach.call(tables, function(table) {
				Arr.forEach.call(table.tBodies, function(tbody) {
					Arr.forEach.call(tbody.rows, _filterSelect);
				});
			});
		}

		function _filter(row) {
      
			var text = row.textContent.toLowerCase(), val = _input.value.toLowerCase();
			row.style.display = text.indexOf(val) === -1 ? 'none' : 'table-row';

		}
    
		function _filterSelect(row) {
     
			var text_select = row.textContent.toLowerCase(), val_select = _select.options[_select.selectedIndex].value.toLowerCase();
			row.style.display = text_select.indexOf(val_select) === -1 ? 'none' : 'table-row';

		}

		return {
			init: function() {
				var inputs = document.getElementsByClassName('light-table-filter');
				var selects = document.getElementsByClassName('select-table-filter');
				Arr.forEach.call(inputs, function(input) {
					input.oninput = _onInputEvent;
				});
				Arr.forEach.call(selects, function(select) {
         select.onchange  = _onSelectEvent;
				});
			}
		};
	})(Array.prototype);

	document.addEventListener('readystatechange', function() {
		if (document.readyState === 'complete') {
			LightTableFilter.init();
		}
	});

})(document);
	</script>  -->
	  	<script>
			$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#Prod1 tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
		</script>
 	</body>
  </html>
