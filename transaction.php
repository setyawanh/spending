<?php
	include_once("connect.php"); //include koneksi

	if(isset($_GET['edit'])){ // cek jika diurl ada parameter edit, jika ada ambil data dari tabel category sesuai id category
		$id=$_GET['edit'];
		$query=mysql_query("select * from category where id_category='$id'") or die(mysql_error());	
		$kolom=mysql_fetch_row($query);
		$name_cat=$kolom[1];
	}else{
		$name_cat='';
	}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Transaction</title>
</head>

<body>


<div id="col-add">
	<h2>Add Transaction</h2>
	<form method="post">
	Category
	<select name="category">
	<?php
		$query=mysql_query("select * from category order by category asc") or die(mysql_error());
		while ($row=mysql_fetch_row($query)) {
			echo "<option value=$row[0]>$row[1]</option>";
		}
	?>
	</select>
	Amount
	<input type="number" name="amount" value=<?=$name_cat?>>
	<input type="submit" value="submit" name="submit">
	</form>
</div>

<br>

<div id="list">
	<table border="1">
		<thead>
			<th>No</th>
			<th>Amount</th>
			<th>Timestamp</th>
			<th>Category</th>
		</thead>

<?php
// get data from table

$sql=mysql_query("select transaction.*,category.category from transaction,category where transaction.id_category=category.id_category order by transaction.timestamp desc") or die(mysql_error());
$no=1;
while($row=mysql_fetch_row($sql)){
	echo"
		<tr>
			<td>$no</td>
			<td>$row[1]</td>
			<td>$row[4]</td>
			<td>$row[5]</td>
		</tr>
	";	
	$no++;
}
?>
	</table>
</div>
</body>

</html> 

<?php
if(isset($_POST['submit'])){
	$category=$_POST['category'];
	$amount=$_POST['amount']; // ambil input nama kategori
	if(!isset($_GET['edit'])){ // jika di url tidak ada parameter edit
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
	}
}
?>