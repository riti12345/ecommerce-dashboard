<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Jit extends CI_Migration {
      public function up() {
            $this->dbforge->add_field("id int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY");
            $this->dbforge->add_field("jit_date date NOT NULL");
            $this->dbforge->add_field("jit_slot int(11) NOT NULL");
            $this->dbforge->add_field("assignee_id int(11) NOT NULL");
            $this->dbforge->add_field("status tinyint(1) NOT NULL DEFAULT '1'");
            $this->dbforge->add_field("added_by int(11) NOT NULL");
            $this->dbforge->add_field("added_on datetime NOT NULL");
            $this->dbforge->add_field("updated_by int(11) NOT NULL");
            $this->dbforge->add_field("updated_on timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP");
            $this->dbforge->add_key('id', TRUE);
            $this->dbforge->create_table('os_jit');
      }

      public function down() {
        $this->dbforge->drop_table('os_jit');
    }

      }