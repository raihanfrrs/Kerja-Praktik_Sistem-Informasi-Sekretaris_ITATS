<?php

use App\Models\Broadcast;
use App\Models\Dosen;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailBroadcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_broadcasts', function (Blueprint $table) {
            $table->foreignIdFor(Broadcast::class);
            $table->foreignIdFor(Dosen::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('detail_broadcasts');
    }
}
