<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "penerbit".
 *
 * @property string $kode_penerbit
 * @property string $nama_penerbit
 * @property string $telepon
 *
 * @property Buku[] $bukus
 */
class Penerbit extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'penerbit';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_penerbit', 'nama_penerbit', 'telepon'], 'required'],
            [['kode_penerbit'], 'string', 'max' => 5],
            [['nama_penerbit'], 'string', 'max' => 100],
            [['telepon'], 'string', 'max' => 12],
            [['kode_penerbit'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_penerbit' => 'Kode Penerbit',
            'nama_penerbit' => 'Nama Penerbit',
            'telepon' => 'Telepon',
        ];
    }

    /**
     * Gets query for [[Bukus]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getBukus()
    {
        return $this->hasMany(Buku::className(), ['kode_penerbit' => 'kode_penerbit']);
    }
}
