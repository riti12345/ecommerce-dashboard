<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Order_reference extends CI_Migration {
    
    public function up() {
        $fields = [
                    'order_reference' => ['type' => 'varchar','constraint'=>255,'null'=>TRUE,'after' => 'delivery_date'],
                  ];
        $this->dbforge->add_column('os_orders', $fields);
    }
     public function down(){
        $this->dbforge->drop_column('os_orders', 'order_reference');
    }

   }
?>