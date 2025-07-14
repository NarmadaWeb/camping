<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateBookingsTable extends Migration
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
            "user_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "campsite_id" => [
                "type" => "INT",
                "constraint" => 11,
                "unsigned" => true,
            ],
            "check_in_date" => [
                "type" => "DATE",
            ],
            "check_out_date" => [
                "type" => "DATE",
            ],
            "total_price" => [
                "type" => "DECIMAL",
                "constraint" => "10,2",
                "default" => 0.0,
            ],
            "status" => [
                "type" => "ENUM",
                "constraint" => [
                    "pending",
                    "confirmed",
                    "cancelled",
                    "completed",
                ],
                "default" => "pending",
            ],
            "created_at datetime default current_timestamp",
            "updated_at datetime default current_timestamp on update current_timestamp",
        ]);
        $this->forge->addKey("id", true);
        $this->forge->addForeignKey(
            "user_id",
            "users",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->forge->addForeignKey(
            "campsite_id",
            "campsites",
            "id",
            "CASCADE",
            "CASCADE"
        );
        $this->forge->createTable("bookings");
    }

    public function down()
    {
        $this->forge->dropTable("bookings");
    }
}
