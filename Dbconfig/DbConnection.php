   <?php

class DbConnection {

    private static $instance = NULL;
    
    public static function getInstance() {

        if (!isset(self::$instance)) {
            try {
                self:: $instance = new PDO("mysql:host=localhost;dbname=es_work1", 'root', '');
                self:: $instance->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
        }
        return self::$instance;
    }
}
