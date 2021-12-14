<?php
    /**
     * Singleton is a creational design pattern that ensures that a class has only one instance,
     * while providing global access to that specific instance.
     * 
     * singltons shouldn't be cloneable or restorable from strings
     */

    class DatabaseConnection
    {

        private static $instance = null;
        protected function __construct() { 
            self::$instance['driver'] = 'mySQL';
            self::$instance['port'] = '8000';
            self::$instance['host'] = '127.0.0.1';
            self::$instance['database'] = 'test';
            self::$instance['username'] = 'tester';
            self::$instance['password'] = '';
            print_r(self::$instance);
        }
        protected function __clone() { }

        public function __wakeup()
        {
            throw new \Exception("Cannot unserialize a singleton.");
        }

        public static function getInstance()
        {
          if (self::$instance == null)
          {
            self::$instance = new DatabaseConnection();
          }
       
          return self::$instance;
        }
    }

    function clientCode()
    {
        $dbConnectionOne = DatabaseConnection::getInstance();
        $dbConnectionTwo = DatabaseConnection::getInstance();
        if ($dbConnectionOne === $dbConnectionTwo) {
            echo "Success. Both db connections contain the same instance.";
        } else {
            echo "Error. Both the two db connections are different instances.";
        }
    }

    clientCode();
?>