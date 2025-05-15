<?php

namespace app\controllers;

use app\models\Cliente;
use app\models\ClienteSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * ClienteController implements the CRUD actions for Cliente model.
 */
class ClienteController extends Controller
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
                'only' => ['view', 'create', 'update', 'delete'], // acciones a proteger
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // sólo usuarios autenticados
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
     * Lists all Cliente models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ClienteSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Cliente model.
     * @param int $idcliente Idcliente
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idcliente)
    {
        return $this->render('view', [
            'model' => $this->findModel($idcliente),
        ]);
    }

    /**
     * Creates a new Cliente model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Cliente();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['view', 'idcliente' => $model->idcliente]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Cliente model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idcliente Idcliente
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idcliente)
    {
        $model = $this->findModel($idcliente);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'idcliente' => $model->idcliente]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Deletes an existing Cliente model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idcliente Idcliente
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idcliente)
    {
        $this->findModel($idcliente)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Cliente model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idcliente Idcliente
     * @return Cliente the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcliente)
    {
        if (($model = Cliente::findOne(['idcliente' => $idcliente])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
