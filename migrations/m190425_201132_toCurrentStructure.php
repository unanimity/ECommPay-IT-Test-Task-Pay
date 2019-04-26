<?php

use yii\db\Migration;

/**
 * Class m190425_201132_toCurrentStructure
 */
class m190425_201132_toCurrentStructure extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("
              CREATE TABLE IF NOT EXISTS `web`.`payments` (
              `payment_id` CHAR(36) NOT NULL,
              `user_email` CHAR(128) NULL,
              `user_birthday` DATE NULL,
              `amount` INT NULL,
              `currency` CHAR(3) NULL,
              `returnUrl` text NULL,
              `referenceNo` CHAR(32) NULL,
              `timestamp` CHAR(32) NULL,
              `language` CHAR(2) NULL,
              `billingFirstName` CHAR(64) NULL,
              `billingLastName` CHAR(64) NULL,
              `billingAddress1` CHAR(128) NULL,
              `billingCity` CHAR(64) NULL,
              `billingPostcode` CHAR(64) NULL,
              `billingCountry` CHAR(2) NULL,
              `paymentMethod` CHAR(32) NULL,
              `number` CHAR(16) NULL,
              `cvv` CHAR(3) NULL,
              `callbackUrl` text NULL,
              PRIMARY KEY (`payment_id`),
              UNIQUE INDEX `payment_id_UNIQUE` (`payment_id` ASC))
            ENGINE = InnoDB;
                        
            -- -----------------------------------------------------
            -- Table `web`.`payments_status`
            -- -----------------------------------------------------
            CREATE TABLE IF NOT EXISTS `web`.`payments_status` (
              `payment_status_id` INT NOT NULL AUTO_INCREMENT,
              `payment_id` CHAR(36) NOT NULL,
              `status` CHAR(18) NOT NULL DEFAULT 'init',
              `date_time` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
              PRIMARY KEY (`payment_status_id`, `payment_id`),
              UNIQUE INDEX `idpayment_meta_id_UNIQUE` (`payment_status_id` ASC),
              INDEX `fk_payments_meta_payments_idx` (`payment_id` ASC),
              CONSTRAINT `fk_payment_id`
                FOREIGN KEY (`payment_id`)
                REFERENCES `web`.`payments` (`payment_id`)
                ON DELETE NO ACTION
                ON UPDATE NO ACTION)
            ENGINE = InnoDB;
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
        DROP TABLE `web`.`payments`;
        DROP TABLE `web`.`payments_status`;
        "
        );
        $command->execute();

    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190425_201132_toCurrentStructure cannot be reverted.\n";

        return false;
    }
    */
}
