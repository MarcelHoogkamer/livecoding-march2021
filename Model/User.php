<?php
declare(strict_types=1);

$user = User::loadFromDatabase(5, 'koen', 'email', 5);

class User
{
    private ?int $id = null;
    private string $name;
    private string $email = 'dummy@dummy.be';
    private int $age;

    public function __construct(string $name, string $email, int $age) // , int $id = null
    {
        $this->name = $name;
        $this->setEmail($email);
        $this->age = $age;
        //$this->id = $id;
    }

    public static function loadFromDatabase(int $id, string $name, string $email, int $age) : User
    {
        $user = new User($name, $email, $age);
        $user->id = $id;
        return $user;
    }

    public function getId():? int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): bool
    {
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        $this->email = $email;

        return true;
    }

    public function getAge(): int
    {
        return $this->age;
    }

    public function setAge(int $age): void
    {
        $this->age = $age;
    }

    private function insert(Pdo $pdo)
    {
        $query = $pdo->prepare('INSERT INTO user (name, email, age) VALUES (:name, :email, :age)');
//        $query = $pdo->prepare('INSERT user SET name = :name, email = :email, age = :age');
        $query->bindValue('name', $this->name);
        $query->bindValue('email', $this->email);
        $query->bindValue('age', $this->age);
        $query->execute();

        $this->id = (int)$pdo->lastInsertId();
    }

    private function update(Pdo $pdo)
    {
        $query = $pdo->prepare('UPDATE user SET name = :name, email = :email, age = :age WHERE id = :id');
        $query->bindValue('name', $this->name);
        $query->bindValue('email', $this->email);
        $query->bindValue('age', $this->age);
        $query->bindValue('id', $this->id);
        $query->execute();
    }

    public function save(Pdo $pdo) : void
    {
        if($this->getId() === null) {
            $this->insert($pdo);
        } else {
            $this->update($pdo);
        }
    }

    public function delete(Pdo $pdo) : void
    {
        if($this->id === null) {
            throw new LogicException('User does not exist in database');
        }

        $query = $pdo->prepare('delete from user where id = :id');
        $query->bindValue('id', $this->id);
        $query->execute();
    }
}