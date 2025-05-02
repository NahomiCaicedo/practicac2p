<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "categoria".
 *
 * @property int $idcategoria
 * @property string|null $nombre_categoria
 * @property string|null $descripcion
 *
 * @property Producto[] $productos
 */
class Categoria extends \yii\db\ActiveRecord
{
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'categoria';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_categoria', 'descripcion'], 'default', 'value' => null],
            [['idcategoria'], 'required'],
            [['idcategoria'], 'integer'],
            [['nombre_categoria', 'descripcion'], 'string', 'max' => 45],
            [['idcategoria'], 'unique'],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idcategoria' => Yii::t('app', 'Idcategoria'),
            'nombre_categoria' => Yii::t('app', 'Nombre Categoria'),
            'descripcion' => Yii::t('app', 'Descripcion'),
        ];
    }

    public function upload()
    {
        if ($this->validate()) {
            if($this->isNewRecord){
                if(!$this->save(false)){
                    return false;
                }
            }
            if($this->imageFile instanceof UploadedFile){
                $filename = $this->idcategoria . '.' . $this->nombre_categoria . '_categoria_' . $this->imageFile->extension;
                $path = Yii::getAlias('@webroot/categorias/') . $filename;

                if($this->imageFile->saveAs($path)){
                    if($this->categoria && $this->categoria !== $filename){
                        $this->deleteCategoria;
                    }
                    $this->categoria = $filename;
                }       
            }
            return $this->save(false);
        }
        return false;
    }

    public function deleteCategoria(){
        $path = Yii::getAlias('@webroot/categorias/') . $this->categoria;
        if(file_exists($path)){
            unlink($path);
        }
    }
    
    /**
     * Gets query for [[Productos]].
     *
     * @return \yii\db\ActiveQuery|ProductoQuery
     */
    public function getProductos()
    {
        return $this->hasMany(Producto::class, ['fk_idcategoria' => 'idcategoria']);
    }

    /**
     * {@inheritdoc}
     * @return CategoriaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new CategoriaQuery(get_called_class());
    }

}
