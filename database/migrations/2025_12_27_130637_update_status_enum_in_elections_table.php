<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class UpdateStatusEnumInElectionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // For MySQL, we need to modify the enum to include 'pending'
        DB::statement("ALTER TABLE elections MODIFY COLUMN status ENUM('pending', 'active', 'closed') DEFAULT 'pending'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("ALTER TABLE elections MODIFY COLUMN status ENUM('active', 'closed') DEFAULT 'active'");
    }
}
