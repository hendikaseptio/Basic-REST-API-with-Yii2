<?php

namespace app\models;

use Yii;
use app\models\Penerbit;
/**
 * This is the model class for table "buku".
 *
 * @property string $kode_buku
 * @property string $judul
 * @property string $tahun_terbit
 * @property string $kode_penerbit
 *
 * @property Penerbit $kodePenerbit
 */
class Buku extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'buku';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_buku', 'judul', 'tahun_terbit', 'kode_penerbit'], 'required'],
            [['kode_buku', 'kode_penerbit'], 'string', 'max' => 5],
            [['judul'], 'string', 'max' => 50],
            [['tahun_terbit'], 'string', 'max' => 4],
            [['kode_buku'], 'unique'],
            [['kode_penerbit'], 'exist', 'skipOnError' => true, 'targetClass' => Penerbit::className(), 'targetAttribute' => ['kode_penerbit' => 'kode_penerbit']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_buku' => 'Kode Buku',
            'judul' => 'Judul',
            'tahun_terbit' => 'Tahun Terbit',
            'kode_penerbit' => 'Kode Penerbit',
        ];
    }

    /**
     * Gets query for [[KodePenerbit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKodePenerbit()
    {
        return $this->hasMany(Penerbit::className(), ['kode_penerbit' => 'kode_penerbit']);
    }
    public function fields()
    {
        return [
            'kode_buku',
            'judul',
            'tahun_terbit',
            'nama_penerbit' => function($model){
                if(empty($model->kodePenerbit[0]->nama_penerbit)){
                    return'';
                } else {
                    return $model->kodePenerbit[0]->nama_penerbit;
                }
            }
        ];
    }
}
