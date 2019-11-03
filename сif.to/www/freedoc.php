<?php
	header ("Content-type: application/ms-word");
	header ('Content-Disposition: attachment; filename="free.doc"');
	require_once 'connection.php';
	$link = mysqli_connect($host, $user, $password, $database) or die("Ошибка " . mysqli_error($link));
		$query ="SELECT * FROM (SELECT * FROM ARCHIVE WHERE ID NOT IN (SELECT ARCHIVE.ID FROM ARCHIVE WHERE punishment =  'расстрел')) AS NORUSTRELL WHERE punishment = 'тюрьма' OR punishment = 'федеральная тюрьма' ORDER BY id, arrest_date";
		$result = mysqli_query($link, $query) or die("Ошибка " . mysqli_error($link));
				$table = "CREATE TABLE free 
					(
						num INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
						ID INT(8) NOT NULL,
						surname VARCHAR(50) NOT NULL, 
						name VARCHAR(50) NOT NULL,	
						patronymic VARCHAR(50) DEFAULT NULL,
						free_date DATE NOT NULL
					)";
				$tableres = mysqli_query($link, $table) or die("Ошибка " . mysqli_error($link));
				$row = mysqli_fetch_assoc($result);
				while ($row != NULL)
				{
					$ID = $row['ID'];
					$surname = $row['surname'];
					$name = $row['name'];
					$patronymic = $row['patronymic'];
					$realdate = NULL;
					$realsrok = NULL;
					$currentdate = NULL;
					$currentsrok = NULL;
					$n = 0;
					do
					{
						$currentdate = $row['arrest_date'];
						$currentsrok = $row['punish_para'];
						if ($realsrok == NULL) $realsrok = $currentsrok;
						if ($realdate == NULL) $realdate = $currentdate;
						if ($n!=0)
						{
							if (strtotime("$realdate + $realsrok year") <= strtotime("$currentdate"))
							{
								$realdate = $currentdate;
								$realsrok = $currentsrok;
							}
							else $realsrok+=$currentsrok;
						}
						$n++;
						$row = mysqli_fetch_assoc($result);
					} while ($row['ID'] == $ID);
					$free_datesec = strtotime("$realdate + $realsrok year");
					if (($free_datesec > strtotime("now")) && ($free_datesec<= strtotime("now+1 month")))
					{
						$free_date = date("Y-m-d", $free_datesec);
						$filltable = "INSERT INTO free (ID, surname, name, patronymic, free_date) VALUES ('$ID', '$surname', '$name', '$patronymic', '$free_date')";
						$filltableres = mysqli_query($link, $filltable) or die("Ошибка " . mysqli_error($link));
					}
				}
				$query1 = "SELECT * FROM free ORDER BY free_date";
				$result1 = mysqli_query($link, $query1) or die("Ошибка " . mysqli_error($link));
				$num_rows1 = mysqli_num_rows($result1);
					echo "</br>";
					echo "<i>Отпускаемые на свободу в ближайший месяц: </i>";
					echo "</br>";
					echo "<table width=80% height=80% border =\"1\">";
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
				$query2 = "DROP TABLE free";
				$result2 = mysqli_query($link, $query2) or die("Ошибка " . mysqli_error($link));
				mysqli_close($link);
?>