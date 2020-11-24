<?php

class Peserta extends Controller {

    public function __construct()
    {
        if(!$_SESSION){   
            $this->redirect('Home', 'Index');
        }
        if(!$_SESSION['roll'] === 'peserta'){
            $this->redirect('Home', 'Index');
        }
        $this->userModel = $this->model('User_model');
    }
    public function index() {
        if(!$_SESSION){   
            $this->redirect('Home', 'Index');
        }
        if(!$_SESSION['roll'] === 'peserta'){
            $this->redirect('Home', 'Index');
        }
        $id_user = $_SESSION['id_user'];
        $cekInfoTeam = $this->userModel->cekInfoTeam($id_user);
        if(!$cekInfoTeam){
            $this->view('common/header_peserta');
            $this->view('peserta/index');
            $this->view('common/footer_peserta');   
        }else{
            $this->view('common/header_peserta');
            $this->view('peserta/infoTeam', false, array(
                'namaTim' => $cekInfoTeam[0],
                'anggota1' => $cekInfoTeam[0],
                'anggota2' => $cekInfoTeam[0],
                'anggota3' => $cekInfoTeam[0],
                'departemen' => $cekInfoTeam[0]
            ));
            $this->view('common/footer_peserta');   
        }
    }

    public function createInfoTeam(){
        $id_user = $_SESSION['id_user'];
        $team = [
            'namaTeam'      => $this->input('namaTeam'),
            'anggota1'          => $this->input('anggota1'),
            'anggota2'         => $this->input('anggota2'),
            'anggota3'      => $this->input('anggota3'),
            'departemen'         => $this->input('departemen')
        ];
        if(!isset($team)){
            echo "<script>alert('Mohon teliti kembali, pastikan terisi semua dengan benar');
                document.location='index'
                </script>";
        }else{
            $parsing = $this->userModel->createInfoTeam($team, $id_user);
            if($parsing){
                echo "<script>alert('Informasi Tim telah diupdate');
                document.location='index'
                </script>";
            }else{
                echo "<script>alert('Mohon teliti kembali, pastikan terisi semua dengan benar');
                document.location='index'
                </script>";
            }
        }

    }

    public function unggah(){
        if(!$_SESSION['roll'] === 'peserta'){
            $this->redirect('Home', 'Index');
        }

        $id_user = $_SESSION['id_user'];
        $judulPeserta = $this->userModel->getFilePeserta($id_user);
        if(!$judulPeserta){
            $this->view('common/header_peserta');
            $this->view('peserta/unggah');
            $this->view('common/footer_peserta');
        }else{
            //var_dump($judulPeserta);
            $this->view('common/header_peserta');
            $this->view('peserta/sudahUnggah', false, array(
                'file' => $judulPeserta[0],
                'lokasi' => $judulPeserta[0],
                'kapan' => $judulPeserta[0],
                'status' => $judulPeserta[0]
            ));
            $this->view('common/footer_peserta');
        }   
    }

    public function mengunggah(){
        if(!$_SESSION['roll'] === 'peserta'){
            $this->redirect('Home', 'Index');
        }

        if(isset($_POST['submit'])){
            // ekstensi file batasan
            $judul = $_POST['judul'];
            $id_peserta = $_SESSION['id_user'];
            $ekstensiBoleh = array('pdf', 'docx', 'doc');
            $userfile = $_FILES['userfile']['name']; // utk mendapatkan nama file yang di upload
            //nama_file.jpg
            $x = explode('.', $userfile);
            $ekstensi = strtolower(end($x));
            $size = $_FILES['userfile']['size']; // utk mendapatkan ukuran file yang di upload
            $file_temp = $_FILES['userfile']['tmp_name'];// utk mendapatkan file sementara yg di upload

            // uji jika ekstensi file yg diupload sesuai
            if(in_array($ekstensi, $ekstensiBoleh) === true){
                // ijinkan upload file
                // cek ukuran file dibawah 10mb = 10240
                if($size < 1044070){
                    //jka ukuran sesuai
                    // pindahkan file uploadan ke folder baru
                    move_uploaded_file($file_temp,'../public/kti/'. $userfile);
                   //var_dump($saveTo);
                   //die();
                    //simpan data ke database
                    //$save = mysqli_query()
                    $simpan = $this->userModel->saveFile($userfile, $judul, $id_peserta);
                    if($simpan){
                        echo "<script>alert('FILE BERHASIL DI UPLOAD');
                document.location='unggah'
                </script>";
                    }else{
                        echo "<script>alert('GAGAL UPLOAD FILE');
                document.location='unggah'
                </script>";
                    }
                }else{
                    // jika tidak
                    echo "<script>alert('UKURAN FILE TERLALU BESAR, MAX 15 MB');
                document.location='unggah'
                </script>";
                }
            }else{
                // ekstensi file yg diupload tak sesuai
                echo "<script>alert('EKSTENSI FILE YANG DIUPLOAD TIDAK DIIZINKAN');
                document.location='unggah'
                </script>";
            }
        }
    }

    public function unduhSertif(){
        if(!$_SESSION){   
            $this->redirect('Home', 'Index');
        }
        if(!$_SESSION['roll'] === 'peserta'){
            $this->redirect('Home', 'Index');
        }

        $this->view('common/header_peserta');
        $this->view('peserta/sertif');
        $this->view('common/footer_peserta');
    }
}