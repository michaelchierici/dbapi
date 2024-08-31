<?php
namespace Src\Controller;
use Src\Model\UserModel;

class UserController {
    private $userModel;

    public function __construct() {
        $mysqli = require '../db.php';
        $this->userModel = new UserModel($mysqli);
    }

    public function getAllUsers() {
        $users = $this->userModel->getAllUsers();
        echo json_encode($users);
    }

    public function getUser($id) {
        echo json_encode(["message" => "Get user with ID $id"]);
    }

    public function createUser($name, $password, $email) {
        $user = $this->userModel->createUser($name, $password, $email);
        echo json_encode($user);
    }

    public function updateUser($id) {
        echo json_encode(["message" => "Update user with ID $id"]);
    }

    public function deleteUser($id) {
        echo json_encode(["message" => "Delete user with ID $id"]);
    }
}

