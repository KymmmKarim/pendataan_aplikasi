<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class UnitSeeder extends Seeder
{
    public function run()
    {
$units = [
            ['id' => 1, 'no' => '20101', 'nama' => 'REKTORAT', 'singkatan' => 'REKTORAT', 'urut' => 1, 'parent_id' => null, 'aktif' => 1],
            ['id' => 2, 'no' => '20102', 'nama' => 'BIRO AKADEMIK', 'singkatan' => 'BA', 'urut' => 5, 'parent_id' => null, 'aktif' => 1],
            ['id' => 3, 'no' => '20103', 'nama' => 'BIRO KEMAHASISWAAN DAN ALUMNI', 'singkatan' => 'BKA', 'urut' => 6, 'parent_id' => null, 'aktif' => 1],
            ['id' => 4, 'no' => '20104', 'nama' => 'BIRO KEUANGAN DAN UMUM', 'singkatan' => 'BKU', 'urut' => 7, 'parent_id' => null, 'aktif' => 1],
            ['id' => 5, 'no' => '20105', 'nama' => 'BIRO SUMBER DAYA MANUSIA', 'singkatan' => 'BSDM', 'urut' => 8, 'parent_id' => null, 'aktif' => 1],
            ['id' => 6, 'no' => '20106', 'nama' => 'BIRO KERJASAMA, HUMAS, DAN PEMASARAN', 'singkatan' => 'BKHP', 'urut' => 9, 'parent_id' => null, 'aktif' => 1],
            ['id' => 7, 'no' => '20210', 'nama' => 'FAKULTAS TEKNOLOGI INDUSTRI', 'singkatan' => 'FTI', 'urut' => 16, 'parent_id' => null, 'aktif' => 1],
            ['id' => 8, 'no' => '20211', 'nama' => 'TEKNIK ELEKTRO', 'singkatan' => 'EL', 'urut' => 18, 'parent_id' => null, 'aktif' => 1],
            ['id' => 9, 'no' => '20212', 'nama' => 'TEKNIK MESIN', 'singkatan' => 'MS', 'urut' => 19, 'parent_id' => null, 'aktif' => 1],
            ['id' => 10, 'no' => '20213', 'nama' => 'TEKNIK INDUSTRI', 'singkatan' => 'TI', 'urut' => 20, 'parent_id' => null, 'aktif' => 1],
            ['id' => 11, 'no' => '20214', 'nama' => 'TEKNIK KIMIA', 'singkatan' => 'TK', 'urut' => 21, 'parent_id' => null, 'aktif' => 1],
            ['id' => 12, 'no' => '20215', 'nama' => 'INFORMATIKA', 'singkatan' => 'IF', 'urut' => 22, 'parent_id' => null, 'aktif' => 1],
            ['id' => 13, 'no' => '20216', 'nama' => 'SISTEM INFORMASI', 'singkatan' => 'IS', 'urut' => 23, 'parent_id' => null, 'aktif' => 1],
            ['id' => 14, 'no' => '20217', 'nama' => 'FAKULTAS TEKNIK SIPIL DAN PERENCANAAN', 'singkatan' => 'FTSP', 'urut' => 26, 'parent_id' => null, 'aktif' => 1],
            ['id' => 15, 'no' => '20218', 'nama' => 'ARSITEKTUR', 'singkatan' => 'AR', 'urut' => 35, 'parent_id' => null, 'aktif' => 1],
            ['id' => 16, 'no' => '20219', 'nama' => 'TEKNIK SIPIL', 'singkatan' => 'SI', 'urut' => 28, 'parent_id' => null, 'aktif' => 1],
            ['id' => 17, 'no' => '20223', 'nama' => 'TEKNIK GEODESI', 'singkatan' => 'GD', 'urut' => 29, 'parent_id' => null, 'aktif' => 1],
            ['id' => 18, 'no' => '20224', 'nama' => 'PERENCANAAN WILAYAH DAN KOTA', 'singkatan' => 'PWK', 'urut' => 30, 'parent_id' => null, 'aktif' => 1],
            ['id' => 19, 'no' => '20225', 'nama' => 'TEKNIK LINGKUNGAN', 'singkatan' => 'TL', 'urut' => 31, 'parent_id' => null, 'aktif' => 1],
            ['id' => 20, 'no' => '20230', 'nama' => 'FAKULTAS ARSITEKTUR DAN DESAIN', 'singkatan' => 'FAD', 'urut' => 33, 'parent_id' => null, 'aktif' => 1],
            ['id' => 21, 'no' => '20231', 'nama' => 'DESAIN INTERIOR', 'singkatan' => 'DI', 'urut' => 36, 'parent_id' => null, 'aktif' => 1],
            ['id' => 22, 'no' => '20232', 'nama' => 'DESAIN PRODUK', 'singkatan' => 'DP', 'urut' => 37, 'parent_id' => null, 'aktif' => 1],
            ['id' => 23, 'no' => '20233', 'nama' => 'DESAIN KOMUNIKASI VISUAL', 'singkatan' => 'DKV', 'urut' => 38, 'parent_id' => null, 'aktif' => 1],
            ['id' => 24, 'no' => '21007', 'nama' => 'UPT PERPUSTAKAAN', 'singkatan' => 'UPT-PERPUS', 'urut' => 10, 'parent_id' => null, 'aktif' => 1],
            ['id' => 25, 'no' => '20108', 'nama' => 'UPT TEKNOLOGI INFORMASI DAN KOMUNIKASI', 'singkatan' => 'UPT-TIK', 'urut' => 11, 'parent_id' => null, 'aktif' => 1],
            ['id' => 26, 'no' => '20110', 'nama' => 'SATUAN PENJAMINAN MUTU', 'singkatan' => 'SPM', 'urut' => 13, 'parent_id' => null, 'aktif' => 1],
            ['id' => 27, 'no' => '20109', 'nama' => 'LEMBAGA PENELITIAN DAN PENGABDIAN PADA MASYARAKAT', 'singkatan' => 'LP2M', 'urut' => 12, 'parent_id' => null, 'aktif' => 1],
            ['id' => 28, 'no' => '10000', 'nama' => 'YAYASAN PENDIDIKAN DAYANG SUMBI', 'singkatan' => 'YPDS', 'urut' => null, 'parent_id' => null, 'aktif' => 1],
            ['id' => 29, 'no' => '20111', 'nama' => 'SATUAN PENGEMBANGAN PEMBELAJARAN', 'singkatan' => 'SPP', 'urut' => 14, 'parent_id' => null, 'aktif' => 1],
            ['id' => 30, 'no' => '20112', 'nama' => 'SATUAN PENGAWAS INTERNAL', 'singkatan' => 'SPI', 'urut' => 15, 'parent_id' => null, 'aktif' => 1],
            ['id' => 31, 'no' => '10001', 'nama' => 'YPDS KEPEGAWAIAN', 'singkatan' => 'YPDS KEP', 'urut' => null, 'parent_id' => null, 'aktif' => 1],
            ['id' => 32, 'no' => '10002', 'nama' => 'YPDS KEUANGAN', 'singkatan' => 'YPDS KEU', 'urut' => null, 'parent_id' => null, 'aktif' => 1],
            ['id' => 33, 'no' => '10003', 'nama' => 'YPDS ASET', 'singkatan' => 'YPDS ASET', 'urut' => null, 'parent_id' => null, 'aktif' => 1],
            ['id' => 34, 'no' => '20261', 'nama' => 'MAGISTER TEKNIK MESIN', 'singkatan' => 'MTM', 'urut' => 24, 'parent_id' => null, 'aktif' => 1],
            ['id' => 35, 'no' => '20262', 'nama' => 'MAGISTER TEKNIK INDUSTRI', 'singkatan' => 'MTI', 'urut' => 25, 'parent_id' => null, 'aktif' => 1],
            ['id' => 36, 'no' => '20263', 'nama' => 'MAGISTER TEKNIK SIPIL', 'singkatan' => 'MTS', 'urut' => 32, 'parent_id' => null, 'aktif' => 1],
            ['id' => 37, 'no' => '20210', 'nama' => 'UNIT FAKULTAS TEKNOLOGI INDUSTRI', 'singkatan' => 'UNIT FTI', 'urut' => 17, 'parent_id' => null, 'aktif' => 1],
            ['id' => 38, 'no' => '20220', 'nama' => 'UNIT FAKULTAS TEKNIK SIPIL DAN PERENCANAAN', 'singkatan' => 'UNIT FTSP', 'urut' => 27, 'parent_id' => null, 'aktif' => 1],
            ['id' => 39, 'no' => '20230', 'nama' => 'UNIT FAKULTAS ARSITEKTUR DAN DESAIN', 'singkatan' => 'UNIT FAD', 'urut' => 34, 'parent_id' => null, 'aktif' => 1],
            ['id' => 40, 'no' => '20101', 'nama' => 'WAKIL REKTOR BIDANG AKADEMIK', 'singkatan' => 'WRAK', 'urut' => 2 , 'parent_id' => null, 'aktif' => 1],
            ['id' => 41, 'no' => '20101', 'nama' => 'WAKIL REKTOR BIDANG KEUANGAN DAN UMUM', 'singkatan' => 'WRKU', 'urut' => 3, 'parent_id' => null, 'aktif' => 1],
            ['id' => 42, 'no' => '20101', 'nama' => 'WAKIL REKTOR BIDANG PERENCANAAN, INOVASI DAN KERJASAMA', 'singkatan' => 'WRPIK', 'urut' => 4, 'parent_id' => null, 'aktif' => 1],
            ['id' => 47, 'no' => '12345', 'nama' => 'UNIT TEST UTAMA', 'singkatan' => 'UTU', 'urut' => 90, 'parent_id' => null, 'aktif' => 1],
            ['id' => 49, 'no' => '1234567', 'nama' => 'UNIT TEST BAGIAN 2', 'singkatan' => 'UTB2', 'urut' => 92, 'parent_id' => null, 'aktif' => 1],
            ['id' => 55, 'no' => '1234', 'nama' => 'UNIT TEST SUB BAGIAN 1', 'singkatan' => 'UTSB1', 'urut' => null, 'parent_id' => null, 'aktif' => 1],
            ['id' => 64, 'no' => '2999', 'nama' => 'LEMBAGA PENJAMINAN MUTU', 'singkatan' => 'LPM', 'urut' => 20, 'parent_id' => null, 'aktif' => 1],
            ['id' => 65, 'no' => '2998', 'nama' => 'BIRO SUMBER DAYA DAN UMUM', 'singkatan' => 'BSDU', 'urut' => 40, 'parent_id' => null, 'aktif' => 1],
            ['id' => 68, 'no' => '99999', 'nama' => 'testing', 'singkatan' => 'test', 'urut' => 20, 'parent_id' => null, 'aktif' => 1],
];

    
    DB::table('units')->insert($units);
    }
}

