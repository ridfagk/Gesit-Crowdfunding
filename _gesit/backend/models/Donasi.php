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
            //[['id_program', 'nama', 'email', 'pesan', 'jumlah'], 'required'],
            [['id_program', 'buktitf_id', 'id_donatur'], 'integer'],
            
            [['jumlah'], 'string', 'min' => 5 , 'tooShort' => 'Nominal donasi minimal Rp. 10.000' ],
            [['nama', 'pdf_url','order_id', 'payment_type', 'transaction_status', 'email', 'pesan', 'buktitf'], 'string'],
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

    public function getProgram()
    {
        return $this->hasOne(ProgramDonasi::className(), ['id' => 'id_program']);
    }
}
