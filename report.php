<!DOCTYPE html>
<!--
-->
<?php
		require_once 'connection.php';
 
		$link = mysqli_connect($host, $user, $password, $database) 
				or die("Ошибка " . mysqli_error($link));
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Отчеты </title>
    </head>
<body>
<table width=100% height=100% border ="1"> 
	<tr>
	<td align=center colspan= "5" bgcolor = '#CAE1FF'>
    <h1 align=center> Картотека уголовного розыска </h1> </td> 
	</tr> 
	<tr>
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="reg.php">Оформление задержанного</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="UK.php">Уголовный кодекс</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="crime_investigation.php">Федеральный розыск</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="archive.php">Архив</a> </h3> </td> 
	<td bgcolor = '#FFE4E1'> <h3 align = center> <a href="report.php">Отчеты</a> </h3> </td> 
	</tr> </table>
<table width=100% height=100%>
<tr><td align=center>
</br>
<form method="post" action="report.php"> 
<button type="submit" name = "free">Показать список отпускаемых на свободу</button>
<?php
	if (isset($_POST['free']))
	{
		$query ="SELECT * FROM 
		(SELECT * FROM ARCHIVE WHERE ID NOT IN 
		(SELECT ARCHIVE.ID FROM ARCHIVE WHERE punishment =  'расстрел')) AS NORUSTRELL 
		WHERE punishment = 'тюрьма' OR punishment = 'федеральная тюрьма' ORDER BY id, arrest_date"; //отсеивает расстрелянных, выбирает только тех, кто сидит/сидел в тюрьме
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
		$num_rows = mysqli_num_rows($result);
			if ($num_rows == NULL)
			{
				echo "</br></br>";
				echo "<i> <font color=\"red\"> К сожалению, ничего не нашлось. </font> </i>";
				echo "</br>";
			}
			else
			{
				$table = "CREATE TABLE free 
					(
						num INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
						ID INT(8) NOT NULL,
						surname VARCHAR(50) NOT NULL, 
						name VARCHAR(50) NOT NULL,	
						patronymic VARCHAR(50) DEFAULT NULL,
						free_date DATE NOT NULL
					)"; //создаем новую таблицу, чтобы записывать в нее подходящие значения 
				$tableres = mysqli_query($link, $table) or die("Ошибка " . mysqli_error($link));
				$row = mysqli_fetch_assoc($result);
				while ($row != NULL) //пробегаемся по всем строчкам 
				{
					$ID = $row['ID']; 
					$surname = $row['surname']; //запоминаем имя, с которым преступник попался первый раз
					$name = $row['name'];
					$patronymic = $row['patronymic'];
					$realdate = NULL; //показатель реальной даты начала отсидки
					$realsrok = NULL; //реальный срок
					$currentdate = NULL; //текущая считанная дата
					$currentsrok = NULL; //текущий считанный срок
					$n = 0;
					do
					{
						$currentdate = $row['arrest_date'];
						$currentsrok = $row['punish_para'];
						if ($realsrok == NULL) $realsrok = $currentsrok; //если первая строчка, заполняем
						if ($realdate == NULL) $realdate = $currentdate;
						if ($n!=0)
						{
							if (strtotime("$realdate + $realsrok year") <= strtotime("$currentdate")) //если условие выполняется, преступник уже вышел до даты следующей отсидки
							{
								$realdate = $currentdate;
								$realsrok = $currentsrok;
							}
							else $realsrok+=$currentsrok; //иначе плюсуем срок
						}
						$n++;
						$row = mysqli_fetch_assoc($result);
					} while ($row['ID'] == $ID);
					$free_datesec = strtotime("$realdate + $realsrok year");
					if (($free_datesec > strtotime("now")) && ($free_datesec<= strtotime("now+1 month"))) //если дата выхода находится в интервале от сегодняшнего дня до сегодня + месяц
					{
						$free_date = date("Y-m-d", $free_datesec);
						$filltable = "INSERT INTO free (ID, surname, name, patronymic, free_date) VALUES ('$ID', '$surname', '$name', '$patronymic', '$free_date')";
						$filltableres = mysqli_query($link, $filltable) or die("Ошибка " . mysqli_error($link));
					}
				}
				$query1 = "SELECT * FROM free ORDER BY free_date"; //выводим получившуюся таблицу с сортировкой по дате
				$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link));
				$num_rows1 = mysqli_num_rows($result1);
				if ($num_rows1 == NULL)
				{
					echo "</br></br>";
					echo "<i> <font color=\"red\"> К сожалению, ничего не нашлось. </font> </i>";
					echo "</br>";
				}
				else
				{
					echo "<table width=80% height=80% border =\"1\">";
					echo "</br>";
					echo "</br>";
					echo "<tr>";
					echo "<td> <div> <p align=\"center\">Отпечатки </p> </div> </td>";
					echo "<td> <div> <p align=\"center\">Фамилия </p> </div> </td>";
					echo "<td> <div> <p align=\"center\">Имя </p> </div> </td>";
					echo "<td> <div> <p align=\"center\">Отчество </p> </div> </td>";
					echo "<td> <div> <p align=\"center\">Дата освобождения </p> </div> </td>";
					echo "</tr>";
					while ($row = mysqli_fetch_assoc($result1))
					{
						$ID = $row['ID'];
						echo "<td>";
						echo "<center>";
						echo "<div>$ID</div>";
						echo "</center>";
						echo "</td>";
						$surname = $row['surname'];
						echo "<td>";
						echo "<center>";
						echo "<div>$surname</div>";
						echo "</center>";
						echo "</td>";
						$name = $row['name'];
						echo "<td>";
						echo "<center>";
						echo "<div>$name</div>";
						echo "</center>";
						echo "</td>";
						$patronymic = $row['patronymic'];
						echo "<td>";
						echo "<center>";
						echo "<div>$patronymic</div>";
						echo "</center>";
						echo "</td>";
						$date = $row['free_date'];
						echo "<td>";
						echo "<center>";
						echo "<div>$date</div>";
						echo "</center>";
						echo "</td>";
						echo "</tr>";
						}
						echo "</table>";
						echo "<table width=30% height=30%>";
						echo "<tr><td><p align=\"center\"> <a href=\"freexls.php\">Скачать в формате .xls </a> </p></td>";
						echo "<td><p align=\"center\"> <a href=\"freedoc.php\">Скачать в формате .doc </a> </p></td> </tr></table>";
				}
				$query2 = "DROP TABLE free"; //удаляем таблицу
				$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
			}
			
	}
?>
</form>
<fieldset>
 <legend><h3 align=center> Получить статистику </h3></legend>
<form method="post" action="report.php"> 
 <div>
 <label for="st_num">№ статьи </label>
      <input type="number" maxlength="3" min="1" max="361" name="st_num" required>
      <label for="searchtype"> Период </label>
      <select name="searchtype">
        <option>Выберите тип поиска</option>
        <option value="lastyear">Последний год</option> 
		<option value="all_time">За все время</option> 
      </select>	
    </div> 
	</br>
    <button type="submit" name="show">Показать!</button>
	<?php
	if(isset($_POST['show']))
	{
		$st_num = $_POST['st_num'];
		$name = $_POST['searchtype'];
		if ($name == "lastyear")
		{
			echo "</br>";
			echo "<table width=50% height=50% border =\"1\">";
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\">Сезон </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Количество преступлений </p> </div> </td>";
			echo "</tr>";
			echo "</br>";
			echo "<i>Статистика за последний год по статье номер $st_num: </i>";
			echo "</br>";
			echo "</br>";
			$query = "SELECT * FROM (SELECT * FROM archive WHERE arrest_date >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY)) AS selected WHERE article_number = '$st_num' AND (arrest_date LIKE '%-03-%' OR arrest_date LIKE '%-04-%' OR arrest_date LIKE '%-05-%')"; //весна
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result); //считаем количество строк == количество преступлений
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Весна </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			$query = "SELECT * FROM (SELECT * FROM archive WHERE arrest_date >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY)) AS selected WHERE article_number = '$st_num' AND MONTH(arrest_date)>=6 AND MONTH(arrest_date)<=8"; //лето
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Лето </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			$query = "SELECT * FROM (SELECT * FROM archive WHERE arrest_date >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY)) AS selected WHERE article_number = '$st_num' AND MONTH(arrest_date)>=9 AND MONTH(arrest_date)<=11"; //осень
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Осень </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			$query = "SELECT * FROM (SELECT * FROM archive WHERE arrest_date >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY)) AS selected WHERE article_number = '$st_num' AND (arrest_date LIKE '%-12-%' OR arrest_date LIKE '%-01-%' OR arrest_date LIKE '%-02-%')"; //зима
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Зима </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			$query = "SELECT * FROM (SELECT * FROM archive WHERE arrest_date >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY)) AS selected WHERE article_number = '$st_num' AND (EXTRACT(MONTH FROM arrest_date)*100+EXTRACT(DAY FROM arrest_date)) >= 701 AND (EXTRACT(MONTH FROM arrest_date)*100+EXTRACT(DAY FROM arrest_date))<=914"; //курортный сезон
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Курортный сезон </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			$query = "SELECT * FROM (SELECT * FROM archive WHERE arrest_date >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY)) AS selected WHERE article_number = '$st_num' AND (EXTRACT(MONTH FROM arrest_date)*100+EXTRACT(DAY FROM arrest_date)) >= 101 AND (EXTRACT(MONTH FROM arrest_date)*100+EXTRACT(DAY FROM arrest_date))<=108"; //новогодные праздники
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Новогодние праздники </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			echo "</table>";
		}
		if ($name == "all_time")
		{
			echo "</br>";
			echo "<table width=50% height=50% border =\"1\">";
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\">Сезон </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Количество преступлений </p> </div> </td>";
			echo "</tr>";
			echo "</br>";
			echo "<i>Статистика за все время по статье номер $st_num: </i>";
			echo "</br>";
			echo "</br>";
			$query = "SELECT * FROM archive WHERE article_number = '$st_num' AND (arrest_date LIKE '%-03-%' OR arrest_date LIKE '%-04-%' OR arrest_date LIKE '%-05-%')";
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Весна </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			$query = "SELECT * FROM archive WHERE article_number = '$st_num' AND MONTH(arrest_date)>=6 AND MONTH(arrest_date)<=8";
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Лето </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			$query = "SELECT * FROM archive WHERE article_number = '$st_num' AND MONTH(arrest_date)>=9 AND MONTH(arrest_date)<=11";
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Осень </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			$query = "SELECT * FROM archive WHERE article_number = '$st_num' AND (arrest_date LIKE '%-12-%' OR arrest_date LIKE '%-01-%' OR arrest_date LIKE '%-02-%')";
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Зима </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			$query = "SELECT * FROM archive AS selected WHERE article_number = '$st_num' AND (EXTRACT(MONTH FROM arrest_date)*100+EXTRACT(DAY FROM arrest_date)) >= 701 AND (EXTRACT(MONTH FROM arrest_date)*100+EXTRACT(DAY FROM arrest_date))<=914";
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Курортный сезон </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			$query = "SELECT * FROM archive WHERE article_number = '$st_num' AND (EXTRACT(MONTH FROM arrest_date)*100+EXTRACT(DAY FROM arrest_date)) >= 101 AND (EXTRACT(MONTH FROM arrest_date)*100+EXTRACT(DAY FROM arrest_date))<=108";
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\"> Новогодние праздники </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">$num_rows </p> </div> </td>";
			echo "</tr>";
			echo "</table>";
		}
	}
	?>
</form>
</fieldset>
</br><a href="index.php">На главную</a></br>
</td></tr>
</table>
</body>
<?php
	mysqli_close($link);
?>
</html>