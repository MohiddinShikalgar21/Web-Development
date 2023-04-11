<!DOCTYPE html>

<head>
	<title>Electricity Bill Calculator</title>
    <style>
         @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@200;300;400;500;600&display=swap");
   *{
       font-family: 'Nunito', sans-serif;
       
    }
        body{
            background-color:#6abadeba;
        }
        .login{
          width: 382px;
          align-items:center;
          justify-content:center;
          overflow: hidden;
          margin: auto;
          margin-top:5%;
          margin: 10 0 0 450px;
          padding: 50px;
          background: #23463f;
          border-radius: 15px ;
        }
    button {
      width: 100%;
      background-color: #155e91;
      color: white;
      padding: 3%;
    } 
    button:hover {
      opacity: 0.6;
      cursor: pointer;
    }
    input{
      width: 100%;
      margin: 10px 0;
      border-radius: 5px;
      padding: 15px 18px;
      box-sizing: border-box;
  }
    </style>
</head>

<?php
$result_str = $result = '';
if (isset($_POST['unit-submit'])) {
    $units = $_POST['units'];
    if (!empty($units)) {
        $result = calculate_bill($units);
        if($units<=50) $result_str = 'Your Consumption in Units is applicable to cost of Rs.3.50 per unit. Hence Consumption of '.$units.'*3.50 results into your payable bill. So the Total Payable Amount of ' . $units . ' is Rs.' . $result;
        else if($units>50 && $units<=100) $result_str = 'Your Consumption in Units is applicable to cost of Rs.4 per unit. Hence Consumption of '.$units.'*4 results into your payable bill. So the Total Payable Amount of ' . $units . ' is Rs.' . $result;
        else if($units>100 && $units<200) $result_str = 'Your Consumption in Units is applicable to cost of Rs.5.20 per unit. Hence Consumption of '.$units.'*5.20 results into your payable bill. So the Total Payable Amount of ' . $units . ' is Rs.' . $result;
        else $result_str = 'Your Consumption in Units is applicable to cost of Rs.6.50 per unit. Hence Consumption of '.$units.'*6.50 results into your payable bill. So the Total Payable Amount of ' . $units . ' is Rs.' . $result;

    }
}
/**
 * To calculate electricity bill as per unit cost
 */
function calculate_bill($units) {
    $unit_cost_first = 3.50;
    $unit_cost_second = 4.00;
    $unit_cost_third = 5.20;
    $unit_cost_fourth = 6.50;

    if($units <= 50) {
        $bill = $units * $unit_cost_first;
    }
    else if($units > 50 && $units <= 100) {
        $temp = 50 * $unit_cost_first;
        $remaining_units = $units - 50;
        $bill = $temp + ($remaining_units * $unit_cost_second);
    }
    else if($units > 100 && $units <= 200) {
        $temp = (50 * 3.5) + (100 * $unit_cost_second);
        $remaining_units = $units - 150;
        $bill = $temp + ($remaining_units * $unit_cost_third);
    }
    else {
        $temp = (50 * 3.5) + (100 * $unit_cost_second) + (100 * $unit_cost_third);
        $remaining_units = $units - 250;
        $bill = $temp + ($remaining_units * $unit_cost_fourth);
    }
    return number_format((float)$bill, 2, '.', '');
}

?>

<body>
	<div id="page-wrap">
    <div class="login">
        <h2 style="color:white; margin-left:30px;font-size:26px;">Electricity Bill Calculator</h2>
		<form action="" method="post" id="quiz-form">
            	<input type="number" name="units" id="units" placeholder="Please Enter No. of Units Consumed" />
            	<button type="submit" name="unit-submit" id="unit-submit" value="Submit" >Submit</button>
		</form>
        <br><br>
        <?php echo '<span style="color:white; font-family: Nunito; font-size:16px;">'  . $result_str; ?>
        <br><br>
        <h3 style="fontfamily:sans-serif;">Total Amount in Rupees: <?php echo '<span style="color:white; font-family: sans-serif; font-size:18px;">'  . $result; ?></h3>
	    <div>
	</div>
	</div>
    </div>
</body>
</html>