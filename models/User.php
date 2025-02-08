<?php

class User {
    protected $db;
    protected $id;
    protected $nom;
    protected $email;
    protected $role;

    public function __construct($id = null) {
        $this->db = Database::getInstance()->getConnection();
        if ($id) {
            $this->loadUser($id);
        }
    }

    protected function loadUser($id) {
        $stmt = $this->db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $this->id = $user['id'];
            $this->nom = $user['nom'];
            $this->email = $user['email'];
            $this->role = $user['role'];
        }
    }

    public function create($nom, $email, $password, $role) {
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
        $stmt = $this->db->prepare("INSERT INTO users (nom, email, password, role) VALUES (?, ?, ?, ?)");
        return $stmt->execute([$nom, $email, $hashedPassword, $role]);
    }

    public static function findByEmail($email) {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($user) {
            $userObj = new static();
            $userObj->loadUser($user['id']);
            return $userObj;
        }
        return null;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function getPassword() {
        $stmt = $this->db->prepare("SELECT password FROM users WHERE id = ?");
        $stmt->execute([$this->id]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['password'];
    }
}

