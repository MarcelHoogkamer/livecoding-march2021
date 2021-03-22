<?php

class UserLoader
{
    public static function getAllUsers(Pdo $pdo) : array
    {
        $query = $pdo->query('select * from user ORDER BY name');
        $rawUsers = $query->fetchAll();

        $users = [];
        foreach($rawUsers AS ['id' => $id, 'name' => $name, 'email' => $email, 'age' => $age]) {
            $users[] = User::loadFromDatabase(
                $id,
                $name,
                $email,
                $age
            );
        }
        return $users;
    }

    public static function getUser(Pdo $pdo, int $id) : User
    {
        //use bindValue to prevent SQL INJECTION
        $query = $pdo->prepare('select * from user where id = :id');
        $query->bindValue('id', $id);
        $query->execute();
        $rawData = $query->fetch();

        return User::loadFromDatabase($id, $rawData['name'], $rawData['email'], $rawData['age']);
    }
}