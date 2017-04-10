<?php
	include_once("connect.php"); //include koneksi

	if(isset($_GET['edit'])){ // cek jika diurl ada parameter edit, jika ada ambil data dari tabel category sesuai id category
		$id=$_GET['edit'];
		$query=mysql_query("select * from category where id_category='$id'") or die(mysql_erorr());	
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
<title>Category</title>
</head>

<body>


<div id="col-add">
	<h2>Add Category</h2>
	<form method="post">
	Category
	<input type="text" name="name" value=<?=$name_cat?>>
	<input type="submit" value="submit" name="submit">
	</form>
</div>

<br>

<div id="list">
	<table border="1">
		<thead>
			<th>No</th>
			<th>Category</th>
			<th>Action</th>
		</thead>

<?php
// get data from table

$sql=mysql_query("select * from category order by category asc") or die(mysql_erorr());
$no=1;
while($row=mysql_fetch_row($sql)){
	echo"
		<tr>
			<td>$no</td>
			<td>$row[1]</td>
			<td><a href='?edit=$row[0]'>Edit</a>
			<a href='?del=$row[0]'>Hapus</a></td>
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
// after user hit submit

if(isset($_POST['submit'])){
	$category=$_POST['name']; // ambil input nama kategori
	if(!isset($_GET['edit'])){ // jika di url tidak ada parameter edit
		$query=mysql_query("insert into category (category) values ('$category')") or die(mysql_erorr());
		if($query){
			header("Location: category.php");
			die();
		}
	}else{		// jika di url ada parameter edit
		$id=$_GET['edit'];
		$query=mysql_query("update category set category='$category' where id_category='$id'") or die(mysql_erorr());
		if($query){
			header("Location: category.php");
			die();
		}
	}
}

if(isset($_GET['del'])){ // cek jika diurl ada parameter del, jika ada hapus data dari tabel category sesuai id category
	$id=$_GET['del'];
	$query=mysql_query("delete from category where id_category='$id'") or die(mysql_erorr());	
	if($query){
		header("Location: category.php");
		die();
	}
}


?>