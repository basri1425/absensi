
<div class="content table-responsive">
    <table class="table table-hover table-striped" >
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
            <th>Keterangan</th>
        </thead>
        <tbody>
        <?php
            // include database
            include '../../config/database.php';

            $kelas=addslashes(trim($_POST['kelas']));

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
            <td>
                <div class="checkbox">
                    <label><input type="checkbox" name="check[]" checked value="1" id="checklist<?php echo $no; ?>" ></label>
                </div>
                <input type="hidden" name="no[]" value="<?php echo $no; ?>" />
                <input type="hidden" name="siswa[]" value="<?php echo $data['nisn']; ?>" />
                <input type="hidden" name="kehadiran[]" id="kehadiran<?php echo $no; ?>" value="1" />
                <input type="hidden" name="keterangan[]" id="v_keterangan<?php echo $no; ?>" value="0" />
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

                    $("#keterangan<?php echo $no; ?>").change(function() {
                        var keterangan = $("#keterangan<?php echo $no; ?>").val();
                        $("#v_keterangan<?php echo $no; ?>").val(keterangan);
                    });


                </script>
            </td>
            <td>
       
                <select class="form-control" id="keterangan<?php echo $no; ?>" name="pil[]" disabled>
                    <option value="0">Pilih</option>
                    <option value="1">Sakit</option>
                    <option value="2">Izin</option>
                    <option value="3">Alpa</option>
                </select>
           
            </td>
        </tr>
        <?php endwhile; ?>
        </tbody>
    </table>
</div>

