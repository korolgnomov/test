<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">

</head>
<body>
    <?php 
if (isset($_GET['day'])) {

  $curr=$_GET['day'];

}
$date =getdate();
$date['d']=$curr;

$link =  mysqli_connect("localhost","root","Znekit192837n","test");
if ($link == false){
    print("Ошибка: Невозможно подключиться к MySQL " . mysqli_connect_error());
}
else {
    
}
  $currentdate=$date['year'];
 $currentdate.="-";
 $currentdate.=$date['mon'];
 $currentdate.="-";
 if($curr<10){
  $currentdate.='0';
}
 $currentdate.=$curr;
 //$currentdate2= strtotime($currentdate);
//print($currentdate2);

$i=0;
$sql="(SELECT * FROM schedule LEFT JOIN subjects ON schedule.id_subject=subjects.id)";
$result=mysqli_query($link,$sql);
$sql="(SELECT * FROM subjects_to_specialities JOIN specialities ON subjects_to_specialities.id_speciality=specialities.id)";
$result2=mysqli_query($link,$sql);
 $calendar = "<caption valign='top'>Экзамены на $currentdate</caption>";
$calendar .= "<table class='tabl'>";
$calendar .= "<tr><th class='sch'>дата экза</th><th class='sch'>предмет</th><th class='sch'>специальность</th></tr>";
while($rows=mysqli_fetch_assoc($result)){
 
  $row = substr($rows['date'], 0, 10);
 
  if($currentdate==$row){
    $rowstabledate=$rows['date'];
    $rowstablesub=$rows['title'];
    $calendar .= "<tr><td class ='scf'> $rowstabledate</td><td class ='scf'>$rowstablesub</td><td>";
     $result2=mysqli_query($link,$sql);
    while ($rows2=mysqli_fetch_assoc($result2)){
    if ($rows['id_subject']==$rows2['id_subject']){
       $rowstablespec=$rows2['title'];
       $calendar .= $rowstablespec;
       $calendar .= "<br>";
    }
   }
   $i++;
  }
   $calendar .=  "</td></tr>";
}
if($i==0){
  $calendar="экзаменов $currentdate нет";  
}

echo $calendar ;
?>
</body>
</html>
