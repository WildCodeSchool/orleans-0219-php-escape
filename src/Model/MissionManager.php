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
        $statement = $this->pdo->prepare("INSERT INTO $this->table (`title`) VALUES (:title)");
        $statement->bindValue('title', $mission['title'], \PDO::PARAM_STR);

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
    public function update(array $mission): bool
    {

        // prepared request
        $statement = $this->pdo->prepare("UPDATE $this->table SET `title` = :title WHERE id=:id");
        $statement->bindValue('id', $mission['id'], \PDO::PARAM_INT);
        $statement->bindValue('title', $mission['title'], \PDO::PARAM_STR);

        return $statement->execute();
    }
}
