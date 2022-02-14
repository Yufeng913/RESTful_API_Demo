<?php
    class Property {
        //DB stuff
        private $conn;
        private $table = 'property';

        // Properties
        public $id;
        public $name;
        public $created_at;

        // Constructor with DB
        public function __construct($db) {
            $this->conn = $db;
        }

        // Get properties
        public function read() {
            // Create query
            $query = 'SELECT
                id,
                price,
                address,
                area,
                agent,
                created_at
            FROM
                ' . $this->table . '
            ORDER BY
                created_at DESC';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        }

        // Create Property
        public function create() {
            // Create query
            $query = 'INSERT INTO ' .
                $this->table . '
                SET
                    price = :price,
                    address = :address,
                    area = :area,
                    agent = :agent';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->area = htmlspecialchars(strip_tags($this->area));
            $this->agent = htmlspecialchars(strip_tags($this->agent));

            // Bind Data
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':area', $this->area);
            $stmt->bindParam(':agent', $this->agent);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            return false;
        }

        // Update Post
        public function update() {
            // Update query
            $query = 'UPDATE ' .
                $this->table . '
                SET
                    price = :price,
                    address = :address,
                    area = :area,
                    agent =:agent
                WHERE
                    id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->price = htmlspecialchars(strip_tags($this->price));
            $this->address = htmlspecialchars(strip_tags($this->address));
            $this->area = htmlspecialchars(strip_tags($this->area));
            $this->agent = htmlspecialchars(strip_tags($this->agent));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind Data
            $stmt->bindParam(':price', $this->price);
            $stmt->bindParam(':address', $this->address);
            $stmt->bindParam(':area', $this->area);
            $stmt->bindParam(':agent', $this->agent);
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            return false;
        }

        // Delete Property
        public function delete() {
            // Create query
            $query = 'DELETE FROM ' . $this->table . ' WHERE id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind data
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            
            return false;
        }
    }