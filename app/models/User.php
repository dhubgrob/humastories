<?php
class User
{
    private $db;

    public function __construct()
    {
        $this->db = new Database;
    }

    // Register user
    public function register($data)
    {
        $this->db->query('INSERT INTO users (username, hashed_password) VALUES (:username, :hashed_password)');
        $this->db->bind(':username', $data['username']);
        $this->db->bind(':hashed_password', $data['password']);
        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
    // Login user
    public function login($username, $password)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        if ($row) {
            $hashed_password = $row->hashed_password;
            if (password_verify($password, $hashed_password)) {
                return $row;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    // Find user by email
    public function findUserByUsername($username)
    {
        $this->db->query('SELECT * FROM users WHERE username = :username');
        $this->db->bind(':username', $username);

        $row = $this->db->single();

        // Check row
        if ($this->db->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    // Get user by id
    public function getUserById($id)
    {
        $this->db->query('SELECT * FROM users WHERE id = :id');
        $this->db->bind(':id', $id);

        $row = $this->db->single();

        return $row;
    }

    public function getAllUsersExceptAdmin()
    {
        $this->db->query('SELECT * FROM users WHERE id <> :id');
        $this->db->bind(':id', 5);

        $results = $this->db->resultSet();

        return $results;
    }

    public function deleteUser($id)
    {
        $this->db->query('DELETE FROM users WHERE id = :id');
        $this->db->bind(':id', $id);


        if ($this->db->execute()) {
            return true;
        } else {
            return false;
        }
    }
}