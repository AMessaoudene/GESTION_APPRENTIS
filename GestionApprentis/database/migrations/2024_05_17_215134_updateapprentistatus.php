<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::unprepared('
            CREATE TRIGGER update_apprentis_status
            AFTER INSERT ON assiduites
            FOR EACH ROW
            BEGIN
                DECLARE now DATE;
                SET now = CURDATE();
                
                IF NEW.datefin < now THEN
                    UPDATE apprentis
                    SET status = "actif"
                    WHERE id = NEW.apprenti_id;
                ELSE
                    UPDATE apprentis
                    SET status = "inactif"
                    WHERE id = NEW.apprenti_id;
                END IF;
            END;
        ');

        DB::unprepared('
            CREATE TRIGGER update_apprentis_status_on_update
            AFTER UPDATE ON assiduites
            FOR EACH ROW
            BEGIN
                DECLARE now DATE;
                SET now = CURDATE();
                
                IF NEW.datefin < now THEN
                    UPDATE apprentis
                    SET status = "actif"
                    WHERE id = NEW.apprenti_id;
                ELSE
                    UPDATE apprentis
                    SET status = "inactif"
                    WHERE id = NEW.apprenti_id;
                END IF;
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
