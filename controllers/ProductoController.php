<?php

namespace app\controllers;

use Yii;

use app\models\Producto;
use app\models\ProductoSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;


/**
 * ProductoController implements the CRUD actions for Producto model.
 */
class ProductoController extends Controller
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
     * Lists all Producto models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProductoSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Producto model.
     * @param int $idproducto Idproducto
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($idproducto)
    {
        return $this->render('view', [
            'model' => $this->findModel($idproducto),
        ]);
    }

    /**
     * Creates a new Producto model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Producto();
        $message = '';

        if ($this->request->isPost){
            $transaction = Yii::$app->db->beginTransaction();
            try{
                if($model->load($this->request->post())){
                    $model->imageFile = UploadedFile::getInstance($model, 'imageFile');
                    if($model->save() && (!$model->imageFile || $model->upload())){
                        $transaction->commit();
                        return $this->redirect(['view', 'idproducto' => $model->idproducto]);
                    }else{
                        $message = 'Error al guardar el producto';
                        $transaction->rollBack();
                    }
                    
                }else{
                    $message = 'Error al cargar la portada';
                    $transaction->rollBack();
                }
            }catch (\Exception $e){
                $transaction->rollBack();
                $message = 'Error al guardar el producto';
            }
        }else{
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'message'=> $message,
        ]);
    }

    /**
     * Updates an existing Producto model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $idproducto Idproducto
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($idproducto)
    {
        $model = $this->findModel($idproducto);
        $message = '';

        if($this->request->isPost && $model->load($this->request->post())){
            $model->imageFile = UploadedFile::getInstance($model, 'imageFile');

            if($model->save() && (!$model->imageFile || $model->upload())){
                return $this->redirect(['view', 'idproducto' => $model->idproducto]);
            }else{
                $message = 'Error al guardar el producto';
            }
        }

        $model->detallepedidos = ArrayHelper::getColumn($model->getDetallepedidos()->asArray()->all(), 'iddetallepedido');

        return $this->render('update', [
            'model' => $model,
            'message' => 'message',
        ]);
    }



    /**
     * Deletes an existing Producto model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $idproducto Idproducto
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($idproducto)
    {
        $model = $this->findModel($idproducto);
        $model->deletePortada();
        $model->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Producto model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $idproducto Idproducto
     * @return Producto the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */

    protected function findModel($idproducto)
    {
        if (($model = Producto::findOne(['idproducto' => $idproducto])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
