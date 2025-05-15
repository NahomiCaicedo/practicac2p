<?php

namespace app\controllers;

use app\models\Detallepedido;
use app\models\DetallepedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * DetallepedidoController implements the CRUD actions for Detallepedido model.
 */
class DetallepedidoController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'only' => ['create', 'update', 'delete'],
                    'rules' => [
                        [
                            'actions' => ['create', 'update', 'delete'],
                            'allow' => true,
                            'roles' => ['@'], // Solo usuarios autenticados
                        ],
                    ],
                ],
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
     * Lists all Detallepedido models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DetallepedidoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Detallepedido model.
     * @param int $iddetallepedido Iddetallepedido
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($iddetallepedido)
    {
        return $this->render('view', [
            'model' => $this->findModel($iddetallepedido),
        ]);
    }

    /**
     * Creates a new Detallepedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Detallepedido();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'iddetallepedido' => $model->iddetallepedido]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Detallepedido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $iddetallepedido Iddetallepedido
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($iddetallepedido)
    {
        $model = $this->findModel($iddetallepedido);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'iddetallepedido' => $model->iddetallepedido]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Detallepedido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $iddetallepedido Iddetallepedido
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($iddetallepedido)
    {
        $this->findModel($iddetallepedido)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Detallepedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $iddetallepedido Iddetallepedido
     * @return Detallepedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($iddetallepedido)
    {
        if (($model = Detallepedido::findOne(['iddetallepedido' => $iddetallepedido])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
