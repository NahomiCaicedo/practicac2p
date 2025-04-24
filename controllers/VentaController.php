<?php

namespace app\controllers;

use app\models\Venta;
use app\models\VentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * VentaController implements the CRUD actions for Venta model.
 */
class VentaController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Venta models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new VentaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Venta model.
     * @param int $idventa Idventa
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idventa)
    {
        return $this->render('view', [
            'model' => $this->findModel($idventa),
        ]);
    }

    /**
     * Creates a new Venta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Venta();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idventa' => $model->idventa]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Venta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idventa Idventa
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idventa)
    {
        $model = $this->findModel($idventa);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idventa' => $model->idventa]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Venta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idventa Idventa
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idventa)
    {
        $this->findModel($idventa)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Venta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idventa Idventa
     * @return Venta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idventa)
    {
        if (($model = Venta::findOne(['idventa' => $idventa])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
