<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "producto".
 *
 * @property int $idproducto
 * @property string|null $Portada
 * @property string|null $nombre
 * @property string|null $descripcion
 * @property string|null $precio
 * @property int $fk_idcategoria
 *
 * @property Detallepedido[] $detallepedidos
 * @property Categoria $fkIdcategoria
 */
class Producto extends \yii\db\ActiveRecord
{
    public $imageFile;


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'producto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
   {
      return [
        [['Portada', 'nombre', 'descripcion', 'precio'], 'default', 'value' => null],
        [['idproducto', 'fk_idcategoria'], 'required'],
        [['idproducto', 'fk_idcategoria'], 'integer'],
        [['Portada'], 'string', 'max' => 255],
        [['nombre', 'descripcion', 'precio'], 'string', 'max' => 45],
        [['idproducto'], 'unique'],
        [['fk_idcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['fk_idcategoria' => 'idcategoria']],
        [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
      ];
    }
       
    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'idproducto' => Yii::t('app', 'Idproducto'),
            'Portada' => Yii::t('app', 'Portada'),
            'nombre' => Yii::t('app', 'Nombre'),
            'descripcion' => Yii::t('app', 'Descripcion'),
            'precio' => Yii::t('app', 'Precio'),
            'fk_idcategoria' => Yii::t('app', 'Fk Idcategoria'),
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
                $filename = $this->idproducto . '.' . $this->imageFile->extension;
                $path = Yii::getAlias('@webroot/portadas/') . $filename;

                if($this->imageFile->saveAs($path)){
                    if($this->Portada && $this->Portada !== $filename){
                        $this->deletePortada();
                    }
                    $this ->Portada = $filename;
                }
            }
          return $this->save(false);  
        }
        return false;
    }

    public function deletePortada()
    {
        $path = Yii::getAlias('@webroot/portadas/') . $this->portada;
        if(file_exists($path)){
            unlink($path);
        }
    }
    /**
     * Gets query for [[Detallepedidos]].
     *
     * @return \yii\db\ActiveQuery|DetallepedidoQuery
     */
    public function getDetallepedidos()
    {
        return $this->hasMany(Detallepedido::class, ['fk_idproducto' => 'idproducto']);
    }

    /**
     * Gets query for [[FkIdcategoria]].
     *
     * @return \yii\db\ActiveQuery|CategoriaQuery
     */
    public function getFkIdcategoria()
    {
        return $this->hasOne(Categoria::class, ['idcategoria' => 'fk_idcategoria']);
    }

    /**
     * {@inheritdoc}
     * @return ProductoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ProductoQuery(get_called_class());
    }

}
