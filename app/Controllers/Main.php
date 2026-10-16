<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\Model;
use App\Models\Relasi;

class Main extends BaseController
{
    protected $db;
    protected $model;
    protected $relasi;

    public function __construct()
    {
        $this->db     = \Config\Database::connect();
        $this->model  = new Model();
        $this->relasi = new Relasi();
        helper(['url', 'form']);
    }

    protected function checkAuth()
    {
        if (!session()->get('username')) {
            return redirect()->to(site_url('login/index'));
        }
        return null;
    }

    public function Date2String($dTgl)
    {
        $parts = explode("-", $dTgl);
        if (count($parts) === 3 && strlen($parts[0]) == 2) {
            return $parts[2] . "-" . $parts[1] . "-" . $parts[0];
        }
        return $dTgl;
    }

    public function String2Date($dTgl)
    {
        $parts = explode("-", $dTgl);
        if (count($parts) === 3 && strlen($parts[0]) == 4) {
            return $parts[2] . "-" . $parts[1] . "-" . $parts[0];
        }
        return $dTgl;
    }

    public function TimeStamp()
    {
        date_default_timezone_set("Asia/Jakarta");
        return date("H:i:s");
    }

    public function DateStamp()
    {
        date_default_timezone_set("Asia/Jakarta");
        return date("d-m-Y");
    }

    public function DateTimeStamp()
    {
        date_default_timezone_set("Asia/Jakarta");
        return date("Y-m-d H:i:s");
    }

    public function index()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $cBulan = date("m");
        $cTahun = date("Y");

        $data = [
            'view'               => 'home',
            'tahun'              => $this->relasi->v_tahun(),
            'tahun2'             => $this->model->ViewASC('history_pelanggaran', 'id_history'),
            'kelas'              => $this->model->ViewASC('kelas', 'kelas'),
            'grafik_bulan_tahun' => $this->relasi->grafik_bulan_tahun_default($cBulan, $cTahun),
            // Summary counters for modern dashboard cards
            'total_siswa'        => $this->db->table('siswa')->countAllResults(),
            'total_pelanggaran'  => $this->db->table('history_pelanggaran')->countAllResults(),
            'total_guru'         => $this->db->table('bagian_kedisiplinan')->countAllResults(),
            'total_kelas'        => $this->db->table('kelas')->countAllResults(),
        ];

        return view('beranda', $data);
    }

    public function grafik_1()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $cBulan = $this->request->getPost('bulan') ?: date("m");
        $cTahun = $this->request->getPost('tahun') ?: date("Y");

        $data = [
            'bulan'              => $cBulan,
            'tahun'              => $cTahun,
            'grafik_bulan_tahun' => $this->relasi->grafik_bulan_tahun_default($cBulan, $cTahun),
        ];

        return view('grafik/grafik-1', $data);
    }

    public function grafik_2()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $cIdKelas = $this->request->getPost('kelas');
        $dbKelas  = $this->model->ViewWhere('kelas', 'id_kelas', $cIdKelas);

        $cKelas = '';
        $cJurusan = '';
        foreach ($dbKelas as $vaKelas) {
            $cKelas   = $vaKelas['kelas'];
            $cJurusan = $vaKelas['jurusan'];
        }

        $data = [
            'kelas'        => $cKelas,
            'jurusan'      => $cJurusan,
            'grafik_kelas' => $this->relasi->grafik_kelas_default($cIdKelas),
        ];

        return view('grafik/grafik-2', $data);
    }

    public function grafik_3()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $cIdKelas = $this->request->getPost('kelas');
        $cBulan   = $this->request->getPost('bulan') ?: date("m");
        $cTahun   = $this->request->getPost('tahun') ?: date("Y");

        $dbKelas  = $this->model->ViewWhere('kelas', 'id_kelas', $cIdKelas);
        $cKelas = '';
        $cJurusan = '';
        foreach ($dbKelas as $vaKelas) {
            $cKelas   = $vaKelas['kelas'];
            $cJurusan = $vaKelas['jurusan'];
        }

        $data = [
            'kelas'              => $cKelas,
            'jurusan'            => $cJurusan,
            'bulan'              => $cBulan,
            'tahun'              => $cTahun,
            'grafik_kelas_bulan' => $this->relasi->grafik_kelas_bulan_tahun_default($cIdKelas, $cBulan, $cTahun),
        ];

        return view('grafik/grafik-3', $data);
    }

    public function data_wali_murid()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'data_wali_murid' => $this->db->table('wali_murid')->get()->getResultArray(),
            'view'            => 'wali_murid/data_wali_murid',
        ];

        return view('beranda', $data);
    }

    public function data_wali_muridP()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'row'  => $this->relasi->v_pelanggaran_sum("WHERE point >= '10'"),
            'view' => 'surat_panggilan/data_wali_muridP',
        ];

        return view('beranda', $data);
    }

    public function surat_panggilan($id = "", $nis = "")
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $this->db->table('siswa')->where('nis', $nis)->update(['status_surat' => 'sudah-dicetak']);

        $siswa = $this->db->query("SELECT * FROM siswa s 
            INNER JOIN kelas k ON s.id_kelas = k.id_kelas
            INNER JOIN wali_murid w ON s.id_wali_murid = w.id_wali_murid
            WHERE w.id_wali_murid = ?", [$id])->getRow();

        $data = [
            'nama_wali'   => $siswa->nama_wali ?? '',
            'alamat_wali' => $siswa->alamat_wali ?? '',
            'nama_siswa'  => $siswa->nama_siswa ?? '',
            'kelas'       => $siswa->kelas ?? '',
            'jurusan'     => $siswa->jurusan ?? '',
            'no_kelas'    => $siswa->no_kelas ?? '',
            'row'         => $this->relasi->v_pelanggaran("WHERE nis = '$nis' AND point >= '10' ORDER BY tgl_pelanggaran LIMIT 0,1"),
            'id_wali'     => $id,
            'nis'         => $nis,
            'view'        => 'surat_panggilan/surat_panggilan',
        ];

        return view('beranda', $data);
    }

    public function viewPrintSurat($id = "", $nis = "")
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $siswa = $this->db->query("SELECT * FROM siswa s 
            INNER JOIN kelas k ON s.id_kelas = k.id_kelas
            INNER JOIN wali_murid w ON s.id_wali_murid = w.id_wali_murid
            WHERE w.id_wali_murid = ?", [$id])->getRow();

        $data = [
            'nama_wali'   => $siswa->nama_wali ?? '',
            'alamat_wali' => $siswa->alamat_wali ?? '',
            'nama_siswa'  => $siswa->nama_siswa ?? '',
            'kelas'       => $siswa->kelas ?? '',
            'jurusan'     => $siswa->jurusan ?? '',
            'no_kelas'    => $siswa->no_kelas ?? '',
            'row'         => $this->relasi->v_pelanggaran("WHERE nis = '$nis' AND point >= '10' ORDER BY tgl_pelanggaran LIMIT 0,1"),
            'id_wali'     => $id,
            'nis'         => $nis,
        ];

        return view('surat_panggilan/print_surat', $data);
    }

    public function update_wali_murid($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'wali_murid' => $this->db->table('wali_murid')->where('id_wali_murid', $id)->get()->getResultArray(),
            'view'       => 'wali_murid/update_wali_murid',
        ];

        return view('beranda', $data);
    }

    public function updateWali()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $nama_wali = $this->request->getPost('nama_wali');
        $id_wali_murid = $this->request->getPost('id_wali_murid');

        $data2 = [
            'nama_wali'   => $nama_wali,
            'alamat_wali' => $this->request->getPost('alamat_wali'),
            'no_hp_wali'  => $this->request->getPost('no_hp_wali'),
            'email_wali'  => $this->request->getPost('email_wali'),
        ];

        $this->db->table('wali_murid')->where('id_wali_murid', $id_wali_murid)->update($data2);

        session()->set([
            'pesan'     => 'Data Wali Siswa ' . $nama_wali . ' berhasil Diupdate',
            'parameter' => '1',
        ]);

        return redirect()->to(site_url('main/data_wali_murid'));
    }

    public function data_pelanggaran()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'pelanggaran' => $this->db->table('pelanggaran')->get()->getResultArray(),
            'view'        => 'pelanggaran/data_pelanggaran',
        ];

        return view('beranda', $data);
    }

    public function input_pelanggaran()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'view' => 'pelanggaran/input_pelanggaran',
        ];

        return view('beranda', $data);
    }

    public function update_pelanggaran($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'pelanggaran' => $this->db->table('pelanggaran')->where('id_pelanggaran', $id)->get()->getResultArray(),
            'view'        => 'pelanggaran/update_pelanggaran',
        ];

        return view('beranda', $data);
    }

    public function insertPelanggaran()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $nama_pelanggaran = $this->request->getPost('nama_pelanggaran');
        $point            = $this->request->getPost('point');

        $count = $this->db->table('pelanggaran')->where('nama_pelanggaran', $nama_pelanggaran)->countAllResults();

        if ($count < 1) {
            $this->db->table('pelanggaran')->insert([
                'nama_pelanggaran' => $nama_pelanggaran,
                'point'            => $point,
            ]);

            session()->set([
                'pesan'     => 'Berhasil Menambah data pelanggaran',
                'parameter' => '1',
            ]);
        } else {
            session()->set([
                'pesan'     => 'Maaf pelanggaran yang Anda masukkan sudah tercatat',
                'parameter' => '2',
            ]);
        }

        return redirect()->to(site_url('main/data_pelanggaran'));
    }

    public function insertPelanggaranM()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $cDate    = $this->request->getPost('tgl_pelanggaran');
        $cPecah   = explode("-", str_replace("/", "-", $cDate));
        $nTahun   = $cPecah[0] ?? date("Y");

        $nis             = $this->request->getPost('nis');
        $id_pelanggaran  = $this->request->getPost('id_pelanggaran');
        $id_kelas        = $this->request->getPost('cIdKelas');
        $sanksi          = $this->request->getPost('sanksi');
        $tgl_pelanggaran = $this->request->getPost('tgl_pelanggaran');

        $data = [
            'nis'                => $nis,
            'id_pelanggaran'     => $id_pelanggaran,
            'id_kelas'           => $id_kelas,
            'tgl_pelanggaran'    => $tgl_pelanggaran,
            'sanksi_pelanggaran' => $sanksi,
            'tahun_pelanggaran'  => $nTahun,
            'status_pelanggaran' => "Belum Validasi",
        ];

        if ($tgl_pelanggaran > date("Y-m-d")) {
            session()->set([
                'pesan'     => 'Tanggal melebihi hari ini',
                'parameter' => '3',
            ]);
        } else {
            $count = $this->db->table('history_pelanggaran')
                ->where('id_pelanggaran', $id_pelanggaran)
                ->where('tgl_pelanggaran', $tgl_pelanggaran)
                ->where('nis', $nis)
                ->countAllResults();

            if ($count < 1) {
                $this->db->table('history_pelanggaran')->insert($data);
                session()->set([
                    'pesan'     => 'Berhasil Menambah data pelanggaran Siswa',
                    'parameter' => '1',
                ]);
            } else {
                session()->set([
                    'pesan'     => 'Maaf pelanggaran yang Anda masukkan sudah tercatat pada tanggal ini',
                    'parameter' => '2',
                ]);
            }
        }

        return redirect()->to(site_url('main/i_pelanggaran_siswa/' . $nis));
    }

    public function editPelanggaranM($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $tgl_pelanggaran = $this->request->getPost('tgl_pelanggaran');

        $data = [
            'nis'                => $this->request->getPost('nis'),
            'sanksi_pelanggaran' => $this->request->getPost('sanksi'),
            'id_pelanggaran'     => $this->request->getPost('id_pelanggaran'),
            'tgl_pelanggaran'    => $tgl_pelanggaran,
            'status_pelanggaran' => "Belum Validasi",
        ];

        if ($tgl_pelanggaran > date("Y-m-d")) {
            session()->set([
                'pesan'     => 'Tanggal melebihi hari ini',
                'parameter' => '3',
            ]);
        } else {
            $this->model->Update('history_pelanggaran', 'id_history', $id, $data);
            session()->set([
                'pesan'     => 'Berhasil Update data pelanggaran Siswa',
                'parameter' => '1',
            ]);
        }

        return redirect()->to(site_url('main/lihat_pelanggaran'));
    }

    public function siswa()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $siswa = $this->db->query("SELECT * FROM siswa s 
            INNER JOIN kelas k ON s.id_kelas = k.id_kelas
            INNER JOIN wali_murid w ON s.id_wali_murid = w.id_wali_murid")->getResultArray();

        $data = [
            'siswa' => $siswa,
            'view'  => 'siswa/data_siswa',
        ];

        return view('beranda', $data);
    }

    public function PelanggaranSiswa()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $nis      = $this->request->getPost('nis');
        $id_kelas = $this->request->getPost('id_kelas');

        $builder = $this->db->table('siswa s')
            ->select('s.*, k.kelas, k.jurusan, k.no_kelas, w.nama_wali, w.no_hp_wali')
            ->join('kelas k', 's.id_kelas = k.id_kelas')
            ->join('wali_murid w', 's.id_wali_murid = w.id_wali_murid');

        if ($nis) {
            $builder->where('s.nis', $nis);
        }
        if ($id_kelas) {
            $builder->where('s.id_kelas', $id_kelas);
        }

        $data = [
            'kelas' => $this->db->table('kelas')->get()->getResultArray(),
            'siswa' => $builder->get()->getResultArray(),
            'view'  => 'pelanggaran_siswa/pelanggaran_siswa',
        ];

        return view('beranda', $data);
    }

    public function data_pelanggaran_siswa()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $nis   = session()->get('username');
        $bulan = $this->request->getPost('bulan');
        $tahun = $this->request->getPost('tahun');

        $siswaRow = $this->db->table('siswa')->where('nis', $nis)->get()->getRow();

        $builder = $this->db->table('history_pelanggaran hp')
            ->select('hp.*, s.*, k.kelas, k.jurusan, k.no_kelas, w.nama_pelanggaran, w.point')
            ->join('siswa s', 'hp.nis = s.nis')
            ->join('kelas k', 's.id_kelas = k.id_kelas')
            ->join('pelanggaran w', 'hp.id_pelanggaran = w.id_pelanggaran')
            ->where('hp.nis', $nis);

        if ($bulan && $tahun) {
            $builder->where('MONTH(hp.tgl_pelanggaran)', (int)$bulan);
            $builder->where('YEAR(hp.tgl_pelanggaran)', (int)$tahun);
        } elseif ($tahun) {
            $builder->where('YEAR(hp.tgl_pelanggaran)', (int)$tahun);
        }

        $data = [
            'foto'  => $siswaRow->foto ?? '',
            'nama'  => $siswaRow->nama_siswa ?? '',
            'kelas' => $this->db->table('kelas')->get()->getResultArray(),
            'siswa' => $builder->get()->getResultArray(),
            'view'  => 'pelanggaran_siswa/data_pelanggaran_siswa',
        ];

        return view('beranda', $data);
    }

    public function lihat_pelanggaran()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'siswa' => $this->model->ViewASC('v_pelanggaran', 'tgl_pelanggaran'),
            'view'  => 'pelanggaran_siswa/lihat_pelanggaran_siswa',
        ];

        return view('beranda', $data);
    }

    public function ViewLaporan()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $id_kelas = $this->request->getPost('id_kelas') ?: 'semua-kelas';
        $bulan    = $this->request->getPost('bulan') ?: 'semua-bulan';
        $tahun    = $this->request->getPost('tahun') ?: 'semua-tahun';

        $builder = $this->db->table('v_pelanggaran');

        if ($id_kelas !== 'semua-kelas') {
            $builder->where('id_kelas', $id_kelas);
        }
        if ($bulan !== 'semua-bulan') {
            $builder->where('MONTH(tgl_pelanggaran)', (int)$bulan);
        }
        if ($tahun !== 'semua-tahun') {
            $builder->where('YEAR(tgl_pelanggaran)', (int)$tahun);
        }

        $row = $builder->orderBy('id_history', 'ASC')->get()->getResultArray();

        $groupBuilder = $this->db->table('history_pelanggaran hp')
            ->select('k.*, hp.*, s.*, SUM(w.point) as point')
            ->join('siswa s', 'hp.nis = s.nis')
            ->join('kelas k', 's.id_kelas = k.id_kelas')
            ->join('pelanggaran w', 'hp.id_pelanggaran = w.id_pelanggaran');

        if ($id_kelas !== 'semua-kelas') {
            $groupBuilder->where('s.id_kelas', $id_kelas);
        }
        if ($bulan !== 'semua-bulan') {
            $groupBuilder->where('MONTH(hp.tgl_pelanggaran)', (int)$bulan);
        }
        if ($tahun !== 'semua-tahun') {
            $groupBuilder->where('YEAR(hp.tgl_pelanggaran)', (int)$tahun);
        }

        $siswa = $groupBuilder->groupBy('hp.nis')->get()->getResultArray();

        $data = [
            'row'      => $row,
            'siswa'    => $siswa,
            'id_kelas' => $id_kelas,
            'bulan'    => $bulan,
            'tahun'    => $tahun,
            'kelas'    => $id_kelas !== 'semua-kelas' ? $this->model->ViewWhere('kelas', 'id_kelas', $id_kelas) : [],
            'view'     => 'laporan/laporan_pelanggaran',
        ];

        return view('beranda', $data);
    }

    public function viewPrint($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $pisah = explode("_", $id);
        $id_kelas = $pisah[0] ?? 'semua-kelas';
        $bulan    = $pisah[1] ?? 'semua-bulan';
        $tahun    = $pisah[2] ?? 'semua-tahun';

        $builder = $this->db->table('v_pelanggaran');
        if ($id_kelas !== 'semua-kelas') {
            $builder->where('id_kelas', $id_kelas);
        }
        if ($bulan !== 'semua-bulan') {
            $builder->where('MONTH(tgl_pelanggaran)', (int)$bulan);
        }
        if ($tahun !== 'semua-tahun') {
            $builder->where('YEAR(tgl_pelanggaran)', (int)$tahun);
        }
        $row = $builder->orderBy('id_history', 'ASC')->get()->getResultArray();

        $groupBuilder = $this->db->table('history_pelanggaran hp')
            ->select('k.*, hp.*, s.*, SUM(w.point) as point')
            ->join('siswa s', 'hp.nis = s.nis')
            ->join('kelas k', 's.id_kelas = k.id_kelas')
            ->join('pelanggaran w', 'hp.id_pelanggaran = w.id_pelanggaran');

        if ($id_kelas !== 'semua-kelas') {
            $groupBuilder->where('s.id_kelas', $id_kelas);
        }
        if ($bulan !== 'semua-bulan') {
            $groupBuilder->where('MONTH(hp.tgl_pelanggaran)', (int)$bulan);
        }
        if ($tahun !== 'semua-tahun') {
            $groupBuilder->where('YEAR(hp.tgl_pelanggaran)', (int)$tahun);
        }
        $siswa = $groupBuilder->groupBy('hp.nis')->get()->getResultArray();

        $data = [
            'row'      => $row,
            'siswa'    => $siswa,
            'id_kelas' => $id_kelas,
            'bulan'    => $bulan,
            'tahun'    => $tahun,
            'kelas'    => $id_kelas !== 'semua-kelas' ? $this->model->ViewWhere('kelas', 'id_kelas', $id_kelas) : [],
        ];

        return view('laporan/print_laporan', $data);
    }

    public function i_pelanggaran_siswa($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $siswaRow = $this->db->table('siswa')->where('nis', $id)->get()->getRow();

        $data = [
            'tampil'      => $this->relasi->v_pelanggaran("WHERE nis = '$id' ORDER BY tgl_pelanggaran ASC"),
            'pelanggaran' => $this->db->table('pelanggaran')->get()->getResultArray(),
            'kelas'       => $this->db->table('kelas')->get()->getResultArray(),
            'wali_murid'  => $this->db->table('wali_murid')->countAllResults(),
            'siswa'       => $this->db->table('siswa')->where('nis', $id)->get()->getResultArray(),
            'foto'        => $siswaRow->foto ?? '',
            'nama'        => $siswaRow->nama_siswa ?? '',
            'nis'         => $id,
            'view'        => 'pelanggaran_siswa/i_pelanggaran_siswa',
        ];

        return view('beranda', $data);
    }

    public function update_h_pelanggaran($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'field'       => $this->model->ViewWhere('v_pelanggaran', 'id_history', $id),
            'pelanggaran' => $this->model->ViewASC('pelanggaran', 'id_pelanggaran'),
            'view'        => 'pelanggaran_siswa/e_pelanggaran_siswa',
        ];

        return view('beranda', $data);
    }

    public function input_siswa()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'kelas'      => $this->db->table('kelas')->get()->getResultArray(),
            'wali_murid' => $this->db->table('wali_murid')->countAllResults(),
            'view'       => 'siswa/input_siswa',
        ];

        return view('beranda', $data);
    }

    public function input_periode()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'kelas' => $this->db->table('kelas')->get()->getResultArray(),
            'tahun' => $this->model->ViewASC('history_pelanggaran', 'id_history'),
            'view'  => 'laporan/input_periode',
        ];

        return view('beranda', $data);
    }

    public function insertSiswa()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $nis           = $this->request->getPost('nis');
        $id_wali_murid = $this->request->getPost('id_wali_murid') ?: 'WM-' . (time() % 100000);
        $id_kelas      = $this->request->getPost('id_kelas');
        $tgl_lahir     = $this->request->getPost('tgl_lahir');

        $dataWali = [
            'id_wali_murid' => $id_wali_murid,
            'nama_wali'     => $this->request->getPost('nama_wali'),
            'alamat_wali'   => $this->request->getPost('alamat_wali'),
            'no_hp_wali'    => $this->request->getPost('no_hp_wali'),
            'email_wali'    => $this->request->getPost('email_wali'),
        ];

        $dataSiswa = [
            'nis'           => $nis,
            'id_wali_murid' => $id_wali_murid,
            'nama_siswa'    => $this->request->getPost('nama_siswa'),
            'id_kelas'      => $id_kelas,
            'alamat_siswa'  => $this->request->getPost('alamat_siswa'),
            'tempat_lahir'  => $this->request->getPost('tempat_lahir'),
            'tgl_lahir'     => $tgl_lahir,
            'foto'          => '',
            'status_surat'  => 'belum-dicetak',
        ];

        $dataUser = [
            'username' => $nis,
            'password' => $nis,
            'role'     => 'Siswa',
        ];

        $dataHistoriKelas = [
            'nis'                => $nis,
            'id_kelas'           => $id_kelas,
            'tahun_ajaran_masuk' => $this->request->getPost('tahun_ajaran_masuk') ?: date('Y'),
        ];

        $count = $this->db->table('siswa')->where('nis', $nis)->countAllResults();

        if ($count < 1) {
            $this->db->table('user')->insert($dataUser);
            $this->db->table('wali_murid')->insert($dataWali);
            $this->db->table('siswa')->insert($dataSiswa);
            $this->db->table('histori_kelas')->insert($dataHistoriKelas);

            session()->set([
                'pesan'     => 'Berhasil Menambah Siswa',
                'parameter' => '1',
            ]);
        } else {
            session()->set([
                'pesan'     => 'Maaf NIS sudah tercatat di sistem',
                'parameter' => '2',
            ]);
        }

        return redirect()->to(site_url('main/siswa'));
    }

    public function update_siswa($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'kelas'      => $this->db->table('kelas')->get()->getResultArray(),
            'wali_murid' => $this->db->table('wali_murid')->countAllResults(),
            'siswa'      => $this->db->table('siswa')->where('nis', $id)->get()->getResultArray(),
            'view'       => 'siswa/update_siswa',
        ];

        return view('beranda', $data);
    }

    public function updateSiswa()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $nis  = $this->request->getPost('nis');
        $nama = $this->request->getPost('nama_siswa');

        $data2 = [
            'nama_siswa'   => $nama,
            'id_kelas'     => $this->request->getPost('id_kelas'),
            'alamat_siswa' => $this->request->getPost('alamat_siswa'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tgl_lahir'    => $this->request->getPost('tgl_lahir'),
        ];

        $this->db->table('siswa')->where('nis', $nis)->update($data2);

        session()->set([
            'pesan'     => 'Data Siswa ' . $nama . ' berhasil Diupdate',
            'parameter' => '1',
        ]);

        return redirect()->to(site_url('main/siswa'));
    }

    public function setting_siswa($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $siswaRow = $this->db->table('siswa')->where('nis', $id)->get()->getRow();

        $data = [
            'kelas'      => $this->db->table('kelas')->get()->getResultArray(),
            'wali_murid' => $this->db->table('wali_murid')->countAllResults(),
            'siswa'      => $this->db->table('siswa')->where('nis', $id)->get()->getResultArray(),
            'foto'       => $siswaRow->foto ?? '',
            'nama'       => $siswaRow->nama_siswa ?? '',
            'view'       => 'setting_siswa/profil_siswa',
        ];

        return view('beranda', $data);
    }

    public function setting_admin($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $guruRow = $this->db->table('bagian_kedisiplinan')->where('nip', $id)->get()->getRow();

        $data = [
            'bagian_kedisiplinan' => $this->db->table('bagian_kedisiplinan')->where('nip', $id)->get()->getResultArray(),
            'foto'                => $guruRow->foto ?? '',
            'nama'                => $guruRow->nama_guru ?? '',
            'view'                => 'setting_admin/profil_admin',
        ];

        return view('beranda', $data);
    }

    public function kelas()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'kelas' => $this->db->table('kelas')->get()->getResultArray(),
            'view'  => 'kelas/data_kelas',
        ];

        return view('beranda', $data);
    }

    public function hapusKelas($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $this->db->table('kelas')->where('id_kelas', $id)->delete();

        session()->set([
            'pesan'     => 'Data kelas berhasil Dihapus',
            'parameter' => '1',
        ]);

        return redirect()->to(site_url('main/kelas'));
    }

    public function hapus_peanggaran($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $this->db->table('pelanggaran')->where('id_pelanggaran', $id)->delete();

        session()->set([
            'pesan'     => 'Data pelanggaran berhasil Dihapus',
            'parameter' => '1',
        ]);

        return redirect()->to(site_url('main/data_pelanggaran'));
    }

    public function hapus_h_pelanggaran($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $this->model->Delete('history_pelanggaran', 'id_history', $id);

        session()->set([
            'pesan'     => 'Data catatan pelanggaran berhasil Dihapus',
            'parameter' => '1',
        ]);

        return redirect()->to(site_url('main/lihat_pelanggaran'));
    }

    public function bagian_kedisiplinan()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'bagian_kedisiplinan' => $this->db->table('bagian_kedisiplinan bk')
                ->join('user u', 'bk.nip = u.username')
                ->get()
                ->getResultArray(),
            'view' => 'bagian_kedisiplinan/data_bagian_kedisiplinan',
        ];

        return view('beranda', $data);
    }

    public function input_bagian_kedisiplinan()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'view' => 'bagian_kedisiplinan/input_bagian_kedisiplinan',
        ];

        return view('beranda', $data);
    }

    public function uBagianKedisiplinan($id)
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'bagian_kedisiplinan' => $this->db->table('bagian_kedisiplinan')->where('nip', $id)->get()->getResultArray(),
            'view'                => 'bagian_kedisiplinan/update_bagian_kedisiplinan',
        ];

        return view('beranda', $data);
    }

    public function updatePelanggaran()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $id_pelanggaran = $this->request->getPost('id_pelanggaran');

        $data2 = [
            'nama_pelanggaran' => $this->request->getPost('nama_pelanggaran'),
            'point'            => $this->request->getPost('point'),
        ];

        $this->db->table('pelanggaran')->where('id_pelanggaran', $id_pelanggaran)->update($data2);

        session()->set([
            'pesan'     => 'Data pelanggaran berhasil Diupdate',
            'parameter' => '1',
        ]);

        return redirect()->to(site_url('main/data_pelanggaran'));
    }

    public function updateBagianKedisiplinan()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $nip  = $this->request->getPost('nip');
        $nama = $this->request->getPost('nama_guru');

        $data2 = [
            'nama_guru'   => $nama,
            'alamat_guru' => $this->request->getPost('alamat_guru'),
            'no_hp'       => $this->request->getPost('no_hp'),
            'email'       => $this->request->getPost('email'),
        ];

        $this->db->table('bagian_kedisiplinan')->where('nip', $nip)->update($data2);

        session()->set([
            'pesan'     => 'Data guru ' . $nama . ' berhasil Diupdate',
            'parameter' => '1',
        ]);

        return redirect()->to(site_url('main/bagian_kedisiplinan'));
    }

    public function updateBagianKedisiplinanP()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $nip  = $this->request->getPost('nip');
        $nama = $this->request->getPost('nama_guru');

        $data2 = [
            'nama_guru'   => $nama,
            'alamat_guru' => $this->request->getPost('alamat_guru'),
            'no_hp'       => $this->request->getPost('no_hp'),
            'email'       => $this->request->getPost('email'),
        ];

        $this->db->table('bagian_kedisiplinan')->where('nip', $nip)->update($data2);

        session()->set([
            'pesan'     => 'Data profil berhasil Diupdate',
            'parameter' => '1',
        ]);

        return redirect()->to(site_url('main/setting_admin/' . $nip));
    }

    public function updateProfil()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $nis  = $this->request->getPost('nis');
        $nama = $this->request->getPost('nama_siswa');

        $data2 = [
            'nama_siswa'   => $nama,
            'alamat_siswa' => $this->request->getPost('alamat_siswa'),
            'tempat_lahir' => $this->request->getPost('tempat_lahir'),
            'tgl_lahir'    => $this->request->getPost('tgl_lahir'),
        ];

        $this->db->table('siswa')->where('nis', $nis)->update($data2);

        session()->set([
            'pesan'     => 'Data Siswa ' . $nama . ' berhasil Diupdate',
            'parameter' => '1',
        ]);

        return redirect()->to(site_url('main/index'));
    }

    public function prosesuploadFoto()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $file = $this->request->getFile('userfile');
        $nis  = $this->request->getPost('nis');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'img', $newName);
            // Also copy to root img if exists
            if (is_dir(ROOTPATH . 'img')) {
                @copy(FCPATH . 'img/' . $newName, ROOTPATH . 'img/' . $newName);
            }

            $this->db->table('siswa')->where('nis', $nis)->update(['foto' => $newName]);
            session()->set('foto', $newName);

            session()->set([
                'pesan'     => 'Foto Berhasil Diganti',
                'parameter' => '1',
            ]);
        } else {
            session()->set([
                'pesan'     => 'Gagal Melakukan Upload Foto',
                'parameter' => '2',
            ]);
        }

        return redirect()->to(site_url('main/index'));
    }

    public function prosesuploadFotoA()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $file = $this->request->getFile('userfile');
        $nip  = $this->request->getPost('nip');

        if ($file && $file->isValid() && !$file->hasMoved()) {
            $newName = $file->getRandomName();
            $file->move(FCPATH . 'img', $newName);
            if (is_dir(ROOTPATH . 'img')) {
                @copy(FCPATH . 'img/' . $newName, ROOTPATH . 'img/' . $newName);
            }

            $this->db->table('bagian_kedisiplinan')->where('nip', $nip)->update(['foto' => $newName]);
            session()->set('foto', $newName);

            session()->set([
                'pesan'     => 'Foto Berhasil Diganti',
                'parameter' => '1',
            ]);
        } else {
            session()->set([
                'pesan'     => 'Gagal Melakukan Upload Foto',
                'parameter' => '2',
            ]);
        }

        return redirect()->to(site_url('main/index'));
    }

    public function insertBagianKedisiplinan()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $nip   = $this->request->getPost('nip');
        $nama  = $this->request->getPost('nama_guru');

        $data = [
            'nip'         => $nip,
            'nama_guru'   => $nama,
            'alamat_guru' => $this->request->getPost('alamat_guru'),
            'no_hp'       => $this->request->getPost('no_hp'),
            'email'       => $this->request->getPost('email'),
            'foto'        => '',
        ];

        $dataUser = [
            'username' => $nip,
            'password' => $nip,
            'role'     => "Bagian Kedisiplinan",
        ];

        $count = $this->db->table('bagian_kedisiplinan')->where('nip', $nip)->countAllResults();

        if ($count < 1) {
            $this->db->table('user')->insert($dataUser);
            $this->db->table('bagian_kedisiplinan')->insert($data);

            session()->set([
                'pesan'     => 'Berhasil Menambah Bagian Kedisiplinan',
                'parameter' => '1',
            ]);
        } else {
            session()->set([
                'pesan'     => 'Maaf NIP sudah tercatat di sistem',
                'parameter' => '2',
            ]);
        }

        return redirect()->to(site_url('main/bagian_kedisiplinan'));
    }

    public function input_data_kelas()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $data = [
            'view' => 'kelas/input_kelas',
        ];

        return view('beranda', $data);
    }

    public function insertKelas()
    {
        if ($redirect = $this->checkAuth()) return $redirect;

        $kelas    = $this->request->getPost('kelas');
        $jurusan  = $this->request->getPost('jurusan');
        $no_kelas = $this->request->getPost('no_kelas');

        $data = [
            'kelas'    => $kelas,
            'jurusan'  => $jurusan,
            'no_kelas' => $no_kelas,
        ];

        $count = $this->db->table('kelas')
            ->where('kelas', $kelas)
            ->where('jurusan', $jurusan)
            ->where('no_kelas', $no_kelas)
            ->countAllResults();

        if ($count < 1) {
            $this->db->table('kelas')->insert($data);

            session()->set([
                'pesan'     => 'Berhasil Menambah Kelas',
                'parameter' => '1',
            ]);
        } else {
            session()->set([
                'pesan'     => 'Gagal Menambah Kelas dikarenakan data sudah ada',
                'parameter' => '2',
            ]);
        }

        return redirect()->to(site_url('main/kelas'));
    }
}
