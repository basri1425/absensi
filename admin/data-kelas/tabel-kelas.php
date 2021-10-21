<br>
<script>
    $('title').text('DATA KELAS');
</script>
<div class="content table-responsive">
    <table class="table table-hover table-striped" id="tabel_kelas">
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

            $sql="select * from kelas order by kode_kelas asc";
            $hasil=mysqli_query($kon,$sql);
            $no=0;
            //Menampilkan data dengan perulangan while
            while ($data = mysqli_fetch_array($hasil)):
            $no++;
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data['kode_kelas'];?></td>
            <td><?php echo $data['nama_kelas'];?></td>
            <td  width="5%"> 
                <button class="edit btn btn-warning btn-fill"  id_kelas="<?php echo $data['id_kelas'];?>"  id="edit" ><i class="nc-icon nc-tag-content"></i></button> &nbsp;
                <button class="hapus btn btn-danger btn-fill" id_kelas="<?php echo $data['id_kelas'];?>"  nama="<?php echo $data['nama_kelas'];?>" ><i class="nc-icon nc-simple-remove"></i></button>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#tabel_kelas').DataTable( {
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
    var id_kelas = $(this).attr("id_kelas");
    $.ajax({
        url: 'admin/data-kelas/edit.php',
        method: 'post',
        data: {id_kelas:id_kelas},
        success:function(data){
            $('#tampil_form').html(data);  
        }
    });
    // Membuka modal
    $('#myModal1').modal('show');
});

$('.hapus').on('click',function(){
    var nama = $(this).attr("nama");
    var agree=confirm("Adakah Anda yakin ingin menghapus kelas  "+nama+" ?");
    if (!agree){
        return false;
    } else {
        var id_kelas = $(this).attr("id_kelas");
        $.ajax({
            url: 'admin/data-kelas/simpan/hapus.php',
            method: 'post',
            data: {id_kelas:id_kelas},
            success:function(data){
                tabel_kelas();
            }
        });
    }
});
</script>