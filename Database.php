<?php
/**
 * User: teng
 * Date: 17-Apr-18
 * Time: 02:06 PM
 */

class Database {
    private $connection;

    private function getInstanceConnection() {
        if (!$this->connection) {
            $this->connection = new PDO('mysql:host=localhost;dbname=product;charset=utf8mb4', 'root', 'root',
                [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                    //PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
        }
        return $this->connection;
    }

    public function insertItem($name, $quantity) {
        try {
            $conn = $this->getInstanceConnection();

            $conn->beginTransaction();
            $sql = "INSERT INTO products(name, quantity) VALUES (:name, :quantity)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(
                array(
                    ':name' => $name,
                    ':quantity' => $quantity
                )
            );
            $conn->commit();

            $affected_rows = $stmt->rowCount();
            return $affected_rows . " record insert successfully.";
        } catch(PDOException $e) {
            $conn->rollback();
            return $sql . "<br>" . $e->getMessage();
        }
    }

    public function selectItemById($id) {
        try {
            $conn = $this->getInstanceConnection();

            $conn->beginTransaction();
            $sql = "SELECT * FROM products where id = :id";
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->execute(
                array(
                    ':id' => $id
                )
            );
            $conn->commit();

            $Item = $stmt->fetch();
            return $Item;
        } catch(PDOException $e) {
            $conn->rollback();
            return $sql . "<br>" . $e->getMessage();
        }
    }

    public function updateItem($id, $cur) {
        try {
            $conn = $this->getInstanceConnection();

            $conn->beginTransaction();
            $sql = "UPDATE products SET quantity = ? where id = ?";
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->execute([$cur, $id]);
            $conn->commit();

            $updated = $stmt->rowCount();
            return $updated." record update successfully.";
        } catch(PDOException $e) {
            $conn->rollback();
            return $sql . "<br>" . $e->getMessage();
        }
    }

    public function deleteItemById($id) {
        try {
            $conn = $this->getInstanceConnection();

            $conn->beginTransaction();
            $sql = "DELETE FROM products WHERE id = :id";
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->execute(
                array(
                    ':id' => $id
                )
            );
            $conn->commit();

            $affected_rows = $stmt->rowCount();
            return $affected_rows . " record delete successfully.";
        } catch(PDOException $e) {
            $conn->rollback();
            return $sql . "<br>" . $e->getMessage();
        }
    }
}