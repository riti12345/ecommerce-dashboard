<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Order_comment extends CI_Migration {
    public function up() {
        $fields = [
                    'comment' => ['type' => 'varchar','constraint'=>255,'null'=>TRUE,'after' => 'status'],
                  ];
        $this->dbforge->add_column('os_orders_items', $fields);
    }

    public function down(){
        $this->dbforge->drop_column('os_orders_items', 'discount_type');
    }
}
?>