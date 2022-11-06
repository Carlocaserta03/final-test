<?php

    use yii\db\Migration;

    /**
     * Class m221101_134455_create_request_tables
     */
    class m221102_170535_create_request_tables extends Migration
    {
        /**
         * {@inheritdoc}
         */
        public function up()
        {
            $this->createTable('RequestType', [
                'id' => $this->primaryKey(),
                'description' => $this->string(200)->notNull(),
                'type' => $this->tinyInteger()->notNull(),
            ]);

            $this->createTable('ContactRequest', [
                'id' => $this->primaryKey(),
                'name' => $this->string(20)->notNull(),
                'email' => $this->string(50)->notNull(),
                'request_body' => $this->string(500)->notNull(),
                'request_time' => $this->timestamp()->notNull(),
                'request_type_id' => $this->integer()->notNull()
            ]);

            $this->addForeignKey('FK_request_type', 'ContactRequest', 'request_type_id', 'RequestType', 'id');

            $this->batchInsert('RequestType', ['type', 'description'], [
                [1, 'Servizi Web'], [1, 'Servizi Gaia'], [1, 'Servizi Telefonici'], [1, 'altro'],
                [2, 'Nuovo Servizio'], [2, 'Richiesta Fattura'], [2, 'Contatto Commerciale'], [2, 'Altro']
            ]);
        }

        /**
         * {@inheritdoc}
         */
        public function down()
        {
            $this->dropTable('RequestType');
            $this->dropTable('ContactRequest');
        }
    }