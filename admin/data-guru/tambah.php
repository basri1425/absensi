<form id="form_tambah">
    <div class="form-group">
        <label>NIP:</label>
        <input type="number" class="form-control" name="nip" id="nip" placeholder="Masukan NIP">
        <br>
        <div id="get_ajax"></div>
    </div>

    <div class="form-group">
        <label>Nama:</label>
        <input type="text" class="form-control" name="nama_guru" placeholder="Masukan Nama">
    </div>

    <div class="form-group">
        <label>Jenis Kelamin:</label>
        <select class="form-control" name="jk">
            <option value="L">Laki-laki</option>
            <option value="P">Perempuan</option>
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
        var form = $('#form_tambah')[0];
        var data = new FormData(form);
        $.ajax({
            type	: 'POST',
            url	: "admin/data-guru/simpan/tambah.php",
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

