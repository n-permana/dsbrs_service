<?php
    require 'models/transaction.php';
    require 'services/slightly_big_api.php';

    class TransactionController {
        function __construct(){}

        public function disburse($param){
           $slightlyBig = new SlightlyBigApi();
           $response = $slightlyBig->post("/disburse",$param);
           $transaction = new Transaction(json_decode($response, true));
           $transaction->save();
           return $transaction;
        }

        public function disburse_status($id){
            $slightlyBig = new SlightlyBigApi();
            $response = $slightlyBig->get("/disburse/".$id,[]);
            $updated = json_decode($response, true);
            $transaction = Transaction::find($id);
            $transaction->updated($updated);
            return $transaction;
        }

        public function disburse_list(){
            $transactions = Transaction::list();
            return $transactions;
        }
    }
?>
