<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if(env('APP_URL') == 'http://test.tadreeblms.com') {
            DB::table('users')
                ->where('id', '1')
                ->update([
                    'first_name' => 'Admin',
                    'last_name'  => 'Istrator',
                    'email'  => env('DEMO_EMAIL', 'demo@admin.com'),
                    'password'   => Hash::make(env('DEMO_PASSWORD', 'secret')),
                    'confirmed'  => true,
                    'updated_at' => now(),
                ]);
        }
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        
    }
};
