<?
require_once $_SERVER['DOCUMENT_ROOT']."/ectr/"."/Database/QueryCommands.php";

class EctrUserClass{
    public $firstName ;
    public $lastName;
    private $password;
    public $email;
    private $birthday;
    private $memType;
    private $userId;
    private $creditCardID;
    
    public function __construct() { 
        $this->firstName = "";
        $this->lastName='';
        $this->password='';//Very Unsafe!!!
        $this->email='';
        $this->birthday='';
        $this->memType='';
    }
    
    public static function WithRow($fName,$lName,$pass,$em,$bday,$mType) { 
        $instance = new self();
        $instance->firstName = $fName;
        $instance->lastName=$lName;
        $instance->password=$pass;//Very Unsafe!!!
        $instance->email=$em;
        $instance->birthday=$bday;
        $instance->memType=$mType; 
        return $instance;
    }
    
    //reads in a row and converts it into a User Object
    public function userDataToObject($key,$value){
        $mysqli = db_connect();
        $userDataTable= getUserTableName();
        $sql= "SELECT * FROM $userDataTable WHERE $key = '$value'";
        $result = $mysqli->query($sql);
        if (!$result) {
            echo 'Could not run query: ' . mysql_error();
            return false;
        }else{
            $row = $result->fetch_row();
            
            $user = EctrUserClass::WithRow($row[0],$row[1],$row[2],$row[3],$row[4],$row[5]); 
            echo '<script>alert("This is Name: Row[0] = '.$row[0].'")</script>';                
            echo '<script>alert("This is Proof of User='.$user->firstName.'")</script>';                

            return $user;
        }
    }
    
    public function addUserToTable(){
        addUser($this->firstName,$this->lastName,$this->email,$this->password,
                $this->memType,$this->userId,$this->creditCardID);
    }
        
    public function getFirstName() {
		return $this->firstName;
	}
    
    public function getLastName() {
		return $this->lastName;
	}
    
    public function getEmail() {
		return $this->email;
	}
    
    public function getBirthday() {
		return $this->birthday;
	}
    
    public function getUserID() {
		return $this->userID;
	}
    
    public function getCrediCardID() {
		return $this->creditCarID;
	}
    
    
}
?>