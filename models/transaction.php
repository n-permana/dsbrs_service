<?php
    require 'db/connection.php';

    class Transaction {
        public $id;
        public $bank_code;
        public $account_number;
        public $amount;
        public $fee;
        public $beneficiary_name;
        public $status;
        public $receipt;
        public $remark;
        public $timestamp;
        public $time_served;
        public $created_at;
        public $updated_at;

        function __construct($parameters = array()) {
            $this->connection = DBConnection::get_connection();
            foreach($parameters as $key => $value) {
                $this->$key = $value;
            }
        }

        public static function list() {
            $connection = DBConnection::get_connection();
            $res = $connection->query('SELECT * FROM transactions');
            $result = array();
            while ($row = $res->fetchArray()) {
                array_push($result,new Transaction($row));
            }
            return $result;
        }

        public static function find($id) {
            $connection = DBConnection::get_connection();
            $query = sprintf("SELECT * FROM transactions WHERE id = %s",$id);
            $res = $connection->query($query);
            while ($row = $res->fetchArray()) {
                return new Transaction($row);
            }
        }

        public function save(){
            $query = sprintf("INSERT INTO transactions VALUES (%s,'%s',%s,%s,%s,'%s','%s','%s','%s','%s','%s','%s','%s')",
            $this->id,$this->bank_code,$this->account_number,$this->amount,$this->fee,$this->beneficiary_name,
            $this->status,$this->receipt,$this->remark,$this->timestamp,$this->time_served,$this->created_at,
            $this->updated_at);
            $result = $this->connection->exec($query);
            return $result;
        }

        public function updated($data){
            $query = sprintf("UPDATE transactions SET `status` = '%s', receipt = '%s', time_served = '%s' where id = %s",
            $data["status"],$data["receipt"],$data["time_served"],$this->id);
            $result = $this->connection->exec($query);
            $this->status = $data["status"];
            $this->receipt = $data["receipt"];
            $this->time_served = $data["time_served"];
            return $result;
        }

        public function serialize() {
            foreach ($this as $key => $value) {
                if (gettype($value) != "object" && !is_numeric($key)){
                    print "$key => $value\n";
                }
            }
            print "==========================\n";
        }

    }
?>
