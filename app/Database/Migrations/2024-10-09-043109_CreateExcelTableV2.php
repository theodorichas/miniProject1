<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateExcelTableV2 extends Migration
{
    public function up()
    {
        $this->forge->addField([
            //general
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'employee_id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nama' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'grade' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'periode' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'gaji_pokok' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            //tunjangan
            'tj_jabatan' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tj_keahlian' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tj_masa_kerja' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tj_keluarga' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'workdays' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'wfo' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'wfa' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'izin' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'alpha' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'tj_transport' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tj_makan' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tj_komunikasi' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'lembur' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'tj_pph21' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tj_hari_raya' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tj_bpjs_kesehatan' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tj_bpjs_jht' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tj_bpjs_jkk' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'tj_bpjs_jkm' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'bonus' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'lain_lain' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            // Pinjaman dan potongan (pj = Pinjaman || pot = potongan)
            'total_pj' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'pj_dibayar' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'pot_pj' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'sisa_pj' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'pot_bpjs_kesehatan' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'pot_bpjs_jht' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'pot_bpjs_jkk' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'pot_bpjs_jkm' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'pot_absensi' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'pot_keterlambatan' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'pot_pph21' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'pot_lain_lain' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],

            // Total
            'total_penerimaan' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'total_potongan' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'thp' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'total_transfer' => [
                'type' => 'DECIMAL',
                'constraint' => '15,2',
            ],
            'bca_source' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            // last salary adjustments
            'last_salary_adj' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'dur_last_salary_adj' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
            'email' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'send_paycheck' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'jabatan' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'divisi' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'employee_status' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ],
            'bank' => [
                'type' => 'VARCHAR',
                'constraint' => '255',
            ]
        ]);
        $this->forge->addPrimaryKey('id');
        $this->forge->createTable('excelV2');
    }

    public function down()
    {
        $this->forge->dropTable('excelV2');
    }
}
