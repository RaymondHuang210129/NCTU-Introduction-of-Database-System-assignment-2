<?php 
	session_start();
    if($_SESSION['Identity'] == "user")
    {
        $input_gray = "disabled='disabled'";
    }
    else
    {
        $input_gray = "";
    }
    
?>
<!DOCTYPE html>
<html>
    <head>
        <title>新增房屋</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <link type="text/css" rel="stylesheet" href="admin.css">
    </head>

    <body>
        <div class="board">
            <h2>新增房屋</h2>
            <form action="create_house.php" method="post">
                　房屋名稱: <input type="text" name="HouseName">
                <br>
                <br>
                　房屋價格: <input type="number" name="HousePrice">
                <br>
                <br>
                　房屋位置: <input type="text" name="HouseLocation">
                <br>
                <br>
                　　　時間: <input type="date" name="HouseTime"> 
                <br>
                <br>
                　　擁有者: <input type="text" name="HouseOwner" <?php echo $input_gray; ?> value="<?php echo $_SESSION['Name']; ?>">
                <br>
                <br>
                <table>
                    <tr>
                        <input type="checkbox" name="information0" value="laundry facilities"> Laundry Facilities<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information1" value="wifi"> Wifi<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information2" value="lockers"> Lockers<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information3" value="kitchen"> Kitchen<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information4" value="elevator"> Elevator<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information5" value="no smoking"> No Smoking<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information6" value="television"> Television<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information7" value="breakfast"> Breakfast<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information8" value="toiletries provided"> Toiletries Provided<br>
                    </tr>
                    <tr>
                        <input type="checkbox" name="information9" value="shuttle service"> Shuttle Service<br>
                    </tr>
                </table>
                <br>
                <br>
                <table>
                    <tr>
                        <td>
                            <input type="submit" value="新增">
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