<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loans', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('borrower_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('lender_name');
            $table->string('legal_loan_id');
            $table->string('loan_type');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('interest_type');
            $table->decimal('interest_rate',10,2);
            $table->string('initial_amount');
            $table->string('tenor');
            $table->string('payment_period');
            $table->string('provision_charges');
            $table->string('insurance_charges');
            $table->string('notary_charges');
            $table->string('collateral');
            $table->string('bank_account');
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
        Schema::dropIfExists('loans');
    }
}
