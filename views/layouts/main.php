<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\widgets\Alert;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'Yii Task 1. Practice 1: Yii basics',
                'brandUrl' => ['/dice/index'],
                'options' => [
                    'class' => 'navbar-inverse navbar-fixed-top',
                ],
            ]);
            
            $navItems=[
                ['label' => 'Провести эксперимент', 'url' => ['/dice/do-exp']],
                ['label' => 'Результаты', 'url' => ['/dice/view']]
              ];
              if (Yii::$app->user->isGuest) {
                array_push($navItems,['label' => 'Вход', 'url' => ['/user/security/login']],['label' => 'Зарегистрироваться', 'url' => ['/user/registration/register']]);
              } else {
                array_push($navItems,['label' => 'Выход (' . Yii::$app->user->identity->username . ')',
                    'url' => ['/user/security/logout'],
                    'linkOptions' => ['data-method' => 'post']]
                );
              }
              if(!Yii::$app->user->isGuest && Yii::$app->user->identity->isAdmin) {
                  array_push($navItems,['label' => 'Админка',
                          'url' => ['/user/admin/index'],
                          'linkOptions' => ['data-method' => 'post']]
                  );
              }
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => $navItems
            ]);
            NavBar::end();
        ?>

        <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
        <p class="pull-left">&copy; Kolodiy Igor <?= date('Y') ?></p>
        <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
