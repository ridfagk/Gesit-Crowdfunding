<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "banner_donasi".
 *
 * @property int $id
 * @property string $program_id
 * @property int $banner_id
 * @property string $banner
 * @property string|null $timecreated
 */
class BannerDonasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'banner_donasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['program_id', 'banner_id', 'banner'], 'required'],
            [['banner_id'], 'integer'],
            [['banner'], 'string'],
            [['timecreated'], 'safe'],
            [['program_id'], 'string', 'max' => 25],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'program_id' => 'Program ID',
            'banner_id' => 'Banner ID',
            'banner' => 'Banner',
            'timecreated' => 'Timecreated',
        ];
    }
}
