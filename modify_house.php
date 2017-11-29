<?php
	session_start();

	$dbservername = 'dbhome.cs.nctu.edu.tw';
	$dbname='tsejui210129_cs_DB_HW1';
	$dbaccount='tsejui210129_cs';
	$dbpassword='ltes123456';

	if(isset($_POST['unlike']) && $_POST['unlike'] != "")
	{
		try
		{
			$connect = new PDO("mysql:host=".$dbservername.";dbname=".$dbname, $dbaccount, $dbpassword);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt=$connect->prepare("DELETE FROM Favorite WHERE user_id = :user_id AND favorite_id = :favorite_id");
			$stmt->execute(array('user_id' => $_SESSION['id'], 'favorite_id' => $_POST['unlike']));
			if($stmt->rowCount() == 1)
			{
				echo <<<"EOT"
					<!DOCTYPE html>
					<html>
						<script>
							alert("remove from favorite successfully.");
							window.location.replace("favorite.php");
						</script>
					</html>
EOT;
			}
			else
			{
				echo $_SESSION['id']." ".$_POST['unlike'];
				echo <<<"EOT"
					<!DOCTYPE html>
					<html>
						<script>
							alert("error.");
							window.location.replace("favorite.php");
						</script>
					</html>
EOT;
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
						window.location.replace("index.php");
					</script>
				</html>
EOT;
		}
	}
	elseif(isset($_POST['delete']) && $_POST['delete'] != "")
	{
		try
		{
			$connect = new PDO("mysql:host=".$dbservername.";dbname=".$dbname, $dbaccount, $dbpassword);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt=$connect->prepare("DELETE FROM House WHERE id = :id");
			$stmt->execute(array('id' => $_POST['delete']));
			if($stmt->rowCount() == 1)
			{
				echo <<<"EOT"
					<!DOCTYPE html>
					<html>
						<script>
							alert("delete successfully.");
							window.location.replace("admin.php");
						</script>
					</html>
EOT;
			}
			else
			{
				echo <<<"EOT"
					<!DOCTYPE html>
					<html>
						<script>
							alert("error.");
							window.location.replace("admin.php");
						</script>
					</html>
EOT;
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
						window.location.replace("index.php");
					</script>
				</html>
EOT;
		}
	}
	elseif(isset($_POST['favorite']) && $_POST['favorite'] != "")
	{
		try
		{
			$connect = new PDO("mysql:host=".$dbservername.";dbname=".$dbname, $dbaccount, $dbpassword);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt=$connect->prepare("INSERT INTO Favorite (user_id, favorite_id) VALUES ( :user_id, :favorite_id)");
			$stmt->execute(array('user_id' => $_SESSION['id'], 'favorite_id' => $_POST['favorite']));
			if($stmt->rowCount() == 1)
			{
				echo <<<"EOT"
					<!DOCTYPE html>
					<html>
						<script>
							alert("add to favorite successfully.");
							window.location.replace("admin.php");
						</script>
					</html>
EOT;
			}
			else
			{
				echo <<<"EOT"
					<!DOCTYPE html>
					<html>
						<script>
							alert("error.");
							window.location.replace("admin.php");
						</script>
					</html>
EOT;
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
						alert("{$msg}");
						window.location.replace("index.php");
					</script>
				</html>
EOT;
		}
	}
	elseif(isset($_POST['submit']) && $_POST['submit'] != "")
	{
		try
		{

			$connect = new PDO("mysql:host=".$dbservername.";dbname=".$dbname, $dbaccount, $dbpassword);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			if(isset($_POST['HouseOwner']))
			{
				$stmt=$connect->prepare("SELECT id FROM Account WHERE name = :name");
				$stmt->execute(array('name' => $_POST['HouseOwner']));
				$buff = $stmt->fetch();
				if($stmt->rowCount() != 0)
				{
					$stmt=$connect->prepare("UPDATE House SET name = :name, price = :price, location = :location, time = :time, owner_id = :owner_id WHERE id = :id");
					$stmt->execute(array('name' => $_POST['HouseName'], 'price' => $_POST['HousePrice'], 'location' => $_POST['HouseLocation'], 'time' => $_POST['HouseTime'], 'owner_id' => $buff[0], 'id' => $_POST['submit']));
				}
				else
				{
					echo <<<"EOT"
					<!DOCTYPE html>
					<html>
						<script>
							alert("Owner does not exist.");
							window.location.replace("house_manage.php");
						</script>
					</html>
EOT;
				}
			}
			else
			{
				$stmt=$connect->prepare("UPDATE House SET name = :name, price = :price, location = :location, time = :time WHERE id = :id");
				$stmt->execute(array('name' => $_POST['HouseName'], 'price' => $_POST['HousePrice'], 'location' => $_POST['HouseLocation'], 'time' => $_POST['HouseTime'], 'id' => $_POST['submit']));
			}
			$stmt=$connect->prepare("DELETE FROM Information WHERE house_id = :house_id");
			$stmt->execute(array('house_id' => $_POST['submit']));
			if(isset($_POST['information0']) && $_POST['information0'] != "")
			{
				$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
				$stmt->execute(array('information' => $_POST['information0'], 'house_id' => $_POST['submit']));
			}
			if(isset($_POST['information1']) && $_POST['information1'] != "")
			{
				$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
				$stmt->execute(array('information' => $_POST['information1'], 'house_id' => $_POST['submit']));
			}
			if(isset($_POST['information2']) && $_POST['information2'] != "")
			{
				$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
				$stmt->execute(array('information' => $_POST['information2'], 'house_id' => $_POST['submit']));
			}
			if(isset($_POST['information3']) && $_POST['information3'] != "")
			{
				$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
				$stmt->execute(array('information' => $_POST['information3'], 'house_id' => $_POST['submit']));
			}
			if(isset($_POST['information4']) && $_POST['information4'] != "")
			{
				$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
				$stmt->execute(array('information' => $_POST['information4'], 'house_id' => $_POST['submit']));
			}
			if(isset($_POST['information5']) && $_POST['information5'] != "")
			{
				$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
				$stmt->execute(array('information' => $_POST['information5'], 'house_id' => $_POST['submit']));
			}
			if(isset($_POST['information6']) && $_POST['information6'] != "")
			{
				$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
				$stmt->execute(array('information' => $_POST['information6'], 'house_id' => $_POST['submit']));
			}
			if(isset($_POST['information7']) && $_POST['information7'] != "")
			{
				$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
				$stmt->execute(array('information' => $_POST['information7'], 'house_id' => $_POST['submit']));
			}
			if(isset($_POST['information8']) && $_POST['information8'] != "")
			{
				$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
				$stmt->execute(array('information' => $_POST['information8'], 'house_id' => $_POST['submit']));
			}
			if(isset($_POST['information9']) && $_POST['information9'] != "")
			{
				$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
				$stmt->execute(array('information' => $_POST['information9'], 'house_id' => $_POST['submit']));
			}
			echo <<<"EOT"
				<!DOCTYPE html>
				<html>
					<script>
						alert("Update successfully.");
						window.location.replace("house_manage.php");
					</script>
				</html>
EOT;

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
						alert("{$msg}");
						window.location.replace("index.php");
					</script>
				</html>
EOT;
		}
	}
	elseif(isset($_POST['edit']) && $_POST['edit'] != "")
	{
		try
		{
			$connect = new PDO("mysql:host=".$dbservername.";dbname=".$dbname, $dbaccount, $dbpassword);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt=$connect->prepare("SELECT House.*, Account.name FROM House, Account WHERE House.id = :id AND House.owner_id = Account.id");
			$stmt->execute(array('id' => $_POST['edit']));
			if($stmt->rowCount() == 1)
			{
				if($_SESSION['Identity'] == "user")
				{
					$gray_owner = "disabled";				
				}
				else
				{
					$gray_owner = "";
				}
				$row = $stmt->fetch();
				$stmt=$connect->prepare("SELECT information FROM Information WHERE house_id = :house_id");
				$stmt->execute(array('house_id' => $row[0]));
				$info[0] = $info[1] = $info[2] = $info[3] = $info[4] = $info[5] = $info[6] = $info[7] = $info[8] = $info[9] = "";
				if($stmt->rowCount() == 0)
				{
					echo <<<"EOT"
						<!DOCTYPE html>
						<html>
							<script>
								alert("error.");
								window.location.replace("index.php");
							</script>
						</html>
EOT;
				}
				while($information = $stmt->fetchObject())
				{
					if($information->information == "laundry facilities")
					{
						$info[0] = "checked='checked'";
					}
					if($information->information == "wifi")
					{
						$info[1] = "checked='checked'";
					}
					if($information->information == "lockers")
					{
						$info[2] = "checked='checked'";
					}
					if($information->information == "kitchen")
					{
						$info[3] = "checked='checked'";
					}
					if($information->information == "elevator")
					{
						$info[4] = "checked='checked'";
					}
					if($information->information == "no smoking")
					{
						$info[5] = "checked='checked'";
					}
					if($information->information == "television")
					{
						$info[6] = "checked='checked'";
					}
					if($information->information == "breakfast")
					{
						$info[7] = "checked='checked'";
					}
					if($information->information == "toiletries provided")
					{
						$info[8] = "checked='checked'";
					}
					if($information->information == "shuttle service")
					{
						$info[9] = "checked='checked'";
					}
				}
			}
			else
			{
				echo <<<"EOT"
					<!DOCTYPE html>
					<html>
						<script>
							alert("error.");
							window.location.replace("index.php");
						</script>
					</html>
EOT;
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
						alert("{$msg}");
						window.location.replace("index.php");
					</script>
				</html>
EOT;
		}
	}
	else
	{
		session_unset();
		session_destroy();
		echo <<<"EOT"
			<!DOCTYPE html>
			<html>
				<body>
					<script>
						alert("Internal error.");
						window.location.replace("index.php");
					</script>
				</body>
			</html>
EOT;
	}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>編輯房屋</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link type="text/css" rel="stylesheet" href="admin.css">
    </head>

    <body>
        <div class="board">
            <h2>編輯房屋</h2>
            <form action="modify_house.php" method="post">
                　房屋名稱: <input type="text" name="HouseName" value="<?php echo $row[1]; ?>">
                <br>
                <br>
                　房屋價格: <input type="number" name="HousePrice" value="<?php echo $row[2]; ?>">
                <br>
                <br>
                　房屋位置: <input type="text" name="HouseLocation" value="<?php echo $row[3]; ?>">
                <br>
                <br>
                　　　時間: <input type="date" name="HouseTime" value="<?php echo $row[4]; ?>"> 
                <br>
                <br>
                　　擁有者: <input type="text" name="HouseOwner" value="<?php echo $row[6]; ?>" <?php echo $gray_owner; ?> >
                <br>
                <br>
                <table>
                    <tr>
                        <input type="checkbox" name="information0" value="laundry facilities" <?php echo $info[0]; ?> > Laundry Facilities<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information1" value="wifi" <?php echo $info[1]; ?>> Wifi<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information2" value="lockers" <?php echo $info[2]; ?>> Lockers<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information3" value="kitchen" <?php echo $info[3]; ?>> Kitchen<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information4" value="elevator" <?php echo $info[4]; ?>> Elevator<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information5" value="no smoking" <?php echo $info[5]; ?>> No Smoking<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information6" value="television" <?php echo $info[6]; ?>> Television<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information7" value="breakfast" <?php echo $info[7]; ?>> Breakfast<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information8" value="toiletries provided" <?php echo $info[8]; ?>> Toiletries Provided<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information9" value="shuttle service" <?php echo $info[9]; ?>> Shuttle Service<br>
                    </tr>
                </table>
                <br>
                <br>
                <table>
                    <tr>
                        <td>
                            <button type='submit' name='submit' value="<?php echo $row[0]; ?>">更新</button>
                        </td>
                        <td>
                            <input type="button" value="返回" onclick="location.href='http://people.cs.nctu.edu.tw/~tsejui210129/house_manage.php'">
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </body>
</html>