<?php
	session_start();

	$dbservername = 'dbhome.cs.nctu.edu.tw';
	$dbname='tsejui210129_cs_DB_HW1';
	$dbaccount='tsejui210129_cs';
	$dbpassword='ltes123456';
	if(isset($_POST['search']) && $_POST['search'] != "")
	{
		$_SESSION['Search'] = $_POST['search'];
		$_SESSION['Sort'] = "";
	}
	else
	{
		$_SESSION['Search'] = "";	
	}
	if(isset($_POST['sort']) && $_POST['sort'] != "")
	{
		$_SESSION['Sort'] = $_POST['sort'];
		$_SESSION['Search'] = "";
	}
	else
	{
		$_SESSION['Sort'] = "";
	}
	if(isset($_POST['information0']) && $_POST['information0'] != "")
	{
		$_SESSION['Information0'] = $_POST['information0'];
		$check[0] = "checked='checked'";
	}
	else
	{
		$_SESSION['Information0'] = "";
		$check[0] = "";
	}
	if(isset($_POST['information1']) && $_POST['information1'] != "")
	{
		$_SESSION['Information1'] = $_POST['information1'];
		$check[1] = "checked='checked'";
	}
	else
	{
		$_SESSION['Information1'] = "";
		$check[1] = "";
	}
	if(isset($_POST['information2']) && $_POST['information2'] != "")
	{
		$_SESSION['Information2'] = $_POST['information2'];
		$check[2] = "checked='checked'";
	}
	else
	{
		$_SESSION['Information2'] = "";
		$check[2] = "";
	}
	if(isset($_POST['information3']) && $_POST['information3'] != "")
	{
		$_SESSION['Information3'] = $_POST['information3'];
		$check[3] = "checked='checked'";
	}
	else
	{
		$_SESSION['Information3'] = "";
		$check[3] = "";
	}
	if(isset($_POST['information4']) && $_POST['information4'] != "")
	{
		$_SESSION['Information4'] = $_POST['information4'];
		$check[4] = "checked='checked'";
	}
	else
	{
		$_SESSION['Information4'] = "";
		$check[4] = "";
	}
	if(isset($_POST['information5']) && $_POST['information5'] != "")
	{
		$_SESSION['Information5'] = $_POST['information5'];
		$check[5] = "checked='checked'";
	}
	else
	{
		$_SESSION['Information5'] = "";
		$check[5] = "";
	}
	if(isset($_POST['information6']) && $_POST['information6'] != "")
	{
		$_SESSION['Information6'] = $_POST['information6'];
		$check[6] = "checked='checked'";
	}
	else
	{
		$_SESSION['Information6'] = "";
		$check[6] = "";
	}
	if(isset($_POST['information7']) && $_POST['information7'] != "")
	{
		$_SESSION['Information7'] = $_POST['information7'];
		$check[7] = "checked='checked'";
	}
	else
	{
		$_SESSION['Information7'] = "";
		$check[7] = "";
	}
	if(isset($_POST['information8']) && $_POST['information8'] != "")
	{
		$_SESSION['Information8'] = $_POST['information8'];
		$check[8] = "checked='checked'";
	}
	else
	{
		$_SESSION['Information8'] = "";
		$check[8] = "";
	}
	if(isset($_POST['information9']) && $_POST['information9'] != "")
	{
		$_SESSION['Information9'] = $_POST['information9'];
		$check[9] = "checked='checked'";
	}
	else
	{
		$_SESSION['Information9'] = "";
		$check[9] = "";
	}
	if(isset($_POST['interval']) && $_POST['interval'] != "interval")
	{
		$_SESSION['Interval'] = $_POST['interval'];
		if($_SESSION['Interval'] == "1200~")
		{
			$select[1] = "selected='selected'";
			$select[0] = $select[2] = $select[3] = $select[4] = "";
		}
		elseif($_SESSION['Interval'] == "600~1200")
		{
			$select[2] = "selected='selected'";
			$select[1] = $select[0] = $select[3] = $select[4] = "";
		}
		elseif($_SESSION['Interval'] == "300~600")
		{
			$select[3] = "selected='selected'";
			$select[1] = $select[2] = $select[0] = $select[4] = "";
		}
		else
		{
			$select[4] = "selected='selected'";
			$select[1] = $select[2] = $select[3] = $select[0] = "";
		}
	}
	else
	{
		$_SESSION['Interval'] = "interval";
		$select[0] = "selected='selected'";
		$select[1] = $select[2] = $select[3] = $select[4] = "";
	}
	if(isset($_POST['id_keyword']) && $_POST['id_keyword'] != "")
	{
		$_SESSION['InputId'] = $_POST['id_keyword'];
	}
	else
	{
		$_SESSION['InputId'] = "";
	}
	if(isset($_POST['name_keyword']) && $_POST['name_keyword'] != "")
	{
		$_SESSION['InputName'] = $_POST['name_keyword'];
	}
	else
	{
		$_SESSION['InputName'] = "";
	}
	if(isset($_POST['location_keyword']) && $_POST['location_keyword'] != "")
	{
		$_SESSION['InputLocation'] = $_POST['location_keyword'];
	}
	else
	{
		$_SESSION['InputLocation'] = "";
	}
	if(isset($_POST['time_keyword']) && $_POST['time_keyword'] != "")
	{
		$_SESSION['InputTime'] = $_POST['time_keyword'];
	}
	else
	{
		$_SESSION['InputTime'] = "";
	}
	if(isset($_POST['owner_keyword']) && $_POST['owner_keyword'] != "")
	{
		$_SESSION['InputOwner'] = $_POST['owner_keyword'];
	}
	else
	{
		$_SESSION['InputOwner'] = "";
	}
	if($_SESSION['Identity'] == "admin")
	{
		$gray_button = "";
	}
	else
	{
		$gray_button = " disabled='disabled'";
	}
	$information0 = $_SESSION['Information0'];
	$information1 = $_SESSION['Information1'];
	$information2 = $_SESSION['Information2'];
	$information3 = $_SESSION['Information3'];
	$information4 = $_SESSION['Information4'];
	$information5 = $_SESSION['Information5'];
	$information6 = $_SESSION['Information6'];
	$information7 = $_SESSION['Information7'];
	$information8 = $_SESSION['Information8'];
	$information9 = $_SESSION['Information9'];
	$inputInterval = $_SESSION['Interval'];
	$inputId = $_SESSION['InputId'];
	$inputName = $_SESSION['InputName'];
	$inputLocation = $_SESSION['InputLocation'];
	$inputTime = $_SESSION['InputTime'];
	$inputOwner = $_SESSION['InputOwner'];
	if(isset($_SESSION['Authenticated']) and $_SESSION['Authenticated'] == true and isset($_SESSION['Account']))
	{
		$account = $_SESSION['Account'];
	}
	else
	{
		session_unset();
		session_destroy();
 		echo <<<"EOT"
 			<!DOCTYPE>
 			<html>
 				<script>
 					alert("Redirect to the login page.");
 					window.location.replace("index.php");
 				</script>
 			</html>
EOT;
	}
?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administrator Interface</title>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
		<link type="text/css" rel="stylesheet" href="admin.css">
	</head>
	<body>
		<div class="board">
			<h2>房屋首頁(<?php echo $_SESSION['Identity']; ?>)</h2>使用者名稱：<?php echo $_SESSION['Name'] ?>
			<br>
			<table align="right">
				<tr>
					<td>
						<input type="button" value="房屋管理" onclick="location.href='http://people.cs.nctu.edu.tw/~tsejui210129/house_manage.php'">
					</td>
					<td>
						<input type="button" value="我的最愛" onclick="location.href='http://people.cs.nctu.edu.tw/~tsejui210129/favorite.php'">
					</td>
					<td>
						<input type="button" value="會員管理"<?php echo $gray_button; ?> onclick="location.href='http://people.cs.nctu.edu.tw/~tsejui210129/member_manage.php'">
					</td>
					<td>
						<input type="button" value="登出" onclick="location.href='http://people.cs.nctu.edu.tw/~tsejui210129/logout.php'">
					</td>
				</tr>
			</table>
			<br>
			<h4>房屋列表</h4>
			<table>
				<tr>
					<form action="admin.php" method="post">
						<table>
							<tr>
								<td>
									<input type="text" name="id_keyword" placeholder="id" size="3" value="<?php echo $inputId; ?>">
								</td>
								<td>
									<input type="text" name="name_keyword" placeholder="name" value="<?php echo $inputName; ?>" size="10">
								</td>
								<td>
									<table>
										<tr>　</tr>
										<tr>
											<td>
												<select name="interval">
													<option <?php echo $select[0] ?> value="interval">interval</option>
													<option <?php echo $select[1] ?> value="1200~">1200~</option>
													<option <?php echo $select[2] ?> value="600~1200">600~1200</option>
													<option <?php echo $select[3] ?> value="300~600">300~600</option>
													<option <?php echo $select[4] ?> value="0~300">0~300</option>
												</select>
											</td>
										</tr>
										<tr>
											<td>
												<button type="submit" name="sort" value="price_sort_high">▼</button>
												<button type="submit" name="sort" value="price_sort_low">▲</button>
											</td>
										</tr>
									</table>
								</td>
								<td>
									<input type="text" name="location_keyword" placeholder="location" value="<?php echo $inputLocation; ?>" size="10">
								</td>
								<td>
									<table>
										<tr>　</tr>
										<tr>
											<td>
												<input type="date" name="time_keyword" placeholder="time" value="<?php echo $inputTime; ?>" size="10">
											</td>
										<tr>
										</tr>
											<td>
												<button type="submit" name="sort" value="date_sort_new">▼</button>
											
												<input type="reset" value="重設">
											
												<button type="submit" name="sort" value="date_sort_old">▲</button>
											</td>					
										</tr>
									</table>
								</td>
								<td>
									<input type="text" name="owner_keyword" placeholder="owner" value="<?php echo $inputOwner; ?>" size="10">
								</td>
								<td width="100">
									<div class="container">
										<table width="200">
											<tr>
												<input type="checkbox" <?php echo $check[0] ?> name="information0" value="laundry_facilities"> Laundry Facilities<br>
											</tr>
											<tr>
												<input type="checkbox" <?php echo $check[1] ?> name="information1" value="wifi"> Wifi<br>
											</tr>
											<tr>
												<input type="checkbox" <?php echo $check[2] ?> name="information2" value="lockers"> Lockers<br>
											</tr>
											<tr>
												<input type="checkbox" <?php echo $check[3] ?> name="information3" value="kitchen"> Kitchen<br>
											</tr>
											<tr>
												<input type="checkbox" <?php echo $check[4] ?> name="information4" value="elevator"> Elevator<br>
											</tr>
											<tr>
												<input type="checkbox" <?php echo $check[5] ?> name="information5" value="no_smoking"> No Smoking<br>
											</tr>
											<tr>
												<input type="checkbox" <?php echo $check[6] ?> name="information6" value="television"> Television<br>
											</tr>
											<tr>
												<input type="checkbox" <?php echo $check[7] ?> name="information7" value="breakfast"> Breakfast<br>
											</tr>
											<tr>
												<input type="checkbox" <?php echo $check[8] ?> name="information8" value="toiletries_provided"> Toiletries Provided<br>
											</tr>
											<tr>
												<input type="checkbox" <?php echo $check[9] ?> name="information9" value="shuttle_service"> Shuttle Service<br>
											</tr>
										</table>
									</div>
								</td>
								<td>
									<table>
										<tr>
											<button type="submit" name="search" value="search">搜尋</button>
										</tr>
									</table>
								</td>
							</tr>
						</table>
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
										$owner_id = 0;
										$connect = new PDO("mysql:host=".$dbservername.";dbname=".$dbname, $dbaccount, $dbpassword);
										$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
										$searchCommand = "Select House.id, House.name, House.price, House.location, House.time, Account.name AS user FROM House, Account WHERE House.owner_id = Account.id";
										if($inputId != "")
										{
											$searchCommand = $searchCommand." AND House.id = :id";
											$idtag = 0;
										}
										if($inputName != "")
										{
											$searchCommand = $searchCommand." AND House.name LIKE '%".$inputName."%'";
											$nametag = 0;
										}
										if($inputLocation != "")
										{
											$searchCommand = $searchCommand." AND location LIKE '%".$inputLocation."%'";
											$locationtag = 0;
										}
										if($inputTime != "")
										{
											$searchCommand = $searchCommand." AND time = :time";
											$timetag = 0;
										}
										if($inputOwner != "")
										{
											$searchCommand = $searchCommand." AND owner_id = :owner_id";
											$stmt=$connect->prepare("SELECT * FROM Account WHERE name = :name");
											$stmt->execute(array('name' => $inputOwner));
											if($stmt->rowCount() == 1)
											{
												$row = $stmt->fetch();
												$owner_id = $row[0];
											}
											else
											{
												$owner_id = 0;
											}
											$ownertag = 0;
										}
										if($inputInterval != "interval")
										{
											if($inputInterval == "1200~")
											{
												$searchCommand = $searchCommand." AND price >= 1200";
											}
											elseif ($inputInterval == "600~1200") 
											{
												$searchCommand = $searchCommand." AND price >= 600 AND price < 1200";
											}
											elseif ($inputInterval == "300~600")
											{
												$searchCommand = $searchCommand." AND price >= 300 AND price < 600";
											}
											elseif ($inputInterval == "0~300")
											{
												$searchCommand = $searchCommand." AND price < 300";
											}
										}
										$infoCommand = "SELECT information FROM Information WHERE house_id = :house_id AND ( 0";
										if($information0 != "" || $information1 != "" || $information2 != "" || $information3 != "" || $information4 != "" || $information5 != "" || $information6 != "" || $information7 != "" || $information8 != "" || $information9 != "")
										{
											if($information0 != "")
											{
												$infoCommand = $infoCommand." OR information = 'laundry facilities'";
											}
											if($information1 != "")
											{
												$infoCommand = $infoCommand." OR information = 'wifi'";
											}
											if($information2 != "")
											{
												$infoCommand = $infoCommand." OR information = 'lockers'";	
											}
											if($information3 != "")
											{
												$infoCommand = $infoCommand." OR information = 'kitchen'";
											}
											if($information4 != "")
											{
												$infoCommand = $infoCommand." OR information = 'elevator'";	
											}
											if($information5 != "")
											{
												$infoCommand = $infoCommand." OR information = 'no smoking'";
											}
											if($information6 != "")
											{
												$infoCommand = $infoCommand." OR information = 'television'";
											}
											if($information7 != "")
											{
												$infoCommand = $infoCommand." OR information = 'breakfast'";
											}
											if($information8 != "")
											{
												$infoCommand = $infoCommand." OR information = 'toiletries provided'";
											}
											if($information9 != "")
											{
												$infoCommand = $infoCommand." OR information = 'shuttle service'";
											}
											$infoCommand = $infoCommand.")";
										}
										if($_SESSION['Sort'] != "")
										{
											if($_SESSION['Sort'] == "date_sort_new")
											{
												$searchCommand = $searchCommand." ORDER BY time DESC";
											}
											elseif($_SESSION['Sort'] == "date_sort_old")
											{
												$searchCommand = $searchCommand." ORDER BY time ASC";
											}
											elseif($_SESSION['Sort'] == "price_sort_high")
											{
												$searchCommand = $searchCommand." ORDER BY price DESC";
											}
											elseif($_SESSION['Sort'] == "price_sort_low")
											{
												$searchCommand = $searchCommand." ORDER BY price ASC";
											}
										}
										///////////////
										$stmt=$connect->prepare($searchCommand);
										if(isset($idtag))
										{
											$stmt->bindparam(":id", $inputId);
										}
										if(isset($timetag))
										{
											$stmt->bindparam(":time", $inputTime);
										}
										if(isset($ownertag))
										{
											$stmt->bindparam(":owner_id", $owner_id);
										}
										$stmt->execute();

										if($stmt->rowCount() == 0)
										{
											echo "沒有任何房子";
										}
										else
										{
											$rows = $stmt->fetchAll();
											foreach ($rows as $row)
											{
												if($information0 != "" || $information1 != "" || $information2 != "" || $information3 != "" || $information4 != "" || $information5 != "" || $information6 != "" || $information7 != "" || $information8 != "" || $information9 != "")
												{
													$stmt=$connect->prepare($infoCommand);
													$stmt->execute(array('house_id' => $row['id']));
													if($stmt->rowCount() == 0)
													{
														continue;
													}
												}
												$stmt=$connect->prepare("SELECT * FROM Favorite WHERE favorite_id = :favorite_id AND user_id = :user_id");
												$stmt->execute(array('favorite_id' => $row['id'], 'user_id' => $_SESSION['id']));
												if($stmt->rowCount() == 0)
												{
													$favor_gray = "";
													$favor_word = "加入最愛";
												}
												else
												{
													$favor_gray = "disabled = 'disabled'";
													$favor_word = "已經加入最愛";
												}
												$stmt=$connect->prepare("SELECT information FROM Information WHERE house_id = :house_id");
												$stmt->execute(array('house_id' => $row['id']));
												$infoHTML = "<table>";
												while($info = $stmt->fetch())
												{
													$infoHTML = $infoHTML."<tr><td>".$info[0]."</td></tr>"; 
												}
												$infoHTML = $infoHTML."</table>";
												$rowId = $row['id'];
												echo "<tr><td valign='top'>".$row['id']."</td><td valign='top'>".$row['name']."</td><td valign='top'>".$row['price']."</td><td valign='top'>".$row['location']."</td><td valign='top'>".$row['time']."</td><td valign='top'>".$row['user']."</td><td valign='top'>".$infoHTML."</td><td valign='top'><form></form><form action='modify_house.php' method='post'><button type='submit' name='delete' value='$rowId'".$gray_button.">刪除</button></form></td><td valign='top'><form action='modify_house.php' method='post'><button type='submit' name='favorite' value='$rowId' ".$favor_gray.">".$favor_word."</button></form></td></tr>";
											}
										}
										/*while ($row = $stmt->fetch())
										{
											echo "<form action='modify_house.php' method='post'><tr><td>".$row[0]."</td><td>".$row[1]."</td><td>".$row[2]."</td><td>".$row[3]."</td><td>".$row[4]."</td><td>".$row[5]."</td><td><button type='submit' name='delete' value='<?php echo $row[0]; ?>'>刪除</button></td><td><button type='submit' name='favorite' value='<?php echo $row[0]; ?>'>加入最愛</button></td></tr></form>";
										}*/
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
							</table>
						</div>
					</form>
				</tr>
			</table>
		</div>
	</body>
</html>