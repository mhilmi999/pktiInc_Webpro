<?php

class Panitia extends Controller
{
    public function __construct()
    {
        if(!$_SESSION){   
            $this->redirect('Home', 'Index');
        }
        if(!$_SESSION['roll'] === 'panitia'){
            $this->redirect('Home', 'Index');
        }
        $this->userModel = $this->model('User_model');   
    }
    
    public function index()
    {
        if(!$_SESSION){   
        $this->redirect('Home', 'Index');
        }
        if(!$_SESSION['roll'] === 'panitia'){
        $this->redirect('Home', 'Index');
        }
        $this->view('common/header_panitia');
        $this->view('panitia/index');
        $this->view('common/footer_panitia');
    }

    public function ktiMasuk(){
        if(!$_SESSION){   
        $this->redirect('Home', 'Index');
        }
        if(!$_SESSION['roll'] === 'panitia'){
        $this->redirect('Home', 'Index');
        }

        $data = $this->userModel->baruMasukFilePeserta();

        $this->view('common/header_panitia');
        $this->view('panitia/baruMasuk', false, array(
            'data' => $data
        ));
        $this->view('common/footer_panitia');
    }

    public function cekKti($id_task = NULL){
        $status = 2;
        $this->userModel->updateCekStatusFile($id_task, $status);
        $this->redirect("Panitia", "ktiMasuk");
    }

    public function ktiPeriksa(){
        if(!$_SESSION){   
        $this->redirect('Home', 'Index');
        }
        if(!$_SESSION['roll'] === 'panitia'){
        $this->redirect('Home', 'Index');
        }

        $data = $this->userModel->cekFilePeserta();

        $this->view('common/header_panitia');
        $this->view('panitia/periksaKTI', false, array(
            'data' => $data
        ));
        $this->view('common/footer_panitia');
    }

    public function selesaiKti($id_task = NULL){
        $status = 3;
        $this->userModel->updateSelesaiStatusFile($id_task, $status);
        $this->redirect("Panitia", "ktiSelesai");
    }


    public function ktiSelesai(){
        if(!$_SESSION){   
        $this->redirect('Home', 'Index');
        }
        if(!$_SESSION['roll'] === 'panitia'){
        $this->redirect('Home', 'Index');
        }

        $data = $this->userModel->selesaiPeriksaFilePeserta();

        $this->view('common/header_panitia');
        $this->view('panitia/selesaiKTI', false, array(
            'data' => $data
        ));
        $this->view('common/footer_panitia');
    }

    public function buatSertif($nama = NULL, $id_peserta = NULL){
        if(!$_SESSION){   
        $this->redirect('Home', 'Index');
        }
        if(!$_SESSION['roll'] === 'panitia'){
        $this->redirect('Home', 'Index');
        }
      //var_dump($nama, $id_peserta);
        $this->view('common/header_panitia');
        $this->view('panitia/buatSertif',false,array(
            "nama" => $nama,
            "id_peserta" => $id_peserta
        ));
        $this->view('common/footer_panitia');
    }

    public function kirimSertif(){
        if(!$_SESSION){   
            $this->redirect('Home', 'Index');
            }
            if(!$_SESSION['roll'] === 'panitia'){
            $this->redirect('Home', 'Index');
            }

        if(isset($_POST['submit'])){
            // ekstensi file batasan
            $id_peserta = $_POST['id_peserta'];
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
                    move_uploaded_file($file_temp,'../public/sertif/'. $userfile);
                    $status = 4;
                    //simpan data ke database
                    $simpan = $this->userModel->kirimSertifPeserta($id_peserta, $userfile); 
                    if($simpan){
                        $this->userModel->updateStatusKirimSertif($id_peserta, $status);
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
                    echo "<script>alert('UKURAN FILE TERLALU BESAR');
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

    public function selesaiSertif(){
        if(!$_SESSION){   
        $this->redirect('Home', 'Index');
        }
        if(!$_SESSION['roll'] === 'panitia'){
        $this->redirect('Home', 'Index');
        }
        $selesaiKirim = $this->userModel->telahKirimSertif();

        if($selesaiKirim){
            $this->view('common/header_panitia');
            $this->view('panitia/selesaiSertif', false, array(
                "data" => $selesaiKirim
            ));
            $this->view('common/footer_panitia');
        }
    }
}
