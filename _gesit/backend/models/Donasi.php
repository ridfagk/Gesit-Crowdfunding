<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "donasi".
 *
 * @property int $id
 * @property int $id_program
 * @property int $id_donatur
 * @property string $id_invoice
 * @property string $nama
 * @property string $email
 * @property string $pesan
 * @property int $jumlah
 */
class Donasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'donasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_program', 'id_donatur', 'id_invoice', 'nama', 'email', 'pesan', 'jumlah'], 'required'],
            [['id_program', 'id_donatur', 'jumlah'], 'integer'],
            [['nama', 'email', 'pesan'], 'string'],
            [['id_invoice'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_program' => 'Id Program',
            'id_donatur' => 'Id Donatur',
            'id_invoice' => 'Id Invoice',
            'nama' => 'Nama',
            'email' => 'Email',
            'pesan' => 'Pesan',
            'jumlah' => 'Jumlah',
        ];
    }
}
