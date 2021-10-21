<?php 
    $id_kelas = $_POST["id_kelas"];
    //Koneksi database
    include '../../config/database.php';
    //Menjalankan query
    $hasil=mysqli_query($kon,"select * from kelas where id_kelas='$id_kelas'");
    $data = mysqli_fetch_array($hasil); 
?>
<div class="alert alert-info">
  Pada form isian Kode Kelas jangan menggunakan spasi
</div>

<form id="form_edit">
    <div class="form-group">
        <input type="hidden" class="form-control"  value="<?php echo $data['id_kelas'];?>" name="id_kelas" >
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control"  value="<?php echo $data['kode_kelas'];?>" name="kode_kelas_sebelum" >
    </div>

    <div class="form-group">
        <label>Kode Kelas:</label>
        <input type="text" class="form-control"  value="<?php echo $data['kode_kelas'];?>" name="kode_kelas" placeholder="Masukan Kode Kelas">
    </div>

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" class="form-control" value="<?php echo $data['nama_kelas'];?>" name="nama_kelas" placeholder="Masukan Nama">
    </div>

</form>

<button class="btn btn-primary btn-fill btn-wd" id="submit"  data-dismiss="modal" >Submit</button>

<script>
    $('#submit').click(function(){
        var form = $('#form_edit')[0];
        var data = new FormData(form);
        $.ajax({
            type	: 'POST',
            url	: "admin/data-kelas/simpan/edit.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success	: function(data){
                tabel_kelas();
            }
        });
    });
</script>

