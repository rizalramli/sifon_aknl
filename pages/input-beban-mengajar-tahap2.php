<?php
$dosen = $_POST['dosen'];
$mata_kuliah = implode(',',$_POST['mk']);
if (isset($_POST['masukdatabase'])) {
   $input = mysql_query("INSERT INTO beban_mengajar (id_beban_mengajar,id_dosen,id_makul) VALUES ('$id','$dosen','$mata_kuliah')");
}
?>
<div class="row">
                <div class="col-md-12">
                    <!-- Form Elements -->
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Input Beban Mengajar Baru
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form role="form" method="POST" action="?frm=input-beban-mengajar">
                                        <input type="hidden" name="id_beban_mengajar">
                                        <div class="form-group">
                                            <label>Dosen</label>
                                            <?php
                                            $query_nama_dosen = mysql_query("SELECT * FROM dosen WHERE id_dosen='$dosen'");
                                            $fetch_nama_dosen = mysql_fetch_array($query_nama_dosen);
                                            ?>
                                            <input type="hidden" name="id_dosen" value="<?php echo $dosen; ?>">
                                            <input class="form-control" type="text" name="dosen" value="<?php echo $fetch_nama_dosen['nama_dosen']; ?>" readonly="">
                                        </div>
                                        <hr>
                                        <?php
                                        $pecah_mata_kuliah = explode(',', $mata_kuliah);
                                        $jumdata_makul = count($pecah_mata_kuliah);
                                        ?>
                                        <input type="hidden" name="jumdata_makul" value="<?php echo $jumdata_makul; ?>">
                                        <?php
                                        for ($i=0; $i < $jumdata_makul; $i++) { 
                                            $query_nama_makul = mysql_query("SELECT * FROM mata_kuliah WHERE kode='$pecah_mata_kuliah[$i]'");
                                            $fetch_nama_makul = mysql_fetch_array($query_nama_makul);
                                        ?>
                                        <input type="hidden" name="makul[]" value="<?php echo $pecah_mata_kuliah[$i]; ?>">
                                        <div class="form-group">
                                            <label><?php echo $pecah_mata_kuliah[$i]." - Mata Pelajaran ".$fetch_nama_makul['nama_makul']; ?></label>
                                        </div>

                                        <div class="form-group">
                                           <h5>Kelas Yang Diajar</h5>
                                           <?php
                                            $query2 = mysql_query("SELECT * FROM kelas");
                                            $no=0;
                                            while ($data2=mysql_fetch_array($query2)) {
                                                echo "<input type='checkbox' name='kelas".$i."[]' value='".$data2['id_kelas']."'  /> ".$data2['kelas']."<br />";
                                            $no++;
                                            }
                                           ?> 
                                        </div>
                                        <hr>
                                        <?php
                                        }
                                        ?>
                                        
                                        <hr>
                                        <button type="submit" class="btn btn-primary" name="masukdb"> Submit </button>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
</div>
 