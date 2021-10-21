<?php 
    include 'config/database.php';
    $id=addslashes(trim($_GET['id']));
    $sql="select * from pertemuan p where p.id_pertemuan='$id' limit 1";
    $hasil=mysqli_query($kon,$sql);
    $cek = mysqli_num_rows($hasil);

    if ($cek<=0){
        echo "<div class='alert alert-warning'> Data tidak ditemukan!</div>";
        exit;
    }
    $data = mysqli_fetch_array($hasil); 
?>

<form id="form_input_absensi">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header ">
                        <h4 class="card-title"> Edit Absensi</h4>
                    </div>
                    <div class="card-body table-full-width table-responsive">
                        <div class="col-sm-12">
                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Kelas:</label>
                                        <select class="form-control" name="kelas" id="kelas" disabled>
                                        <?php
                                            include 'config/database.php';
                                            $sql="select * from kelas order by id_kelas asc";
                                            $hasil=mysqli_query($kon,$sql);
                                            while ($row = mysqli_fetch_array($hasil)):
                                        ?>
                                        <option <?php if ($data['kelas']==$row['kode_kelas']) echo "selected"; ?> value="<?php echo $row['kode_kelas']; ?>"><?php echo $row['nama_kelas']; ?></option>
                                        <?php endwhile; ?>
                                        </select> 
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="row">
                                        <div class="col-sm-8">
                                            <div class="form-group">
                                                <label>Mata Pelajaran:</label>
                                                <select class="form-control" name="mapel" id="mapel">
                                                <?php
                                                    include 'config/database.php';
                                                    $sql="select * from mapel order by id_mapel asc";
                                                    $hasil=mysqli_query($kon,$sql);
                                                    while ($row = mysqli_fetch_array($hasil)):
                                                ?>
                                                <option <?php if ($data['mapel']==$row['kode_mapel']) echo "selected"; ?>  value="<?php echo $row['kode_mapel']; ?>"><?php echo $row['nama_mapel']; ?></option>
                                                <?php endwhile; ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label>Pertemuan Ke:</label>
                                                <input type="number" class="form-control" name="pertemuan_ke" value="<?php echo $data['pertemuan_ke'];?>" min="1" id="pertemuan_ke" placeholder="Masukan pertemuan ke">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Topik/Pembahasan:</label>
                                        <input type="text" class="form-control" value="<?php echo $data['topik'];?>" name="topik" id="topik" placeholder="Masukan nama topik atau pembahasan">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Tanggal:</label>
                                        <input type="date" class="form-control" value="<?php echo $data['tanggal'];?>" name="tanggal" id="tanggal" onkeydown="return false">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Mulai:</label>
                                        <input type="time" class="form-control" name="mulai" value="<?php echo $data['mulai'];?>"  id="mulai">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label>Selesai:</label>
                                        <input type="time" class="form-control" name="selesai" value="<?php echo $data['selesai'];?>"   id="selesai">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="content table-responsive">
                                        <table class="table table-hover table-striped">
                                            <thead>
                                                <th>No</th>
                                                <th>NISN</th>
                                                <th width="60%">Nama</th>
                                                <th>JK</th>
                                                <th>
                                                    <script> function toggle(pilih) { 
                                                        pilihan = document.getElementsByName('pil[]');
                                                        checkboxes = document.getElementsByName('check[]');
                                                        kehadiran = document.getElementsByName('kehadiran[]');
                                                        keterangan = document.getElementsByName('keterangan[]');
                                                        for(var i=0, n=checkboxes.length;i<n;i++)
                                                            { 
                                                                pilihan[i].disabled = pilih.checked; 
                                                                checkboxes[i].checked = pilih.checked; 
                                                            
                                                                if ($('#CheckAll').prop("checked") == false){
                                                                    kehadiran[i].value=0;
                                                                    keterangan[i].value=0;
                                                                }else {
                                                                    kehadiran[i].value=1;
                                                                    pilihan[i].value=0;
                                                                    keterangan[i].value=0;
                                                                }
                                                            
                                                            }
                                                        } 
                                                    </script>
                                                    <input class="checkbox" id="CheckAll" checked onClick="toggle(this)" type="checkbox" value="">
                                                </th>
                                                <th>Aksi</th>
                                            </thead>
                                            <tbody>
                                            <?php
                                                // include database
                                                include 'config/database.php';
                                                $id=addslashes(trim($_GET['id']));
                                                $sql="select s.* from siswa s inner join kehadiran k on k.siswa=s.nisn
                                                inner join pertemuan n on n.id_pertemuan=k.pertemuan
                                                where n.id_pertemuan='".$id."'
                                                 order by s.id_siswa asc";
                                                $hasil=mysqli_query($kon,$sql);
                                                $no=0;
                                                $bil=0;
                                                //Menampilkan data dengan perulangan while
                                                while ($row = mysqli_fetch_array($hasil)):
                                                $no++;
                                            ?>
                                            <tr>
                                                <td><?php echo $no; ?></td>
                                                <td><?php echo $row['nisn'];?></td>
                                                <td><?php echo $row['nama_siswa'];?></td>
                                                <td><?php echo $row['jk'];?></td>
                                                <?php 

                                                    $id=addslashes(trim($_GET['id']));                                
                                                    $result=mysqli_query($kon,"select * from kehadiran where pertemuan='$id' and siswa='".$row['nisn']."'");
                                                    while ($get = mysqli_fetch_array($result)):
                                                    $bil++;
                                                ?>
                                                <td>
                                                    <div class="checkbox">
                                                        <label><input type="checkbox" name="check[]" <?php if ($get['status_kehadiran']==1) echo "checked"; ?> value="1" id="checklist<?php echo $no; ?>" ></label>
                                                    </div>
                                                    <input type="hidden" name="no[]" value="<?php echo $no; ?>" />
                                                    <input type="hidden" name="siswa[]" value="<?php echo $row['nisn']; ?>" />
                                                    <input type="hidden" name="kehadiran[]" id="kehadiran<?php echo $no; ?>" value="<?php echo $get['status_kehadiran']; ?>" />
                                                    <input type="hidden" name="keterangan[]" id="v_keterangan<?php echo $no; ?>" value="<?php echo $get['keterangan']; ?>" />
                                                    <script>
                                                        $('#checklist<?php echo $no; ?>').on('click',function(){
                                                            if ($('#checklist<?php echo $no; ?>').prop("checked") == false){
                                                                $("#keterangan<?php echo $no; ?>").prop( "disabled", false );
                                                                $("#keterangan<?php echo $no; ?>").val("0");
                                                                $("#kehadiran<?php echo $no; ?>").val("0");
                                                            }else {
                                                                $("#keterangan<?php echo $no; ?>").prop( "disabled", true );
                                                                $("#keterangan<?php echo $no; ?>").val("0");
                                                                $("#kehadiran<?php echo $no; ?>").val("1");
                                                                $("#v_keterangan<?php echo $no; ?>").val('0');
                                                            }
                                                    
                                                        });
                                                    </script>
                                                </td>
                                                <td>
                                                    <select class="form-control" id="keterangan<?php echo $no; ?>" name="pil[]" <?php if ($get['status_kehadiran']==1) echo "disabled"; ?> >
                                                        <option <?php if ($get['keterangan']==0) echo "selected"; ?> value="0">Pilih</option>
                                                        <option <?php if ($get['keterangan']==1) echo "selected"; ?> value="1">Sakit</option>
                                                        <option <?php if ($get['keterangan']==2) echo "selected"; ?> value="2">Izin</option>
                                                        <option <?php if ($get['keterangan']==3) echo "selected"; ?> value="3">Alpa</option>
                                                    </select>
                                                </td>
                                                <?php 
                                                    endwhile;
                                                ?>
                                                <script>
                                                    $("#keterangan<?php echo $no; ?>").change(function() {
                                                        var keterangan = $("#keterangan<?php echo $no; ?>").val();
                                                        $("#v_keterangan<?php echo $no; ?>").val(keterangan);
                                                    });

                                                </script>
                                            </tr>
                                            <?php
                                                endwhile; 
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <button type="button" class="btn btn-primary btn-fill btn-wd" id="submit" >Submit</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<input type="hidden" name="id_pertemuan" value="<?php echo $id; ?>" />
</form>

<script type="text/javascript">
    var dtToday = new Date();
    var month = dtToday.getMonth() + 1;     // getMonth() is zero-based
    var day = dtToday.getDate() - 14;
    var year = dtToday.getFullYear();
    if(month < 10)
    month = '0' + month.toString();
    if(day < 10)
    day = '0' + day.toString();
   
    var maxDate = year + '-' + month + '-' + day;
    //atur 14 hari dari hari ini
    $('#tanggal').attr('min', maxDate);
    //disabled untuk hari berikutnya
    tanggal.max = new Date().toISOString().slice(0, -14);
</script>


<script>
    $('#submit').click(function(){
        if ($("#kelas").val().length == 0) {
            alert('Kelas harus dipilih');
            return false;
        } else if ($("#mapel").val().length == 0) {
            alert('Mata pelajaran harus dipilih');
            return false;
        } else if ($("#topik").val().length == 0) {
            alert('Topik harus dimasukan');
            return false;
        } else if ($("#tanggal").val().length == 0) {
            alert('Tanggal harus dipilih');
            return false;
        } else if  ($("#mulai").val().length == 0) {
            alert('Waktu mulai harus diisi');
            return false;
        } else if  ($("#selesai").val().length == 0) {
            alert('Waktu selesai harus diisi');
            return false;
        } else {


            var nilai=0;
            var nomor=0;
            no = document.getElementsByName('no[]');
            cek = document.getElementsByName('check[]');
            pil = document.getElementsByName('pil[]');
            kehadiran = document.getElementsByName('kehadiran[]');
            for(var i=0, n=cek.length;i<n;i++)
            {

                if (kehadiran[i].value==0){
                    if (pil[i].value==0){
                        nomor=i+1;
                        nilai++;
                    }
                }
             

            }

            if (nilai==0){
                update_absensi();
                return true;
            }else {
                alert('Keterangan nomor '+nomor+' belum dipilih');
                return false;
            }
        }
    });
</script>


<script>
     function update_absensi(){
        var form = $('#form_input_absensi')[0];
        var data = new FormData(form);
        $.ajax({
            type	: 'POST',
            url	: "guru/absensi/simpan/update.php",
            data: data,
            processData: false,
            contentType: false,
            cache: false,
            success	: function(data){
                window.location.href = "index.php?halaman=daftar-pertemuan";
            }
        });
    };
</script>

