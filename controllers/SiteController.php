<?php

namespace app\controllers;

use Yii;
use app\models\Places;
use app\models\SearchPlaces;
use yii\helpers\ArrayHelper;
use yii\data\ActiveDataProvider;
use yii\data\ArrayDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

class SiteController extends Controller
{

    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    //ВЫВОД ВСЕХ ГОРОДОВ И ПОИСК
    public function actionIndex()
    {
        //GET запрос поиска города
        $search = Yii::$app->request->get('SearchPlaces');
        //Если GET нет, выводим все города из БД
        if (!$search) {

            $searchModel = new SearchPlaces();
            $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

            return $this->render('index', [
                'searchModel' => $searchModel,
                'dataProvider' => $dataProvider,
            ]);

        } else {

            $model = Places::findOne($search);
            $models = Places::find()->all();
            $places = array();
            if (!$model) {

                ArrayHelper::setValue($places, ['id' => ''], ['address' => 'Город не найден', 'distance' => '']);

            } else {

                $lat1 = $model->lat;
                $lng1 = $model->lng;

                foreach ($models as $m) {
                    $address = $m->address;
                    $lat2 = $m->lat;
                    $lng2 = $m->lng;
                    $id = $m->id;
                    //Считаем расстояние между городами
                    $distance = Places::calcDistance($lat1, $lng1, $lat2, $lng2);
                    //Добавлям элемент в массив $places
                    ArrayHelper::setValue($places, ['id' => $id], ['address' => $address, 'distance' => $distance]);
                }
                //Сортировка массива по расстоянию
                ArrayHelper::multisort($places, ['distance'], [SORT_ASC]);
            }

            $dataProvider = new ArrayDataProvider(['allModels' => $places]);

            return $this->render('search', [
                'dataProvider' => $dataProvider,
            ]);
        }
    }

    //ВЫВОД ГОРОДА ПО ID
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    //СОЗДАНИЕ ГОРОДА
    public function actionCreate()
    {
        $model = new Places();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    //РЕДАКТИРОВАНИЕ ГОРОДА
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    //УДАЛЕНИЕ ГОРОДА
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    //ПОИСК ГОРОДА ПО ID
    protected function findModel($id)
    {
        if (($model = Places::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
