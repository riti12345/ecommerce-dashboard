<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Invoice extends CI_Migration {
    public function up() {
        $fields = [
                    'discount_type' => ['type' => 'tinyint','constraint'=>1,'null'=>TRUE,'after' => 'auth'],
                    'discount_value' => ['type' => 'float','unsigned' => TRUE,'null'=>TRUE,'after' => 'discount_type'],
                  ];
        $this->dbforge->add_column('os_orders_invoice', $fields);
    }

    public function down(){
        $this->dbforge->drop_column('os_orders_invoice', 'discount_type');
        $this->dbforge->drop_column('os_orders_invoice', 'discount_value');
    }
}
?>