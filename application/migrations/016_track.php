<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Track extends CI_Migration {
    public function up() {
        $fields = [
                    'order_id' => ['type' => 'int','constraint'=>11,'unsigned' => TRUE,'null'=>FALSE,'after' => 'id'],
                    'team_id' => ['type' => 'int','constraint'=>11,'unsigned' => TRUE,'null'=>FALSE,'after' => 'order_id'],
                    'lat' => ['type' => 'double','null'=>FALSE,'after' => 'team_id'],
                    'long' => ['type' => 'double','null'=>FALSE,'after' => 'lat']
                  ];
        $this->dbforge->add_column('os_track_dump', $fields);
        $this->dbforge->drop_column('os_track_dump', 'updated_on');
        $this->dbforge->drop_column('os_track_dump', 'dump');

    }

    public function down(){
        $this->dbforge->drop_column('os_track_dump', 'lat');
        $this->dbforge->drop_column('os_track_dump', 'long');
    }
}
?>