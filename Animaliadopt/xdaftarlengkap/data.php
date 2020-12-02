<?php include_once('../_header.php');?> 
    <div class="box">
        <h1>Adopsi<h1>
        <h4>
            <small>Daftar Adopsi Lengkap</small>
            <div class="pull-right">
                <a href="" class="btn btn-default btn-xs"><i class="glyphicon glyphicon-refresh"></i></a>
            </div>
        <h4>
        
        <div style="margin-bottom: 20px;">
            <form class="form-inline" action="" method="post">
                <div class = "form-group">
                    <input type="text" name="pencarian" class="form-control" placeholder="Pencarian">
                </div>
                <div class = "form-group">
                    <button type="submit" class="btn btn-primary"><span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
                </div>
            </form>
        </div>
        <div class ="table-responsive">
            <table class="table table-striped table-bordered table-hover">
                <thead>
                    <tr>
                        <th>Id_hwn</th>
                        <th>Jenis</th>
                        <th>Ras</th>
                        <th>Warna</th>
                        <th>Nama Pemilik</th>
                        <th>Tgl Adopt</th>
                    </tr>   
                </thead>
                <tbody>
                <?php
                $batas = 5;
                $hal = @$_GET['hal'];
                if(empty($hal)){
                    $posisi = 0;
                    $hal = 1;                
                }else{
                    $posisi =($hal -1)*$batas;                
                }
                $no=1;
                if($_SERVER['REQUEST_METHOD']=="POST"){
                    $pencarian =trim(mysqli_real_escape_string($con, $_POST['pencarian']));
                    if($pencarian!= ''){
                        $sql = "SELECT*FROM daftarlengkap WHERE Nama LIKE '$pencarian%'";
                        $query = $sql;
                        $queryJml =$sql;
                    } else{
                        $query = "SELECT*FROM daftarlengkap LIMIT $posisi, $batas";
                        $queryJml = "SELECT*FROM daftarlengkap";
                        $no =$posisi +1;
                    }
                }else{
                    $query = "SELECT*FROM daftarlengkap LIMIT $posisi, $batas";
                    $queryJml = "SELECT*FROM daftarlengkap";
                    $no =$posisi +1;
                }

                $sql_daftarlengkap = mysqli_query($con, $query) or die (mysqli_error($con));
                if(mysqli_num_rows($sql_daftarlengkap)>0){
                    while($data= mysqli_fetch_array($sql_daftarlengkap)) {?>
                    <tr>
                        <td><?=$data['id_hewan']?></td>
                        <td><?=$data['jenis']?></td>
                        <td><?=$data['ras']?></td>
                        <td><?=$data['warna']?></td>
                        <td><?=$data['nama']?></td>
                        <td><?=$data['tgl_adopt']?></td>
                    </tr>
                <?php   
                    }
                }else{
                    echo "<tr><td colspan=\"4\" align =\"center\">Data tidak ditemukan</td></tr>";
                }
                ?>
            </table> 
        </div>
        <?php
        if(isset($_POST['pencarian'])){
            echo"<div style=\"float:left;\">";
            $jml = mysqli_num_rows(mysqli_query($con, $queryJml));
            echo"Data Hasil Pencarian: <b>$jml</b>";
            echo "</div>";}
            else{?>       
            <div style="float:left;">
                <?php
                $jml = mysqli_num_rows(mysqli_query($con, $queryJml));
                echo"Jumlah Data: <b>$jml</b>";
        ?>
        </div>
        <div style="float:right;">
        <ul class="pagination pagination-sm" style="margin:0">
            <?php
            $jml_hal= ceil($jml/$batas);
            for ($i=1; $i<=$jml_hal; $i++){
                if($i != $hal){
                    echo "<li><a href=\"?hal=$i\">$i</a></li>";
                } else{
                    echo "<li class=\"active\"><a>$i</a></li>";
                    
                }
            }
            ?>
        </ul>
    </div>
<?php
}
?>
    </div>       
<?php include_once('../_footer.php'); ?>