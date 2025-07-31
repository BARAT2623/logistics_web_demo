<?php
class Post {
    private $conn;
    private $table = 'bills'; // Table name is 'bills'

    public $id;
    public $from_location;
    public $to_location;
    public $consignee;
    public $consigner;
    public $no_of_pieces;
    public $weight;
    public $rate;
    public $total_bill;

    public function __construct($db) {
        $this->conn = $db;
    }
    
    public function read() {
        $query = 'SELECT 
                    id,
                    from_location,  -- Corrected column name
                    to_location,
                    consignee,
                    consigner,
                    no_of_pieces,
                    weight,
                    rate,
                    total_bill,
                    status
                  FROM
                    ' . $this->table . '
                  ORDER BY 
                    id ASC'; // Ordering by id since created_at is not available

        $stmt = $this->conn->prepare($query);

        if ($stmt === false) {
            die("Error preparing query: " . $this->conn->error);
        }

        // Execute
        $stmt->execute();

        return $stmt->get_result();
    }
    
  
  
}
?>
