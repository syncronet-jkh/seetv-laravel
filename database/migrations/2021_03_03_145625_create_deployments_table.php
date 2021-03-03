<?php

use App\Models\SourceProvider;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDeploymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('deployments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(SourceProvider::class)->constrained()->cascadeOnDelete();
            $table->string('status');
            $table->string('repository_url');
            $table->string('branch')->default('master');
            $table->string('sha');
            $table->string('commit_message');
            $table->string('script');
            $table->text('script_output')->nullable();
            $table->timestamp('executed_at')->nullable();
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
        Schema::dropIfExists('deployments');
    }
}
