<?php

class database{
    
    public function connect(){
        $connection = new  mysqli("localhost","padra741_vista","vist@123","padra741_vista");
        return $connection;
    }
}

