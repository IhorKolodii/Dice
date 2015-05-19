<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['action' => ['dice/exp-results']]); ?>
    <?= $form->field($model, 'name', ['options' => ['style'=>'max-width: 400px']])->textInput(['value'=> 'Экспериментатор']) ?>
    <?= $form->field($model, 'dices', ['options' => ['style'=>'max-width: 400px']])->textInput(['value'=> '2']) ?>
    <?= $form->field($model, 'throws', ['options' => ['style'=>'max-width: 400px']])->textInput(['value'=> '36000']) ?>
    <?= $form->field($model, 'edge_num', ['options' => ['style'=>'max-width: 400px']])->textInput(['value'=> '6']) ?>
    <div class="form-group">
        <?= Html::submitButton('Эксперимент!',
		['class' => 'btn btn-primary']) ?>
    </div>
<?php ActiveForm::end(); ?>