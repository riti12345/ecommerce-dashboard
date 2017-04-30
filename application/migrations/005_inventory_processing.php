<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Inventory_processing extends CI_Migration {
    public function up() {
        $fields = [
                    'sku_id' => ['type' => 'INT','constraint'=>11,'unsigned' => TRUE,'null'=>FALSE,'after' => 'item_id']
                  ];
        $this->dbforge->add_column('os_inventory_processing', $fields);
    }

    public function down(){
        $this->dbforge->drop_column('os_inventory_processing', 'sku_id');
    }
}
?>