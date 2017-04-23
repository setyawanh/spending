<?php
function connect(){
	$conn = new mysqli('localhost', 'root', '', 'spending_db');
	if($conn->connect_errno > 0){
	    die('Unable to connect to database [' . $conn->connect_error . ']');
	}
	return $conn;
}

//execute select query without parameter
function exec_query($sql){
	$db = connect();
	$exec=$db->prepare($sql);
	if($exec->execute()){
		$rs=$exec->get_result();
		$array = $rs->fetch_all(MYSQLI_ASSOC);
	}else{
		$array=array();
	}
	$db->close();
	return $array;
}

function cat_disp($field='id_category',$sort='asc'){
	$sql="SELECT * from category order by $field $sort";
	$array=exec_query($sql);
	return $array;
}

function trx_insert($amount,$id_category){
	$db = connect();
	$sql="INSERT into transaction(amount,id_category) VALUES(?,?)";
	$exec=$db->prepare($sql);
	$exec->bind_param(ii,$amount,$id_category);
	if($exec->execute()){
		$result=true;
	}else{
		$result=false;
	}
	$db->close();
	return $result;
}

function trx_delete($id){
	$db = connect();
	$sql="DELETE transaction WHERE id_trx=?";
	$exec=$db->prepare($sql);
	$exec->bind_param(i,$id);
	if($exec->execute()){
		$result=true;
	}else{
		$result=false;
	}
	$db->close();
	return $result;
}

//show transcation monthly, group by date
function trx_show_day($year,$month,$day){	
	$sql="SELECT t.*,c.category from transaction as t, category as c
	WHERE YEAR(t.timestamp)='$year' AND MONTH(t.timestamp)='$month' AND DAY(t.timestamp)='$day' AND t.id_category=c.id_category
	ORDER BY t.timestamp asc";	
	return exec_query($sql);
}

//show transcation monthly, group by date
function trx_show($year,$month){
	$sql="SELECT DAY(timestamp) AS day,SUM(amount) AS sum FROM transaction 
	WHERE YEAR(timestamp)='2017' AND MONTH(timestamp)='4' 
	GROUP BY DAY(timestamp) ORDER BY timestamp ASC";
	return exec_query($sql);
}

?>