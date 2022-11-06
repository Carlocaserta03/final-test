<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * ContactForm is the model behind the contact form.
 */
class ContactForm extends ActiveRecord
{
    public $name;
    public $email;
    public $requestType;
    public $requestDetail;
    public $body;

    public static function tableName()
    {
        return 'RequestType';
    }

    /**
     * @return array the validation rules.
     */
    public function rules()
    {
        return [
            // name, email, subject and body are required
            [['name', 'email', 'requestType', 'requestDetail', 'body'], 'required'],
            // email has to be a valid email address
            ['email', 'email'],
        ];
    }
}
