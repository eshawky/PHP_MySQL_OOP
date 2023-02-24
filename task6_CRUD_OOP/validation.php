<?php 

class validation
{
    public $value;
    public $valid=true;
    public $messages = [];

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function test_input() 
    {
        $value = trim($this->value); 
        $value = stripslashes($value); 
        $value = htmlspecialchars($value); 
        $this->value = $value;
    }
    
    public function required()
    {
        if (empty($this->value)) 
        {
            $this->messages[] = "a value is required\n";
            $this->valid = false;
        }
    }

    public function is_name()
    {
        if (!preg_match("/^[a-zA-Z-' ]*$/", $this->value)) 
        {
            $this->messages[] = "Only letters and white space are allowed for Name\n";
            $this->valid = false;
        }
    }

    public function is_email()
    {
        if (!filter_var($this->value, FILTER_VALIDATE_EMAIL)) 
        {
            $this->messages[] = "Please enter a valid email format\n";
            $this->valid = false;
        }
    }

    public function is_phone()
    {
        if (!preg_match("/^[0-9 +]*$/", $this->value)) 
        {
            $this->messages[] = "Only numbers are allowed for phone number\n";
            $this->valid = false;
        }
    }

    public function min_phone()
    {
        if (strlen($this->value) < 10) 
        {
            $this->messages[] = "Minimum length of phone number is 10\n";
            $this->valid = false;
        }
    }
}
