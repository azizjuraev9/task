<?php

namespace backend\controllers;

use Yii;
use common\models\Params;
use common\models\ParamsSearch;
use yii\base\Model;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ParamsController implements the CRUD actions for Params model.
 */
class ParamsController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            return in_array(Yii::$app->user->identity->username,Yii::$app->params['admins']);
                        }
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Params models.
     * @return mixed
     */
    public function actionIndex()
    {
        $models = Params::find()->all();

        if(Model::loadMultiple($models,Yii::$app->request->post()) && Model::validateMultiple($models)){
            foreach ($models as $model)
                $model->save();
            return $this->refresh();
        }
        return $this->render('index',[
            'models' => $models
        ]);
    }

    /**
     * Updates an existing Params model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionSave()
    {
        $models = Params::find()->all();

        if(Model::loadMultiple($models,Yii::$app->request->post()) && Model::validateMultiple($models)){
            foreach ($models as $model)
                $model->save();
            return $this->refresh();
        }
        return $this->render('index',[
            'models' => $models
        ]);
    }

    /**
     * Finds the Params model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Params the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Params::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
