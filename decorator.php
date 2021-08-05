<?php
    interface BasicService{
        public function getCost();
    }

    class BasicFunctionality implements BasicService{
        public function getCost(){
            return 'Basic service: $20'."\n";
        }
    }

    // decorator that implements the same contract as the core class
    class ExtraFunctionality implements BasicService{
        protected $basicService;
        
        // the constructor takes in an instance of the contract to build up the decorator at run-time
        // rather than using inheritance.
        function __construct(BasicService $basicService){
            $this->basicService = $basicService;
        }

        public function getCost(){
            return $this->basicService->getCost().'+ Extra service: $30'."\n";
        }
    }

    class AnotherExtraFunctionality implements BasicService{
        protected $basicService;
        
        // the constructor takes in an instance of the contract to build up the decorator at run-time
        // rather than using inheritance.
        function __construct(BasicService $basicService){
            $this->basicService = $basicService;
        }

        public function getCost(){
            return $this->basicService->getCost().'+ Another extra service: $40'."\n";
        }
    }


    echo (new BasicFunctionality())->getCost();
    echo "-----------------------------------\n";
    echo (new ExtraFunctionality(new BasicFunctionality()))->getCost();
    echo "-----------------------------------\n";
    echo (new AnotherExtraFunctionality(new ExtraFunctionality(new BasicFunctionality())))->getCost();

?>
