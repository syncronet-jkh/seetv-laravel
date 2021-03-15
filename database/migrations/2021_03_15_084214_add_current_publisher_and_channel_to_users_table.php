<?php

use App\Models\Channel;
use App\Models\Publisher;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCurrentPublisherAndChannelToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->foreignIdFor(Publisher::class, 'current_publisher_id')->nullable()->constrained('publishers', 'id')->nullOnDelete();
            $table->foreignIdFor(Channel::class, 'current_channel_id')->nullable()->constrained('channels', 'id')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropConstrainedForeignId('current_publisher_id');
            $table->dropConstrainedForeignId('current_channel_id');
        });
    }
}
