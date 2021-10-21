<div class="alert alert-info">
  Pada form isian Kode Kelas jangan menggunakan spasi
</div>

<form id="form_tambah">
    <div class="form-group">
        <label>Kode:</label>
        <input type="text" class="form-control" name="kode_kelas" placeholder="Masukan Kode Kelas">
    </div>

    <div class="form-group">
        <label>Nama Kelas:</label>
        <input type="text" class="form-control" name="nama_kelas" placeholder="Masukan Nama Kelas">
    </div>

</form>

<button class="btn btn-primary btn-fill btn-wd" id="submit"  data-dismiss="modal" >Submit</button>

<script>
$('#submit').click(function(){
    var form = $('#form_tambah')[0];
    var data = new FormData(form);
    $.ajax({
        type	: 'POST',
        url	: "admin/data-kelas/simpan/tambah.php",
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

