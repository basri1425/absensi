<?php 
    $id_mapel = $_POST["id_mapel"];
    //Koneksi database
    include '../../config/database.php';
    //Menjalankan query
    $hasil=mysqli_query($kon,"select * from mapel where id_mapel='$id_mapel'");
    $data = mysqli_fetch_array($hasil); 
?>

<form id="form_edit">
    <div class="form-group">
        <input type="hidden" class="form-control"  value="<?php echo $data['id_mapel'];?>" name="id_mapel" >
    </div>
    <div class="form-group">
        <input type="hidden" class="form-control"  value="<?php echo $data['kode_mapel'];?>" name="kode_mapel_sebelum" >
    </div>

    <div class="form-group">
        <label>Kode:</label>
        <input type="text" class="form-control"  value="<?php echo $data['kode_mapel'];?>" name="kode_mapel" placeholder="Masukan Kode Mapel">
    </div>

    <div class="form-group">
        <label>Nama Mapel:</label>
        <input type="text" class="form-control" value="<?php echo $data['nama_mapel'];?>" name="nama_mapel" placeholder="Masukan Nama Mapel">
    </div>

</form>

<button class="btn btn-primary btn-fill btn-wd" id="submit"  data-dismiss="modal" >Submit</button>

<script>
    $('#submit').click(function(){
        var form = $('#form_edit')[0];
        var data = new FormData(form);
        $.ajax({
            type	: 'POST',
            url	: "admin/data-mapel/simpan/edit.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success	: function(data){
                tabel_mapel();
            }
        });
    });
</script>

