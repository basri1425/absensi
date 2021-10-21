<?php 
    $id_siswa = $_POST["id_siswa"];
    //Koneksi database
    include '../../config/database.php';
    //Menjalankan query
    $hasil=mysqli_query($kon,"select * from siswa where id_siswa='$id_siswa'");
    $data = mysqli_fetch_array($hasil); 
?>

<form id="form_edit">
    <div class="form-group">
        <input type="hidden" class="form-control"  value="<?php echo $data['id_siswa'];?>" name="id_siswa" >
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control"  value="<?php echo $data['nisn'];?>" name="nisn_sebelum" >
    </div>

    <div class="form-group">
        <label>NISN:</label>
        <input type="number" class="form-control"  value="<?php echo $data['nisn'];?>" name="nisn" placeholder="Masukan NISN">
    </div>

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" class="form-control" value="<?php echo $data['nama_siswa'];?>" name="nama_siswa" placeholder="Masukan Nama">
    </div>

    <div class="form-group">
        <label>Jenis Kelamin:</label>
        <select class="form-control" name="jk">
            <option <?php if($data['jk']=='L') echo "selected"; ?> value="L">Laki-laki</option>
            <option <?php if($data['jk']=='P') echo "selected"; ?>  value="P">Perempuan</option>
        </select>
    </div>

    <div class="form-group">
        <label>Kelas:</label>
        <select class="form-control" name="kelas">
        <?php
            include '../../config/database.php';
            $sql="select * from kelas order by kode_kelas asc";
            $hasil=mysqli_query($kon,$sql);
            while ($row = mysqli_fetch_array($hasil)):
        ?>
            <option <?php if ($data['kelas']==$row['kode_kelas']) echo "selected"; ?> value="<?php echo $row['kode_kelas']; ?>"><?php echo $row['nama_kelas']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>



</form>

<button class="btn btn-primary btn-fill btn-wd" id="submit"  data-dismiss="modal" >Submit</button>

<script>
    $('#submit').click(function(){
        var form = $('#form_edit')[0];
        var data = new FormData(form);
        $.ajax({
            type	: 'POST',
            url	: "admin/data-siswa/simpan/edit.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success	: function(data){
                tabel_siswa();
            }
        });
    });
</script>

