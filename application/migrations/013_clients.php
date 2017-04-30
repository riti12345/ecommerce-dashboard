<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Clients extends CI_Migration {
    public function up() {
        $fields = [
                    'category' => ['type' => 'INT','constraint'=>2,'null'=>FALSE,'after' => 'pincode']
                  ];
        $this->dbforge->add_column('os_clients', $fields);
    }

    public function down(){
        $this->dbforge->drop_column('os_clients', 'category');
    }
}
?>