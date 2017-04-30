<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Transport_2 extends CI_Migration {
    public function up() {
        $this->dbforge->drop_column('os_transport', 'contact');
        $fields = [
                    'contact' => ['contact','type' => 'VARCHAR','constraint' => '20','null'=>FALSE,'after' => 'licence_no']
                  ];
        $this->dbforge->add_column('os_transport', $fields);
    }

    public function down(){
        $this->dbforge->drop_column('os_transport', 'contact');
    }
}
?>