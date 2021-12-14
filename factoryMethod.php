<?php
    /**
    *   The factory method replaces direct object construction calls
    *   with calls to specific factory methods. Also called virtual constructor.
    *   The factory method can be declared abstract to enforce it's implementation.
    */

    abstract class EmployeeFactory
    {
        abstract public function initiateEmployee();

        public function callEmpOperation(): string
        {
            $employeeProduct = $this->initiateEmployee();
            return "Employee Factory Code Called By : ".$employeeProduct->operation();
        }
    
    }

    class RegularEmployeeCreator extends EmployeeFactory
    {
        public function initiateEmployee()
        {
            return new firstEmployeeProduct();
        }
    }

    class NewerEmployeeCreator extends EmployeeFactory
    {
        public function initiateEmployee()
        {
            return new secondEmployeeProduct();
        }
    }

    interface Employee
    {
        public function operation();
    }

    class firstEmployeeProduct implements Employee
    {
        private $employeeDetail;

        public function __construct()
        {
            $this->employeeDetail = "Production Line #1"."\nEmployee created at : ".date("h:i:sa");
        }
        public function operation ()
        {
            return $this->employeeDetail;
        }
    }

    class secondEmployeeProduct implements Employee
    {
        private $employeeDetail;

        public function __construct()
        {
            $this->employeeDetail = "Production Line #2"."\nEmployee created at : ".date("h:i:sa");
        }
        public function operation ()
        {
            return $this->employeeDetail;
        }
    }

    function clientCode(EmployeeFactory $factory)
    {
        echo "Creating Employee Product ... \n"
            . $factory->callEmpOperation();
    }

    echo "App: Launched with the Regular Employee Code.\n";
    clientCode(new RegularEmployeeCreator());
    echo "\n-----------------------------\n";
    sleep(2);
    echo "App: Launched with the Newer Employee Code.\n";
    clientCode(new NewerEmployeeCreator());

?>

