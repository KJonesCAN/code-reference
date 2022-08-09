<?php
class Contact {
    public $firstName;
    public $lastName;
    public $phone;
    public $email;
    public $website;

    public function __construct($firstName, $lastName, $phone, $email, $website) {
        $this->firstName = $firstName; 
        $this->lastName = $lastName; 
        $this->phone = $phone; 
        $this->email = $email; 
        $this->website = $website; 
    }

    public function welcome() {
        echo "
            <p>Welcome to the website, {$this->firstName}!</p>
            <p>
                <label>Name:</label> {$this->firstName} {$this->lastName}<br />
                <label>Phone:</label> {$this->phone}<br />
                <label>Email:</label> {$this->email}<br />
                <label>Website:</label> {$this->website}<br />
            </p>
        ";
    }
}

class Goodbye {
    const LEAVING_MESSAGE = "Thank you for visiting!";
}

$user = new Contact('Kelly', 'Jones', '905-555-1234', 'kellyjones@outlook.com', 'https://kellyjones.ca');
$user->welcome();

var_dump($user);

echo '<p>' . Goodbye::LEAVING_MESSAGE . '</p>';

/* Goodbye 2nd Example */

class Goodbye2 {
    const LEAVING_MESSAGE2 = "<p>Thank you for visiting KellyJones.ca!</p>";

    public function byebye() {
        echo self::LEAVING_MESSAGE2;
    }
}

$goodbye = new Goodbye2();
$goodbye->byebye();
?>