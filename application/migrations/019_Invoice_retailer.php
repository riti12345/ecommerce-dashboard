<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Invoice_retailer extends CI_Migration {
    public function up() {
        $this->dbforge->add_field("id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY");
        $this->dbforge->add_field("order_id int(11) unsigned NOT NULL");
        $this->dbforge->add_field("auth longblob");
        $this->dbforge->add_field("discount_type tinyint(1) DEFAULT NULL");
        $this->dbforge->add_field("discount_value float DEFAULT NULL");
        $this->dbforge->add_field("feedback varchar(255) DEFAULT NULL");
        $this->dbforge->add_field("added_by int(11) unsigned NOT NULL");
        $this->dbforge->add_field("added_on datetime NOT NULL");
        $this->dbforge->add_field("updated_by int(11) NOT NULL");
        $this->dbforge->add_field("updated_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('os_orders_invoice_retailer');
    }

    public function down() {
        $this->dbforge->drop_table('os_orders_invoice_retailer');
    }
}
?>