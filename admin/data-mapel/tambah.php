<form id="form_tambah">
    <div class="form-group">
        <label>Kode:</label>
        <input type="text" class="form-control" name="kode_mapel" placeholder="Masukan Kode Mata Pelajaran">
    </div>

    <div class="form-group">
        <label>Nama Mapel:</label>
        <input type="text" class="form-control" name="nama_mapel" placeholder="Masukan Nama Mapel">
    </div>

</form>

<button class="btn btn-primary btn-fill btn-wd" id="submit"  data-dismiss="modal" >Submit</button>

<script>
$('#submit').click(function(){
    var form = $('#form_tambah')[0];
    var data = new FormData(form);
    $.ajax({
        type	: 'POST',
        url	: "admin/data-mapel/simpan/tambah.php",
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

