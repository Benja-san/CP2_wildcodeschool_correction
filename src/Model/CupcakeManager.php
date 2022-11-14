<?php

namespace App\Model;

use PDO;

class CupcakeManager extends AbstractManager {

    public const TABLE = 'cupcake';

    public function addCupcake(array $cupcake): void
    {
        $query = "INSERT INTO " . self::TABLE . " (name, color1, color2, color3, accessory_id) VALUES (:name, :color1, :color2, :color3, :accessoryId)";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(":name", $cupcake["name"], PDO::PARAM_STR);
        $statement->bindValue(":color1", $cupcake["color1"], PDO::PARAM_STR);
        $statement->bindValue(":color2", $cupcake["color2"], PDO::PARAM_STR);
        $statement->bindValue(":color3", $cupcake["color3"], PDO::PARAM_STR);
        $statement->bindValue(":accessoryId", $cupcake["accessory"], PDO::PARAM_INT);
        $statement->execute();
    }

    /**
     * Get all cupcakes with their accessories.
     */
    public function selectAllWithAccessories(string $orderBy = '', string $direction = 'ASC'): array
    {
        $query = 'SELECT cupcake.*, accessory.url FROM ' . static::TABLE . " JOIN accessory ON cupcake.accessory_id=accessory.id";
        if ($orderBy) {
            $query .= ' ORDER BY ' . $orderBy . ' ' . $direction;
        }

        $statement = $this->pdo->query($query);
        $cupcakes = $statement->fetchAll();

        return $cupcakes;
    }

    public function selectOneWithAccessory(int $id): array
    {
        $query = 'SELECT cupcake.*, accessory.url, accessory.name AS accName FROM ' . static::TABLE . " JOIN accessory ON cupcake.accessory_id=accessory.id WHERE cupcake.id = :id";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(":id", $id, PDO::PARAM_INT);
        $statement->execute();
        $cupcake = $statement->fetch();
        return $cupcake;
    }

}