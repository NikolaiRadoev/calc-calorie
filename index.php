<?php
session_start();
?>
<?php
#$mysqli = new mysqli('localhost', 'niki', 'UbuntuNKR-9', 'calc_calories'); 
#$mysqli->set_charset('utf8'); 

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://bootswatch.com/5/united/bootstrap.min.css"><!--sketchy, cyborg, lux, minty, quartz-->
    <title>Калколатор за калории</title>
    <style>

    </style>
</head>
<body>
    <div align="center">
    <?php
    //$_SESSION['name'] = $row['name'];
    if($_SESSION['id']) {
        $login_result = $mysqli->query("SELECT * from user WHERE id='".$_SESSION['id']."'");
  	$user = $login_result->fetch_assoc();
        echo "<h1>Здравейте " .$user['name'] ."</h1> <a href='index.php?nav=logout'>Изход</a> <br> <a href='index.php?nav=delete_acc' onclick=\"return confirm('Сигурни ли сте че искате да изтриете профила')\">Изтрий профила</a>";
        
        $height = $err_height = '';
    $kg = $err_kg = '';
    $years = $err_years = '';
    $active_range = $err_active_range = '';


    $height = $user['height'];
    $kg = $user['kg'];
    $years = $user['years'];
    $active_range = $user['active_range'];

    // if ($user['active_range'] == '1.22')  {$active_range = isset($user['active_range']);}
    // if ($user['active_range'] == '1.33')  {$active_range = isset($user['active_range']);}
    // if ($user['active_range'] == '1.44')  {$active_range = isset($user['active_range']);}
    // if ($user['active_range'] == '1.55')  {$active_range = isset($user['active_range']);}
    // if ($user['active_range'] == '1.66')  {$active_range = isset($user['active_range']);}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['height'])) {$err_height = 'Въведете валидна височина';} else{$height = $_POST['height'];}
    if (empty($_POST['kg']))  {$err_kg = 'Въведете валидни килограми';} else{$kg = $_POST['kg'];}
    if (empty($_POST['years']))  {$err_years = 'Въведете валидни години';} else{$years = $_POST['years'];}
    if (empty($_POST['active_range']))  {$err_active_range = 'Въведете валидна степен на активност';} else{$active_range = $_POST['active_range'];}
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($err_height) && empty($err_kg) && empty($err_years) && empty($err_active_range)){
    $height = $_POST['height'];
    $kg = $_POST['kg'];
    $years = $_POST['years'];
    $active_range = $_POST['active_range'];

    // if ($_POST['active_range'] == 'Заседнал')  {$isset(active_range);}
    // if ($_POST['active_range'] == 'Ниско')  {$isset(active_range);}
    // if ($_POST['active_range'] == 'Средно')  {$isset(active_range);}
    // if ($_POST['active_range'] == 'Високо')  {$isset(active_range);}
    // if ($_POST['active_range'] == 'Свръх')  {$isset(active_range);}
    $update_result = $mysqli->query("UPDATE user SET height='".$height."',kg='".$kg."',years='".$years."',active_range='".$active_range."' WHERE id=".$user['id']);
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
}
//da se promeni formata da se dobavqt smetkite 
else {?>

<div align="center">
     <form name="frmUser" method="post" action="<?php $_SERVER["PHP_SELF"] ?>" align="center">
<h3 align="center">Въведете вашите данни за да изсчислим вашите калории</h3>
<div><?php if($err_height!="") { echo $err_height;} ?></div>
<div><?php if($err_kg!="") { echo $err_kg;} ?></div>
<div><?php if($err_years!="") { echo $err_years;} ?></div>
<div><?php if($err_active_range!="") { echo $err_active_range;} ?></div>

 <br>
 <input type="number" name="height" placeholder="височина в см" value="<?php echo $height;?>">
 <br>
 <br>
<input type="number" name="kg" placeholder="килограми" value="<?php echo $kg;?>">
<br>
<br>
<input type="number" name="years" placeholder="години" value="<?php echo $years;?>">
<br>
<br>
<input type="radio" name="active_range" <?php if (isset($active_range) && $active_range=="1.2") {echo "checked";}?> value="1.2">Застоял  
<input type="radio" name="active_range" <?php if (isset($active_range) && $active_range=="1.37") {echo "checked";}?> value="1.37">Леко Активен  
<input type="radio" name="active_range" <?php if (isset($active_range) && $active_range=="1.55") {echo "checked";}?> value="1.55">Умерено Активен  
<input type="radio" name="active_range" <?php if (isset($active_range) && $active_range=="1.72") {echo "checked";}?> value="1.72">Много Активен  
<input type="radio" name="active_range" <?php if (isset($active_range) && $active_range=="1.92") {echo "checked";}?> value="1.92">Супер Активен  
<br>
<br>
<input type="submit" name="submit" value="Изчисли">
<!-- <input type="reset"> -->
</form> </div>

<?php
}
?>
<br>
<br>
<h3> Степени на активност</h3>
<p> <strong>Застоял</strong> - без тренировки, много ниска активност</p>
<p> <strong>Леко Активен</strong> - 1 или 2 дена леко физическо натоварване (разходки)</p>
<p> <strong>Умерено Активен</strong> - 3 или 4 дена средно физическо натоварване (бягане)</p>
<p> <strong>Много Активен</strong> - 5, 6 дена тежко физическо натоварване (тренировки с тежести)</p>
<p> <strong>Супер Активен</strong> - 6, 7 дена тежко физическо натоварване (по две тренировки с тежести за ден + бягане + други активности)</p>
<br>
<br>
<?php
    
    $gender_value = 0;
    $calories = 0;
    $proteins = 0;
    $carbs = 0;
    $fats = 0;
    if ($user['gender'] == 'мъж') {$gender_value = 5;} else {$gender_value = -161;}
    if ($user['height'] && $user['kg'] && $user['years'] && $user['active_range'])
    { $calories = round(((10 * $user['kg'] + 6.25 * $user['height'] -5 * $user['years'] + $gender_value) * $user['active_range']), 2 );
        $proteins = round(($calories / 2) / 4, 2);
        $carbs = round(($calories * 30 / 100) / 4, 2);
        $fats = round(($calories - ($proteins + $carbs)) / 9, 2);
        echo "<h4>Резултати</h4><strong>".$calories."</strong>"; echo " - Това са вашите калории които е препоръчително да приемате за ден - С тях ще подържате вашите моментни килограми или килограмите които искате да сте";
        echo "<br><br> <b>Протеини</b> - ".$proteins;
        echo "<br><br> <b>Въглехидрати</b> - ".$carbs;
        echo "<br><br> <b>Мазнини</b> - ".$fats;
    };

    }
    else {
        echo "<h1 align='center'>Добре дошли в калкулатора за калории </h1>";
        echo "<h2 align='center'>Моля влезте в своя профил или се регистрирайте</h2>";
        echo '<a href="index.php?nav=login" style="text-decoration:none; if ($_REQUEST["nav"] == "login") echo "color:red;"?>Вход</a> | 
		<a href="index.php?nav=register" style="text-decoration:none;  <?php if ($_REQUEST["nav"] == "register") echo "color:red;"?>Регистраци</a>';

    }
    ?>
    </div>
    <div>
    <?php
    if ($_REQUEST["nav"] == "login") {
    $email = $err_email = '';
    $password = $err_password = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email']) || (strpos($_POST['email'], '@') == false)) {$err_email = 'Въведете валиден имейл';}
    else{$result = $mysqli->query("SELECT * from user WHERE email='".$_POST['email']."'");
    $num_results = $result->num_rows; if($num_results == 0){$err_email = 'Въведете съществуващ имейл';} else{$email = $_POST['email'];}} 
    if (empty($_POST['password']))  {$err_password = 'Въведете валидна парола';}
    else {$result2 = $mysqli->query("SELECT * from user WHERE email='".$email."' AND password='".$_POST['password']."'"); $num_results2 = $result2->num_rows; if($num_results2 == 0){$err_password = 'Грешна парола';} else{$password = $_POST['password'];}} 
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($err_email) && empty($err_password)){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $login_result = $mysqli->query("SELECT * from user WHERE email='".$email."' AND password='".$password."'");
  	$user = $login_result->fetch_assoc();
    $_SESSION['id'] = $user['id'];
    //$_REQUEST["nav"] = "user";
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
}

else {?>

<div align="center">
     <form name="frmUser" method="post" action="<?php $_SERVER["PHP_SELF"] ?>" align="center">
<h3 align="center">Въведете вашите данни за вход</h3>
<div><?php if($err_email!="") { echo $err_email;} ?></div>
<div><?php if($err_password!="") { echo $err_password;} ?></div>
 <br>
 <input type="text" name="email" placeholder="имейл" value="<?php echo $email;?>">
 <br>
 <br>
<input type="password" name="password" placeholder="парола" value="<?php echo $password;?>">
<br><br>
<input type="submit" name="submit" value="Вход">
<!-- <input type="reset"> -->
</form> </div>

<?php
}

} else if ($_REQUEST["nav"] == "logout"){
    session_destroy();
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
} else if ($_REQUEST["nav"] == "delete_acc"){
    $mysqli->query("DELETE from user WHERE id='".$_SESSION['id']."'");
    echo '<meta http-equiv="refresh" content="0;url=index.php?nav=logout">';
} else if ($_REQUEST["nav"] == "register"){
    $email = $err_email = '';
    $password = $err_password = '';
    $name = $err_name = '';
    $gender = $err_gender = '';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST['email']) || (strpos($_POST['email'], '@') == false)) {$err_email = 'Въведете валиден имейл';}
     else { $n_result = $mysqli->query("SELECT * from user WHERE email='".$_POST['email']."'");
    $num_results = $n_result->num_rows; if($num_results > 0) {$err_email = 'Този имейл е зает Опитайте друг';} else{$email = $_POST['email'];}}
    if (empty($_POST['password']))  {$err_password = 'Въведете валидна парола';} else{$password = $_POST['password'];}
    if (empty($_POST['name']))  {$err_name = 'Въведете валидно име';} else{$name = $_POST['name'];}
    if (empty($_POST['gender']))  {$err_gender = 'Въведете валиден пол';} else{$gender = $_POST['gender'];}
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && empty($err_email) && empty($err_password) && empty($err_name) && empty($err_gender)){
    $email = $_POST['email'];
    $password = $_POST['password'];
    $name = $_POST['name'];
    $gender = $_POST['gender'];

    $register_result = $mysqli->query("INSERT INTO user (id, email, password, name, gender) 
        VALUES (NULL, '".$email."', '".$password."', '".$name."', '".$gender."')");


    $login_result = $mysqli->query("SELECT * from user WHERE email='".$email."' AND password='".$password."'");
  	$user = $login_result->fetch_assoc();
    $_SESSION['id'] = $user['id'];
    //$_REQUEST["nav"] = "user";
    echo '<meta http-equiv="refresh" content="0;url=index.php">';
}

else {?>

<div align="center">
     <form name="frmUser" method="post" action="<?php $_SERVER["PHP_SELF"] ?>" align="center">
<h3 align="center">Въведете вашите данни за Регистрация</h3>
<div><?php if($err_email!="") { echo $err_email;} ?></div>
<div><?php if($err_password!="") { echo $err_password;} ?></div>
<div><?php if($err_name!="") { echo $err_name;} ?></div>
<div><?php if($err_gender!="") { echo $err_gender;} ?></div>

 <br>
 <input type="text" name="email" placeholder="имейл" value="<?php echo $email;?>">
 <br>
 <br>
<input type="password" name="password" placeholder="парола" value="<?php echo $password;?>">
<br>
<br>
<input type="text" name="name" placeholder="име" value="<?php echo $name;?>">
<br>
<br>
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="жена") echo "checked";?> value="жена">жена
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="мъж") echo "checked";?> value="мъж">мъж
<input type="radio" name="gender" <?php if (isset($gender) && $gender=="друго") echo "checked";?> value="друго">друго  
<br>
<br>
<input type="submit" name="submit" value="Регистрация">
<!-- <input type="reset"> -->
</form> </div>

<?php
}
}

?>
</div>

</body>
</html>
