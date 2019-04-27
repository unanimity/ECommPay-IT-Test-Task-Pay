<?php

use yii\db\Migration;

/**
 * Class m190427_084507_alterDB
 */
class m190427_084507_alterDB extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
        ALTER TABLE `web`.`payments` 
        ADD COLUMN `returnForm` TEXT NULL AFTER `callbackUrl`,
        ADD COLUMN `transactionId` CHAR(32) NULL AFTER `returnForm`;

        ALTER TABLE `web`.`payments_status` 
        ADD COLUMN `message` CHAR(255) NULL AFTER `date_time`;


        "
        );
        $command->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {



                $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
        ALTER TABLE `web`.`payments` 
        DROP COLUMN `transactionId`,
        DROP COLUMN `returnForm`;
        ALTER TABLE `web`.`payments_status` 
        DROP COLUMN `message`;
        "
        );
        $command->execute();

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190427_084507_alterDB cannot be reverted.\n";

        return false;
    }
    */
}
