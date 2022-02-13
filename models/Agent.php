<?php
    class Agent {
        //
        private $conn;
        private $table = 'agent';

        // Agent properties
        public $id;
        public $category_id;
        public $agent_name;
        public $age;
        public $email;
        public $created_at;

        // Constructor with DB
        public function __construct($db){
            $this->conn = $db;
        }

        //
        public function read() {
            //
            $query = 'SELECT 
                a.name as agent_name,
                p.id,
                p.category_id,
                p.age,
                p.email,
                p.created_at
            FROM
            ' . $this->table . ' p
            LEFT JOIN
               agent a ON p.category_id = a.id     
            ORDER BY
                p.created_at DESC';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Execute query
            $stmt->execute();

            return $stmt;
        
        }

        // Get Single Post
        public function read_single(){
             //
             $query = 'SELECT 
             a.name as agent_name,
             p.id,
             p.category_id,
             p.age,
             p.email,
             p.created_at
         FROM
            ' . $this->table . ' p
         LEFT JOIN
            agent a ON p.category_id = a.id     
         WHERE
             p.id = ?
        LIMIT 0,1';

        // Prepare statement
        $stmt = $this->conn->prepare($query);

        // Bind ID
        $stmt->bindParam(1, $this->id);

        // Execute query
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        // Set properties
        $this->agent_name = $row['agent_name'];
        $this->age = $row['age'];
        $this->email = $row['email'];
        $this->category_id = $row['category_id'];
        }

        // Create Post
        public function create() {
            // Create query
            $query = 'INSERT INTO ' .
                $this->table . '
                SET
                    agent_name = :agent_name,
                    age = :age,
                    email = :email,
                    category_id =:category_id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->agent_name = htmlspecialchars(strip_tags($this->agent_name));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));

            // Bind Data
            $stmt->bindParam(':agent_name', $this->agent_name);
            $stmt->bindParam(':age', $this->age);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':category_id', $this->category_id);

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
                    agent_name = :agent_name,
                    age = :age,
                    email = :email,
                    category_id =:category_id
                WHERE
                    id = :id';

            // Prepare statement
            $stmt = $this->conn->prepare($query);

            // Clean data
            $this->agent_name = htmlspecialchars(strip_tags($this->agent_name));
            $this->age = htmlspecialchars(strip_tags($this->age));
            $this->email = htmlspecialchars(strip_tags($this->email));
            $this->category_id = htmlspecialchars(strip_tags($this->category_id));
            $this->id = htmlspecialchars(strip_tags($this->id));

            // Bind Data
            $stmt->bindParam(':agent_name', $this->agent_name);
            $stmt->bindParam(':age', $this->age);
            $stmt->bindParam(':email', $this->email);
            $stmt->bindParam(':category_id', $this->category_id);
            $stmt->bindParam(':id', $this->id);

            // Execute query
            if($stmt->execute()) {
                return true;
            }

            // Print error if something goes wrong
            printf("Error: %s. \n", $stmt->error);
            return false;
        }

        // Delete Post
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

