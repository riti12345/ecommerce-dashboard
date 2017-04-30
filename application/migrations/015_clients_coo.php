<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Clients_coo extends CI_Migration {
    public function up() {
        $fields = [
                    'lat' => ['type' => 'double','null'=>FALSE,'after' => 'delivery_address'],
                    'long' => ['type' => 'double','null'=>FALSE,'after' => 'lat']
                  ];
        $this->dbforge->add_column('os_clients_props', $fields);
    }

    public function down(){
        $this->dbforge->drop_column('os_clients_props', 'lat');
        $this->dbforge->drop_column('os_clients_props', 'long');
    }
}
?>