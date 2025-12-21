<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add missing column to bahanmaterial table
        if (!Schema::hasColumn('bahanmaterial', 'statusbahanmaterial')) {
            Schema::table('bahanmaterial', function (Blueprint $table) {
                $table->string('statusbahanmaterial', 1)->default('1')->after('fotobahanmaterial');
            });
        }

        // Add missing column to tukang table
        if (!Schema::hasColumn('tukang', 'fotohasilkerja')) {
            Schema::table('tukang', function (Blueprint $table) {
                $table->string('fotohasilkerja', 50)->nullable()->after('fotosim');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('bahanmaterial', 'statusbahanmaterial')) {
            Schema::table('bahanmaterial', function (Blueprint $table) {
                $table->dropColumn('statusbahanmaterial');
            });
        }

        if (Schema::hasColumn('tukang', 'fotohasilkerja')) {
            Schema::table('tukang', function (Blueprint $table) {
                $table->dropColumn('fotohasilkerja');
            });
        }
    }
};
