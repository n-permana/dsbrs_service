<?php
    require 'controllers/transaction_controller.php';

    function main() {
        echo "---------------------\n";
        echo "1 - Create Disburse\n";
        echo "2 - Disburse Status\n";
        echo "3 - Disbursement List\n";
        echo "0 - Quit\n\n";
        echo "Enter your choice: ";
        $choice = trim(fgets(STDIN));
        switch($choice) {
        
            case 1: {
                create_disburse();
                break;
            }
            case 2: {
                disburse_status();
                break;
            }
            case 3: {
                disburse_list();
                break;
            }
            case 0: {
                exit(0);
                break;
            }
            default: {
                echo "\n\nPlease provide a valid choice\n";
                main();
            }
        }
    }

    function disburse_status() {
        echo "Please enter transaction ID: ";
        $id = trim(fgets(STDIN));

        $transaction = new TransactionController();
        $result = $transaction->disburse_status($id);
        $result->serialize();
        main();
    }
    
    function create_disburse() {
        $input_values = array();

        echo "Please enter bank code: ";
        $input_values['bank_code'] = trim(fgets(STDIN));

        echo "Please enter account number: ";
        $input_values['account_number'] = trim(fgets(STDIN));

        echo "Please enter amount: ";
        $input_values['amount'] = trim(fgets(STDIN));

        echo "Please enter remark: ";
        $input_values['remark'] = trim(fgets(STDIN));

        $transaction = new TransactionController();
        $result = $transaction->disburse($input_values);
        $result->serialize();
        main();
    }

    function disburse_list(){
        $transaction = new TransactionController();
        $list = $transaction->disburse_list();
        foreach($list as $trx){
            $trx->serialize();
        }
        main();
    }

    // Start Here
    main();
   
    
?>
