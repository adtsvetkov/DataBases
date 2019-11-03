<?php
	header ("Content-type: application/ms-excel");
	header ('Content-Disposition: attachment; filename="crime_investigation.xls"');
	require_once 'connection.php';
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	$query ="SELECT wanted.id, wanted.surname, wanted.name, wanted.patronymic, wanted.article_number, uk.article 
  FROM wanted 
  INNER JOIN uk
  ON uk.article_number = wanted.article_number
  ORDER BY surname, name, patronymic";
  $result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
	echo "</br>";
	echo "<i>Текущее состояние федерального розыска: </i>";
	echo "</br>";
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
	mysqli_close($link);
?>