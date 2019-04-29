
###Site

    http://ecommpayit.sk-project.ru/

### Install


You need Docker and Docker-compose
     
    https://docs.docker.com/install/linux/docker-ce/ubuntu/

    https://docs.docker.com/compose/install/

    
Run the installation triggers (creating cookie validation code)

    sudo docker-compose run --rm php composer install    
    
Start the container

    sudo docker-compose up
    
Set access to web process

    //example etc
    sudo chmod -R 755 ./runtime    
    
You can then access the application through the following URL:

    http://127.0.0.1:8089
    
DataBase deploy

    sudo docker ps // get <php cont name>
    sudo docker exec -i -t <php cont name> bash
    
    yii migrate safeUp
    
To callback answer

     /config/params.php  callbackUrl=
     
To Apache2

    ProxyRequests off
    ProxyPreserveHost on
    ProxyPass / http://127.0.0.1:8089/
    ProxyPassReverse / http://127.0.0.1:8089/