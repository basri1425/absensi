<?php 
    $id_guru = $_POST["id_guru"];
    //Koneksi database
    include '../../config/database.php';
    //Menjalankan query
    $hasil=mysqli_query($kon,"select * from guru where id_guru='$id_guru'");
    $data = mysqli_fetch_array($hasil); 
?>

<form id="form_edit">
    <div class="form-group">
        <input type="hidden" class="form-control"  value="<?php echo $data['id_guru'];?>" name="id_guru" >
    </div>

    <div class="form-group">
        <input type="hidden" class="form-control"  value="<?php echo $data['nip'];?>" name="nip_sebelum" >
    </div>

    <div class="form-group">
        <label>NIP:</label>
        <input type="number" class="form-control"  value="<?php echo $data['nip'];?>" name="nip"  id="nip" placeholder="Masukan NIP">
        <br>
        <div id="get_ajax"></div>
    </div>

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" class="form-control" value="<?php echo $data['nama_guru'];?>" name="nama_guru" placeholder="Masukan Nama">
    </div>

    <div class="form-group">
        <label>Jenis Kelamin:</label>
        <select class="form-control" name="jk">
            <option <?php if($data['jk']=='L') echo "selected"; ?> value="L">Laki-laki</option>
            <option <?php if($data['jk']=='P') echo "selected"; ?>  value="P">Perempuan</option>
        </select>
    </div>
</form>

<button class="btn btn-primary btn-fill btn-wd" id="submit"  data-dismiss="modal" >Submit</button>

<script>
    $('#nip').bind('keyup', function () {
        var nip=$("#nip").val();
        $.ajax({
          url: 'admin/data-guru/cek-nip.php',
          method: 'POST',
          data:{nip:nip},
          success:function(data){
            $("#get_ajax").html(data);
          }
      }); 
    });
</script>


<script>
    $('#submit').click(function(){
        var form = $('#form_edit')[0];
        var data = new FormData(form);
        $.ajax({
            type	: 'POST',
            url	: "admin/data-guru/simpan/edit.php",
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

