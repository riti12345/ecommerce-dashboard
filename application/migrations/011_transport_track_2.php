<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Transport_track_2 extends CI_Migration {
    public function up() {
        $this->dbforge->drop_column('os_transport_track', 'out_time');
        $fields = [
                    'out_time' => ['out_time','type' => 'time','null'=>TRUE,'after' => 'in_time']
                  ];
        $this->dbforge->add_column('os_transport_track', $fields);
    }

    public function down(){
        $this->dbforge->drop_column('os_transport_track', 'out_time');
    }
}
?>