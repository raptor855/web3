<?php
header('Content-Type:text/html;charset=UTF-8');
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  if (!empty($_GET['save'])) {
    print('Спасибо, результаты сохранены.');
  }
  include('form.php');
  exit();
}
$errors = FALSE;
$name = $_POST['name'];
$email = $_POST['email'];
$year = $_POST['year'];
$sex =	$_POST['sex'];
$flag=FALSE;
$limbs = $_POST['limbs'];
$bio = $_POST['biography'];	
$consent = $_POST['consent'];

if (empty($_POST['name'])) {
  echo	"Укажите имя.<br/>";
  $errors = TRUE;
}else if(!preg_match("#^[aA-zZ0-9\-_]+$#",$_POST['name'])){
	print('Недопустимые символы.<br/>');
	$errors=TRUE;
}
if (empty($email)){
	echo "Укажите адрес.<br/>";
	$errors = TRUE;
}
if	(empty($year)){
	echo "Укажите год рождения.<br/>";
	$errors = TRUE;
}
if	(empty($sex)){
	echo "Укажите пол.<br/>";
	$errors	= TRUE;
}
if	(empty($limbs)){
	echo "Укажите кол-во конечностей.<br/>";
	$errors	= TRUE;	
}
$Sverh = $_POST['sverh'];
  if(!isset($Sverh))
  {
    echo("<p>Вы не выбрали способности</p>\n");
  }
  else
  {	echo"Ваши способности:<br/>";
    for($i=0; $i < count($Sverh); $i++)
    {
		if($Sverh[$i]=="net")$flag=TRUE;
    }
  }
 if($flag){
	 for($t=0;$t<count($Sverh);$t++){
		 if($Sverh[$t]!="net")unset($Sverh[$t]);
	 }
 }else if(!empty($Sverh)){
	 for($y=0;$y<count($Sverh);$y++){
		echo"$Sverh[$y]<br/>";
	}
 }
 $sverh_separated=implode(",",$Sverh);
if	(empty($bio)){
	echo "Не заполнена биография.<br/>";
	$errors	= TRUE;
}
if	(empty($consent)){
	echo "Вы не согласились с условиями контракта.<br/>";
	$errors	= TRUE;	
}

if($errors){
	exit();
}
$user = 'u15699';
$pass = '8026331';
$db = new PDO('mysql:host=localhost;dbname=u15699', $user, $pass,
array(PDO::ATTR_PERSISTENT => true));
try {
 $stmt = $db->prepare("INSERT INTO application (name, email, birth, sex, limbs, sverh, bio,consent) 
 VALUES (:name, :email, :birth, :sex, :limbs, :birth,:bio, :consent)");
$stmt->bindParam(':name', $name_db);
$stmt->bindParam(':email', $email_db);
$stmt->bindParam(':birth', $year_db);
$stmt->bindParam(':sex', $sex_db);
$stmt->bindParam(':limbs', $limb_db);
$stmt->bindParam(':sverh', $sverh_db);
$stmt->bindParam(':bio', $bio_db);
$stmt->bindParam(':consent', $consent_db);
$name_db=$name;
$email_db=$email;
$year_db=$year;
$sex_db=$sex;
$limb_db=$limbs;
$sverh_db=$sverh_separated;
$bio_db=$bio;
$consent_db=$consent;
$stmt->execute();
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}
header('Location: ?save=1')
?>