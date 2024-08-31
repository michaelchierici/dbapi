<?php

namespace Src\Model;

class UserModel {
    private $mysqli;

    public function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    public function getAllUsers() {
        $sql = "SELECT * FROM user";
        $result = $this->mysqli->query($sql);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getUserById($id) {
        $stmt = $this->mysqli->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        return $stmt->get_result()->fetch_assoc();
    }

    public function createUser($name, $password, $email) {
        $stmt = $this->mysqli->prepare("INSERT INTO user (name, password, email) VALUES (?, ?, ?)");
        $stmt->bind_param("ss", $name, $password, $email);
        return $stmt->execute();
    }

    public function updateUser($id, $name, $email) {
        $stmt = $this->mysqli->prepare("UPDATE user SET name = ?, email = ? WHERE id = ?");
        $stmt->bind_param("ssi", $name, $email, $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $stmt = $this->mysqli->prepare("DELETE FROM user WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
