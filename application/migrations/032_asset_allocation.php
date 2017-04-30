<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Asset_allocation extends CI_Migration {
    public function up() {

			$this->dbforge->add_field("id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY");
            $this->dbforge->add_field("assigned_to_id int(11) NOT NULL");
            $this->dbforge->add_field("assets_id int(11) NOT NULL");
            $this->dbforge->add_field("date_of_allocation date NOT NULL");
            $this->dbforge->add_field("date_of_revocation date NOT NULL");
            $this->dbforge->add_field("status tinyint(4) NOT NULL DEFAULT '1'");
            $this->dbforge->add_field("added_by int(11) NOT NULL");
            $this->dbforge->add_field("added_on datetime NOT NULL");
            $this->dbforge->add_field("updated_by int(11) NOT NULL");
            $this->dbforge->add_field("updated_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP");
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('os_asset_allocation');
    }

    public function down() {
        $this->dbforge->drop_table('os_asset_allocation');
    }
}
?>