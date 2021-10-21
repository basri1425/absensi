<?php
//Jika user yang mengakses halaman ini bukan admin maka halaman akan di kunci
if ($_SESSION["level"]!='admin'){
    echo "<center><h3>Maaf. Halaman tidak di temukan !</h3></center>";
    exit;
}
?>
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">
                    <h4 class="card-title">Data Mata Pelajaran</h4>
                </div>
                <div class="card-body table-full-width table-responsive">
                    <div class="col-sm-12">
                        <button class="btn btn-primary btn-fill btn-wd" id="tambah" >Tambah</button>
                        <div id="tampil_tabel"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade modal-primary" id="myModal1" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header justify-content-center">

            </div>
            <div class="modal-body">
                <div id="tampil_form"></div>
            </div>
            <div class="modal-footer">
            
            </div>
        </div>
    </div>
</div>

<script>
    $('#tambah').on('click',function(){
        $.ajax({
            url: 'admin/data-mapel/tambah.php',
            method: 'post',
            success:function(data){
                $('#tampil_form').html(data);  
            }
        });
        // Membuka modal
        $('#myModal1').modal('show');
    });
</script>

<script>

  $(document).ready( function () {
    tabel_mapel();
  });


  function tabel_mapel(){

    $.ajax({
        type: "POST",
        dataType: "html",
        async : false,
        url: 'admin/data-mapel/tabel-mapel.php',
        success: function(data) {
            $("#tampil_tabel").html(data);
        }
    });
  }

</script>