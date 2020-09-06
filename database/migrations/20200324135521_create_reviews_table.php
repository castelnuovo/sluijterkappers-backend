<?php

use CQ\DB\Migration;

class CreateReviewsTable extends Migration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $reviews = $this->table('reviews', ['id' => false, 'primary_key' => 'id']);
        $reviews->addColumn('id', 'uuid')
            ->addColumn('score', 'decimal', ['null' => false])
            ->addColumn('name', 'string', ['limit' => 32, 'null' => false])
            ->addColumn('description', 'string', ['limit' => 2048, 'null' => false])
            ->addColumn('updated_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->addColumn('created_at', 'datetime', ['default' => 'CURRENT_TIMESTAMP'])
            ->create()
        ;
    }
}
