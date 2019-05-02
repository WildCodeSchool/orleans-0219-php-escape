<?php


namespace App\Model;

class MissionManager extends AbstractManager
{
    /**
     *
     */
    const TABLE = 'missions';

    /**
     *  Initializes this class.
     */
    public function __construct()
    {
        parent::__construct(self::TABLE);
    }

    /**
     * @param array $mission
     * @return int
     */
    public function insert(array $mission): int
    {
        // prepared request
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`title`, `level`, `subtitle`, `minplayers`,
 `maxplayers`, `description`, `image`) VALUES (:title, :level, :subtitle, :minplayers, :maxplayers, :description, :image)");
        $statement->bindValue('title', $mission['title'], \PDO::PARAM_STR);
        $statement->bindValue('subtitle', $mission['subtitle'], \PDO::PARAM_STR);
        $statement->bindValue('minplayers', $mission['minplayers'], \PDO::PARAM_INT);
        $statement->bindValue('maxplayers', $mission['maxplayers'], \PDO::PARAM_INT);
        $statement->bindValue('level', $mission['level'], \PDO::PARAM_INT);
        $statement->bindValue('description', $mission['description'], \PDO::PARAM_STR);
        $statement->bindValue('image', $mission['image'], \PDO::PARAM_STR);
        if ($statement->execute()) {
            return (int)$this->pdo->lastInsertId();
        }
    }


    /**
     * @param int $id
     */
    public function delete(int $id): void
    {
        // prepared request
        $statement = $this->pdo->prepare("DELETE FROM $this->table WHERE id=:id");
        $statement->bindValue('id', $id, \PDO::PARAM_INT);
        $statement->execute();
    }


    /**
     * @param array $mission
     * @return bool
     */
    public function update(array $mission):bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title,`level` = :level,
 `subtitle` = :subtitle,`minplayers` = :minplayers, `maxplayers` = :maxplayers,`description` = :description,
  `image` = :image WHERE id=:id");
        $statement->bindValue('id', $mission['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $mission['title'], \PDO::PARAM_STR);
        $statement->bindValue('subtitle', $mission['subtitle'], \PDO::PARAM_STR);
        $statement->bindValue('minplayers', $mission['minplayers'], \PDO::PARAM_INT);
        $statement->bindValue('maxplayers', $mission['maxplayers'], \PDO::PARAM_INT);
        $statement->bindValue('level', $mission['level'], \PDO::PARAM_INT);
        $statement->bindValue('description', $mission['description'], \PDO::PARAM_STR);
        $statement->bindValue('image', $mission['image'], \PDO::PARAM_STR);


        return $statement->execute();
    }
}
