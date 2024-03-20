<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement("
        CREATE VIEW view_users AS 
        SELECT 
            users.id, 
            users.name, 
            users.username, 
            users.email, 
            GROUP_CONCAT(roles.name SEPARATOR ', ') as roles
        FROM 
            users
        LEFT JOIN 
            model_has_roles ON users.id = model_has_roles.model_id
        LEFT JOIN 
            roles ON model_has_roles.role_id = roles.id
        GROUP BY 
            users.id
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("DROP VIEW view_users");
    }
};
