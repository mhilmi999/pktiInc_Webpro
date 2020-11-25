<?php

class User_model extends Database {
    private $nama = 'Hilmi';

    public function getUser()
    {
        return $this->nama;
    }

    public function __construct()
    {
        $this->db = new Database;
    }
    
    public function saveFile($userfile, $judul, $id_user){

        $q = "INSERT INTO task (judul, file_location, id_peserta) VALUES (:judul, :file_location, :id_peserta)";
        $this->db->query($q);

        $this->db->bind(':judul', $judul);
        $this->db->bind(':file_location', $userfile);
        $this->db->bind(':id_peserta', $id_user);
        $this->db->execute();
        return $this->db->rowCount();

    }

    public function getFilePeserta($id_user){
        $this->db->query("SELECT judul,file_location,date_created, status FROM task WHERE id_peserta = :id_peserta");
        $this->db->bind(':id_peserta', $id_user);
        return $this->db->resultSet();
    }
    
    public function createInfoTeam($team,$id_user){
        $q = "INSERT INTO team (namaTeam, anggota1, anggota2, anggota3, departemen, id_anggota1) 
                VALUES (:namaTeam, :anggota1, :anggota2, :anggota3,:departemen,:id_anggota1)";
        $this->db->query($q);

        $this->db->bind(':namaTeam', $team['namaTeam']);
        $this->db->bind(':anggota1', $team['anggota1']);
        $this->db->bind(':anggota2', $team['anggota2']);
        $this->db->bind(':anggota3', $team['anggota3']);
        $this->db->bind(':departemen', $team['departemen']);
        $this->db->bind(':id_anggota1', $id_user);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cekInfoTeam($id_user){
        $this->db->query("SELECT * FROM team WHERE id_anggota1 = :id_anggota1");
        $this->db->bind(':id_anggota1', $id_user);
        return $this->db->resultSet();
    }

    public function baruMasukFilePeserta(){
        $this->db->query("SELECT t1.*, t2.nama FROM task t1 JOIN users t2 ON t1.id_peserta = t2.id_user AND status = 1");
        return $this->db->resultSet();
        
    }

    public function updateCekStatusFile($id_task, $status){
        $this->db->query("UPDATE task SET status = :status WHERE id_task = :id_task");
        $this->db->bind(':status', $status);
        $this->db->bind('id_task', $id_task);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function cekFilePeserta(){
        $this->db->query("SELECT t1.*, t2.nama FROM task t1 JOIN users t2 ON t1.id_peserta = t2.id_user AND status = 2");
        return $this->db->resultSet();
        
    }

    public function updateSelesaiStatusFile($id_task, $status){
        $this->db->query("UPDATE task SET status = :status WHERE id_task = :id_task");
        $this->db->bind(':status', $status);
        $this->db->bind('id_task', $id_task);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function selesaiPeriksaFilePeserta(){
        $this->db->query("SELECT t1.*, t2.nama FROM task t1 JOIN users t2 ON t1.id_peserta = t2.id_user AND status = 3");
        return $this->db->resultSet();
        
    }

    public function kirimSertifPeserta($id_peserta, $userfile){
        $this->db->query("UPDATE task JOIN users ON id_peserta = :id_peserta SET file_complete = :file_complete");
        $this->db->bind(':id_peserta', $id_peserta);
        $this->db->bind(':file_complete', $userfile);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function updatestatusKirimSertif($id_peserta, $status){
        $this->db->query("UPDATE task JOIN users ON id_peserta = :id_peserta SET status = :status");
        $this->db->bind(':id_peserta', $id_peserta);
        $this->db->bind(':status', $status);
        $this->db->execute();
        return $this->db->rowCount();
    }

    public function telahKirimSertif(){
        $this->db->query("SELECT t1.*, t2.nama FROM task t1 JOIN users t2 ON t1.id_peserta = t2.id_user AND status = 4");
        return $this->db->resultSet();
    }

    public function tampilSertifPesertaku($id_user){
        $this->db->query("SELECT t1.*, t2.nama, t2.id_user FROM task t1 JOIN users t2 ON t1.id_peserta= t2.id_user WHERE t1.status = 4 AND t2.id_user = :id_user");
        $this->db->bind(':id_user', $id_user);
        return $this->db->resultSet();
    }
}
