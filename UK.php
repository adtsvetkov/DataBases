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
        <title> Уголовный кодекс </title>
    </head>
<body>
<table width=100% height=100% border ="1"> 
	<tr>
	<td align=center colspan= "5" bgcolor = '#CAE1FF'>
    <h1 align=center> Картотека уголовного розыска </h1> </td> 
	</tr> 
	<tr>
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="reg.php">Оформление задержанного</a> </h3> </td> 
	<td bgcolor = '#FFE4E1'> <h3 align = center> <a href="UK.php">Уголовный кодекс</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="crime_investigation.php">Федеральный розыск</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="archive.php">Архив</a> </h3> </td> 
	<td bgcolor = '#BCD2EE'> <h3 align = center> <a href="report.php">Отчеты</a> </h3> </td> 
	</tr> </table>
<table width=100% height=100%>
<tr><td align=center>
</br>
<details> <summary> <i> <b> Просмотреть статьи уголовного кодекса </i> </b> </summary>
<?php
	$query ="SELECT * FROM uk";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	echo "<table width=100% height=100% border =\"1\">";
			echo "</br>";
			echo "<tr>";
			echo "<td> <div> <p align=\"center\">Номер статьи </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Статья </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Наказание </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Количество (лет/рублей) </p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Наказание в случае рецидива</p> </div> </td>";
			echo "<td> <div> <p align=\"center\">Количество (лет/рублей) в случае рецидива</p> </div> </td>";
			echo "</tr>";
 while ($row = mysqli_fetch_assoc($result))
	{
      $article_number = $row['article_number'];
      echo "<td>";
	  echo "<center>";
      echo "<div>$article_number</div>";
	  echo "</center>";
      echo "</td>";
      $article = $row['article'];
      echo "<td>";
	  echo "<center>";
      echo "<div>$article</div>";
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
      $relapse = $row['relapse'];
      echo "<td>";
	  echo "<center>";
      echo "<div>$relapse</div>";
	  echo "</center>";
      echo "</td>";
	  $relapse_para = $row['relapse_para'];
      echo "<td>";
	  echo "<center>";
      echo "<div>$relapse_para</div>";
	  echo "</center>";
      echo "</td>";
	  echo "</tr>";
	}
	echo "</tr>";
	echo "</table>";
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