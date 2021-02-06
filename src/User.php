<?php

class User {
    
    // get the sum of the numbers in an array
    public function get_sum($array) {
        $sum = 0;
        
        foreach($array as $element) {
            $sum = $sum + $element;
        }
        
        return $sum;
    }  
}

?>
