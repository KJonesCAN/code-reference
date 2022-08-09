<?php
class Contact {
    public $firstName;
    public $lastName;
    public $company;
    public $dob;
    public $phone;
    public $email;
    public $website;
    public $address1;
    public $address2;
    public $city;
    public $province;
    public $postalCode;
    public $country;

    public function __construct($firstName, $lastName, $company, $dob, $phone, $email, $website, $address1, $address2, $city, $province, $postalCode, $country) {
        $this->firstName = $firstName; 
        $this->lastName = $lastName; 
        $this->company = $company; 
        $this->dob = $dob; 
        $this->phone = $phone; 
        $this->email = $email; 
        $this->website = $website; 
        $this->address1 = $address1; 
        $this->address2 = $address2; 
        $this->city = $city; 
        $this->province = $province; 
        $this->postalCode = $postalCode; 
        $this->country = $country; 
    }

    public function welcome() {
        echo "
            <p>Welcome to the website, {$this->firstName}!</p>
            <p>
                <label>Name:</label> {$this->firstName} {$this->lastName}<br />
                <label>Date of Birth:</label> {$this->dob}<br />
                <label>Company:</label> {$this->company}<br />
                <label>Phone:</label> {$this->phone}<br />
                <label>Email:</label> {$this->email}<br />
                <label>Website:</label> {$this->website}<br />
                <label>Address:</label> {$this->address1} {$this->address2}<br />
                <label>City:</label> {$this->city}<br />
                <label>Province:</label> {$this->province}<br />
                <label>Postal Code:</label> {$this->postalCode}<br />
                <label>Country:</label> {$this->country}<br />
            </p>
        ";
    }
}

class Goodbye {
    const LEAVING_MESSAGE = "Thank you for visiting!";
}

$user = new Contact('Kelly', 'Jones', 'KellyJones.ca', '09-26-1975', '905-555-1234', 'kellyjones@outlook.com', 'https://kellyjones.ca', '123 Main St.', 'Apt. 4', 'Hamilton', 'Ontario', 'L8N 2C3', 'Canada');
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