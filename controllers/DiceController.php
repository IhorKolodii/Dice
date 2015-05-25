<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use yii\data\Pagination;
use app\models\Experiment;
use app\models\Result;
use app\models\ExperimentData;
use yii\filters\AccessControl;
use app\filters\MyAccessRule;
use yii\filters\VerbFilter;


class DiceController extends Controller {

  public function behaviors()
    {
         return [
            'access' => [
                'class' => AccessControl::className(),
                'ruleConfig' => [
                    'class' => MyAccessRule::className(),
                ],
                'only' => ['view', 'viewSelected', 'do-exp','exp-results'],
                'rules' => [
                    [
                        'allow' => false,
                        'actions' => ['view', 'viewSelected', 'do-exp','exp-results'],
                        'roles' => ['?'],
                    ],
                    [
                        'allow' => true,
                        'actions' => ['view', 'viewSelected', 'do-exp','exp-results'],
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }
  
  public function actionView() {
    $query = Experiment::find();
    $pagination = new Pagination([
      'defaultPageSize' => 5,
      'totalCount' => $query->count(),
    ]);
    $experiments = $query->orderBy('id_exp')
        ->offset($pagination->offset)
        ->limit($pagination->limit)
        ->all();

    return $this->render('view', [
          'experiments' => $experiments,
          'pagination' => $pagination,
    ]);
  }

  public function actionViewSelected() {
    $id_exp = Yii::$app->request->get('id');
    $exp = Experiment::findOne($id_exp);
    if (!$exp) {
      return "Не найден эксперимент!";
    }
    $results = Result::findAll($id_exp);

    if (!$results) {
      return "Не найдено ни одного результата!";
    }

    return $this->render('viewSelected', [
          'exp' => $exp,
          'results' => $results,
    ]);
  }

  public function actionIndex() {
    return $this->render('index');
  }

  public function actionDoExp() {
    $model = new ExperimentData;
    return $this->render('doExperiment', ['model' => $model]);
  }

  public function actionExpResults() {
    $model = new ExperimentData;
    $model->load(Yii::$app->request->post());
    if (!$model->validate()) {
      return "Ошибка данных!";
    }
    $exp = new Experiment;
    $exp->name = $model->name;
    $exp->dice_num = $model->dices;
    $exp->throws = $model->throws;
    $exp->edge_num = $model->edge_num;
    $exp->date = date("Y-m-d");
    $exp->time = date("H:i:s");
    if ($exp->save()) {
      $score_min = $exp->dice_num;
      $score_max = $exp->dice_num * $exp->edge_num;
      $scores = [];

      for ($i = $score_min; $i <= $score_max; $i++) {
        $scores[$i] = 0;
      }

      for ($i = 0; $i < $exp->throws; $i++) {
        $score = 0;
        for ($j = 0; $j < $exp->dice_num; $j++) {
          $score += rand(1, $exp->edge_num);
        }
        $scores[$score] ++;
      }
      for ($i = $score_min; $i <= $score_max; $i++) {
        $result = new Result;
        $result->id_exp = $exp->id_exp;
        $result->score = $i;
        $result->count = $scores[$i];
        $result->save();
      }

      $results = Result::findAll($exp->id_exp);

      if (!$results) {
        return $this->render("Не найдено ни одного результата!");
      }
      return "<h5>Эксперимент сохранен в базу</h5>" . $this->render('viewSelected', [
            'exp' => $exp,
            'results' => $results,
      ]);
    } else {
      return "Ошибка записи в базу {$exp->id_exp}";
    }
  }
  /*
  public function actionLogin() {
    if (!\Yii::$app->user->isGuest) {
      return $this->goHome();
    }

    $model = new LoginForm();
    if ($model->load(Yii::$app->request->post()) && $model->login()) {
      return $this->goBack();
    } else {
      return $this->render('login', [
            'model' => $model,
      ]);
    }
  }

  public function actionLogout() {
    Yii::$app->user->logout();

    return $this->goHome();
  }

  public function actionSignup() {
    $model = new SignupForm();
    if ($model->load(Yii::$app->request->post())) {
      if ($user = $model->signup()) {
        if (Yii::$app->getUser()->login($user)) {
          return $this->goHome();
        }
      }
    }

    return $this->render('signup', [
          'model' => $model,
    ]);
  }

  public function actionRequestPasswordReset() {
    $model = new PasswordResetRequestForm();
    if ($model->load(Yii::$app->request->post()) && $model->validate()) {
      if ($model->sendEmail()) {
        Yii::$app->getSession()->setFlash('success', 'Check your email for further instructions.');

        return $this->goHome();
      } else {
        Yii::$app->getSession()->setFlash('error', 'Sorry, we are unable to reset password for email provided.');
      }
    }

    return $this->render('requestPasswordResetToken', [
          'model' => $model,
    ]);
  }

  public function actionResetPassword($token) {
    try {
      $model = new ResetPasswordForm($token);
    } catch (InvalidParamException $e) {
      throw new BadRequestHttpException($e->getMessage());
    }

    if ($model->load(Yii::$app->request->post()) && $model->validate() && $model->resetPassword()) {
      Yii::$app->getSession()->setFlash('success', 'New password was saved.');

      return $this->goHome();
    }

    return $this->render('resetPassword', [
          'model' => $model,
    ]);
  }
*/
}
