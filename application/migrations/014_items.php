<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Items extends CI_Migration {
    public function up() {
        $fields = [
                    'master_item' => ['type' => 'varchar','constraint'=>250,'null'=>TRUE,'after' => 'description'],
                    'brand_name' => ['type' => 'varchar','constraint'=>250,'null'=>TRUE,'after' => 'master_item']
                  ];
        $this->dbforge->add_column('os_items', $fields);
    }

    public function down(){
        $this->dbforge->drop_column('os_items', 'master_item');
        $this->dbforge->drop_column('os_items', 'brand_name');
    }
}
?>