<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property string $nim
 * @property string $nama
 * @property string $tempat_lahir
 * @property string $tgl_lahir
 *
 * @property Kelas $kelas
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nim', 'nama', 'tempat_lahir', 'tgl_lahir'], 'required'],
            [['tgl_lahir'], 'safe'],
            [['nim'], 'string', 'max' => 11],
            [['nama', 'tempat_lahir'], 'string', 'max' => 300],
            [['nim'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'nim' => 'Nim',
            'nama' => 'Nama',
            'tempat_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tgl Lahir',
        ];
    }

    /**
     * Gets query for [[Kelas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKelas()
    {
        return $this->hasOne(Kelas::className(), ['nim' => 'nim']);
    }

    public function fields(){
        return [
            'nim',
            'nama',
            // 'kelas',
            'kelas' => function($model){
                if(!empty($model->kelas->nama_kelas)){
                    return $model->kelas->nama_kelas;
                }else{
                    return '';
                }
            }
        ];
    }
}
