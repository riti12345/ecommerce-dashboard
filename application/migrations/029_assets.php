<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Assets extends CI_Migration {
    public function up() {

       	$this->dbforge->add_field("id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY");
        $this->dbforge->add_field("sub_cat_id int(11) NOT NULL");
        $this->dbforge->add_field("asset_tag_unique_name varchar(50) NOT NULL");
        $this->dbforge->add_field("brand_name varchar(50) NOT NULL");
        $this->dbforge->add_field("date_of_purchase date NOT NULL");
        $this->dbforge->add_field("price float NOT NULL");
        $this->dbforge->add_field("Comments varchar(255) NOT NULL");
        $this->dbforge->add_field("status tinyint(4) NOT NULL DEFAULT '1'");
        $this->dbforge->add_field("added_by int(11) NOT NULL");
        $this->dbforge->add_field("added_on datetime NOT NULL");
        $this->dbforge->add_field("updated_by int(11) NOT NULL");
        $this->dbforge->add_field("updated_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('os_assets');
    }

    public function down() {
        $this->dbforge->drop_table('os_assets');
    }
}
?>