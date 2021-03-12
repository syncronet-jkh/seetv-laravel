<?php

use App\Models\Broadcast;
use App\Models\Publisher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePublisherStatusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('publisher_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Publisher::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Broadcast::class)->nullable()->constrained();
            $table->string('value');
            $table->string('reason')->nullable();
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
        Schema::dropIfExists('publisher_statuses');
    }
}
