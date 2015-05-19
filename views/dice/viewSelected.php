<h3>Просмотр результатов</h3>
<br>
<?php use yii\helpers\Url; 
$max = (int)$exp->edge_num * (int)$exp->dice_num;

?>

Эксперимент № <?= $exp->id_exp ?><br>
Эксперимент проводил: <?= $exp->name ?><br>
Дата: <?= $exp->date, " ",$exp->time ?><br>
Количество бросаемых костей: <?= $exp->dice_num ?><br>
Количество бросков: <?= $exp->throws ?><br>
Количество граней каждого кубика: <?= $exp->edge_num ?><br>
Минимально возможное количество очков: <?= $exp->dice_num ?><br>
Максимально возможное количество очков: <?= $max ?><br>
<center><h4>Статистика:</h4></center>
<table border='2' align='center'><tr><th>Кол-во очков</th><th>Выпало раз</th><th>Относительно числа бросков, %</th></tr>
  <?php foreach($results as $result): ?>
    <tr><td><?= $result->score  ?></td><td><?= $result->count  ?></td><td><?= $result->count/$exp->throws*100  ?></td></tr>
  <?php endforeach; ?>
</table><br><br>