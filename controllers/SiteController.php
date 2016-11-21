<?php

namespace app\controllers;

use app\services\notam\NOTAMService;
use yii\web\Controller;
use app\models\IndexInputModel;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    /**
     * Displays index page.
     *
     * @return string
     */
    public function actionIndex()
    {
        $service = new NOTAMService(['ICAO' => 'EGKA']);
        $model = new IndexInputModel();
        $service->getICAOData();  exit;
        return $this->render('index', ['model' => $model]);
    }


    /**
     * Return in
     * @throws \yii\web\HttpException
     */
    public function actionGetIcaoInfo(){

        /** @var IndexInputModel $model used for input validation*/
        $model = new IndexInputModel();
        $model->ICAO = \Yii::$app->request->post('icao');
        if( $model->validate()){
            $service = new NOTAMService(['ICAO' => $model->ICAO]);
            return json_encode($service->getICAOData());
        }
        throw new \yii\web\HttpException(400, 'Something went wrong');
    }

}
