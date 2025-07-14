<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateCampsitesTable extends Migration
{
    public function up()
    {
        $this->forge->addField([
            "id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
                "auto_increment" => true,
            ],
            "name" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "description" => [
                "type" => "TEXT",
                "null" => true,
            ],
            "location" => [
                "type" => "VARCHAR",
                "constraint" => "255",
            ],
            "price_per_night" => [
                "type" => "DECIMAL",
                "constraint" => "10,2",
                "default" => 0.0,
            ],
            "capacity" => [
                "type" => "INT",
                "constraint" => 11,
                "default" => 1,
            ],
            "image" => [
                "type" => "VARCHAR",
                "constraint" => "255",
                "null" => true,
            ],
            "facilities" => [
                "type" => "TEXT",
                "null" => true,
            ],
            "created_at datetime default current_timestamp",
            "updated_at datetime default current_timestamp on update current_timestamp",
        ]);
        $this->forge->addKey("id", true);
        $this->forge->createTable("campsites");
    }

    public function down()
    {
        $this->forge->dropTable("campsites");
    }
}
