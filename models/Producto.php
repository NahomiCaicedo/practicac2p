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
    public $detallepedidos = [];

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
            [['fk_idcategoria'], 'required'],
            [['idproducto', 'fk_idcategoria'], 'integer'],
            [['Portada', 'descripcion'], 'string', 'max' => 255],
            [['nombre'], 'string', 'max' => 100],
            [['precio'], 'string', 'max' => 45],
            [['detallepedidos'], 'safe'],
            [['fk_idcategoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['fk_idcategoria' => 'idcategoria']],
            [['imageFile'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg, jpeg, gif'],
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
            'fk_idcategoria' => Yii::t('app', 'Categoria'),
            'detallepedidos' => Yii::t('app', 'Detalles de pedidos'),
            'imageFile' => Yii::t('app', 'Imagen del producto'),
        ];
    }

    /**
     * Maneja la subida de archivos y actualiza el atributo Portada.
     * NO guarda el modelo - eso se hace en el controlador.
     */
    public function upload()
    {
        if ($this->imageFile instanceof UploadedFile) {
            // Crear carpeta si no existe
            $uploadPath = Yii::getAlias('@webroot/portadas/');
            if (!is_dir($uploadPath)) {
                mkdir($uploadPath, 0755, true);
            }

            $filename = uniqid('producto_') . '.' . $this->imageFile->extension;
            $path = $uploadPath . $filename;

            if ($this->imageFile->saveAs($path)) {
                // Eliminar imagen anterior si existe y es diferente
                if ($this->Portada && $this->Portada !== $filename) {
                    $this->deletePortada();
                }
                
                // Solo actualizar el atributo, NO guardar el modelo
                $this->Portada = $filename;
                return true;
            }

            return false;
        }

        return true; // Si no hay imagen, todo bien
    }

    /**
     * Elimina la imagen anterior del servidor.
     */
    public function deletePortada()
    {
        if ($this->Portada) {
            $path = Yii::getAlias('@webroot/portadas/') . $this->Portada;
            if (file_exists($path)) {
                unlink($path);
            }
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