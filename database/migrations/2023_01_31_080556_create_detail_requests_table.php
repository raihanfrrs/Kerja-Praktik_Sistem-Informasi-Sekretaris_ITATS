<?php

use App\Models\JenisSurat;
use App\Models\Request;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Request::class);
            $table->foreignIdFor(JenisSurat::class);
            $table->string('surat');
            $table->enum('status', ['pending', 'accept', 'reject', 'done']);
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
        Schema::dropIfExists('detail_requests');
    }
}
