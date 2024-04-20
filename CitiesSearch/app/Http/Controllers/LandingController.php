<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpParser\Node\Stmt\Foreach_;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class LandingController extends Controller
{
    public function search(Request $request)
    {
        // $category = Input::get('category', 'default category');
        $query = $request->input('q');
        $rank = $request->input('rank');
        $filter = $request->input('filter');
        $filter = explode(",", $filter);

        $process = new Process(array_merge(['C:\Users\ASUS\OneDrive\Documents\citiesSearch\.venv\Scripts\python.exe', 'query.py', 'citiesDB', $rank, $query], $filter));
        $process->run();

        // executes after the command finishes
        if (!$process->isSuccessful()) {
            throw new ProcessFailedException($process);
        }

        $list_data = array_filter(explode("\n",$process->getOutput()));
        
        $data = array();

        foreach ($list_data as $dunia) {
            $dataj =  json_decode($dunia, true);
            $zona_waktu = '';
            foreach($dataj['zona_waktu'] as $zona) {
                $zona_waktu .= '• '.$zona['zoneName'].' - '.$zona['gmtOffsetName'].' '.$zona['tzName'].' ('.$zona['abbreviation'].')<br>';
            }
            array_push($data, '
            <div class="col-3">
                <div class="card mb-4" style="background-color: #393838;">
                    <h5 class="card-header text-white">'.$dataj['nama_negara'].'</h5>
                    <img style="width: 100px; height: 100px;" src="https://flagsapi.com/'.$dataj['singkatan_negara'].'/flat/64.png" class="card-img-top  mx-auto d-block" alt="bendera">
                    <div class="card-body">
                        <h6 class="card-title"><a href="https://www.google.com/search?q='.$dataj["nama_kota"]. '+city" class="text-light" target="_blank"><b>'.$dataj['nama_kota'].'</b></a></h6>
                        <p class="card-text text-white">
                            <a href="https://www.google.com/maps/@'.$dataj["latKota"].','.$dataj["longKota"].',20000m/data=!3m1!1e3?entry=ttu" target="_blank" >Klik untuk melihat menggunakan Maps!</a>
                        </p>
                    </div>
                    <div class="card-footer text-body-secondary">
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalWilayah">
                            Detail Wilayah
                        </button>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNegara">
                            Detail Negara
                        </button>
                        
                        <!-- Modal Negara -->
                        <div class="modal fade" id="modalNegara" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detil Negara</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Nama Negara: '.$dataj['nama_negara'].' ('.$dataj['singkatan_negara'].')<br>
                                        Nomor Telepon: +'.$dataj['noTelp'].'<br>
                                        Ibukota: '.$dataj['ibukota'].'<br>
                                        Kebangsaan: '.$dataj['kebangsaan'].'<br>
                                        Bahasa: '.$dataj['bahasa'].'<br>
                                        Mata Uang: '.$dataj['nama_mata_uang'].' ('.$dataj['mata_uang'].' = '.$dataj['simbol_mata_uang'].')<br>
                                        Benua: '.$dataj['benua'].'<br>
                                        Sub-Benua: '.$dataj['sub_benua'].'<br>
                                        Maps: <a href="https://www.google.com/maps/@'.$dataj["latNegara"].','.$dataj["longNegara"].',2000000m/data=!3m1!1e3?entry=ttu" target="_blank" >Klik untuk melihat menggunakan Maps!</a>
                                        <br>
                                        <br>
                                        Zona Waktu:<br>'.$zona_waktu.'<br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Modal Wilayah -->
                        <div class="modal fade" id="modalWilayah" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Detil Wilayah</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Nama Wilayah/Distrik: '.$dataj['nama_wilayah'].' ('.$dataj['kode_wilayah'].')<br>
                                        Tipe Wilayah: '.$dataj['tipe_wilayah'].'<br>
                                        Maps: <a href="https://www.google.com/maps/@'.$dataj["latWilayah"].','.$dataj["longWilayah"].',200000m/data=!3m1!1e3?entry=ttu" target="_blank" >Klik untuk melihat menggunakan Maps!</a>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            ');
        }
        echo json_encode($data);
    }
}