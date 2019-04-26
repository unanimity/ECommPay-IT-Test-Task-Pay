<?php

use yii\db\Migration;

/**
 * Class m190426_043612_addInitPaymentStoredProc
 */
class m190426_043612_addInitPaymentStoredProc extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {

        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
        CREATE DEFINER=`web`@`%` PROCEDURE `initPayment`(
            in i_user_email varchar(128),
            in i_user_birthday DATE,
            in i_amount INT,
            in i_currency CHAR(3),
            in i_returnUrl text,
            in i_referenceNo CHAR(32),
            in i_timestamp CHAR(32),
            in i_language CHAR(2),
            in i_billingFirstName char(64),
            in i_billingLastName char(64),
            in i_billingAddress1 char(128),
            in i_billingCity char(64),
            in i_billingPostcode char(64),
            in i_billingCountry char(2),
            in i_paymentMethod CHAR(32),
            in i_number CHAR(16),
            in i_cvv CHAR(3),
            in i_expiryMonth varchar(64),
            in i_expiryYear CHAR(2),
            in i_callbackUrl text
            )
            BEGIN
            
                DECLARE i_payment_id  char(36); 
                START TRANSACTION;
                set i_payment_id=UUID();
                        INSERT INTO `web`.`payments`
                        (`payment_id`,
                        `user_email`,
                        `user_birthday`,
                        `amount`,
                        `currency`,
                        `returnUrl`,
                        `referenceNo`,
                        `timestamp`,
                        `language`,
                        `billingFirstName`,
                        `billingLastName`,
                        `billingAddress1`,
                        `billingCity`,
                        `billingPostcode`,
                        `billingCountry`,
                        `paymentMethod`,
                        `number`,
                        `cvv`,
                        `expiryMonth`,
                        `expiryYear`,
                        `callbackUrl`)
                        VALUES
                        (i_payment_id,
                        i_user_email,
                        i_user_birthday,
                        i_amount,
                        i_currency,
                        i_returnUrl,
                        i_referenceNo,
                        i_timestamp,
                        i_language,
                        i_billingFirstName,
                        i_billingLastName,
                        i_billingAddress1,
                        i_billingCity,
                        i_billingPostcode,
                        i_billingCountry,
                        i_paymentMethod,
                        i_number,
                        i_cvv,
                        i_expiryMonth,
                        i_expiryYear,
                        i_callbackUrl);
                        
                        INSERT INTO `web`.`payments_status`
                        (`payment_id`)
                        VALUES
                        (
                        i_payment_id);
                COMMIT;
            select i_payment_id;
            END
        "
        );
        $command->execute();

    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190426_043612_addInitPaymentStoredProc cannot be reverted.\n";
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
            DROP PROCEDURE `web`.`initPayment`;
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
        echo "m190426_043612_addInitPaymentStoredProc cannot be reverted.\n";

        return false;
    }
    */
}
