<?php

use App\Models\Channel;
use App\Models\ChannelMember;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBroadcastsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('broadcasts', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Channel::class)->constrained()->cascadeOnDelete();
            $table->unsignedBigInteger('channel_member_id');
            $table->foreign('channel_member_id')->references('id')->on('channel_members');
            $table->timestamp('starts_at');
            $table->timestamp('ends_at')->nullable();
            $table->string('title');
            $table->string('description');
            $table->timestamps();

            $table->index(['starts_at', 'ends_at']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('broadcasts');
    }
}
