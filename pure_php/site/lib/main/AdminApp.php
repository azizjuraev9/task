<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 08.10.2018
 * Time: 15:40
 */

class AdminApp extends App
{

    protected static $userMethods = [];

    public static $defaultAction = 'params';

    public static function run($db, $params, $user)
    {
        if (!$user->username || $user->role != 'admin')
            die;
        parent::run($db, $params, $user);
    }

    protected static function _winnings($data)
    {
        $sql = "SELECT  t.id, u.username, t.money, t.gift_id, t.status, t.time, g.name, g.image 
FROM user_gift t 
LEFT JOIN gifts AS g ON t.gift_id = g.id
LEFT JOIN users AS u ON t.user_id = u.id";

        if(isset($data['winning'])){
            $addSql = [];
            if (preg_match('/[a-zA-z0-9]/', $data['winning']['username']) && strlen(trim((string)$data['winning']['username'])) > 0)
                $addSql[] = "u.username LIKE'%".trim($data['winning']['username'])."%'";
            if (preg_match('/[a-zA-z0-9]/', $data['winning']['gift_name']) && strlen(trim((string)$data['winning']['gift_name'])) > 0)
                $addSql[] = "g.name LIKE'%".trim($data['winning']['gift_name'])."%'";
            if (preg_match('/[a-zA-z0-9]/', $data['winning']['status']) && strlen(trim((string)$data['winning']['status'])) > 0)
                $addSql[] = "t.status = ".trim($data['winning']['status']);
            if (preg_match('/[a-zA-z0-9]/', $data['winning']['money']) && strlen(trim((string)$data['winning']['money'])) > 0)
                $addSql[] = "t.money = ".trim($data['winning']['money']);
            if(count($addSql) > 0)
                $sql .= ' WHERE '.implode(' AND ',$addSql);
//            var_dump($addSql,$sql);die;
        }

        $gifts = self::$db->query($sql);
        if(!$gifts){
            var_dump($sql,self::$db->error());die;
        }
        self::$view_params['include'] = 'winnings';
        self::$view_params['gifts'] = $gifts;
    }

    protected static function _send($data)
    {
        if(isset($data['id']) && self::checkToken($data)){
            $id = (int)$data['id'];
            self::$db->query("UPDATE user_gift SET status=2 WHERE id={$id}");

            // TODO:

        }
        header("location: admin.php?action=winnings");
    }

    protected static function _params()
    {
        self::$view_params['include'] = 'list_params';
        self::$view_params['pitems'] = self::$db->query("SELECT * FROM params");
    }

    protected static function _gifts()
    {
        self::$view_params['include'] = 'list_gifts';
        self::$view_params['gitems'] = self::$db->query("SELECT * FROM gifts");
    }

    protected static function _updateGift()
    {
        if (isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $r = self::$db->query("SELECT * FROM gifts WHERE id = {$id}");
            $r = $r->fetch_assoc();
            if (!$r)
                header("location: admin.php?action=gifts");
            self::$view_params['giftVal'] = $r;
            self::$view_params['include'] = 'update-gift';
        } else
            header("location: admin.php?action=gifts");
    }

    protected static function _deleteGift()
    {
        if (self::checkToken($_GET) && isset($_GET['id'])) {
            $id = (int)$_GET['id'];
            $r = self::$db->query("SELECT * FROM gifts WHERE id = {$id}");
            $r = $r->fetch_assoc();
            if($r){
                unlink($r['image']);
                self::$db->query("DELETE FROM gifts WHERE id = {$id}");
            }
        }
        header("location: admin.php?action=gifts");
    }

    protected static function _post_saveParams()
    {
        if (isset($_POST['params'])) {
            $sql = '';
            foreach ($_POST['params'] as $k => $v)
                // I consider that this place is safe so :
                $sql .= "UPDATE `params`\n SET `value` = '{$v}'\n WHERE `key`='{$k}';\n";

            $r = self::$db->multiple($sql);
            if (!$r) {
                var_dump($sql, self::$db->error());
                die;
            }
        }
        header("location: admin.php?action=params");
    }

    protected static function _post_addGift()
    {
        if (isset($_POST['gift'])) {
            if (($valid = self::validateGift($_POST['gift'])) === true) {
                if (($image = self::uploadImage('addGift')) !== false) {
                    $sql = "INSERT INTO gifts(name, image, amount, status) VALUES('{$_POST['gift']['name']}','{$image}',{$_POST['gift']['amount']},{$_POST['gift']['status']})";
                    if (!self::$db->query($sql)) {
                        unlink($image);
                        self::$errors['addGift'][] = 'Something went wrong';
                        return;
                    }
                    header("location: admin.php?action=gifts");
                }
            } else
                self::$errors['addGift'] = $valid;
        }
    }

    protected static function _post_updateGift()
    {
        if (isset($_POST['gift'])) {
            if (($valid = self::validateGift($_POST['gift'])) === true) {

                if (($image = self::uploadImage('updateGift')) === false)
                    $image = self::$view_params['giftVal']['image'];
                else
                    unlink(self::$view_params['giftVal']['image']);

                $id = self::$view_params['giftVal']['id'];
                $sql = "UPDATE gifts SET name = '{$_POST['gift']['name']}', image = '{$image}', amount = {$_POST['gift']['amount']}, status = {$_POST['gift']['status']} WHERE id={$id}";
                if (!self::$db->query($sql)) {
                    self::$errors['updateGift'][] = 'Something went wrong';
                    return;
                }
                header("location: admin.php?action=gifts");

            } else
                self::$errors['updateGift'] = $valid;
        }
    }

    private static function uploadImage($errors)
    {
        if (isset($_FILES['image'])) {
            if (in_array(strtolower(substr($_FILES['image']['name'], -3)), ['jpg', 'jpeg', 'png', 'bmp'])) {
                $name = 'uploads/' . uniqid(time() . '_') . substr($_FILES['image']['name'], -4);
                if (!is_dir('uploads'))
                    mkdir('uploads');
                if (move_uploaded_file($_FILES['image']['tmp_name'], $name))
                    return $name;
            } else {
                self::$errors[$errors][] = 'image type is incorrect';
            }
        } else {
            self::$errors[$errors][] = 'image has not been chosen';
        }
        return false;
    }

    private function validateGift($data)
    {
        $rules = [
            'rules' => [
                'name' => [
                    'required' => true,
                ],
                'amount' => [
                    'required' => true,
                    'number' => true,
                ],
                'status' => [
                    'required' => true,
                    'number' => true,
                ],
            ],
            'messages' => [
                'name' => [
                    'required' => 'Enter the name',
                ],
                'amount' => [
                    'required' => 'Enter the amount',
                    'number' => 'Amount must be numerical',
                ],
                'status' => [
                    'required' => 'Enter the password again',
                    'number' => 'Status must be numerical',
                ],
            ],
        ];

        return Validation::_initialize($rules, $data);
    }
}