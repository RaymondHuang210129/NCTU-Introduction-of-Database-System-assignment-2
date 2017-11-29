<?php
	session_start();

	$dbservername='dbhome.cs.nctu.edu.tw';
	$dbname='tsejui210129_cs_DB_HW1';
	$dbaccount='tsejui210129_cs';
	$dbpassword='ltes123456';


	if(!isset($_POST['HouseOwner']))
	{
		$_POST['HouseOwner'] = $_SESSION['Name'];
	}
	if(trim($_POST['HouseName']) != "" and trim($_POST['HousePrice']) != "" and trim($_POST['HouseLocation']) != "" and trim($_POST['HouseTime']) != "" and trim($_POST['HouseOwner']) != "")
	{
		
		$HouseName = trim($_POST['HouseName']);
		$HousePrice =  trim($_POST['HousePrice']);
		$HouseLocation = trim($_POST['HouseLocation']);
		$HouseTime = $_POST['HouseTime'];
		$HouseOwner =trim($_POST['HouseOwner']);
		try
		{
			$connect = new PDO("mysql:host=".$dbservername.";dbname=".$dbname, $dbaccount, $dbpassword);
			$connect->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			$stmt = $connect->prepare("SELECT * FROM House WHERE name = :housename");
			$stmt->execute(array('housename' => $HouseName));
			unset($errMsg);
			if ($stmt->rowCount() == 1)
			{
				if(!isset($errMsg))
				{
					$errMsg = "";
				}
				$errMsg = $errMsg."House name already exist.     ";
			}
			$stmt = $connect->prepare("SELECT id FROM Account WHERE name = :username");
			$stmt->execute(array('username' => $HouseOwner));
			if($stmt->rowCount() == 0)
			{
				if(!isset($errMsg))
				{
					$errMsg = "";
				}
				$errMsg = $errMsg."Owner does not exist.     ";
			}
			else
			{
				$row = $stmt->fetch();
				$HouseOwnerId = $row[0];
			}
			if(isset($errMsg))
			{
				echo <<<"EOT"
				<!DOCTYPE html>
				<html>
					<body>
						<script>
							alert("{$errMsg}");
							window.location.replace("new_house.php");
						</script>
					</body>
				</html>
EOT;
			}
			else
			{
				$stmt = $connect->prepare("INSERT INTO House (name, price, location, time, owner_id) VALUES (:name, :price, :location, :time, :owner_id)");
				$stmt->execute(array('name' => $HouseName, 'price' => $HousePrice, 'location' => $HouseLocation, 'time' => $HouseTime, 'owner_id' => $HouseOwnerId));
				$stmt = $connect->prepare("SELECT id FROM House WHERE name = :name");
				$stmt->execute(array('name' => $HouseName));
				$row = $stmt->fetch();
				$HouseId = $row[0];
				if(isset($_POST['information0']) && $_POST['information0'] != "")
				{
					$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
					$stmt->execute(array('information' => $_POST['information0'], 'house_id' => $HouseId));
				}
				if(isset($_POST['information1']) && $_POST['information1'] != "")
				{
					$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
					$stmt->execute(array('information' => $_POST['information1'], 'house_id' => $HouseId));
				}
				if(isset($_POST['information2']) && $_POST['information2'] != "")
				{
					$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
					$stmt->execute(array('information' => $_POST['information2'], 'house_id' => $HouseId));
				}
				if(isset($_POST['information3']) && $_POST['information3'] != "")
				{
					$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
					$stmt->execute(array('information' => $_POST['information3'], 'house_id' => $HouseId));
				}
				if(isset($_POST['information4']) && $_POST['information4'] != "")
				{
					$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
					$stmt->execute(array('information' => $_POST['information4'], 'house_id' => $HouseId));
				}
				if(isset($_POST['information5']) && $_POST['information5'] != "")
				{
					$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
					$stmt->execute(array('information' => $_POST['information5'], 'house_id' => $HouseId));
				}
				if(isset($_POST['information6']) && $_POST['information6'] != "")
				{
					$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
					$stmt->execute(array('information' => $_POST['information6'], 'house_id' => $HouseId));
				}
				if(isset($_POST['information7']) && $_POST['information7'] != "")
				{
					$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
					$stmt->execute(array('information' => $_POST['information7'], 'house_id' => $HouseId));
				}
				if(isset($_POST['information8']) && $_POST['information8'] != "")
				{
					$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
					$stmt->execute(array('information' => $_POST['information8'], 'house_id' => $HouseId));
				}
				if(isset($_POST['information9']) && $_POST['information9'] != "")
				{
					$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
					$stmt->execute(array('information' => $_POST['information9'], 'house_id' => $HouseId));
				}
				/*
				for( $i = 0; $i < 10; $i++)
				{
					if(isset($Information[$i]) && $Information[$i] != "")
					{
						$stmt = $connect->prepare("INSERT INTO Information (information, house_id) VALUES (:information, :house_id)");
						$stmt->execute(array('information' => $Information[$i], 'house_id' => $HouseId));
					}
				}
			*/	
				echo <<<"EOT"
				<!DOCTYPE html>
				<html>
					<body>
						<script>
							alert("House added successfully.");
							window.location.replace("house_manage.php");
						</script>
					</body>
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
	else
	{
		echo <<<"EOT"
			<!DOCTYPE html>
			<html>
				<body>
					<script>
						alert("Do not leave any field with blank.");
						window.location.replace("new_house.php");
					</script>
				</body>
			</html>
EOT;
	}
?>