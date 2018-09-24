<?php

use yii\db\Migration;

class m180924_151304_places extends Migration
{

    public function safeUp()
    {
        $this->execute(file_get_contents(__DIR__ . '/dump.sql'));
    }

    public function safeDown()
    {
        $this->dropTable('places');

    }

}
