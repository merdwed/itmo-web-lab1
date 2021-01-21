<?php

//стартуем микросекундомерчик
$start = microtime(true);
//вата и дремя 
date_default_timezone_set('Europe/Moscow');
$now= date('d.m.y H:i'); 
//получаем параметры из index.php
if(isset($_GET['coordX']) and isset($_GET['coordY']) and isset($_GET['paramR'])){
    $coordX=(float)$_GET['coordX'];
    $coordY=(float)str_replace(',','.',$_GET['coordY']);
    $paramR=(float)$_GET['paramR'];
    $hit=false;
    //1 четверть
    if(($coordX >= 0) and ($coordY >= 0) and ($coordX <= $paramR/2) and ($coordY <= $paramR)){
        $hit=true;
    }
    else
    if(($coordX <= 0) and ($coordY >= 0) and ($coordX * $coordX + $coordY * $coordY <= $paramR)){
        $hit=true;
    }
    else
    if(($coordX <= 0) and ($coordY <= 0) and ($coordY >= -2 * $coordX - $paramR)){
        $hit=true;
    }
    //просто бессмысленное действие чтобы набить побольше времени выполнения. А то оно == 0
    for($i=0;$i<100000;$i++)
    $a=sqrt($i);
    


    if (!isset($_SESSION['counter']))
        $_SESSION['counter']=0;
    if (!isset($_SESSION['table']))
        $_SESSION['table']=array();

    //увеличиваем количество строчек в таблице
    $ses=$_SESSION['counter'];
    $_SESSION['counter']++;
    

    if($hit)
        $message="Есть попадание, Капитан!";
    else
        $message="промах, Сэр!";

    //финишируем микросекундомерчик
    $finish = microtime(true);
    $timeWork=round($finish-$start,6);





    $_SESSION['table'][$ses]= 
    "<tr>
    <td> $now</td>
    <td> $timeWork с</td>
    <td> $coordX </td>
    <td> $coordY </td>
    <td> $paramR </td>
    <td> $message </td>
    </tr>";
    
}
else{
    $message="приветствуем вас";
}
?>
<h3><?php echo $message; ?></h3>
<br>

<table>
    <tr>
        <td>Дата и время запроса</td>
        <td>Время выполнения</td>
        <td>Координата X</td>
        <td>Координата Y</td>
        <td>Параметр R</td>
        <td>Результат</td>
    </tr>
    <?php 
	//таблица истории введённых значений. Работает на костылях и некрасиво, но работает
    for($i=$_SESSION['counter']-1;$i>=0;$i--){
        if(isset($_SESSION['table'][$i]))
            echo $_SESSION['table'][$i];
    }
    ?>
    
</table>
