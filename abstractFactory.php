<?php
    /**
     * Creational desgin pattern that allows producing families of related objects
     * without specifying their concrete class.
     */

    interface AbstractFactory
    {
        public function createClassicProduct();
        public function createModernProduct();
    }

    class firstConcreteFactory implements AbstractFactory
    {
        public function createClassicProduct() 
        {
            return new ConcreteProductA1();
        }

        public function createModernProduct()
        {
            return new ConcreteProductB1();
        }
    }

    class secondConcreteFactory implements AbstractFactory
    {
        public function createClassicProduct()
        {
            return new ConcreteProductA2();
        }

        public function createModernProduct()
        {
            return new ConcreteProductB2();
        }
    }

    interface AbstractProductA
    {
        public function productAInit();
    }

    class ConcreteProductA1 implements AbstractProductA
    {
        public function productAInit()
        {
            return "The result of the product A1 creation.";
        }
    }

    class ConcreteProductA2 implements AbstractProductA
    {
        public function productAInit()
        {
            return "The result of the product A2 creation.";
        }
    }

    interface AbstractProductB
    {
        public function productBInit();
        public function postProductBInit(AbstractProductA $collaborator);
    }

    class ConcreteProductB1 implements AbstractProductB
    {
        public function productBInit()
        {
            return "The result of the product B1.";
        }

        public function postProductBInit(AbstractProductA $collaborator)
        {
            $result = $collaborator->productAInit();

            return "The result of the B1 collaborating with the ({$result})";
        }
    }

    class ConcreteProductB2 implements AbstractProductB
    {
        public function productBInit()
        {
            return "The result of the product B2.";
        }

        public function postProductBInit(AbstractProductA $collaborator)
        {
            $result = $collaborator->productAInit();

            return "The result of the B2 collaborating with the ({$result})";
        }
    }

    function clientCode(AbstractFactory $factory)
    {
        $productA = $factory->createClassicProduct();
        $productB = $factory->createModernProduct();

        echo $productB->productBInit() . "\n";
        echo $productB->postProductBInit($productA) . "\n";
    }

    echo "Creating A1 B1 Family Combination ... :\n";
    clientCode(new firstConcreteFactory());

    echo "\n";

    echo "Creating A2 B2 Family Combination ... :\n";
    clientCode(new secondConcreteFactory());
?>
