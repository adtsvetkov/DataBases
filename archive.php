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
        <title> Архив задержанных </title>
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
	<td bgcolor = '#FFE4E1'> <h3 align = center> <a href="archive.php">Архив</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="report.php">Отчеты</a> </h3> </td> 
	</tr> 
</table>
<table width=100% height=100%>
<tr><td align=center>
<fieldset>
 <legend><h3 align=center> Поиск по архиву </h3></legend>
 <form method="post" action="archive.php">
 <i> Введите ФИО для поиска: </i>
 </br>
 </br>
 <div>
      <label for="surname">Фамилия</label>
      <input type="text" name="surname" required>
      <label for="name">Имя</label>
      <input type="text" name="name" required>
      <label for="patronymic">Отчество</label>
      <input type="text" name="patronymic">
	  </br>
	  </br>
	  <button type="submit" name = "find1">Найти!</button>
	  <div>
	  <?php
		if(isset($_POST['find1']))
		{
			$surname1 = $_POST['surname'];
			$name1 = $_POST['name'];
			$patronymic1 = $_POST['patronymic'];
			if ($patronymic1 == NULL)
			{
				$query ="SELECT * FROM archive WHERE surname = '$surname1' AND name = '$name1' ORDER BY arrest_date DESC";
			}
			else 
			{
				$query = "SELECT * FROM archive WHERE surname = '$surname1' AND name = '$name1' AND patronymic = '$patronymic1' ORDER BY arrest_date DESC";
			}
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
			echo "<table width=75% height=75% border =\"1\">";
			echo "</br>";
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\">Номер записи </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Отпечатки </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Фамилия </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Имя </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Отчество </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Дата задержания </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Номер статьи </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Наказание </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Количество (лет/рублей) </p> </div> </td>";
			echo "</tr>";
			while ($row = mysqli_fetch_assoc($result))
			{
				$number = $row['note_number'];
				echo "<tr>";
				echo "<td>";
				echo "<center>";
				echo "<div>$number</div>";
				echo "</center>";
				echo "</td>";
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
				$nak = $row['punishment'];
				echo "<td>";
				echo "<center>";
				echo "<div>$nak</div>";
				echo "</center>";
				echo "</td>";
				$para = $row['punish_para'];
				echo "<td>";
				echo "<center>";
				echo "<div>$para</div>";
				echo "</center>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			}
		}
?>
</br>
</form>
	 <form method="post" action="archive.php">
	  <i> Введите ID для поиска: </i>
		</br>
		</br>
      <label for="ID">ID задержанного</label>
      <input type="number" maxlength="8" min="1" max="99999999" name="ID" required>
    </div>
	</br>
    <button type="submit" name = "find2">Найти!</button>
	</br>
<?php
	if(isset($_POST['find2']))
		{
			$ID1 = $_POST['ID'];
			$query = "SELECT * FROM archive WHERE ID = '$ID1' ORDER BY arrest_date DESC";
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
			echo "<table width=75% height=75% border =\"1\">";
			echo "</br>";
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\">Номер записи </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Отпечатки </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Фамилия </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Имя </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Отчество </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Дата задержания </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Номер статьи </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Наказание </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Количество (лет/рублей) </p> </div> </td>";
			echo "</tr>";
			while ($row = mysqli_fetch_assoc($result))
			{
				$number = $row['note_number'];
				echo "<tr>";
				echo "<td>";
				echo "<center>";
				echo "<div>$number</div>";
				echo "</center>";
				echo "</td>";
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
				$nak = $row['punishment'];
				echo "<td>";
				echo "<center>";
				echo "<div>$nak</div>";
				echo "</center>";
				echo "</td>";
				$para = $row['punish_para'];
				echo "<td>";
				echo "<center>";
				echo "<div>$para</div>";
				echo "</center>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "</br>";
			}
		}
?>
</form>
</fieldset>
</td>
</tr>
<tr><td align=center>
<fieldset>
 <legend><h3 align=center> Просмотр архива </h3></legend>
<form  method="post" action="archive.php"> 
 <div>
      <label for="searchtype">Парметры отображения</label>
      <select name="searchtype">
        <option>Выберите тип поиска</option>
        <option value="lastmonth"> Последний месяц </option>
		<option value="lastyear">Последний год</option>
      </select> 
    </div> 
	</br>
    <button type="submit" name = "show">Показать!</button>
	<?php
	if(isset($_POST['show']))
	{
		$name = $_POST['searchtype'];
		echo "</br>";
		if ($name == "lastmonth")
		{
			$query ="SELECT * FROM archive WHERE arrest_date >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY) ORDER BY arrest_date DESC";
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
				echo "</br>";
				echo "<i>Данные из архива за последний месяц: </i>";
				echo "</br>";
			echo "<table width=75% height=75% border =\"1\">";
			echo "</br>";
			echo "<tr>"; 
			echo "<td> <div> <p align=\"center\">Номер записи </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Отпечатки </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Фамилия </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Имя </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Отчество </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Дата задержания </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Номер статьи </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Наказание </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Количество (лет/рублей) </p> </div> </td>";
			echo "</tr>";
			while ($row = mysqli_fetch_assoc($result))
			{
				$number = $row['note_number'];
				echo "<tr>";
				echo "<td>";
				echo "<center>";
				echo "<div>$number</div>";
				echo "</center>";
				echo "</td>";
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
				$nak = $row['punishment'];
				echo "<td>";
				echo "<center>";
				echo "<div>$nak</div>";
				echo "</center>";
				echo "</td>";
				$para = $row['punish_para'];
				echo "<td>";
				echo "<center>";
				echo "<div>$para</div>";
				echo "</center>";
				echo "</td>";
				echo "</tr>";
			}
			echo "</table>";
			echo "</br>";
			echo "<table width=30% height=30%>";
			echo "<tr><td><p align=\"center\"> <a href=\"archivexls1.php\">Скачать в формате .xls </a> </p></td>";
			echo "<td><p align=\"center\"> <a href=\"archivedoc1.php\">Скачать в формате .doc </a> </p></td> </tr></table>";
		}}
		if ($name == "lastyear")
		{
			$query ="SELECT * FROM archive WHERE arrest_date >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY) ORDER BY arrest_date DESC";
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
				echo "</br>";
				echo "<i>Данные из архива за последний год: </i>";
				echo "</br>";
				echo "<table width=75% height=75% border =\"1\">";
				echo "</br>";
				echo "<tr>"; 
				echo "<td> <div> <p align=\"center\">Номер записи </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Отпечатки </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Фамилия </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Имя </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Отчество </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Дата задержания </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Номер статьи </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Наказание </p> </div> </td>";
				echo "<td> <div> <p align=\"center\">Количество (лет/рублей) </p> </div> </td>";
				echo "</tr>";
				while ($row = mysqli_fetch_assoc($result))
				{
				$number = $row['note_number'];
				echo "<tr>";
				echo "<td>";
				echo "<center>";
				echo "<div>$number</div>";
				echo "</center>";
				echo "</td>";
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
				$nak = $row['punishment'];
				echo "<td>";
				echo "<center>";
				echo "<div>$nak</div>";
				echo "</center>";
				echo "</td>";
				$para = $row['punish_para'];
				echo "<td>";
				echo "<center>";
				echo "<div>$para</div>";
				echo "</center>";
				echo "</td>";
				echo "</tr>";
				}
			echo "</table>";
			echo "</br>";
			echo "<table width=30% height=30%>";
			echo "<tr><td><p align=\"center\"> <a href=\"archivexls2.php\">Скачать в формате .xls </a> </p></td>";
			echo "<td><p align=\"center\"> <a href=\"archivedoc2.php\">Скачать в формате .doc </a> </p></td> </tr></table>";
			}
		}
	}
?>
</form>
</fieldset>
</td> </tr>
<td align = center>
</br><a href="index.php">На главную</a></br>
</td></tr>
</table>
</body>
<?php
	mysqli_close($link);
?>
</html>