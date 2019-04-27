<?php

use yii\db\Migration;

/**
 * Class m190427_125027_addDefData
 */
class m190427_125027_addDefData extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $connection = Yii::$app->getDb();
        $command = $connection->createCommand("     
    
        INSERT INTO `payments` (`payment_id`,`user_email`,`user_birthday`,`amount`,`currency`,`returnUrl`,`referenceNo`,`timestamp`,`language`,`billingFirstName`,`billingLastName`,`billingAddress1`,`billingCity`,`billingPostcode`,`billingCountry`,`paymentMethod`,`number`,`callbackUrl`,`returnForm`,`transactionId`) VALUES ('0756c814-68e9-11e9-aaab-0242ac160002','PENDING@TEST.RU','1970-01-01',300200,'EUR','http://www.sk-project.ru','reference_5cc44cb71e9ee','1556368567','en','4652 Rd str.','b. 31','El/ st','Gotem','436632','RU','card','4012888888881881','http://www.sk-project.ru/api/callback','','67427-6368567427-427');
        INSERT INTO `payments` (`payment_id`,`user_email`,`user_birthday`,`amount`,`currency`,`returnUrl`,`referenceNo`,`timestamp`,`language`,`billingFirstName`,`billingLastName`,`billingAddress1`,`billingCity`,`billingPostcode`,`billingCountry`,`paymentMethod`,`number`,`callbackUrl`,`returnForm`,`transactionId`) VALUES ('0fbd385f-68e9-11e9-aaab-0242ac160002','NGINX500@TEST.RU','1970-01-01',500000,'EUR','http://www.sk-project.ru','reference_5cc44cc536278','1556368581','en','4652 Rd str.','b. 31','El/ st','Gotem','436632','RU','card','4012888888881881','http://www.sk-project.ru/api/callback','','81535-6368581535-535');
        INSERT INTO `payments` (`payment_id`,`user_email`,`user_birthday`,`amount`,`currency`,`returnUrl`,`referenceNo`,`timestamp`,`language`,`billingFirstName`,`billingLastName`,`billingAddress1`,`billingCity`,`billingPostcode`,`billingCountry`,`paymentMethod`,`number`,`callbackUrl`,`returnForm`,`transactionId`) VALUES ('34dd1676-68e9-11e9-aaab-0242ac160002','DECLINED@TEST.RU','1970-01-01',100,'EUR','http://www.sk-project.ru','reference_5cc44d037bbaf','1556368643','en','4652 Rd str.','b. 31','El/ st','Gotem','436632','RU','card','4012888888881881','http://www.sk-project.ru/api/callback','','43810-6368643810-810');
        INSERT INTO `payments` (`payment_id`,`user_email`,`user_birthday`,`amount`,`currency`,`returnUrl`,`referenceNo`,`timestamp`,`language`,`billingFirstName`,`billingLastName`,`billingAddress1`,`billingCity`,`billingPostcode`,`billingCountry`,`paymentMethod`,`number`,`callbackUrl`,`returnForm`,`transactionId`) VALUES ('9442e269-68ea-11e9-aaab-0242ac160002','ERROR@TEST.RU','1970-01-01',500,'EUR','http://www.sk-project.ru','reference_5cc44f510cf92','1556369233','en','4652 Rd str.','b. 31','El/ st','Gotem','436632','RU','card','4012888888881881','http://www.sk-project.ru/api/callback','','33327-6369233327-327');
     
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (1,'0756c814-68e9-11e9-aaab-0242ac160002','INIT','2019-04-27 12:36:07',NULL);
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (2,'0756c814-68e9-11e9-aaab-0242ac160002','WAITING','2019-04-27 12:36:09','Waiting.');
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (3,'0fbd385f-68e9-11e9-aaab-0242ac160002','INIT','2019-04-27 12:36:21',NULL);
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (4,'0fbd385f-68e9-11e9-aaab-0242ac160002','WAITING','2019-04-27 12:36:23','Waiting.');
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (5,'0756c814-68e9-11e9-aaab-0242ac160002','PENDING','2019-04-27 12:36:31','Waiting.');
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (6,'0fbd385f-68e9-11e9-aaab-0242ac160002','APPROVED','2019-04-27 12:36:45','Покупка успешно завершена');
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (7,'34dd1676-68e9-11e9-aaab-0242ac160002','INIT','2019-04-27 12:37:23',NULL);
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (8,'34dd1676-68e9-11e9-aaab-0242ac160002','DECLINED','2019-04-27 12:37:25','');
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (9,'34dd1676-68e9-11e9-aaab-0242ac160002','DECLINED','2019-04-27 12:37:47','Refer to card issuer.');
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (12,'9442e269-68ea-11e9-aaab-0242ac160002','INIT','2019-04-27 12:47:13',NULL);
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (13,'9442e269-68ea-11e9-aaab-0242ac160002','DECLINED','2019-04-27 12:47:15','');
        INSERT INTO `payments_status` (`payment_status_id`,`payment_id`,`status`,`date_time`,`message`) VALUES (14,'9442e269-68ea-11e9-aaab-0242ac160002','DECLINED','2019-04-27 12:47:39','Do not honor..');
                "
        );
        $command->execute();
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        echo "m190427_125027_addDefData cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m190427_125027_addDefData cannot be reverted.\n";

        return false;
    }
    */
}
