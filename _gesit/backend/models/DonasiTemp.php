<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "donasi_temp".
 *
 * @property int $id
 * @property int|null $id_program
 * @property int|null $id_donatur
 * @property string|null $id_invoice
 * @property string|null $nama
 * @property string|null $email
 * @property string|null $pesan
 * @property int|null $buktitf_id
 * @property string|null $buktitf
 * @property int|null $jumlah
 */
class DonasiTemp extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'donasi_temp';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nama', 'email','jumlah'], 'required', 'message'=>'{attribute} tidak boleh kosong'],
            [['id_program', 'buktitf_id', 'id_donatur'], 'integer'],
            ['id_invoice', 'autonumber', 'format' => '{my}????'],
            [['jumlah'], 'string', 'min' => 5 , 'tooShort' => 'Nominal donasi minimal Rp. 10.000' ],
            [['nama', 'email', 'pesan', 'buktitf'], 'string'],
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
            'buktitf_id' => 'Buktitf ID',
            'buktitf' => 'Buktitf',
            'jumlah' => 'Nominal',
        ];
    }
}
