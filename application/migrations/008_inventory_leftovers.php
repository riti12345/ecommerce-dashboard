<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Inventory_leftovers extends CI_Migration {
    public function up() {
        $this->dbforge->add_field("id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY");
        $this->dbforge->add_field("processing_id int(11) unsigned NOT NULL");
        $this->dbforge->add_field("proc_items_id int(11) unsigned NOT NULL");
        $this->dbforge->add_field("item_id int(11) unsigned NOT NULL");
        $this->dbforge->add_field("grade char(1) NOT NULL");
        $this->dbforge->add_field("quantity float NOT NULL");
        $this->dbforge->add_field("crate_id int(11) unsigned NOT NULL");
        $this->dbforge->add_field("status tinyint(1) unsigned NOT NULL DEFAULT '1'");
        $this->dbforge->add_field("added_by int(10) unsigned NOT NULL");
        $this->dbforge->add_field("added_on datetime NOT NULL");
        $this->dbforge->add_field("updated_by int(10) unsigned NOT NULL");
        $this->dbforge->add_field("updated_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('os_inventory_leftovers');

    }

    public function down() {
        $this->dbforge->drop_table('os_inventory_leftovers');
    }
}
?>