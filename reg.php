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
        <title> Оформление задержанного </title>
    </head>
<body>
<table width=100% height=100% border ="1"> 
	<tr>
	<td align=center colspan= "5" bgcolor = '#CAE1FF'>
    <h1 align=center> Картотека уголовного розыска </h1> </td> 
	</tr> 
	<tr>
	<td bgcolor = '#FFE4E1'> <h3 align = center> <a href="reg.php">Оформление задержанного</a> </h3> </td>
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="UK.php">Уголовный кодекс</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="crime_investigation.php">Федеральный розыск</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="archive.php">Архив</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="report.php">Отчеты</a> </h3> </td> 
	</tr> </table>
<table width=100% height=100%>
<tr><td align=center>
<fieldset>
 <legend><h3 align=center> Оформление задержанного </h3></legend>
 <form method="post" action="reg.php">
 <div>
      <label for="surname">Фамилия</label>
      <input type="text" name="surname" required placeholder="Иванов" maxlength = "50">
      <label for="name">Имя</label>
      <input type="text" name="name" required placeholder="Иван" maxlength = "50">
      <label for="patronymic">Отчество</label>
      <input type="text" name="patronymic" placeholder="не обязательно" maxlength = "50">
	  </br>
	<div>
	</br>
      <label for="date">Дата ареста</label>
      <input type="date" name="date" required>
    </div>
	</br>
	<div>
      <label for="ID">ID задержанного</label>
      <input type="number" maxlength="8" min="1" max="99999999" name="ID" required>
    </div>
	</br>
	<div>
      <label for="clause">№ статьи </label>
      <input type="number" maxlength="3" min="1" max="361" name="clause" required>
    </div>
	</br>
    <button type="submit" name = "add">Добавить</button>
	<button type="reset">Сбросить</button>
</form>
<?php
	if (isset($_POST['add']))
	{
		$surname = $_POST['surname'];
		$name = $_POST['name'];
		$patronymic = $_POST['patronymic'];
		$date = $_POST['date'];
		$ID = $_POST['ID'];
		$st_num = $_POST['clause'];
		$date1 = date('Y-m-d');
		if ($date > $date1)
		{
			echo "</br>";
			echo "<i> <font color=\"red\">Произошла ошибка: дата не может быть больше текущей </font> </i>";
			echo "</br>";
		}
		else
		{
			$query = "SELECT * FROM archive WHERE id = '$ID' AND punishment = 'расстрел'";
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			$query1 = "SELECT * FROM archive WHERE id = '$ID'";
			$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link));
			$num_rows1 = mysqli_num_rows($result1);
			$query2 = "SELECT * FROM wanted WHERE id = '$ID'";
			$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
			$num_rows2 = mysqli_num_rows($result2);
			if ($num_rows !=NULL)
			{
				if ($num_rows2!=NULL) 
				{
					$querydel = "DELETE FROM wanted WHERE id = '$ID'";
					mysqli_query($link, $querydel) or die("Ошибка " . mysqli_error($link));
				}
				echo "</br></br>";
				echo "<i> <font color=\"red\"> Произошла ошибка: попавшийся был расстрелян </font> </i>";
				echo "</br></br>";
			}
			else
			{
				if (($num_rows1 == NULL) && ($num_rows2 == NULL))
				{
					$query3 = "SELECT * FROM uk WHERE article_number = '$st_num'";
					$result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
					$row3 = mysqli_fetch_assoc($result3);
					$punishment3 = $row3['punishment'];
					$punish_para3 = $row3['punish_para'];
					mysqli_query($link, "INSERT INTO archive (ID, surname, name, patronymic, arrest_date, article_number, punishment, punish_para) VALUES ('$ID', '$surname', '$name', '$patronymic', '$date', '$st_num', '$punishment3', '$punish_para3')");
					echo "</br></br>";
					echo "<i> <font color=\"green\"> Успешно! Приговор: </font> </i>";
					if ($punishment3 == 'расстрел') echo "<i> <font color=\"green\"> расстрел. </font> </i>";
					if ($punishment3 == 'тюрьма') echo "<i> <font color=\"green\"> в тюрьму. Количество лет: $punish_para3 </font> </i>";
					if ($punishment3 == 'штраф') echo "<i> <font color=\"green\"> штраф в размере $punish_para3 рублей.</font> </i>";
					echo "</br></br>";
				}
				if (($num_rows1 != NULL) && ($num_rows2 == NULL))
				{
					$query3 = "SELECT * FROM uk WHERE article_number = '$st_num'";
					$result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
					$row3 = mysqli_fetch_assoc($result3);
					$punishment3 = $row3['relapse'];
					$punish_para3 = $row3['relapse_para'];
					mysqli_query($link, "INSERT INTO archive (ID, surname, name, patronymic, arrest_date, article_number, punishment, punish_para) VALUES ('$ID', '$surname', '$name', '$patronymic', '$date', '$st_num', '$punishment3', '$punish_para3')");
					echo "</br></br>";
					echo "<i> <font color=\"green\"> Успешно! Приговор: </font> </i>";
					if ($punishment3 == 'расстрел') echo "<i> <font color=\"green\"> расстрел. </font> </i>";
					if ($punishment3 == 'тюрьма') echo "<i> <font color=\"green\"> в тюрьму. Количество лет: $punish_para3 </font> </i>";
					if ($punishment3 == 'штраф') echo "<i> <font color=\"green\"> штраф в размере $punish_para3 рублей.</font> </i>";
					echo "</br></br>";
				}
				if (($num_rows1 == NULL) && ($num_rows2 != NULL))
				{
					$prison_count = 0;
					$rustrell_count = 0;
					$tax_count = 0;
					$query3 = "SELECT * FROM uk WHERE article_number = '$st_num'";
					$result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
					$row3 = mysqli_fetch_assoc($result3);
					$punishment3 = $row3['punishment'];
					$punish_para3 = $row3['punish_para'];
					if ($punishment3 == 'тюрьма') 
					{
						$punishment3 = 'федеральная тюрьма';
						$prison_count += $punish_para3;
					}
					if ($punishment3 == 'штраф') $tax_count+= $punish_para3;
					if ($punishment3 == 'расстрел') $rustrell_count = 1;
					mysqli_query($link, "INSERT INTO archive (ID, surname, name, patronymic, arrest_date, article_number, punishment, punish_para) VALUES ('$ID', '$surname', '$name', '$patronymic', '$date', '$st_num', '$punishment3', '$punish_para3')");
					while ($row2 = mysqli_fetch_assoc($result2)) //поиск по ID в федеральном списке 
					{
						$surname2 = $row2['surname'];
						$name2 = $row2['name'];
						$patronymic2 = $row2['patronymic'];
						$st_num2 = $row2['article_number'];
						$query3 = "SELECT * FROM uk WHERE article_number = '$st_num2'";
						$result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
						$row3 = mysqli_fetch_assoc($result3);
						$punishment3 = $row3['punishment'];
						$punish_para3 = $row3['punish_para'];
						if ($punishment3 == 'тюрьма') 
						{
							$punishment3 = 'федеральная тюрьма';
							$prison_count += $punish_para3;
						}
						if ($punishment3 == 'штраф') $tax_count+= $punish_para3;
						if ($punishment3 == 'расстрел') $rustrell_count = 1;
						mysqli_query($link, "INSERT INTO archive (ID, surname, name, patronymic, arrest_date, article_number, punishment, punish_para) VALUES ('$ID', '$surname2', '$name2', '$patronymic2', '$date', '$st_num2', '$punishment3', '$punish_para3')");
					}
					echo "</br></br>";
					echo "<i> <font color=\"green\"> Успешно! Приговор: </font> </i>";
					if ($rustrell_count!= NULL) echo "<i> <font color=\"green\"> Расстрел. </font> </i>";
					else
					{
						if ($prison_count != NULL) echo "<i> <font color=\"green\"> В федеральную тюрьму. Количество лет: $prison_count </font> </i> </br>";
					}
					if ($tax_count != NULL) echo "<i> <font color=\"green\"> Штраф в размере $tax_count рублей.</font> </i>";
					echo "</br></br>";
					$querydel = "DELETE FROM wanted WHERE id = '$ID'";
					mysqli_query($link, $querydel) or die("Ошибка " . mysqli_error($link));
				}
				if (($num_rows1 != NULL) && ($num_rows2 != NULL))
				{
					$prison_count = 0;
					$rustrell_count = 0;
					$tax_count = 0;
					$query3 = "SELECT * FROM uk WHERE article_number = '$st_num'";
					$result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
					$row3 = mysqli_fetch_assoc($result3);
					$punishment3 = $row3['relapse'];
					$punish_para3 = $row3['relapse_para'];
					if ($punishment3 == 'тюрьма') 
					{
						$punishment3 = 'федеральная тюрьма';
						$prison_count += $punish_para3;
					}
					if ($punishment3 == 'штраф') $tax_count+= $punish_para3;
					if ($punishment3 == 'расстрел') $rustrell_count = 1;
					mysqli_query($link, "INSERT INTO archive (ID, surname, name, patronymic, arrest_date, article_number, punishment, punish_para) VALUES ('$ID', '$surname', '$name', '$patronymic', '$date', '$st_num', '$punishment3', '$punish_para3')");
					while ($row2 = mysqli_fetch_assoc($result2)) //поиск по ID в федеральном списке 
					{
						$surname2 = $row2['surname'];
						$name2 = $row2['name'];
						$patronymic2 = $row2['patronymic'];
						$st_num2 = $row2['article_number'];
						$query3 = "SELECT * FROM uk WHERE article_number = '$st_num2'";
						$result3 = mysqli_query($link, $query3) or die("Ошибка " . mysqli_error($link));
						$row3 = mysqli_fetch_assoc($result3);
						$punishment3 = $row3['relapse'];
						$punish_para3 = $row3['relapse_para'];
						if ($punishment3 == 'тюрьма') 
						{
							$punishment3 = 'федеральная тюрьма';
							$prison_count += $punish_para3;
						}
						if ($punishment3 == 'штраф') $tax_count+= $punish_para3;
						if ($punishment3 == 'расстрел') $rustrell_count = 1;
						mysqli_query($link, "INSERT INTO archive (ID, surname, name, patronymic, arrest_date, article_number, punishment, punish_para) VALUES ('$ID', '$surname2', '$name2', '$patronymic2', '$date', '$st_num2', '$punishment3', '$punish_para3')");
					}
					echo "</br></br>";
					echo "<i> <font color=\"green\"> Успешно! Приговор: </font> </i>";
					if ($rustrell_count!= NULL) echo "<i> <font color=\"green\"> Расстрел. </font> </i>";
					else
					{
						if ($prison_count != NULL) echo "<i> <font color=\"green\"> В федеральную тюрьму. Количество лет: $prison_count </font> </i> </br>";
					}
					if ($tax_count != NULL) echo "<i> <font color=\"green\"> Штраф в размере $tax_count рублей.</font> </i>";
					echo "</br></br>";
					$querydel = "DELETE FROM wanted WHERE id = '$ID'";
					mysqli_query($link, $querydel) or die("Ошибка " . mysqli_error($link));
				}
			}
		}
	}
?>
 </fieldset>
<fieldset>
<legend><h3 align=center> Показать попавшихся в течение дня </h3></legend>
<form method="post" action="reg.php">
<label for="date1">Введите день: </label>
<input type="date" name="date1" required>
</br>
</br>
<button type="submit" name = "show">Показать!</button>
</br>
</form>
<?php
	if(isset($_POST['show']))
		{
			$date = $_POST['date1'];
			$query = "SELECT archive.id, archive.surname, archive.name, archive.patronymic, archive.arrest_date, archive.article_number, archive.punishment, archive.punish_para, uk.article 
			FROM archive 
			INNER JOIN uk 
			ON uk.article_number = archive.article_number WHERE arrest_date = '$date' 
			ORDER BY archive.surname, archive.name, archive.patronymic";
			$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
			$num_rows = mysqli_num_rows($result);
			if ($num_rows == NULL)
			{
				echo "</br>";
				echo "<i> <font color=\"red\"> К сожалению, ничего не нашлось. </font> </i>";
				echo "</br>";
			}
			else
			{
				echo "<table width=80% height=80% border =\"1\">";
				echo "</br>";
				echo "<tr>";
				echo "<td> <div> <p align=\"center\">Отпечатки </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Фамилия </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Имя </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Отчество </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Дата задержания </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Номер статьи </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Статья </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Наказание </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Количество (лет/рублей) </p> </div> </td>";
				echo "</tr>";
				while ($row = mysqli_fetch_assoc($result))
				{
				$ID = $row['id'];
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
				$date = $row['arrest_date'];
				echo "<td>";
				echo "<center>";
				echo "<div>$date</div>";
				echo "</center>";
				echo "</td>";
				$st_number = $row['article_number'];
				echo "<td>";
				echo "<center>";
				echo "<div>$st_number</div>";
				echo "</center>";
				echo "</td>";
				$st_desc = $row['article'];
				echo "<td>";
				echo "<center>";
				echo "<div>$st_desc</div>";
				echo "</center>";
				echo "</td>";
				$punishment = $row['punishment'];
				echo "<td>";
				echo "<center>";
				echo "<div>$punishment</div>";
				echo "</center>";
				echo "</td>";
				$punish_para = $row['punish_para'];
				echo "<td>";
				echo "<center>";
				echo "<div>$punish_para</div>";
				echo "</center>";
				echo "</td>";
				echo "</tr>";
				}
			echo "</table>";
			echo "</br>";
			}
		}
?>
</fieldset>
</br><a href="index.php">На главную</a></br>
</td></tr>
</table>
</body>
<?php
	mysqli_close($link);
?>
</html>