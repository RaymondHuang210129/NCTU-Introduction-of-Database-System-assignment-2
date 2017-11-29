<?php
	session_start();

	$dbservername = 'dbhome.cs.nctu.edu.tw';
	$dbname='tsejui210129_cs_DB_HW1';
	$dbaccount='tsejui210129_cs';
	$dbpassword='ltes123456';
	
	$identity = $_SESSION['Identity'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>house manage</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<link type="text/css" rel="stylesheet" href="house.css">
</head>
<body>
	<div class="board">
		<h2>我的房屋</h2>
		<br>
		<table align="right">
			<tr>
				<td>
					<input type="button" value="首頁" onclick="location.href='http://people.cs.nctu.edu.tw/~tsejui210129/admin.php'">
				</td>
				<td>
					<input type="button" value="登出" onclick="location.href='http://people.cs.nctu.edu.tw/~tsejui210129/logout.php'">
				</td>
			</tr>
		</table>
		<br>
		<h4>房屋列表</h4>
		<br>
		<table align="left">	
			<tr>
				<td>
					<input type="button" value="新增" onclick="location.href='http://people.cs.nctu.edu.tw/~tsejui210129/new_house.php'">
				</td>
			</tr>
		</table>
		<br>
		<div class="container2">
			<table>
				<tr>
					<th>編號</th>
					<th>房屋名稱</th>
					<th>房屋價格</th>
					<th>地點</th>
					<th>時間</th>
					<th>擁有者</th>
					<th>其他資訊</th>
				</tr>
				<tr>
				</tr>
				<?php
					try
					{
						$connect = new PDO("mysql:host=".$dbservername.";dbname=".$dbname, $dbaccount, $dbpassword);
						$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
						$stmt=$connect->prepare("Select House.id, House.name, House.price, House.location, House.time, Account.name AS user FROM House, Account WHERE House.owner_id = Account.id AND House.owner_id = :owner_id");
						$stmt->execute(array('owner_id' => $_SESSION['id']));
						if($stmt->rowCount() == 0)
						{
							echo "您尚未擁有任何房子";
						}
						else
						{
							$rows = $stmt->fetchAll();
							foreach ($rows as $row)
							{
								$stmt=$connect->prepare("SELECT information FROM Information WHERE house_id = :house_id");
								$stmt->execute(array('house_id' => $row['id']));
								$infoHTML = "<table>";
								while($info = $stmt->fetch())
								{
									$infoHTML = $infoHTML."<tr><td>".$info[0]."</td></tr>"; 
								}
								$infoHTML = $infoHTML."</table>";
								$rowId = $row['id'];
								echo "<tr><td valign='top'>".$row['id']."</td><td valign='top'>".$row['name']."</td><td valign='top'>".$row['price']."</td><td valign='top'>".$row['location']."</td><td valign='top'>".$row['time']."</td><td valign='top'>".$row['user']."</td><td valign='top'>".$infoHTML."</td><td valign='top'><form></form><form action='modify_house.php' method='post'><button type='submit' name='delete' value='$rowId'>刪除</button></form></td><td valign='top'><form action='modify_house.php' method='post'><button type='submit' name='edit' value='$rowId'>編輯</button></form></td></tr>";
							}
						}
					}
					catch(PDOException $e)
					{
						$msg = $e->getMessage();
						echo $msg;
						session_unset();
						session_destroy();
						echo <<<"EOT"
							<!DOCTYPE html>
							<html>
								<script>
									alert("Internel Error.");
									window.location.replace("index2.php");
								</script>
							</html>
EOT;
					}
				?>
			<table>
		</div>
	</div>
</body>
</html>