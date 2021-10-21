<br>
   
<div class="alert alert-info">
Saat Guru pertama kali ditambahkan, Gunakan password default <strong>12345</strong> untuk login ke aplikasi.
</div>
<script>
    $('title').text('DATA GURU');
</script>
<div class="content table-responsive">
    <table class="table table-hover table-striped" id="tabel_guru">
        <thead>
            <th>No</th>
            <th>NIP</th>
            <th width="60%">Nama</th>
            <th>JK</th>
            <th>Wali Kelas</th>
            <th>Aksi</th>
        </thead>
        <tbody>
        <?php
            // include database
            include '../../config/database.php';

            $sql="select * from guru order by id_guru asc";
            $hasil=mysqli_query($kon,$sql);
            $no=0;
            //Menampilkan data dengan perulangan while
            while ($data = mysqli_fetch_array($hasil)):
            $no++;
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data['nip'];?></td>
            <td><?php echo $data['nama_guru'];?></td>
            <td><?php echo $data['jk'];?></td>
            <td><?php echo $data['wali_kelas'];?></td>
            <td>
                <button class="wali_kelas btn btn-success btn-fill"  id_guru="<?php echo $data['id_guru'];?>"  id="Wali Kelas" ><i class="nc-icon nc-settings-tool-66"></i></button> &nbsp;
                <button class="edit btn btn-warning btn-fill"  id_guru="<?php echo $data['id_guru'];?>"  id="edit" ><i class="nc-icon nc-tag-content"></i></button> &nbsp;
                <button class="hapus btn btn-danger btn-fill" nip="<?php echo $data['nip'];?>" id_guru="<?php echo $data['id_guru'];?>"  nama="<?php echo $data['nama_guru'];?>" ><i class="nc-icon nc-simple-remove"></i></button>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#tabel_guru').DataTable( {
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
$('.wali_kelas').on('click',function(){
    var id_guru = $(this).attr("id_guru");
    $.ajax({
        url: 'admin/data-guru/wali-kelas.php',
        method: 'post',
        data: {id_guru:id_guru},
        success:function(data){
            $('#tampil_form').html(data);  
        }
    });
    // Membuka modal
    $('#myModal1').modal('show');
});

$('.edit').on('click',function(){
    var id_guru = $(this).attr("id_guru");
    $.ajax({
        url: 'admin/data-guru/edit.php',
        method: 'post',
        data: {id_guru:id_guru},
        success:function(data){
            $('#tampil_form').html(data);  
        }
    });
    // Membuka modal
    $('#myModal1').modal('show');
});


$('.hapus').on('click',function(){
    var id_guru = $(this).attr("id_guru");
    var nip = $(this).attr("nip");
    var nama = $(this).attr("nama");
    $.ajax({
        url: 'admin/data-guru/hapus.php',
        method: 'post',
        data: {id_guru:id_guru,nip:nip,nama:nama},
        success:function(data){
            $('#tampil_form').html(data);  
        }
    });
    // Membuka modal
    $('#myModal1').modal('show');
});

</script>