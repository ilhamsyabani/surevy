<?php

use App\Models\Category;
use App\Models\Feedback;
use App\Models\Result;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryResultTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('category_results', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Result::class)->constrained()->cascadeOnDelete()->nullable();
            $table->foreignIdFor(Category::class)->constrained()->cascadeOnDelete()->nullable();
            $table->foreignIdFor(Feedback::class)->constrained()->cascadeOnDelete();
            $table->integer('total_points')->default(0);
            $table->string('attachment')->nullable();
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
        Schema::dropIfExists('category_result');
    }
}
