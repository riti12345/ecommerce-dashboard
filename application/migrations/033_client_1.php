<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Client_1 extends CI_Migration {
      public function up() {
        $fields = [
                    'email' => ['type' => 'VARCHAR','constraint'=>50,'null'=>FALSE,'after' => 'address']
                  ];
        $this->dbforge->add_column('os_clients', $fields);
    }

      public function down(){
        $this->dbforge->drop_column('os_clients', 'email');
    }
}

