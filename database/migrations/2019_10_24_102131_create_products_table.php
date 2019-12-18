<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->set('unit', ['kg', 'grams', 'qty.', 'cm', 'liters']);
            $table->unsignedInteger('quantity');
            $table->decimal('sell_price')->default(0.00);
            $table->decimal('sell_quantity_base')->default(0.00);
            $table->unsignedBigInteger('product_type')->nullable();
            $table->dateTime('updated_at')->useCurrent();
            $table->dateTime('created_at')->useCurrent();
            $table->softDeletes();
            $table->foreign('product_type')->references('id')->on('product_types');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
}
