<html>
<head>
<title>Spending</title>
<link rel="stylesheet" href="css/materialize.min.css">
</head>
<body>

<!--Navigation Bar-->

 <nav>
    <div class="nav-wrapper">
      <a href="#" class="brand-logo">Logo Spending</a>
      <ul id="nav-mobile" class="right hide-on-med-and-down">
        <li><a href="sass.html">Spending1</a></li>
        <li><a href="badges.html">Spending2</a></li>
        <li><a href="collapsible.html">Log Out</a></li>
      </ul>
    </div>
  </nav>
  
<!--Body-->
  
  <div class="container">
	<div class="row">
		<div class="col s12 m8 l8">
			<div>
				<h5>Your Visualization</h5>
			</div>
			
			<div class="col s12">
			  <div class="card blue-grey darken-1">
				<div class="card-content white-text">
				  <span class="card-title">Visualization</span>
				  <p>Visualisasi data sebulan terakhir.</p>
				</div>
			  </div>
			</div>
		</div>
		
		<div class ="col s12 m4 l4">
			<div>
				<h5>Category Visualization</h5>
			</div>
			
			<div class="col s12">
			  <div class="card blue-grey darken-1">
				<div class="card-content white-text">
				  <span class="card-title">Visualization</span>
				  <p>Visualisasi data tag</p>
				</div>
			  </div>
			</div>
			
			<div class="col s12">
			  <div class="card blue-grey darken-1">
				<div class="card-content white-text">
				  <span class="card-title">Visualization</span>
				  <p>Visualisasi data tag</p>
				</div>
			  </div>
			</div>	
		</div>
      </div>
  </div>
  
  <div class="fixed-action-btn">
    <a class="btn-floating btn-large red" href="#trxmodal">
      <i class="large material-icons">+</i>
    </a>
  </div>
  
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
		</div>'
		
	<script type="text/javascript" src="js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="js/materialize.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
    	// the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    		$('#trxmodal').modal();
    		$('select').material_select();
  		});
	</script>
</body>
</html>