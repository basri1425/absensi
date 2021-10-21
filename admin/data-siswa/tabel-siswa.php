<br>
<script>
    $('title').text('DATA SISWA KELAS <?php echo $_POST['kelas']; ?>');
</script>
<div class="content table-responsive">
    <table class="table table-hover table-striped" id="tabel_siswa">
        <thead>
            <th>No</th>
            <th>NISN</th>
            <th width="60%">Nama</th>
            <th>JK</th>
            <th>Kelas</th>
            <th>Aksi</th>
        </thead>
        <tbody>
        <?php
            // include database
            include '../../config/database.php';
            $kelas=$_POST['kelas'];
            $sql="select * from siswa where kelas='".$kelas."' order by id_siswa asc";
            $hasil=mysqli_query($kon,$sql);
            $no=0;
            //Menampilkan data dengan perulangan while
            while ($data = mysqli_fetch_array($hasil)):
            $no++;
        ?>
        <tr>
            <td><?php echo $no; ?></td>
            <td><?php echo $data['nisn'];?></td>
            <td><?php echo $data['nama_siswa'];?></td>
            <td><?php echo $data['jk'];?></td>
            <td><?php echo $data['kelas'];?></td>
            <td width="5%"> 
                <button class="edit btn btn-warning btn-fill"  id_siswa="<?php echo $data['id_siswa'];?>"  id="edit" ><i class="nc-icon nc-tag-content"></i></button> &nbsp;
                <button class="hapus btn btn-danger btn-fill" id_siswa="<?php echo $data['id_siswa'];?>"  nama="<?php echo $data['nama_siswa'];?>" ><i class="nc-icon nc-simple-remove"></i></button>
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>



<script>
$('.edit').on('click',function(){
    var id_siswa = $(this).attr("id_siswa");
    $.ajax({
        url: 'admin/data-siswa/edit.php',
        method: 'post',
        data: {id_siswa:id_siswa},
        success:function(data){
            $('#tampil_form').html(data);  
        }
    });
    // Membuka modal
    $('#myModal1').modal('show');
});

$('.hapus').on('click',function(){
    var nama = $(this).attr("nama");
    var agree=confirm("Adakah Anda yakin ingin menghapus siswa  "+nama+" ?");
    if (!agree){
        return false;
    } else {
        var id_siswa = $(this).attr("id_siswa");
        $.ajax({
            url: 'admin/data-siswa/simpan/hapus.php',
            method: 'post',
            data: {id_siswa:id_siswa},
            success:function(data){
                tabel_siswa();
            }
        });
    }
});
</script>