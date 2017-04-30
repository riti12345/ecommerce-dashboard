<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Procurement_balances extends CI_Migration {
    public function up() {
        $this->dbforge->add_field(
           array(
              'id' => array(
                 'type' => 'INT',
                 'constraint' => 11,
                 'unsigned' => true,
                 'auto_increment' => true
              ),
              'procure_id' => array(
                 'type' => 'INT',
                 'constraint' => '11',
                 'unsigned' => true
              ),
              'start_balance' => array(
                 'type' => 'FLOAT',
                 'constraint' => '10',
                 'unsigned' => true
              ),
              'end_balance' => array(
                 'type' => 'FLOAT',
                 'constraint' => '10',
                 'unsigned' => true
              ),
              'team_id' => array(
                 'type' => 'INT',
                 'constraint' => '11',
                 'unsigned' => true
              ),
              'added_by' => array(
                 'type' => 'INT',
                 'constraint' => '11',
                 'unsigned' => true
              ),
              'added_on' => array(
                 'type' => 'DATETIME',       
              ),
              'updated_by' => array(
                 'type' => 'INT',
                 'constraint' => '11',
                 'unsigned' => true
              ),
              'updated_on' => array(
                 'type' => 'TIMESTAMP',      
              )
           )
        );

        $this->dbforge->add_key('id', TRUE);
        $this->dbforge->create_table('os_procurement_balances');
    }

    public function down() {
        $this->dbforge->drop_table('os_procurement_balances');
    }
}
?>