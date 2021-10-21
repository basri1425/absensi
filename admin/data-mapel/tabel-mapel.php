<br>
<script>
    $('title').text('DATA MATA PELAJARAN');
</script>
<div class="content table-responsive">
    <table class="table table-hover table-striped" id="tabel_mapel">
        <thead>
            <th>No</th>
            <th>Kode</th>
            <th width="60%">Nama</th>
            <th>Aksi</th>
        </thead>
        <tbody>
        <?php
            // include database
            include '../../config/database.php';

            $sql="select * from mapel order by id_mapel asc";
            $hasil=mysqli_query($kon,$sql);
            $no=0;
            //Menampilkan data dengan perulangan while
            while ($data = mysqli_fetch_array($hasil)):
            $no++;
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data['kode_mapel'];?></td>
            <td><?php echo $data['nama_mapel'];?></td>
            <td width="5%"> 
                <button class="edit btn btn-warning btn-fill"  id_mapel="<?php echo $data['id_mapel'];?>"  id="edit" ><i class="nc-icon nc-tag-content"></i></button> &nbsp;
                <button class="hapus btn btn-danger btn-fill" id_mapel="<?php echo $data['id_mapel'];?>"  nama="<?php echo $data['nama_mapel'];?>" ><i class="nc-icon nc-simple-remove"></i></button>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#tabel_mapel').DataTable( {
            "searching": false,
            "paging":   false,
            "ordering": false,
            "info":     true,
            dom: 'Bfrtip',
            buttons: ['excel']
        });
    });
</script>

<script>
$('.edit').on('click',function(){
    var id_mapel = $(this).attr("id_mapel");
    $.ajax({
        url: 'admin/data-mapel/edit.php',
        method: 'post',
        data: {id_mapel:id_mapel},
        success:function(data){
            $('#tampil_form').html(data);  
        }
    });
    // Membuka modal
    $('#myModal1').modal('show');
});

$('.hapus').on('click',function(){
    var nama = $(this).attr("nama");
    var agree=confirm("Adakah Anda yakin ingin menghapus mapel  "+nama+" ?");
    if (!agree){
        return false;
    } else {
        var id_mapel = $(this).attr("id_mapel");
        $.ajax({
            url: 'admin/data-mapel/simpan/hapus.php',
            method: 'post',
            data: {id_mapel:id_mapel},
            success:function(data){
                tabel_mapel();
            }
        });
    }
});
</script>