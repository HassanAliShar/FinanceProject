<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLoanApprovelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loan_approvels', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->foreignId('borrower_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->unsignedBigInteger('loan_id')->nullable(); // when update or delte will be performed we will set the id
            $table->string('lender_name');
            $table->string('legal_loan_id');
            $table->string('loan_internal_number');
            $table->string('loan_type');
            $table->string('loan_status');
            $table->string('loan_reason');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('interest_type');
            $table->decimal('interest_rate',10,2);
            $table->string('initial_amount');
            $table->string('tenor');
            $table->string('payment_period');
            $table->string('administration_charges');
            $table->string('government_charges');
            $table->string('agreement_charges');
            $table->string('provision_charges');
            $table->string('skmht_charges');
            $table->string('apht_charges');
            $table->string('fiduciary_charges');
            $table->string('certificate_charges');
            $table->string('other_charges');
            $table->string('insurance_charges');
            $table->string('notary_charges');
            $table->string('collateral');
            $table->string('bank_account');
            $table->foreignId('user_id')->constrained()->cascadeOnDelete()->cascadeOnUpdate();
            $table->string('type');
            $table->string('status')->default('Pending'); //Approved  and Rejected
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
        Schema::dropIfExists('loan_approvels');
    }
}
