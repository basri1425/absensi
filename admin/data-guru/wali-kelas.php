<?php 
    $id_guru = $_POST["id_guru"];
    //Koneksi database
    include '../../config/database.php';
    //Menjalankan query
    $hasil=mysqli_query($kon,"select * from guru where id_guru='$id_guru'");
    $data = mysqli_fetch_array($hasil);

    if (isset($data['wali_kelas'])){
        $wali_kelas=$data['wali_kelas'];
    }else {
        $wali_kelas=null;
    }
?>

<form id="form">
    Apakah anda ingin menetapkan Guru ini sebagai wali kelas?<br>
    <div class="form-check-inline">
    <label class="form-check-label">
        <input type="radio" id="ya" <?php if ($data['wali_kelas']!='') echo "checked"; ?> class="form-check-input" value="ya" name="pilih">Ya
    </label>
    </div>
    <div class="form-check-inline">
    <label class="form-check-label">
        <input type="radio" class="form-check-input" value="tidak" name="pilih">Tidak
    </label>
    </div>
    <hr>
    <div id="pilih_kelas">
        <div class="form-group">
            <label>Pilih Kelas:</label>
            <select class="form-control" name="kelas">
                <?php
                    include '../../config/database.php';
                    $sql="select * from kelas order by kode_kelas asc";
                    $hasil=mysqli_query($kon,$sql);
                    while ($row = mysqli_fetch_array($hasil)):
                ?>
                <option <?php if ($wali_kelas==$row['kode_kelas']) echo "selected"; ?> value="<?php echo $row['kode_kelas']; ?>"><?php echo $row['nama_kelas']; ?></option>
                <?php endwhile; ?>
            </select>
        </div>
    </div>
    <button class="btn btn-primary btn-fill btn-wd" id="submit"  data-dismiss="modal" >Submit</button>

    <div class="form-group">
        <input type="hidden" class="form-control"  value="<?php echo $_POST["id_guru"]; ?>" name="id_guru" >
    </div>



</form>
<script>
    <?php if ($data['wali_kelas']==''): ?>
    $("#pilih_kelas").hide();
    <?php endif; ?>

    $( "input" ).on( "click", function() {
        var pilih =  $( "input:checked" ).val();
        if (pilih=='ya'){
            $("#pilih_kelas").show(100);
        }else {
            $("#pilih_kelas").hide(100);
        }
    });



</script>

<script>
    $('#submit').click(function(){
        var form = $('#form')[0];
        var data = new FormData(form);
        $.ajax({
            type	: 'POST',
            url	: "admin/data-guru/simpan/wali-kelas.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success	: function(data){
                tabel_guru();
            }
        });
    });
</script>



