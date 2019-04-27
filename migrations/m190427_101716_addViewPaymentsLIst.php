<?php

use yii\db\Migration;

/**
 * Class m190427_101716_addViewPaymentsLIst
 */
class m190427_101716_addViewPaymentsLIst extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `web`@`%` 
    SQL SECURITY DEFINER
VIEW `getPaymentList` AS
    SELECT 
        `payments_status`.`payment_id` AS `payment_id`,
        `payments`.`user_email` AS `user_email`,
        `payments`.`user_birthday` AS `user_birthday`,
        `payments`.`amount` AS `amount`,
        `payments_status`.`status` AS `status`,
        `payments_status`.`message` AS `message`
    FROM
        (((SELECT 
            `payments_status`.`payment_id` AS `payment_id`,
                MAX(`payments_status`.`date_time`) AS `max_date_time`
        FROM
            `payments_status`
        GROUP BY `payments_status`.`payment_id`) `T1`
        JOIN `payments`)
        JOIN `payments_status`)
    WHERE
        ((`payments`.`payment_id` = `payments_status`.`payment_id`)
            AND (`T1`.`max_date_time` = `payments_status`.`date_time`)
            AND (`T1`.`payment_id` = `payments`.`payment_id`))
        "
        );
        $command->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190427_101716_addViewPaymentsLIst cannot be reverted.\n";


           $connection = Yii::$app->getDb();
        $command = $connection->createCommand("    
        DROP VIEW `web`.`getPaymentList`;
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
        echo "m190427_101716_addViewPaymentsLIst cannot be reverted.\n";

        return false;
    }
    */
}
