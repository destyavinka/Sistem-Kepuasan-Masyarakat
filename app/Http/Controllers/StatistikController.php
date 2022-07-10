<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Polling;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatistikController extends Controller
{
    public function index()
    {
        $exe = Polling::select(DB::raw("LEFT(created_at, 4) as tahun"))
            ->groupBy(DB::raw("LEFT(created_at, 4)"))
            ->orderBy(DB::raw("LEFT(created_at, 4)"), 'ASC')
            ->get();

        $listTahun         = array();
        $listSangatPuas    = array();
        $listPuas        = array();
        $listTidakPuas    = array();

        foreach ($exe as $row) {
            $listTahun[$row->tahun] = "" . $row->tahun . "";
            $listSangatPuas[$row->tahun] = 0;
            $listPuas[$row->tahun] = 0;
            $listTidakPuas[$row->tahun] = 0;
        }
        $labelTahun = implode(', ', $listTahun);

        #-- Data Sangat Puas
        $exe = Polling::select(DB::raw("LEFT(created_at, 4) as tahun"), DB::raw("(COUNT(id)) as data"))
            ->where('nilai', 5)
            ->groupBy(DB::raw("LEFT(created_at, 4)"))
            ->orderBy(DB::raw("LEFT(created_at, 4)"), 'ASC')
            ->get();
        foreach ($exe as $row) {
            $listSangatPuas[$row->tahun] = $row->data;
        }
        $labelSangatPuas = implode(', ', $listSangatPuas);

        #-- Data Puas
        $exe = Polling::select(DB::raw("LEFT(created_at, 4) as tahun"), DB::raw("(COUNT(id)) as data"))
            ->where('nilai', 4)
            ->groupBy(DB::raw("LEFT(created_at, 4)"))
            ->orderBy(DB::raw("LEFT(created_at, 4)"), 'ASC')
            ->get();
        foreach ($exe as $row) {
            $listPuas[$row->tahun] = $row->data;
        }
        $labelPuas = implode(', ', $listPuas);

        #-- Data Tidak Puas
        $exe = Polling::select(DB::raw("LEFT(created_at, 4) as tahun"), DB::raw("(COUNT(id)) as data"))
            ->where('nilai', 2)
            ->groupBy(DB::raw("LEFT(created_at, 4)"))
            ->orderBy(DB::raw("LEFT(created_at, 4)"), 'ASC')
            ->get();
        foreach ($exe as $row) {
            $listTidakPuas[$row->tahun] = $row->data;
        }
        $labelTidakPuas = implode(',', $listTidakPuas);

        return view('admin.home', [
            'labelTahun' => $labelTahun,
            'labelSangatPuas' => $labelSangatPuas,
            'labelPuas' => $labelPuas,
            'labelTidakPuas' => $labelTidakPuas,
            'listTahun' => $listTahun,
            'listSangatPuas' => $listSangatPuas,
            'listPuas' => $listPuas,
            'listTidakPuas' => $listTidakPuas,
        ]);
    }
    public function statistik(Request $request)
    {
        $mod = $request->query('mod');

        switch ($mod) {
            case 'hari':
                $tahun_ini = Carbon::now()->format('Y');
                $bulan_ini = Carbon::now()->format('Y-m');
                $hari_ini = Carbon::now()->format('Y-m-d');
                #-- tanggal
                $listTanggal             = array();
                $listTanggal[$hari_ini]    = $hari_ini;

                #-- Data Sangat Puas
                $exe = Polling::select(DB::raw("LEFT(created_at, 10) as tanggal"), DB::raw("(COUNT(nilai)) as data"))
                    ->where('nilai', 5)
                    ->where(DB::raw("LEFT(created_at, 10)"), $hari_ini)
                    ->groupBy(DB::raw("LEFT(created_at, 10)"))
                    ->orderBy(DB::raw("LEFT(created_at, 10)"), 'ASC')
                    ->get();
                // dd($exe);
                $listSangatPuas = array();
                foreach ($exe as $row) {
                    $listSangatPuas[$row->tanggal] = $row->data;
                }
                $labelSangatPuas = implode(', ', $listSangatPuas);

                #-- Data Puas
                $exe = Polling::select(DB::raw("LEFT(created_at, 10) as tanggal"), DB::raw("(COUNT(nilai)) as data"))
                    ->where('nilai', 4)
                    ->where(DB::raw("LEFT(created_at, 10)"), $hari_ini)
                    ->groupBy(DB::raw("LEFT(created_at, 10)"))
                    ->orderBy(DB::raw("LEFT(created_at, 10)"), 'ASC')
                    ->get();
                $listPuas = array();
                foreach ($exe as $row) {
                    $listPuas[$row->tanggal] = $row->data;
                }
                $labelPuas = implode(', ', $listPuas);

                #-- Data Tidak Puas
                $exe = Polling::select(DB::raw("LEFT(created_at, 10) as tanggal"), DB::raw("(COUNT(nilai)) as data"))
                    ->where('nilai', 2)
                    ->where(DB::raw("LEFT(created_at, 10)"), $hari_ini)
                    ->groupBy(DB::raw("LEFT(created_at, 10)"))
                    ->orderBy(DB::raw("LEFT(created_at, 10)"), 'ASC')
                    ->get();
                $listTidakPuas = array();
                foreach ($exe as $row) {
                    $listTidakPuas[$row->tanggal] = $row->data;
                }
                $labelTidakPuas = implode(',', $listTidakPuas);
                return view('admin.statistik.harian', [
                    'labelSangatPuas' => $labelSangatPuas,
                    'labelPuas' => $labelPuas,
                    'labelTidakPuas' => $labelTidakPuas,
                    'listTanggal' => $listTanggal,
                    'listSangatPuas' => $listSangatPuas,
                    'listPuas' => $listPuas,
                    'listTidakPuas' => $listTidakPuas,
                ]);
                break;
            case 'minggu':
                if (request()->start_date || request()->end_date) {
                    $start_date = Carbon::parse(request()->start_date);
                    $end_date = Carbon::parse(request()->end_date);
                    // $start_date = Carbon::parse(request()->start_date)->toDateTimeString();
                    // $end_date = Carbon::parse(request()->end_date)->toDateTimeString();
                    $interval = $start_date->diff($end_date);
                    $jumlah_hari = $interval->days;
                    dd($jumlah_hari);
                } else {
                }
                return view('admin.statistik.mingguan');
                break;
            case 'bulan':
                $tahun_ini = Carbon::now()->format('Y');
                $bulan_ini = Carbon::now()->format('Y-m');
                $bulan_ini_indo = Carbon::now()->format('m-Y');
                $hari_ini = Carbon::now()->format('Y-m-d');
                $jumlah_hari    = date('t', mktime(0, 0, 0, substr($bulan_ini, 5, 2), 1, $tahun_ini));
                // dd($jumlah_hari);
                for ($i = 1; $i <= $jumlah_hari; $i++) {
                    $listTanggal[$i] = "'" . $i . "'";
                }
                $labelTanggal = implode(', ', $listTanggal);
                #-- Data Sangat Puas
                $exe = Polling::select(DB::raw("LEFT(created_at, 10) as tanggal"), DB::raw("(COUNT(nilai)) as data"))
                    ->where('nilai', 5)
                    ->where(DB::raw("LEFT(created_at, 7)"), $bulan_ini)
                    ->groupBy(DB::raw("LEFT(created_at, 10)"))
                    ->orderBy(DB::raw("LEFT(created_at, 10)"), 'ASC')
                    ->get();
                $listSangatPuas = array();
                for ($i = 1; $i <= $jumlah_hari; $i++) {
                    $listSangatPuas[$i] = 0;
                }
                foreach ($exe as $row) {
                    $int_data    = (int) substr($row->tanggal, 8, 10);
                    $listSangatPuas[$int_data] = $row->data;
                }
                $labelSangatPuas = implode(', ', $listSangatPuas);

                #-- Data Puas
                $exe = Polling::select(DB::raw("LEFT(created_at, 10) as tanggal"), DB::raw("(COUNT(nilai)) as data"))
                    ->where('nilai', 4)
                    ->where(DB::raw("LEFT(created_at, 7)"), $bulan_ini)
                    ->groupBy(DB::raw("LEFT(created_at, 10)"))
                    ->orderBy(DB::raw("LEFT(created_at, 10)"), 'ASC')
                    ->get();
                $listPuas = array();
                for ($i = 1; $i <= $jumlah_hari; $i++) {
                    $listPuas[$i] = 0;
                }
                foreach ($exe as $row) {
                    $int_data    = (int) substr($row->tanggal, 8, 10);
                    $listPuas[$int_data] = $row->data;
                }
                $labelPuas = implode(', ', $listPuas);

                #-- Data Tidak Puas
                $exe = Polling::select(DB::raw("LEFT(created_at, 10) as tanggal"), DB::raw("(COUNT(nilai)) as data"))
                    ->where('nilai', 2)
                    ->where(DB::raw("LEFT(created_at, 7)"), $bulan_ini)
                    ->groupBy(DB::raw("LEFT(created_at, 10)"))
                    ->orderBy(DB::raw("LEFT(created_at, 10)"), 'ASC')
                    ->get();
                $listTidakPuas = array();
                for ($i = 1; $i <= $jumlah_hari; $i++) {
                    $listTidakPuas[$i] = 0;
                }
                foreach ($exe as $row) {
                    $int_data    = (int) substr($row->tanggal, 8, 10);
                    $listTidakPuas[$int_data] = $row->data;
                }
                $labelTidakPuas = implode(',', $listTidakPuas);
                return view('admin.statistik.bulanan', [
                    'labelTanggal' => $labelTanggal,
                    'labelSangatPuas' => $labelSangatPuas,
                    'labelPuas' => $labelPuas,
                    'labelTidakPuas' => $labelTidakPuas,
                    'listTanggal' => $listTanggal,
                    'listSangatPuas' => $listSangatPuas,
                    'listPuas' => $listPuas,
                    'listTidakPuas' => $listTidakPuas,
                    'bulan_ini_indo' => $bulan_ini_indo,
                ]);
                break;
            case 'tahun':
                $tahun_ini = Carbon::now()->format('Y');
                $jumlah_hari    = 12;
                #-- Bulan
                for ($i = 1; $i <= $jumlah_hari; $i++) {
                    $listBulan[$i] = "'" . $i . "'";
                }
                $labelBulan = implode(', ', $listBulan);

                #-- Data Sangat Puas
                $exe = Polling::select(DB::raw("MID(created_at, 6, 2) as bulan"), DB::raw("(COUNT(nilai)) as data"))
                    ->where('nilai', 5)
                    ->where(DB::raw("LEFT(created_at, 4)"), $tahun_ini)
                    ->groupBy(DB::raw("MID(created_at, 6, 2)"))
                    ->orderBy(DB::raw("MID(created_at, 6, 2)"), 'ASC')
                    ->get();
                $listSangatPuas = array();
                for ($i = 1; $i <= $jumlah_hari; $i++) {
                    $listSangatPuas[$i] = 0;
                }
                foreach ($exe as $row) {
                    $int_data    = (int) $row->bulan;
                    $listSangatPuas[$int_data] = $row->data;
                }
                $labelSangatPuas = implode(', ', $listSangatPuas);

                #-- Data Puas
                $exe = Polling::select(DB::raw("MID(created_at, 6, 2) as bulan"), DB::raw("(COUNT(nilai)) as data"))
                    ->where('nilai', 4)
                    ->where(DB::raw("LEFT(created_at, 4)"), $tahun_ini)
                    ->groupBy(DB::raw("MID(created_at, 6, 2)"))
                    ->orderBy(DB::raw("MID(created_at, 6, 2)"), 'ASC')
                    ->get();
                $listPuas = array();
                for ($i = 1; $i <= $jumlah_hari; $i++) {
                    $listPuas[$i] = 0;
                }
                foreach ($exe as $row) {
                    $int_data    = (int) $row->bulan;
                    $listPuas[$int_data] = $row->data;
                }
                $labelPuas = implode(', ', $listPuas);

                #-- Data Tidak Puas
                $exe = Polling::select(DB::raw("MID(created_at, 6, 2) as bulan"), DB::raw("(COUNT(nilai)) as data"))
                    ->where('nilai', 2)
                    ->where(DB::raw("LEFT(created_at, 4)"), $tahun_ini)
                    ->groupBy(DB::raw("MID(created_at, 6, 2)"))
                    ->orderBy(DB::raw("MID(created_at, 6, 2)"), 'ASC')
                    ->get();
                $listTidakPuas = array();
                for ($i = 1; $i <= $jumlah_hari; $i++) {
                    $listTidakPuas[$i] = 0;
                }
                foreach ($exe as $row) {
                    $int_data    = (int) $row->bulan;
                    $listTidakPuas[$int_data] = $row->data;
                }
                $labelTidakPuas = implode(',', $listTidakPuas);
                return view('admin.statistik.tahunan', [
                    'labelBulan' => $labelBulan,
                    'labelSangatPuas' => $labelSangatPuas,
                    'labelPuas' => $labelPuas,
                    'labelTidakPuas' => $labelTidakPuas,
                    'listBulan' => $listBulan,
                    'listSangatPuas' => $listSangatPuas,
                    'listPuas' => $listPuas,
                    'listTidakPuas' => $listTidakPuas,
                    'tahun_ini' => $tahun_ini,
                ]);
                break;
            default:
                return redirect('/panel/dashboard');
                break;
        }
    }
}
