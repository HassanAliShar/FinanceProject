<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBorrowersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('borrowers', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->id();
            $table->string('name');
            $table->string('identity_no');
            $table->string('identity_type');
            $table->string('nationality');
            $table->date('dob');
            $table->string('status');
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
            $table->boolean('approved')->default(0);
            $table->foreignId('created_by')->constrained("users")->cascadeOnDelete()->cascadeOnUpdate();
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
        Schema::dropIfExists('borrowers');
    }
}
