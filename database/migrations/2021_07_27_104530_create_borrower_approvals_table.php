<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowerApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrower_approvals', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->unsignedBigInteger('borrower_id')->nullable(); // when update or delte will be performed we will set the id
            $table->string('name');
            $table->string('identity_no');
            $table->string('identity_type');
            $table->string('nationality');
            $table->date('dob');
            $table->string('tax_identity_no');
            $table->string('borrower_type');
            $table->string('person_in_contact');
            $table->string('reference');
            $table->text('identity_address');
            $table->text('domicile_address');
            $table->text('office_address');
            $table->string('occupation');
            $table->string('line_of_business');
            $table->string('bank_account');
            $table->string('type');//insert , update , delete
            $table->foreignId('user_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->string('status')->default("Pending"); // Approved, Rejected, Pending
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
        Schema::dropIfExists('borrower_approvals');
    }
}
