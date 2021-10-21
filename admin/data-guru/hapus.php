


    <p>Apakah anda yakin ingin menghapus Guru <strong><?php echo $_POST['nama'];?>?</strong></p>
    <form id="form_hapus_guru">
        <div class="form-group">
            <input type="hidden" class="form-control"  value="<?php echo $_POST['id_guru'];?>" name="id_guru" >
        </div>
        <button class="btn btn-warning btn-fill btn-wd" id="hapus_guru" name="hapus_guru" data-dismiss="modal" >Hanya hapus guru</button>
    </form>
    <form id="form_hapus_semua">
        <div class="form-group">
            <input type="hidden" class="form-control"  value="<?php echo $_POST['nip'];?>" name="nip" >
        </div>
        <button class="btn btn-danger btn-fill btn-wd" id="hapus_semua" name="hapus_semua" data-dismiss="modal" >Hapus beserta data absensi</button>
    </form>
    

    <h4>Keterangan</h4>

    <p><strong>Hanya hapus guru</strong> artinya hanya data guru yang dihapus, Sedangkan data absensi yang pernah diinput tidak akan dihapus.</p>

    <p><strong>Hapus beserta data absensi</strong> artinya seluruh data baik data Guru dan data absensi yang diinput akan dihapus.</p>

<script>
    $('#hapus_guru').click(function(){
        var agree=confirm("Adakah Anda yakin?");
        if (!agree){
            return false;
        }else {
            var form = $('#form_hapus_guru')[0];
            var data = new FormData(form);
            $.ajax({
                type	: 'POST',
                url	: "admin/data-guru/simpan/hapus.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success	: function(data){
                    tabel_guru();
                }
            });
        }

    });
    $('#hapus_semua').click(function(){
        var agree=confirm("Adakah Anda yakin?");
        if (!agree){
            return false;
        }else {
            var form = $('#form_hapus_semua')[0];
            var data = new FormData(form);
            $.ajax({
                type	: 'POST',
                url	: "admin/data-guru/simpan/hapus.php",
                data: data,
                processData: false,
                contentType: false,
                cache: false,
                success	: function(data){
                    tabel_guru();
                }
            });
        }
    });
</script>

