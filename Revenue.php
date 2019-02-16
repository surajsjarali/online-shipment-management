<?php
	  session_start();
    header("X-XSS-Protection: 1; mode=block");
    require('config.php');
    include('header.php');
    //total orders
    $query = "select count(*) from orders where 1";
    $result = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($result);
    $r = implode("",$row);
    //orders_delieverd
    $query1 = "select count(*) from agents where order_status = 'shipped'";
    $result1 = mysqli_query($conn,$query1);
    $row1 = mysqli_fetch_assoc($result1);
    $r1 = implode("",$row1);
    //echo $r1;
    //orders remaining
    $query2 = "select count(*) from agents where order_status != 'shipped'";
    $result2 = mysqli_query($conn,$query2);
    $row2 = mysqli_fetch_assoc($result2);
    //echo $row2['agent_id'];
    $r2 = implode("",$row2);
    //echo $r2;
    //total amount recieved
    $query3 = "select sum(prod_price) from orders ord ,product prd where ord.prod_id=prd.prod_id and ord.mop = 'cash'";
    $result3 = mysqli_query($conn,$query3);
    $row3 = mysqli_fetch_assoc($result3);
    $r3 = implode("",$row3);
    //echo $r3;
    //total amount remaining
    $query4 = "select sum(prod_price) from orders ord ,product prd where ord.prod_id=prd.prod_id and ord.mop != 'cash'";
    $result4 = mysqli_query($conn,$query4);
    $row4 = mysqli_fetch_assoc($result4);
    $r4 = implode("",$row4);
    echo $r4;
    $query4 = "insert into revenue(total_orders,orders_delved,orders_remn,amount_cash,amount_online) values('$r','$r1','$r2','$r3','$r4')";
    $result4 = mysqli_query($conn,$query4);
    
    $query5 = "select * from revenue";
    $result5 = mysqli_query($conn,$query5);
    $row5 = mysqli_fetch_assoc($result5);
  ?>
  <!DOCTYPE html>
  <html>
  <head>
  	<title>Products</title>
  </head>
  <body>
  	<div class="container" align="center">
  		
	  	<table class="Product-table" id="Prod">
	  		<tr class="header">
	  			<th>Total Orders Recieved</th>
	  			<th>Orders Delievered</th>
	  			<th>Orders Remaining</th>
	  			<th>Orders Through Cash</th>
	  			<th>Orders Through Online</th>
	  			
	  		</tr>
	  		<tbody id="Prod1">
	  			<input type="text" id="myInput" name="search" class="form-control" placeholder="Search for products" onkeyup="myFunction()">
    	  		<tr>
    			  	<td><?php echo $row['total_orders']; ?></td> 
    			  	<td><?php echo $row1['orders_delved']; ?></td>
    			  	<td><?php echo $row3['orders_remn']; ?></td>
    			  	<td><?php echo $row4['amount_cash']; ?></td>
    			  	<td><?php echo $row5['amount_online']; ?></td>
    			  		
    	  		</tr>
	  	    </tbody>
	  	</table>
	</div>
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