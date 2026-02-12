<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\AsetPju;

class KoneksiPjuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1. Ambil data Aset PJU yang punya Panel KWH beserta data Panel-nya
        // Kita gunakan 'with' agar query lebih efisien (Eager Loading)
        AsetPju::with('panelKwh')
            ->whereNotNull('panel_kwh_id')
            ->chunk(200, function ($asetPjus) {
                $dataKoneksi = [];

                foreach ($asetPjus as $pju) {
                    // Skip jika relasi panel kwh ternyata kosong (safety check)
                    if (!$pju->panelKwh) continue;

                    // Cek duplikasi
                    $exists = DB::table('koneksi_pju_kwh')
                                ->where('aset_pju_id', $pju->id)
                                ->where('panel_kwh_id', $pju->panel_kwh_id)
                                ->exists();

                    if (!$exists) {
                        // HITUNG JARAK (Latitude/Longitude PJU vs Panel KWH)
                        $jarakMeter = $this->calculateDistance(
                            $pju->latitude, 
                            $pju->longitude, 
                            $pju->panelKwh->latitude, 
                            $pju->panelKwh->longitude
                        );

                        // Tambahkan 'buffer' sedikit (misal 5% atau 2 meter) untuk lekukan kabel (Opsional)
                        // Disini saya pakai murni jarak garis lurus (displacement)
                        $estimasiKabel = round($jarakMeter, 2);

                        $dataKoneksi[] = [
                            'aset_pju_id'       => $pju->id,
                            'panel_kwh_id'      => $pju->panel_kwh_id,
                            'nomor_mcb_panel'   => null,
                            'fasa'              => null,
                            'status_koneksi'    => 'Aktif',
                            'tgl_koneksi'       => now(),
                            'panjang_kabel_est' => $estimasiKabel, // Data otomatis masuk sini!
                            'keterangan_jalur'  => 'Migrasi otomatis. Jarak tarik lurus: ' . $estimasiKabel . ' m',
                            'created_at'        => now(),
                            'updated_at'        => now(),
                        ];
                    }
                }

                // 2. Insert massal
                if (!empty($dataKoneksi)) {
                    DB::table('koneksi_pju_kwh')->insert($dataKoneksi);
                }
            });
    }

    /**
     * Menghitung jarak antara dua titik koordinat dalam satuan METER
     * Menggunakan rumus Haversine
     */
    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
        // Radius Bumi dalam Meter
        $earthRadius = 6371000;

        // Konversi derajat ke radian
        $lat1 = deg2rad((float)$lat1);
        $lon1 = deg2rad((float)$lon1);
        $lat2 = deg2rad((float)$lat2);
        $lon2 = deg2rad((float)$lon2);

        // Hitung selisih
        $latDelta = $lat2 - $lat1;
        $lonDelta = $lon2 - $lon1;

        // Rumus Haversine
        $a = sin($latDelta / 2) * sin($latDelta / 2) +
             cos($lat1) * cos($lat2) *
             sin($lonDelta / 2) * sin($lonDelta / 2);
             
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        // Jarak dalam meter
        $distance = $earthRadius * $c;

        return $distance;
    }
}