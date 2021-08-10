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
            $table->string('internal_number');
            $table->string('identity_no');
            $table->string('identity_type');
            $table->string('nationality');
            $table->string('place_of_birth');
            $table->date('dob');
            $table->string('last_education');
            $table->string('mother_maiden');
            $table->string('surveyor');
            $table->string('partner_spouse');
            $table->string('partner_spouse_identity_number');
            $table->string('partner_spouse_contact_number');
            $table->string('partner_spouse_domicile_address');
            $table->string('marriage_status');
            $table->string('family_card_number');
            $table->string('home_number');
            $table->string('mobile_number');
            $table->string('office_number');
            $table->string('domicile_status');
            $table->string('email');
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
            $table->string('business_experience');
            $table->string('business_capital');
            $table->string('annual_income');
            $table->string('other_income');
            $table->string('joint_income');
            $table->string('total_income');
            $table->string('living_expenses');
            $table->string('business_expenses');
            $table->string('other_expenses');
            $table->string('other_loan');
            $table->string('net_cash_flow');
            $table->string('total_assets');
            $table->string('other_lenders');
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
