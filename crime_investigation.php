<!DOCTYPE html>
<!--
-->
<?php
require_once 'connection.php'; // подключаем скрипт
 
$link = mysqli_connect($host, $user, $password, $database) 
    or die("Ошибка " . mysqli_error($link));
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title> Федеральный розыск </title>
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
	<td bgcolor = '#FFE4E1'> <h3 align = center> <a href="crime_investigation.php">Федеральный розыск</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="archive.php">Архив</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="report.php">Отчеты</a> </h3> </td> 
	</tr> </table>
<table width=100% height=100%>
<tr><td align=center>
</br>
<details> <summary> <i> <b> Просмотреть текущее состояние федерального розыска </i> </b> </summary>
<?php
  $query ="SELECT wanted.id, wanted.surname, wanted.name, wanted.patronymic, wanted.article_number, uk.article 
  FROM wanted 
  INNER JOIN uk
  ON uk.article_number = wanted.article_number
  ORDER BY id, surname, name, patronymic";
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
			echo "<td> <div> <p align=\"center\">Отпечатки </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Фамилия </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Имя </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Отчество </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Номер статьи </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Статья </p> </div> </td>";
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
      $st_number = $row['article_number'];
      echo "<td>";
	  echo "<center>";
      echo "<div>$st_number</div>";
	  echo "</center>";
      echo "</td>";
	  $state = $row['article'];
      echo "<td>";
	  echo "<center>";
      echo "<div>$state</div>";
	  echo "</center>";
      echo "</td>";
	  echo "</tr>";
}
	echo "</tr>";
	echo "</table>";
	echo "<table width=30% height=30%>";
	echo "<tr><td><p align=\"center\"> <a href=\"ci_xls.php\">Скачать в формате .xls </a> </p></td>";
	echo "<td><p align=\"center\"> <a href=\"ci_doc.php\">Скачать в формате .doc </a> </p></td> </tr></table>";
	}
?>
	</details>
</br><a href="index.php">На главную</a></br>
</td></tr>
</table>
<?php
	mysqli_close($link);
?>
</body>
</html>