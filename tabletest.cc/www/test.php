<?php
function random_string($length) {
    $char = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charlen = strlen($characters);
    $string = '';
    for ($i = 0; $i < $length; $i++) {
        $string = $char[rand(0, $charlen - 1)];
    }
    return $string;
}
	require_once 'connection.php'; // подключаем скрипт
	
	ini_set('max_execution_time', 9000);
	
	$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));

/*echo "<b>Поиск по ключевому полю: </b> </br>";
$time = NULL;
for ($i = 0; $i < 100; $i++)
	{
		$id = rand(1, 1000);
		$time_start = microtime(TRUE);
		$query = "SELECT * FROM table1 WHERE id = $id;";
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		$time_end = microtime(TRUE);
		$time += ($time_end - $time_start);
	}
$time /= 100;
echo "</br> <i> 1 000: </i>";
echo "$time";

$time=0;
for ($i = 0; $i < 100; $i++)

{

$id = rand(1, 10000);

$time_start = microtime(TRUE);

$query = "SELECT * FROM table2 WHERE id = $id;";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 10 000: </i>";
echo "$time";

$time=0;
for ($i = 0; $i < 100; $i++)

{

$id = rand(1, 100000);

$time_start = microtime(TRUE);

$query = "SELECT* FROM table3 WHERE id = $id;";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 100 000: </i>";
echo $time; */



/*echo "<b>Поиск по  не ключевому полю: </b> </br>";
$time = NULL;
for ($i = 0; $i < 100; $i++)
	{

		$num = rand(1, 10000); //в значении no1 лежит число от 1 до 10000
		$time_start = microtime(TRUE);
		$query = "SELECT * FROM table1 WHERE no1 = $num;";
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		$time_end = microtime(TRUE);
		$time += ($time_end - $time_start);
	}

$time /= 100; //усредняем время

echo "</br> <i> 1 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$num = rand(1, 10000);

$time_start = microtime(TRUE);

$query = "SELECT * FROM table2 WHERE no1 = $num;";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 10 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$num = rand(1, 10000);

$time_start = microtime(TRUE);

$query = "SELECT * FROM table3 WHERE no1 = $num;";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 100 000: </i>";
echo $time;*/




/*echo "<b>Поиск по маске: </b> </br>";
$time = NULL;
for ($i = 0; $i < 100; $i++)
	{
		$mask = random_string(5);
		$time_start = microtime(TRUE);
		$query = "SELECT * FROM table1 WHERE text LIKE '%$mask%'";
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		$time_end = microtime(TRUE);
		$time += ($time_end - $time_start);
	}
$time /= 100;
echo "</br> <i> 1 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$mask = random_string(5);


$time_start = microtime(TRUE);

$query = "SELECT * FROM table2 WHERE text LIKE '%$mask%'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 10 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$mask = random_string(5);



$time_start = microtime(TRUE);

$query = "SELECT * FROM table3 WHERE text LIKE '%$mask%'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 100 000: </i>";
echo $time;*/




/*echo "<b>Добавление записи: </b> </br>";
$time = NULL;
$num1 = rand(1, 10000); 
$num2 = rand(1, 10000);
$str = random_string(15); //длина строки в text
for ($i = 0; $i < 100; $i++)
{
	$time_start = microtime(TRUE);
	$query = "INSERT INTO table1 VALUES (NULL, '$str', '$num1', '$num2')";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$time_end = microtime(TRUE);
	$time += ($time_end - $time_start);
}
$time /= 100; //усредняем время
echo "</br> <i> 1 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$time_start = microtime(TRUE);

$query = "INSERT INTO table2 VALUES (NULL, '$str', '$num1', '$num2')";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 10 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$time_start = microtime(TRUE);

$query = "INSERT INTO table3 VALUES (NULL, '$str', '$num1', '$num2')";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 100 000: </i>";
echo $time;*/





/*echo "<b>Добавление группы записей: </b> </br>";
$time=NULL;
$time_start = microtime(TRUE);
for ($i = 0; $i < 100; $i++)
{
	$num1 = rand(1, 10000);
	$num2 = rand(1, 10000);
	$str = random_string(15);
	$query = "INSERT INTO table1 VALUES (NULL, '$str', '$num1', '$num2')";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	
}
$time_end = microtime(TRUE);
$time = ($time_end - $time_start);
echo "</br> <i> 1 000: </i>";
echo $time;

$time=0;
$time_start = microtime(TRUE);
for ($i = 0; $i < 100; $i++)

{
	$num1 = rand(1, 10000);
	$num2 = rand(1, 10000);
	$str = random_string(15);
	$query = "INSERT INTO table2 VALUES (NULL, '$str', '$num1', '$num2')";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
}
$time_end = microtime(TRUE);

$time = ($time_end - $time_start);


echo "</br> <i> 10 000: </i>";
echo $time;

$time=0;
$time_start = microtime(TRUE);
for ($i = 0; $i < 100; $i++)

{
	$num1 = rand(1, 10000);
	$num2 = rand(1, 10000);
	$str = random_string(15);
	$query = "INSERT INTO table3 VALUES (NULL, '$str', '$num1', '$num2')";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

}

$time_end = microtime(TRUE);

$time = ($time_end - $time_start);

echo "</br> <i> 100 000: </i>";
echo $time;*/



/*echo "<b>Изменение записи по ключу: </b> </br>";
$time=NULL;
for ($i = 0; $i < 100; $i++)
{
	$num1 = rand(1, 10000);
	$num2 = rand(1, 10000);
	$str = random_string(10);
	$id = rand(1, 1000);
	$time_start = microtime(TRUE);
	$query = "UPDATE table1 SET text = '$str', no1 = '$num1', no2 = '$num2' WHERE id = $id;";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$time_end = microtime(TRUE);
	$time += ($time_end - $time_start);
}
$time /= 100;
echo "</br> <i> 1 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$num1 = rand(1, 10000);

$num2 = rand(1, 10000);

$str = random_string(10);

$id = rand(1, 10000);

$time_start = microtime(TRUE);

$query = "UPDATE table2 SET text = '$str', no1 = '$num1', no2 = '$num2' WHERE id = $id;";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 10 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$num1 = rand(1, 10000);

$num2 = rand(1, 10000);

$str = random_string(10);

$id = rand(1, 100000);

$time_start = microtime(TRUE);

$query = "UPDATE table3 SET text = '$str', no1 = '$num1', no2 = '$num2' WHERE id = $id;";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 100 000: </i>";
echo $time;*/



/*echo "<b>Изменение записи по не ключевому полю: </b> </br>";

$time=NULL;
for ($i = 0; $i < 100; $i++)
{
	$num1 = rand(1, 10000);
	$num2 = rand(1, 10000);
	$str = random_string(15);
	$id = rand(1, 1000);
	$time_start = microtime(TRUE);
	$query = "UPDATE table1 SET text = '$str', no1 = '$num1', no2 = '$num2' WHERE no1 = $num1";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$time_end = microtime(TRUE);
	$time += ($time_end - $time_start);
}
$time /= 100;
echo "</br> <i> 1 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$num1 = rand(1, 10000);

$num2 = rand(1, 10000);

$str = random_string(15);

$id = rand(1, 10000);

$time_start = microtime(TRUE);

$query = "UPDATE table2 SET text = '$str', no1 = '$num1', no2 = '$num2' WHERE no1 = $num1";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 10 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$num1 = rand(1, 10000);

$num2 = rand(1, 10000);

$str = random_string(15);

$id = rand(1, 100000);

$time_start = microtime(TRUE);

$query = "UPDATE table3 SET text = '$str', no1 = '$num1', no2 = '$num2' WHERE no1 = $num1";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 100 000: </i>";
echo $time;*/




//$mysqli = new mysqli("localhost", "root", "", "test");
/*echo "<b>Удаление записи по ключевому полю: </b> </br>";
$time = NULL;
$num1 = rand(1, 10000);
$num2 = rand(1, 10000);
$str = random_string(15);
for ($i = 0; $i < 100; $i++)
{
	$mysqli->query("INSERT INTO table1 VALUES (NULL, '$str', '$num1', '$num2')");
	$id = mysqli_insert_id($mysqli); //запоминаем id вставленной строки, чтобы потом ее удалить
	$time_start = microtime(TRUE);
	$mysqli->query("DELETE FROM table1 WHERE id = $id");
	$time_end = microtime(TRUE);
	$time += ($time_end - $time_start);
}
$time /= 100;
echo "</br> <i> 1 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

	$mysqli->query("INSERT INTO table2 VALUES (NULL, '$str', '$num1', '$num2')");
	$id = mysqli_insert_id($mysqli);
	$time_start = microtime(TRUE);
	$mysqli->query("DELETE FROM table2 WHERE id = $id");

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 10 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{
	$mysqli->query("INSERT INTO table3 VALUES (NULL, '$str', '$num1', '$num2')");
	$id = mysqli_insert_id($mysqli);
	$time_start = microtime(TRUE);
	$mysqli->query("DELETE FROM table3 WHERE id = $id");

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 100 000: </i>";
echo $time;*/




/*echo "<b>Удаление записи по не ключевому полю: </b> </br>";
$time = NULL;
$num1 = rand(1, 10000);
$num2 = rand(1, 10000);
$str = random_string(15);
for ($i = 0; $i < 100; $i++)
{
$query = "INSERT INTO table1 VALUES (NULL, '$str', '$num1', '$num2')";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$time_start = microtime(TRUE);
$query = "DELETE FROM table1 WHERE text = '$str'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$time_end = microtime(TRUE);
$time += ($time_end - $time_start);
}
$time /= 100;
echo "</br> <i> 1 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$query = "INSERT INTO table2 VALUES (NULL, '$str', '$num1', '$num2')";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$time_start = microtime(TRUE);
$query = "DELETE FROM table2 WHERE text = '$str'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 10 000: </i>";
echo $time;

$time=0;
for ($i = 0; $i < 100; $i++)

{

$query = "INSERT INTO table3 VALUES (NULL, '$str', '$num1', '$num2')";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$time_start = microtime(TRUE);
$query = "DELETE FROM table3 WHERE text = '$str'";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time_end = microtime(TRUE);

$time += ($time_end - $time_start);

}

$time /= 100;

echo "</br> <i> 100 000: </i>";
echo $time;*/



/*echo "<b>Удаление группы записей: </b> </br>";
//$mysqli = new mysqli("localhost", "localhost", "localhost", "tests_zip");

$time = NULL;
for ($i = 301; $i < 501; $i++)
{
	$time_start = microtime(TRUE);
	$query = "DELETE FROM table1 WHERE id=$i";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$time_end = microtime(TRUE);
	$time += ($time_end - $time_start);
}
echo "</br> <i> 1 000: </i>";
echo $time;

$time=0;

for ($i = 8000; $i < 8200; $i++)
{
$time_start = microtime(TRUE);
$query = "DELETE FROM table2 WHERE id=$i";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$time_end = microtime(TRUE);

$time += ($time_end - $time_start);
}


echo "</br> <i> 10 000: </i>";
echo $time;

$time=0;


for ($i = 90700; $i < 90900; $i++)

{
	$time_start = microtime(TRUE);
	$query = "DELETE FROM table3 WHERE id=$i";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	$time_end = microtime(TRUE);
	$time += ($time_end - $time_start);
}


echo "</br> <i> 100 000: </i>";
echo $time;*/



























/*echo "<b>Оптимизация без 200 записей: </b> </br>";
//$mysqli = new mysqli("localhost", "localhost", "localhost", "tests_zip");

$time = NULL;
$start = microtime(true);
$query = "OPTIMIZE TABLE table1";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$time = (microtime(true) - $start);

echo "</br> <i> 1 000: </i>";
echo $time;

$time = NULL;

$start = microtime(true);

$query = "OPTIMIZE TABLE table2";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));

$time = (microtime(true) - $start);

echo "</br> <i> 10 000: </i>";
echo $time;

$time = NULL;
$start = microtime(true);
$query = "OPTIMIZE TABLE table3";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$time = (microtime(true) - $start);

echo "</br> <i> 100 000: </i>";
echo $time;*/


echo "<b>Оптимизация только 200 записей: </b> </br>";

$time=NULL;
//$query = "DELETE FROM table1 WHERE id < 500 OR id >= 700";
//$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$start = microtime(true);
$query = "OPTIMIZE TABLE table1";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$time = (microtime(true) - $start);
echo "</br> <i> 1 000: </i>";
echo $time;

$time = NULL;
$start = microtime(true);
$query = "OPTIMIZE TABLE table2";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$time = (microtime(true) - $start);
echo "</br> <i> 10 000: </i>";
echo $time;

$time = NULL;
$start = microtime(true);
$query = "OPTIMIZE TABLE table3";
$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
$time = (microtime(true) - $start);

echo "</br> <i> 100 000: </i>";
echo $time;




?>