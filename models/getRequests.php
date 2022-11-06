<?php

    namespace app\models;

    use yii\db\ActiveRecord;

    class ContactRequest extends ActiveRecord
    {
        public $name;
        public $email;
        public $request_body;
        public $request_date;
        public $request_type_id;
        /**
        * @inheritdoc
        */
        public static function tableName()
        {
            return 'ContactRequest';
        }

        /**
         * @return array the validation rules.
         */
        public function rules()
        {
            return [
                [['name', 'email', 'request_body', 'request_date', 'request_type_id'], 'required'],
                ['name', 'string', 'max' => 20],
                ['email', 'email'],
                ['request_body', 'string', 'max' => 500],
                [['request_date'],'date', 'format'=>'dd-mm-yyyy'],
            ];
        }
    }