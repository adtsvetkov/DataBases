<?php
function random_string($length) {
	//$length=10;
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}
	require_once 'connection.php'; // подключаем скрипт
	
	ini_set('max_execution_time', 9000);
	
	$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
	
	for ($i=0; $i<100000; $i++)
	{
		$num1 = rand(1, 10000);
		$num2 = rand(1, 10000);
		$str = random_string(15);
		$query ="INSERT INTO table3 VALUES (NULL, '$str', '$num1', '$num2')";
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	}
	mysqli_close($link);
?>
