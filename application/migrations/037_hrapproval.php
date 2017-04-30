<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Hrapproval extends CI_Migration {
      public function up() {
            $this->dbforge->add_field("id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY");
            $this->dbforge->add_field("hr_request_id int(11) NOT NULL");
            $this->dbforge->add_field("approval_message varchar(255) NOT NULL");
            $this->dbforge->add_field("status tinyint(4) NOT NULL DEFAULT '1'");
            $this->dbforge->add_field("added_by int(3) NOT NULL");
            $this->dbforge->add_field("added_on datetime NOT NULL");
            $this->dbforge->add_field("updated_by int(3) NOT NULL");
            $this->dbforge->add_field("updated_on datetime NOT NULL");
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('os_hr_approval');
      }

      public function down() {
        $this->dbforge->drop_table('os_hr_approval');
    }

      }