<?php

namespace app\controllers;

use app\models\DetalleVenta;
use app\models\DetalleVentaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DetalleVentaController implements the CRUD actions for DetalleVenta model.
 */
class DetalleVentaController extends Controller
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
     * Lists all DetalleVenta models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DetalleVentaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single DetalleVenta model.
     * @param int $iddetalle Iddetalle
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($iddetalle)
    {
        return $this->render('view', [
            'model' => $this->findModel($iddetalle),
        ]);
    }

    /**
     * Creates a new DetalleVenta model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new DetalleVenta();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'iddetalle' => $model->iddetalle]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing DetalleVenta model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $iddetalle Iddetalle
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($iddetalle)
    {
        $model = $this->findModel($iddetalle);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'iddetalle' => $model->iddetalle]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing DetalleVenta model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $iddetalle Iddetalle
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($iddetalle)
    {
        $this->findModel($iddetalle)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the DetalleVenta model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $iddetalle Iddetalle
     * @return DetalleVenta the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($iddetalle)
    {
        if (($model = DetalleVenta::findOne(['iddetalle' => $iddetalle])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
