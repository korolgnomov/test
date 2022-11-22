<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<div>
<form action="" method="$_POST">
<?php 
     $dateComponents = getdate();
     $month = $dateComponents['month']; 
     $year = $dateComponents['year'];
     $daysOfWeek = array('Mon','Tue','Wed','Thu','Fri','Sat','Sun');
     $firstDayOfMonth = mktime(0,0,0, $dateComponents['mon'] ,1,$year);
     $numberDays = date('t',$firstDayOfMonth);
     $calendar = "<caption valign='top'>$month $year</caption>";
     $calendar .= "<table class='calendar'>";
     
     $calendar .= "<tr>";
     foreach($daysOfWeek as $day) {
          $calendar .= "<th class='header'>$day</th>";
     } 
     $currentDay = 1;
     $calendar .= "</tr><tr>";
     $monthsfirstday = $dateComponents['wday'];
     if ($monthsfirstday > 0) { 
          $calendar .= "<td colspan='$monthsfirstday'>&nbsp;</td>"; 
     }
       while ($currentDay <= $numberDays) {
          if ($monthsfirstday == 7) {
               $monthsfirstday = 0;
               $calendar .= "</tr><tr>";
          }
 
     $calendar.= "<td class='footer'><a href='schedule.php?day=$currentDay'>
     $currentDay
     </a></td>";
     $currentDay++;
     $monthsfirstday++;
     }
     $calendar .= "</tr>";
     $calendar .= "</table>";
     echo $calendar
?>
</form>
</div>


</body>
</html>
<?php 

$link =  mysqli_connect("localhost","root","Znekit192837n","test");
if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    print("Соединение установлено успешно");
}

$sql="SELECT * FROM `subjects`";
$result=mysqli_query($link,$sql);
?>
<div> 
    <form action='' method='POST'>
    <input type="datetime-local" name='date' id="vvod">
    <select name='subject' id="select">
      <?php  while($rows =mysqli_fetch_array($result)){ ?>
<option value="<?php  echo $rows['id'] ?>"><?php  echo $rows['title'] ?></option>
      
       <?php
       }
      ?>
    </select>
    <button type="submit" name="savesubmit">отправить</button>
    </form>

<?php 
if (isset($_POST['savesubmit'])&&isset($_POST['date'])&&isset($_POST['subject'])){
    $date=$_POST['date'];
    $subject=$_POST['subject'];
    $query="INSERT INTO schedule (id_subject, date) VALUES('$subject','$date')";
    $query_run=mysqli_query($link,$query);
    }

?>

</div>