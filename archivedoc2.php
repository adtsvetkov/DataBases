<?php
	header ("Content-type: application/ms-word");
	header ('Content-Disposition: attachment; filename="archive_year.doc"');
	require_once 'connection.php';
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
	$query ="SELECT * FROM archive WHERE arrest_date >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY) ORDER BY arrest_date DESC";
	$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
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
	mysqli_close($link);
?>