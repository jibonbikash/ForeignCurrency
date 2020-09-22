<?php
/**
 * Created by  jibon Bikash Roy.
 * User: jibon
 * Date: 8/29/20
 * Time: 9:45 PM
 * Copyright jibon <jibon.bikash@gmail.com>
 */

class ForeignCurrency{

    // Connection
    private $conn;

    // Table
    private $db_table = "foreign_currency";

    // Columns
    public $id;
    public $NumCode;
    public $CharCode;
    public $Nominal;
    public $Name;
    public $Value;

    // Db connection
    public function __construct($db){
        $this->conn = $db;
    }

    // GET ALL


    // CREATE
    public function createForCurrency(){
        $sqlQuery = "INSERT INTO
                        ". $this->db_table ."
                    SET
                        NumCode = :NumCode, 
                        CharCode = :CharCode, 
                        Nominal = :Nominal, 
                        Name = :Name, 
                        Value = :Value, 
                        created = :created";

        $stmt = $this->conn->prepare($sqlQuery);

        // sanitize
        $this->NumCode=htmlspecialchars(strip_tags($this->NumCode));
        $this->CharCode=htmlspecialchars(strip_tags($this->CharCode));
        $this->Nominal=htmlspecialchars(strip_tags($this->Nominal));
        $this->Name=htmlspecialchars(strip_tags($this->Name));
        $this->Value=htmlspecialchars(strip_tags($this->Value));
        $this->created=htmlspecialchars(strip_tags($this->created));

        // bind data
        $stmt->bindParam(":NumCode", $this->NumCode);
        $stmt->bindParam(":CharCode", $this->CharCode);
        $stmt->bindParam(":Nominal", $this->Nominal);
        $stmt->bindParam(":Name", $this->Name);
        $stmt->bindParam(":Value", $this->Value);
        $stmt->bindParam(":created", $this->created);

        if($stmt->execute()){
            return true;
        }
        return false;
    }

    public function Emptytable()
    {

        $sqlQuery = "TRUNCATE TABLE " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function getAllForCurrency(){
        $sqlQuery = "SELECT id, NumCode, CharCode, Nominal, Name, Value, created FROM " . $this->db_table . "";
        $stmt = $this->conn->prepare($sqlQuery);
        $stmt->execute();
        return $stmt;
    }

}