<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Assets_properties extends CI_Migration {
    public function up() {

        $this->dbforge->add_field("id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY");
        $this->dbforge->add_field("assets_id int(11) NOT NULL");
        $this->dbforge->add_field("prop_name varchar(50) NOT NULL");
        $this->dbforge->add_field("status tinyint(4) NOT NULL DEFAULT '1'");
        $this->dbforge->add_field("added_by int(3) NOT NULL");
        $this->dbforge->add_field("added_on datetime NOT NULL");
        $this->dbforge->add_field("updated_by int(3) NOT NULL");
        $this->dbforge->add_field("updated_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('os_asset_properties');
    }

    public function down() {
        $this->dbforge->drop_table('os_asset_properties');
    }
}
?>