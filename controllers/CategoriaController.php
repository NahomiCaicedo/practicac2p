<?php

namespace app\controllers;
use Yii;
use app\models\Categoria;
use app\models\CategoriaSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * CategoriaController implements the CRUD actions for Categoria model.
 */
class CategoriaController extends Controller
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
     * Lists all Categoria models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new CategoriaSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Categoria model.
     * @param int $idcategoria Idcategoria
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idcategoria)
    {
        return $this->render('view', [
            'model' => $this->findModel($idcategoria),
        ]);
    }

    /**
     * Creates a new Categoria model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Categoria();
        $message = '';

        if($this->request->isPost){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                if($model->load($this->request->post())){
                    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                    if($model->save() && (!$model->imageFile || $model->upload())){
                        $transaction->commit();
                        return $this->redirect(['view', 'idcategoria' => $model->idcategoria]);
                    }else{
                        $message = 'Error al guardar la categoria';
                        $transaction->rollBack();
                    }
                }else{
                    $message = 'Error al cargar los datos del formulario';
                    $transaction->rollBack();
                }
            }catch(\Exception $e){
                $transaction->rollBack();
                $message = 'Error al guardar la categoria: ' . $e->getMessage();
            }
        }else{
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'message' => $message,
        ]);
    }

    /**
     * Updates an existing Categoria model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idcategoria Idcategoria
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idcategoria)
    {
        $model = $this->findModel($idcategoria);
        $message = '';

        if($this->request->isPost && $model->load($this->request->post())){
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if($model->save() && (!$model->imageFile || $model->upload())){
                return $this->redirect(['view', 'idcategoria' => $model->idcategoria]);
            }else{
                Yii::$app->session->setFlash('error', 'Error al guardar la categoria');
            }
        }

        return $this->render('update', [
            'model' => $model,
            'message' => $message,
        ]);
    }

    /**
     * Deletes an existing Categoria model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idcategoria Idcategoria
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idcategoria)
    {
        $this->findModel($idcategoria)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Categoria model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idcategoria Idcategoria
     * @return Categoria the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($idcategoria)
    {
        if (($model = Categoria::findOne(['idcategoria' => $idcategoria])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
