Installation

    Before running the application you need to make sure that the following ports are open and not busy by other applications
        - 8001
        - 3000
    
    To run the application just run this command ```docker-compose up -d``` in application folder.

Technology

    - PHP version is 7.3-fpm
    - I use ``Symfony 4.4`` as a framework 
    - For unit and functional test I use ``symfony/phpunit-bridge`` and also ``phpunit``


Test and Api usage

    To run the test just go to the project folder and run this command ```./bin/phpunit```

    In order to test the Api you can send a GET request to ```127.0.0.1:8001/mars-time?time=<time>```
    which ``time`` should be in ```Y-m-d H:i:s``` format, for example 

    ```127.0.0.1:8001/mars-time?time=2020-01-26 11:23:18```

