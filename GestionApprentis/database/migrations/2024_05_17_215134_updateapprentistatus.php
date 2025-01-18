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
        // Trigger for INSERT
        DB::unprepared('
            CREATE TRIGGER update_apprentis_status
            AFTER INSERT ON assiduites
            FOR EACH ROW
            BEGIN
                UPDATE apprentis
                SET status = CASE
                    WHEN NEW.datefin < DATE("now") THEN "actif"
                    ELSE "inactif"
                END
                WHERE id = NEW.apprenti_id;
            END;
        ');

        // Trigger for UPDATE
        DB::unprepared('
            CREATE TRIGGER update_apprentis_status_on_update
            AFTER UPDATE ON assiduites
            FOR EACH ROW
            BEGIN
                UPDATE apprentis
                SET status = CASE
                    WHEN NEW.datefin < DATE("now") THEN "actif"
                    ELSE "inactif"
                END
                WHERE id = NEW.apprenti_id;
            END;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::unprepared('DROP TRIGGER IF EXISTS update_apprentis_status');
        DB::unprepared('DROP TRIGGER IF EXISTS update_apprentis_status_on_update');
    }
};