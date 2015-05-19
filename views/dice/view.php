<h3>Просмотр результатов</h3>
<br>
<ul>
<?php 
use yii\helpers\Url;
use yii\widgets\LinkPager;
foreach($experiments as $exp): ?>
  <li>
      <?= "<a href='".Url::toRoute(['dice/view-selected', 'id' => $exp->id_exp])."'>Эсперимент №{$exp->id_exp}</a><br>"; ?>
      <?= "{$exp->date} {$exp->time}<br>"; ?>
  </li>

<?php endforeach; ?>

<?= LinkPager::widget(['pagination'=>$pagination]) ?>

