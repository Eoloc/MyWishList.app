<?php
Class DB {

    private static $dns;
    public static $conn;
    private static $username;
    private static $password;

    public function __construct($file)
    {
        if(!$settings = parse_ini_file($file, TRUE))
            throw new Exception('Impossible d\'ouvrir le fichier' . $file . '.'); 
        try {
            self::$dns = $settings['driver'] .
            ':host=' . $settings['host'] .
            ((!empty($settings['port'])) ? (';port=' . $settings['port']) : '') .
            ';dbname=' . $settings['schema'];
            self::$username = $settings['username'];
            self::$password = $settings['password'];
            self::$conn = null;
        } catch (Exception $e) {
            print_r($e);
        }
    }

    public static function makeConnection() {
        if(self::$conn == null) {
            try {
                self::$conn = new PDO(self::$dns, self::$username, self::$password);
                self::$conn->prepare('SET NAMES \'UTF8\'')->execute();
            } catch(PDOException $e) {
                throw new PDOException('connection: ' . self::$dns . $e->getMessage() . '<br/>');
            }
        }
    }

    public function makeQuery($query) {
        if(self::$conn != null) {
            try {
                self::$conn->prepare($query);
            } catch(Exception $e) {
                throw new Exception('connection: ' . self::$dns . $e->getMessage() . '<br/>');
            }
        }
    }

    public function getResult() {
        if(self::$conn != null) {
            try {
                return self::$conn;
            } catch(Exception $e) {
                throw new Exception('connection: ' . self::$dns . $e->getMessage() . '<br/>');
            }
        }
    }
}
