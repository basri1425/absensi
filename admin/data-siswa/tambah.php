<form id="form_tambah">


    <div class="form-group">
        <label>NISN:</label>
        <input type="number" class="form-control" name="nisn" placeholder="Masukan NISN">
    </div>

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" class="form-control" name="nama_siswa" placeholder="Masukan Nama">
    </div>

    <div class="form-group">
        <label>Jenis Kelamin:</label>
        <select class="form-control" name="jk">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
        </select>
    </div>

    <div class="form-group">
        <label>Kelas:</label>
        <select class="form-control" name="kelas">
        <?php
            include '../../config/database.php';
            $sql="select * from kelas order by kode_kelas asc";
            $hasil=mysqli_query($kon,$sql);
            while ($data = mysqli_fetch_array($hasil)):
        ?>
            <option value="<?php echo $data['kode_kelas']; ?>"><?php echo $data['nama_kelas']; ?></option>
            <?php endwhile; ?>
        </select>
    </div>


</form>

<button class="btn btn-primary btn-fill btn-wd" id="submit"  data-dismiss="modal" >Submit</button>

<script>
$('#submit').click(function(){
    var form = $('#form_tambah')[0];
    var data = new FormData(form);
    $.ajax({
        type	: 'POST',
        url	: "admin/data-siswa/simpan/tambah.php",
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

