<?php

namespace app\controllers;

use app\models\Pedido;
use app\models\PedidoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * PedidoController implements the CRUD actions for Pedido model.
 */
class PedidoController extends Controller
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
                    'class' => AccessControl::className(),
                    'only' => ['update', 'delete'], // Solo estas acciones requieren autenticación
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'], // Usuarios autenticados
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => \yii\filters\VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Pedido models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new PedidoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Pedido model.
     * @param int $idpedido Idpedido
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idpedido)
    {
        return $this->render('view', [
            'model' => $this->findModel($idpedido),
        ]);
    }

    /**
     * Creates a new Pedido model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Pedido();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idpedido' => $model->idpedido]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Pedido model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idpedido Idpedido
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idpedido)
    {
        $model = $this->findModel($idpedido);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idpedido' => $model->idpedido]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Pedido model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idpedido Idpedido
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idpedido)
    {
        $this->findModel($idpedido)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Pedido model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idpedido Idpedido
     * @return Pedido the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idpedido)
    {
        if (($model = Pedido::findOne(['idpedido' => $idpedido])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
