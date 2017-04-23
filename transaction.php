<?php
	include_once("api.php"); //include koneksi
	include_once("connect.php"); //include koneksi

	if(isset($_GET['m'])){

	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Transaction</title>
<link type="text/css" rel="stylesheet" href="css/materialize.min.css"  media="screen,projection"/>
<link href="css/icon.css" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
</head>

<body>
  <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">SPENDING</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="sass.html">Sass</a></li>
        <li><a href="badges.html">Components</a></li>
        <li><a href="collapsible.html">JavaScript</a></li>
      </ul>
    </div>
  </nav>

	<div class="container">
        <!-- Page Content goes here -->

		<!-- Modal Structure -->
		<div id="trxmodal" class="modal">
			<div class="modal-content">
			  <div class="row">
			    <form class="col s12" method="post">			      
			      <div class="row">
			        <div class="input-field col s12">
			          <select name="category">
			            <option value="" disabled selected>Choose your option</option>
						<?php
							$category=cat_disp('category','asc');
							print_r($category);
							foreach ($category as $row) {
								echo '<option value='.$row['id_category'].'>'.$row['category'].'</option>';
							}
						?>
					  </select>
			          <label for="last_name">Category</label>
			        </div>
			      </div>

			      <div class="row">
			        <div class="input-field col s12">
			          <input id="last_name" type="text" class="validate" name="amount">
			          <label for="last_name">Amount</label>
			        </div>
			      </div>

			      <div class="row">
			        <div class="col s12">
			          <button id="trx_submit" class="btn waves-effect waves-light right" type="submit" name="submit">Submit</button>
			        </div>
			      </div>
			      			
			    </form>
			  </div>
		    </div>
		</div>


		<!-- Card Styled Transaction-->
	    <div class="row">
		<?php
		if(isset($_GET['y']) && isset($_GET['m'])){
			$year=$_GET['y'];
			$month=$_GET['m'];
		}else{
			$year=date('Y');
			$month=date('n');
		}
		$trx_day=trx_show($year,$month);
		foreach ($trx_day as $day) {
			$date=date('d M y',strtotime($year.'-'.$month.'-'.$day['day']));
		?>
	      <div class="col s12 m6">
	        <div class="card blue-grey darken-1">	            
	          <div class="card-content white-text">
	            <span class="card-title orange-text accent-2"><?=$date;?></span>
				<?php
				$trx_daily=trx_show_day($year,$month,$day['day']);
				foreach ($trx_daily as $trx) {
					echo '
				      <div class="row">
				        <div class="col s6">'.$trx['category'].'</div>
				        <div class="col s6 red-text"><span class="right">'.$trx['amount'].'</span></div>
				      </div>
					';
				}
				?>
	          </div>

	          <div class="card-action red-text">
	        	<a></a><span class="right"><b><?=$day['sum']?></b></span>
	          </div>
	        </div>
	      </div>
	            
		<?php
		}
		?>
	    </div>


		<!-- FAB Modal Trigger -->
	    <div class="fixed-action-btn">
	    	<a class="btn-floating btn-large waves-effect waves-light red" href="#trxmodal"><i class="material-icons">add</i></a>
	    </div>
        
    </div>

	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
    	// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    		$('.modal').modal();
    		$('select').material_select();
  		});
	</script>
</body>

</html> 

<?php
if(isset($_POST['submit'])){
	echo 'a';
	$category=$_POST['category'];
	$amount=$_POST['amount']; // ambil input nama kategori
	if(!isset($_GET['edit'])){
		if(trx_insert($amount,$category)){
			header("Location: transaction.php");
			die();
		}
	}


/*	if(!isset($_GET['edit'])){ // jika di url tidak ada parameter edit
		$query=mysql_query("insert into transaction (amount,id_category) values ('$amount','$category')") or die(mysql_error());
		if($query){
			header("Location: transaction.php");
			die();
		}
	}else{		// jika di url ada parameter edit
		$id=$_GET['edit'];
		$query=mysql_query("update category set category='$category' where id_category='$id'") or die(mysql_error());
		if($query){
			header("Location: transaction.php");
			die();
		}
	}*/
}
?>