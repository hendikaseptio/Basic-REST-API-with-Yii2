<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "kelas".
 *
 * @property string $nim
 * @property string $nama_kelas
 *
 * @property Mahasiswa $nim0
 */
class Kelas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'kelas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nim', 'nama_kelas'], 'required'],
            [['nim'], 'string', 'max' => 11],
            [['nama_kelas'], 'string', 'max' => 10],
            [['nim'], 'unique'],
            [['nim'], 'exist', 'skipOnError' => true, 'targetClass' => Mahasiswa::className(), 'targetAttribute' => ['nim' => 'nim']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nim' => 'NIM',
            'nama_kelas' => 'Nama Kelas',
        ];
    }

    /**
     * Gets query for [[Nim0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNim0()
    {
        return $this->hasOne(Mahasiswa::className(), ['nim' => 'nim']);
    }
}