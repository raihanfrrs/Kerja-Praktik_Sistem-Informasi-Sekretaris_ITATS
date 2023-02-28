<?php

use App\Models\Dosen;
use App\Models\Request;
use App\Models\Surat;
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
            $table->foreignIdFor(Dosen::class)->nullable();
            $table->foreignIdFor(Surat::class);
            $table->string('surat')->nullable();
            $table->enum('status', ['pending', 'accept', 'reject', 'done'])->default('pending');
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
