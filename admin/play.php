<?php 

/**
 * Class Car
 * @return void
 */

 class Car{
    // Declare property for the car object 

    private $color;
    private $company;
    private $name;
    public const version = '1.0';

    public function __construct($color = 'Space Gray', $name = 'Audi', $company = 'Marcedes'){
        $this->color = $color;
        $this->name = $name;
        $this->company = $company;
    }

    public function getCar(){
        return "The car name is: ". PHP_EOL . $this->name . "<br> The company is: " . $this->company . "<br> Color is: " . $this->color;
    }

    public function setCar($c, $n, $cm){
        $this->name = $n;
        $this->company = $cm;
        $this->color = $c;
    }
 }

    $all_cars = [];

    $car1 = new Car();
    $carone= $car1->setCar('Blue', 'Hundai', 'Awesome');

    echo $car1::version;

    $car2 = new Car();
    $cartow = $car2->setCar('Blue', 'Hundai', 'Awesome');

    $all_cars[] = $car1;
    $all_cars[] = $car2;

    $car_holder = [
        [
            'Carholder 1:' => 'Awesome holder 1', 
            'car' => $car1
        ],
        [
            'Carholder 2:' => 'Awesome holder 1', 
            'car' => $car2
        ]
    ];

/**

Form data
*/


if(isset($_POST['submit'])){
    
    $name = isset( $_POST['name'] ) ? $_POST['name'] : '';
    $email = isset( $_POST['email'] ) ? $_POST['email'] : '';
    $selectoption = isset( $_POST['selectoption'] ) ? $_POST['selectoption'] : '';
    $boolean = isset( $_POST['boolean'] ) ? $_POST['boolean'] : '';
    $feedback = isset( $_POST['feedback'] ) ? $_POST['feedback'] : '';
    
    $all = $name . "<br>" . $email . "<br>" . $selectoption . "<br>" . $boolean . "<br>" . $feedback;
    
    print_r($all);
}
