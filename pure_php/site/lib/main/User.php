<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.10.2018
 * Time: 13:20
 */


class User extends BaseClass
{

    public $id;
    public $username = false;
    public $email;
    public $units;
    public $name;
    public $lastname;
    public $role;
    public $db;
    public $params;

    public function __construct(DB $db, Params $params)
    {
        $this->db = $db;
        $this->params = $params;
        if (!session_start())
            die("Could not open the session");

        if (isset($_SESSION['user'])) {
            $this->id = $_SESSION['user']['id'];
            $this->update();
        }else
            $this->logout();

    }

    /**
     * @param string $username
     * @param string $password
     * @return array|bool
     */
    public function login($data)
    {
        if ($this->username)
            return ['You are already logged in'];
        $valid = $this->validateLogin($data);
//        var_dump($valid);die;
        if ($valid === true) {
            $sql = "SELECT * FROM users WHERE username = '{$data['username']}'";
            $user = $this->db->query($sql);
            $user = $user->fetch_assoc();
            if ($user){
                if ($user['password'] == sha1($data['password'])) {
                    $this->setSession($user);
                    return true;
                }
            }
            return ['Username or password is incorrect'];
        } else
            return $valid;
    }

    /**
     * @return array|bool
     */
    public function register($data)
    {
        if ($this->username)
            return ['You are already logged in'];
        $valid = $this->validateUser($data);
        if ($valid) {
            if($data['password'] != $data['password2'])
                return ['Passwords are not equal'];
            $password = sha1($data['password']);
            $sql = "INSERT INTO users(username, password, email, name, lastname, units, status, role) VALUES( '{$data['username']}', '{$password}', '{$data['email']}', '{$data['name']}', '{$data['lastname']}', 0, 1, 'user')";
            $user = App::$db->query($sql);
            if ($user) {
                $this->login($data);
                return true;
            }
            else
                return [$sql];
            return ['Something went wrong'];
        } else
            return $valid;
    }

    /**
     * @param string $username
     * @param string $password
     * @return array|bool
     */
    public function logout()
    {
        unset($_SESSION['user']);
        $this->id = null;
        $this->username = false;
        $this->email = null;
        $this->units = null;
        $this->name = null;
        $this->lastname = null;
        $this->role = null;
    }

    /**
     * @param array $data
     * @return array|bool
     */
    private function validateLogin($data)
    {
        $rules = [
            'rules' => [
                'username' => [
                    'required' => true,
                    'maxLength' => 100,
                    'minLength' => 3,
                    'alphaNumeric' => true,
                ],
                'password' => [
                    'required' => true,
                ],
            ],
            'messages' => [
                'username' => [
                    'required' => 'Enter the username',
                    'maxLength' => 'username is too long',
                    'minLength' => 'username us too short',
                    'alphaNumeric' => 'Username must contain only alphabetic characters and numbers',
                ],
                'password' => [
                    'required' => 'Enter the password',
                ],
            ],
        ];

        return Validation::_initialize($rules, $data);
    }

    /**
     * @param string $username
     * @return array|bool
     */
    private function validateUser($data)
    {
        $rules = [
            'rules' => [
                'username' => [
                    'required' => true,
                    'maxLength' => 100,
                    'minLength' => 3,
                    'alphaNumeric' => true,
                ],
                'password' => [
                    'required' => true,
                    'maxLength' => 100,
                    'minLength' => 5,
                ],
                'password2' => [
                    'required' => true,
                ],
                'email' => [
                    'required' => true,
                    'email' => true,
                ],
                'name' => [
                    'alphabetsOnly' => true,
                ],
                'lastname' => [
                    'alphabetsOnly' => true,
                ],
            ],
            'messages' => [
                'username' => [
                    'required' => 'Enter the username',
                    'maxLength' => 'Username is too long',
                    'minLength' => 'Username us too short',
                    'alphaNumeric' => 'Username must contain only alphabetic characters and numbers',
                ],
                'password' => [
                    'required' => 'Enter the password',
                    'maxLength' => 'Password is too long',
                    'minLength' => 'Password us too short',
                ],
                'password2' => [
                    'required' => 'Enter the password again',
                ],
                'email' => [
                    'required' => 'Enter the email',
                    'email' => 'Email is not valid',
                ],
                'name' => [
                    'required' => 'Name must contain only alphabetic characters',
                ],
                'lastname' => [
                    'required' => 'Last Name must contain only alphabetic characters',
                ],
            ],
        ];

        return Validation::_initialize($rules, $data);
    }

    private function setSession($user)
    {
        $_SESSION['user']['id'] = $user['id'];
    }

    public function update()
    {
        $user = $this->db->query("SELECT * FROM users WHERE id = '{$this->id}'");
        $user = $user->fetch_assoc();
        if ($user) {
            $this->id = $user['id'];
            $this->username = $user['username'];
            $this->email = $user['email'];
            $this->units = $user['units'];
            $this->name = $user['name'];
            $this->lastname = $user['lastname'];
            $this->role = $user['role'];

            $_SESSION['user']['id'] = $user['id'];
            return true;
        }
        return false;
    }
}