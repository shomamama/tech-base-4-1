        <p><input type="submit" value="削除"></p>
  </form>
  <form action="mission_4-1.php" method="post">
  	<p>編集対象番号:<br>
  	<input type="text" name="edit" placeholder="編集対象番号"></p>
	<p>パスワード:<br>
	<input type="text" name="pass3" placeholder="パスワード"></p>
  	<p><input type="submit" value="編集"></p>
  </form>

  </body>

  <?php
	
$dsn='mysql:jii;host=localhost';
//Data Source Name
$user='gooo';
$password='kok';
$pdo=new PDO($dsn,$user,$password,array(PDO::ATTR_ERRMODE=>PDO::ERRMODE_WARNING));

//設定


   	
  if(!empty($_POST['ednumber'])){
   	$id = $_POST['ednumber'];
   	$name = $_POST['name'];
   	$comment = $_POST['comment'];
   	$time = date('Y/m/d H:i:s');
   	$sql = 'update MISSION_4 set 
   		name=:name,comment=:comment,time=:time where id=:id';
   		$stmt = $pdo -> prepare($sql);
   		$stmt -> bindParam(':name',$name,PDO::PARAM_STR);
   		$stmt -> bindParam(':comment',$comment,PDO::PARAM_STR);
   		$stmt -> bindParam(':time',$time,PDO::PARAM_STR);
   		$stmt -> bindParam(':id',$id,PDO::PARAM_INT);
   		$stmt -> execute();
  }elseif(!empty($_POST['name']) && !empty($_POST['comment']) && !empty($_POST['password'])){

 	  $sql=$pdo -> prepare("INSERT INTO MISSION_4(name,comment,time,password) 
 	  VALUES(:name,:comment,:time,:password)");

 	  $sql -> bindParam(':name',$name,PDO::PARAM_STR);
 	  $sql -> bindParam(':comment',$comment,PDO::PARAM_STR);
 	  $sql -> bindParam(':time',$time,PDO::PARAM_STR);
 	  $sql -> bindParam(':password',$password,PDO::PARAM_STR);
 	  $name = $_POST['name'];
 	  $comment = $_POST['comment'];
 	  $time = date('Y/m/d H:i:s');
 	  $password = $_POST['password'];
 	  $sql -> execute();}

 	if (!empty($_POST['suuji']) && !empty($_POST['pass2'])){
 		
 		$sql='SELECT*FROM MISSION_4';
 		$stmt=$pdo -> query($sql);
 		foreach ($stmt as $value) {
 			if ($_POST['pass2'] == $value[password]){
 				$id = $_POST['suuji'];
 				$sql = 'delete from MISSION_4-1 where id=:id';
 				$stmt = $pdo -> prepare($sql);
 				$stmt -> bindParam(':id',$id,PDO::PARAM_INT);
 				$stmt -> execute();
	}
 	}
 	}


    $sql2='SELECT*FROM MISSION_4';
    $stm = $pdo -> query($sql2);
    $results=$stm -> fetchAll();

 	foreach($results as $row){
 		echo $row['id'].',';
 		echo $row['name'].',';
 		echo $row['comment'].',';
 		echo $row['time'].',';
 		echo $row['password'].'<br>';
 	}  
?>

</html>