<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DataDiriDosen;
use App\Models\DataJabatanAkademik;
use App\Models\DataNIDN;
use App\Models\DataPendidikanDosen;
use App\Models\DataPengembanganDiri;
use App\Models\DataProdiDosen;
use App\Models\DataStaff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class Controller_Database extends Controller
{
    // Get Data
    public function getDataDosen()
    {
        try {
            $data = DataDiriDosen::where('nidn_dosen', Auth::user()->nidn_nik)->first();
            if ($data) {
                return response()->json([
                    'pesan' => 'Data Berhasil',
                    'data' => $data
                ]);
            } else {
                response()->json([
                    'pesan' => 'Data Kosong',
                    'data' => $data
                ], 401);
            }
            return response()->json([
                'pesan' => 'Error',
                'data' => $data
            ], 408);
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Data Gagal',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function getDataPendidikan()
    {
        try {
            $data = DataPendidikanDosen::where('nidn_dosen', Auth::user()->nidn_nik)->first();
            if ($data) {
                return response()->json([
                    'data' => $data
                ]);
            } else {
                return response()->json([
                    'pesan' => 'Gagal',
                ], 401);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getDataProdi()
    {
        try {
            $data = DataProdiDosen::where('nidn_dosen', Auth::user()->nidn_nik)->first();
            if ($data) {
                return response()->json([
                    'data' => $data
                ]);
            } else {
                return response()->json([
                    'pesan' => 'Gagal'
                ], 401);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getDataJabatan()
    {
        try {
            $data = DataJabatanAkademik::where('nidn_dosen', Auth::user()->nidn_nik)->first();
            if ($data) {
                return response()->json([
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'data' => $data
                ], 401);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getDataPengembanganDiri()
    {
        try {
            $data = DataPengembanganDiri::where('nidn_dosen', Auth::user()->nidn_nik)->first();

            if ($data) {
                return response()->json([
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'data' => $data
                ], 401);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function getDataStaff()
    {
        try {
            $data = DataStaff::where('nidn_dosen', Auth::user()->nidn_nik)->first();
            if ($data) {
                return response()->json([
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'data' => $data
                ], 401);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }

    // Create
    // Input Data Diri
    public function inputDataDiri(Request $request)
    {
        try {
            $data = $request->all();
            $input = DataNIDN::where('NIDN_NIK', $request['nidn_dosen'])->first();

            $namaFoto = $request->file('foto_dosen')->getClientOriginalName();
            $pathFoto = $request->file('foto_dosen')->storeAs('upload/images', $namaFoto);
            $data['foto_dosen'] = $pathFoto;
            $namaSertif = $request->file('sertifikasi_pendidik')->getClientOriginalName();
            $pathSertif = $request->file('sertifikasi_pendidik')->storeAs('upload/pdf/sertif', $namaSertif);
            $data['sertifikasi_pendidik'] = $namaSertif;
            $namaSk = $request->file('tmt_sk_pertama')->getClientOriginalName();
            $pathSk = $request->file('tmt_sk_pertama')->storeAs('upload/pdf/sertif', $namaSk);
            $data['tmt_sk_pertama'] = $namaSk;

            if ($input) {
                $data = DataDiriDosen::create($data);
                return response()->json([
                    'pesan' => 'Input Data Diri Dosen Berhasil.',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'pesan' => 'Input Data Diri Dosen Gagal.',
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Terjadi Kesalahan.',
                'error' => $e->getMessage()
            ]);
        }
    }

    // Input Data Pendidikan
    public function inputDataPendidikan(Request $request)
    {
        try {
            $data = $request->all();
            $input = DataNIDN::where('NIDN_NIK', $request['nidn_dosen'])->first();

            if ($request->file('file_bukti_s1')) {
                $namaS1 = $request->file('file_bukti_s1')->getClientOriginalName();
                $pathS1 = $request->file('file_bukti_s1')->storeAs('upload/pdf/bukti/pendidikan', $namaS1);
                $data['file_bukti_s1'] = $namaS1;
            }
            if ($request->file('file_bukti_s2')) {
                $namaS2 = $request->file('file_bukti_s2')->getClientOriginalName();
                $pathS2 = $request->file('file_bukti_s2')->storeAs('upload/pdf/bukti/pendidikan', $namaS2);
                $data['file_bukti_s2'] = $namaS2;
            }
            if ($request->file('file_bukti_s3')) {
                $namaS3 = $request->file('file_bukti_s3')->getClientOriginalName();
                $pathS3 = $request->file('file_bukti_s3')->storeAs('upload/pdf/bukti/pendidikan', $namaS3);
                $data['file_bukti_s3'] = $namaS3;
            }

            if ($input) {
                DataPendidikanDosen::create($data);

                return response()->json([
                    'pesan' => "Input Data Pendidikan Berhasil.",
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'pesan' => "Input Data Pendidikan Gagal.",
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => "Terjadi Kesalahan.",
                'error' => $e->getMessage()
            ]);
        }
    }

    // Input Data Prodi
    public function inputDataProdi(Request $request)
    {
        try {
            $data = $request->all();
            $input = DataNIDN::where('NIDN_NIK', $request['nidn_dosen'])->first();

            if ($input) {
                DataProdiDosen::create($data);
                return response()->json([
                    'pesan' => 'Input Data Prodi Berhasil.',
                    'data' => $data
                ]);
            } else {
                return response()->json([
                    'pesan' => 'Input Data Prodi Gagal.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Terjadi Kesalahan.',
                'error' => $e->getMessage()
            ]);
        }
    }

    // Input Data Jabatan
    public function inputDataJabatan(Request $request)
    {
        try {
            $data = $request->all();
            $input = DataNIDN::where('NIDN_NIK', $request['nidn_dosen'])->first();

            if ($input) {
                DataJabatanAkademik::create($data);

                return response()->json([
                    'pesan' => 'Input Data Jabatan Berhasil.',
                    'data' => $data
                ]);
            } else {
                return response()->json([
                    'pesan' => 'Input Data Jabatan Gagal.',
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Terjadi Kesalahan.',
                'error' => $e->getMessage()
            ]);
        }
    }

    // Inpud Data Pengembangan
    public function inputDataPengembangan(Request $request)
    {
        try {
            $data = $request->all();
            $input = DataNIDN::where('NIDN_NIK', $request['nidn_dosen'])->first();
            if ($request->file('bukti_kegiatan')) {
                $namaKegiatan = $request->file('bukti_kegiatan')->getClientOriginalName();
                $pathKegiatan = $request->file('bukti_kegiatan')->storeAs('upload/pdf/bukti/pengembangan_diri', $namaKegiatan);
                $data['bukti_kegiatan'] = $namaKegiatan;
            }

            if ($input) {
                DataPengembanganDiri::create($data);

                return response()->json([
                    'pesan' => 'Input Data Pengembangan Diri, Berhasil.',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'pesan' => 'Input Data Pengembangan Diri, Gagal.',
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Terjadi Kesalahan.',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function inputDataStaff(Request $request)
    {
        try {
            $data = $request->all();
            $input = DataNIDN::where('NIDN_NIK', $request['nidn_dosen'])->first();

            if ($input) {
                $input = DataStaff::create($data);
                return response()->json([
                    'pesan' => 'Input Data Staff, Berhasil.',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'pesan' => 'Gagal.',
                ], 401);
            }
        } catch (\Exception $e) {
            return $e;
        }
    }




    // Update
    // Input Data Diri
    public function updateDataDiri(Request $request, $nidn_dosen)
    {
        try {
            $data = $request->all();
            $apdet = DataDiriDosen::find($nidn_dosen);
            if ($request->hasFile('foto_dosen')) {
                // foto
                Storage::delete('upload/images' . $apdet->foto_dosen);
                $namaFoto = $request->file('foto_dosen')->getClientOriginalName();
                $pathFoto = $request->file('foto_dosen')->storeAs('upload/images', $namaFoto);
                $data['foto_dosen'] = $pathFoto;

                $apdet->update($data);

                return response()->json([
                    'pesan' => 'Update Data Diri Berhasil.',
                    'data' => $apdet
                ]);
            } else if ($request->hasFile('sertifikasi_pendidik')) {
                // pdf1
                Storage::delete('public/upload/pdf' . $apdet->sertifikasi_pendidik);
                $namaSertif = $request->file('sertifikasi_pendidik')->getClientOriginalName();
                $pathSertif = $request->file('sertifikasi_pendidik')->storeAs('upload/pdf', $namaSertif);
                $data['sertifikasi_pendidik'] = $namaSertif;

                $apdet->update($data);

                return response()->json([
                    'pesan' => 'Update Data Diri Berhasil.',
                    'data' => $apdet
                ]);
            } else if ($request->hasFile('tmt_sk_pertama')) {
                // pdf2
                $namaSk = $request->file('tmt_sk_pertama')->getClientOriginalName();
                $pathSk = $request->file('tmt_sk_pertama')->storeAs('upload/pdf', $namaSk);
                $data['tmt_sk_pertama'] = $namaSk;
                Storage::delete('public/upload/pdf' . $apdet->tmt_sk_pertama);

                $apdet->update($data);

                return response()->json([
                    'pesan' => 'Update Data Diri Berhasil.',
                    'data' => $apdet
                ]);
            } else {
                $apdet->update($data);

                return response()->json([
                    'pesan' => 'Update Data Diri Berhasil.',
                    'data' => $apdet
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Terjadi Kesalahan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateDataPendidikan(Request $request, $nidn_dosen)
    {
        try {
            $data = $request->all();
            $apdet = DataPendidikanDosen::find($nidn_dosen);

            if ($request->hasFile('file_bukti_s1')) {
                $namaS1 = $request->file('file_bukti_s1')->getClientOriginalName();
                $pathS1 = $request->file('file_bukti_s1')->storeAs('upload/pdf/bukti/pendidikan', $namaS1);
                $data['file_bukti_s1'] = $namaS1;

                $apdet->update($data);
                Storage::delete('upload/pdf/bukti/pendidikan', $apdet->file_bukti_s1);
                return response()->json([
                    'pesan' => 'Data Pendidikan Berhasil di Update.',
                    'data' => $apdet
                ]);
            } else if ($request->hasFile('file_bukti_s2')) {
                $namaS2 = $request->file('file_bukti_s2')->getClientOriginalName();
                $pathS2 = $request->file('file_bukti_s2')->storeAs('upload/pdf/bukti/pendidikan', $namaS2);
                $data['file_bukti_s2'] = $namaS2;

                $apdet->update($data);
                Storage::delete('upload/pdf/bukti/pendidikan', $apdet->file_bukti_s2);
                return response()->json([
                    'pesan' => 'Data Pendidikan Berhasil di Update.',
                    'data' => $apdet
                ]);
            } else if ($request->hasFile('file_bukti_s3')) {
                $namaS3 = $request->file('file_bukti_s3')->getClientOriginalName();
                $pathS3 = $request->file('file_bukti_s3')->storeAs('upload/pdf/bukti/pendidikan', $namaS3);
                $data['file_bukti_s3'] = $namaS3;

                $apdet->update($data);
                Storage::delete('upload/pdf/bukti/pendidikan', $apdet->file_bukti_s3);
                return response()->json([
                    'pesan' => 'Data Pendidikan Berhasil di Update.',
                    'data' => $apdet
                ]);
            } else {

                $apdet->update($data);
                return response()->json([
                    'pesan' => 'Data Pendidikan Berhasil di Update.',
                    'data' => $apdet
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Data Pendidikan Gagal di Update.',
                'data' => $e->getMessage()
            ], 500);
        }
    }

    public function updateDataProdi(Request $request, $nidn_dosen)
    {
        try {
            $data = $request->all();
            $apdet = DataProdiDosen::find($nidn_dosen);

            if ($apdet) {
                $apdet->update($data);
                return response()->json([
                    'pesan' => 'Data Pendidikan Berhasil di Update',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'pesan' => 'Gagal di Update'
                ], 403);
            }
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Terdapat Kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateDataJabatan(Request $request, $nidn_dosen)
    {
        try {
            $data = $request->all();
            $apdet = DataJabatanAkademik::find($nidn_dosen);

            if ($apdet) {
                $apdet->update($data);

                return response()->json([
                    'pesan' => 'Data Jabatan Berhasil di Update',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'pesan' => 'Data Jabatan Gagal di Update',
                ], 403);
            }
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Terjadi Kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateDataPengembangan(Request $request, $nidn_dosen)
    {
        try {
            $data = $request->all();
            $apdet = DataPengembanganDiri::find($nidn_dosen);

            if ($request->hasFile('bukti_kegiatan')) {
                $namaKegiatan = $request->file('bukti_kegiatan')->getClientOriginalName();
                $path = $request->file('bukti_kegiatan')->storeAs('upload/pdf/bukti/pengembangan_diri', $namaKegiatan);
                $data['bukti_kegiatan'] = $namaKegiatan;

                $apdet->update($data);
                Storage::delete('upload/pdf/bukti/pengembangan_diri' . $apdet->bukti_kegiatan);

                return response()->json([
                    'pesan' => 'Data Pengembangan Diri Berhasil di Update.',
                    'data' => $apdet
                ]);
            } else {
                $apdet->update($data);

                return response()->json([
                    'pesan' => 'Data Pengembangan Diri Berhasil di Update.',
                    'data' => $apdet
                ]);
            }
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Terjadi Kesalahan.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function updateDataStaff(Request $request, $nidn_dosen)
    {
        try {
            $data = $request->all();
            $apdet = DataStaff::find($nidn_dosen);

            if ($apdet) {
                $apdet->update($data);

                return response()->json([
                    'pesan' => 'Data Staff Berhasil di Update.',
                    'data' => $data
                ], 200);
            } else {
                return response()->json([
                    'pesan' => 'Data Staff Gagal di Update.',
                    'data' => $data
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'pesan' => 'Terjadi Kesalahan',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function getData($nidn_dosen)
    {
        try {
            $get = DataDiriDosen::find($nidn_dosen);

            if ($get) {
                $getData = DataDiriDosen::where('datas_diri_dosen.nidn_dosen', '=', $nidn_dosen)
                    ->with(
                        'datas_pendidikan_dosen',
                        'datas_prodi_dosen',
                        'datas_jabatan_dosen',
                        'datas_pengembangan_diri_dosen',
                        'datas_staf_dosen'
                    )->first();

                return response()->json([
                    'data' => $getData
                ], 200);
            } else {
                return response()->json([
                    'data' => null
                ], 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e->getMessage()
            ], 500);
        }
    }

    // Admin
    public function getAllData(Request $request)
    {
        $limit = $request->input('limit', 5);
        try {
            $data = DataDiriDosen::with(
                'datas_pendidikan_dosen',
                'datas_prodi_dosen',
                'datas_jabatan_dosen',
                'datas_pengembangan_diri_dosen',
                'datas_staf_dosen'
            )->paginate($limit);

            if ($data) {
                return response()->json($data, 200);
                // return $data;
            } else {
                return response()->json($data, 401);
            }
        } catch (\Exception $e) {
            return response()->json([
                'data' => $e->getMessage()
            ]);
        }
    }

    public function hapusData($nidn_dosen)
    {
        DB::transaction(function () use ($nidn_dosen) {
            DB::table('datas_diri_dosen')->where('nidn_dosen', $nidn_dosen)->delete();
            DB::table('datas_pendidikan_dosen')->where('nidn_dosen', $nidn_dosen)->delete();
            DB::table('datas_prodi_dosen')->where('nidn_dosen', $nidn_dosen)->delete();
            DB::table('datas_jabatan_dosen')->where('nidn_dosen', $nidn_dosen)->delete();
            DB::table('datas_pengembangan_diri_dosen')->where('nidn_dosen', $nidn_dosen)->delete();
            DB::table('datas_staf_dosen')->where('nidn_dosen', $nidn_dosen)->delete();
        });

        return response()->json([
            'pesan' => 'Sukses',
        ]);
    }

    public function inputNIDN(Request $request)
    {
        $data = $request->all();
        DataNIDN::create($data);

        return response()->json([
            'pesan' => 'Input NIDN/NIK Berhasil.',
            'data' => $data
        ]);
    }

    // public function hapusData($nidn_dosen)
    // {
    //     try {
    //         $get = DataDiriDosen::find($nidn_dosen);

    //         if ($get) {
    //             $data = DataDiriDosen::where('datas_pendidikan_dosen', '=', $nidn_dosen)
    //                 ->with(
    //                     'datas_prodi_dosen',
    //                     'datas_jabatan_dosen',
    //                     'datas_pengembangan_diri_dosen',
    //                     'datas_staf_dosen'
    //                 )->first();
    //             return response()->json([
    //                 'pesan' => 'Berhasil Dihapus.',
    //                 'data' => $data
    //             ], 200);
    //             // return $data;
    //         } else {
    //             return response()->json([
    //                 'pesan' => 'Gagal Terhapus'
    //             ], 401);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'data' => $e->getMessage()
    //         ]);
    //     }
    // }
}
