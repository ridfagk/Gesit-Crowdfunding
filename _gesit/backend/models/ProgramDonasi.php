<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "program_donasi".
 *
 * @property int $id
 * @property string $title
 * @property string $banner
 * @property string $deskripsi
 * @property string $kategori
 */
class ProgramDonasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'program_donasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title','due', 'deskripsi', 'kategori'], 'required'],
            [['title', 'banner', 'deskripsi'], 'string'],
            [['kategori'], 'string', 'max' => 15],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'banner' => 'Banner',
            'deskripsi' => 'Deskripsi',
            'kategori' => 'Kategori',
        ];
    }
}
