<?php
    $title ="Reportes | ";
    include "head.php";
    include "sidebar.php";

    $projects = mysqli_query($con, "select * from project");
    $priorities = mysqli_query($con,  "select * from priority");
    $statuses = mysqli_query($con, "select * from status");
    $kinds = mysqli_query($con, "select * from kind");
?>  


    <div class="right_col" role="main"><!-- page content -->
        <div class="">
            <div class="page-title">
                <div class="clearfix"></div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        <div class="x_title">
                            <h2>Reportes</h2>
                            <ul class="nav navbar-right panel_toolbox">
                                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                </li>
                                <li><a class="close-link"><i class="fa fa-close"></i></a>
                                </li>
                            </ul>
                            <div class="clearfix"></div>
                        </div>

                        <!-- form search -->
                        <form class="form-horizontal" role="form">
                            <input type="hidden" name="view" value="reports">
                            <div class="form-group">
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-male"></i></span>
                                    <select name="project_id" class="form-control">
                                    <option value="">PROJECTO</option>
                                      <?php foreach($projects as $p):?>
                                        <option value="<?php echo $p['id']; ?>" <?php if(isset($_GET["project_id"]) && $_GET["project_id"]==$p['id']){ echo "selected"; } ?>><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="fa fa-support"></i></span>
                                    <select name="priority_id" class="form-control">
                                    <option value="">PRIORIDAD</option>
                                      <?php foreach($priorities as $p):?>
                                        <option value="<?php echo $p['id']; ?>" <?php if(isset($_GET["priority_id"]) && $_GET["priority_id"]==$p['id']){ echo "selected"; } ?>><?php echo $p['name']; ?></option>
                                      <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                  <span class="input-group-addon">INICIO</span>
                                  <input type="date" name="start_at" value="<?php if(isset($_GET["start_at"]) && $_GET["start_at"]!=""){ echo $_GET["start_at"]; } ?>" class="form-control" placeholder="Palabra clave">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="input-group">
                                  <span class="input-group-addon">FIN</span>
                                  <input type="date" name="finish_at" value="<?php if(isset($_GET["finish_at"]) && $_GET["finish_at"]!=""){ echo $_GET["finish_at"]; } ?>" class="form-control" placeholder="Palabra clave">
                                </div>
                            </div>
                            </div>
                            <div class="form-group">
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">ESTADO</span>
                                        <select name="status_id" class="form-control">
                                          <?php foreach($statuses as $p):?>
                                            <option value="<?php echo $p['id']; ?>" <?php if(isset($_GET["status_id"]) && $_GET["status_id"]==$p['id']){ echo "selected"; } ?>><?php echo $p['name']; ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="input-group">
                                        <span class="input-group-addon">TIPO</span>
                                        <select name="kind_id" class="form-control">
                                          <?php foreach($kinds as $p):?>
                                            <option value="<?php echo $p['id']; ?>" <?php if(isset($_GET["kind_id"]) && $_GET["kind_id"]==$p['id']){ echo "selected"; } ?>><?php echo $p['name']; ?></option>
                                          <?php endforeach; ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <button class="btn btn-primary btn-block">Procesar</button>
                                </div>
                            </div>
                        </form>
                        <!-- end form search -->

                         <?php
                                        $users= array();
                                        if((isset($_GET["status_id"]) && isset($_GET["kind_id"]) && isset($_GET["project_id"]) && isset($_GET["priority_id"]) && isset($_GET["start_at"]) && isset($_GET["finish_at"]) ) && ($_GET["status_id"]!="" ||$_GET["kind_id"]!="" || $_GET["project_id"]!="" || $_GET["priority_id"]!="" || ($_GET["start_at"]!="" && $_GET["finish_at"]!="") ) ) {
                                        $sql = "select * from ticket where ";
                                        if($_GET["status_id"]!=""){
                                            $sql .= " status_id = ".$_GET["status_id"];
                                        }

                                        if($_GET["kind_id"]!=""){
                                        if($_GET["status_id"]!=""){
                                            $sql .= " and ";
                                        }
                                            $sql .= " kind_id = ".$_GET["kind_id"];
                                        }


                                        if($_GET["project_id"]!=""){
                                        if($_GET["status_id"]!=""||$_GET["kind_id"]!=""){
                                            $sql .= " and ";
                                        }
                                            $sql .= " project_id = ".$_GET["project_id"];
                                        }

                                        if($_GET["priority_id"]!=""){
                                        if($_GET["status_id"]!=""||$_GET["project_id"]!=""||$_GET["kind_id"]!=""){
                                            $sql .= " and ";
                                        }

                                            $sql .= " priority_id = ".$_GET["priority_id"];
                                        }



                                        if($_GET["start_at"]!="" && $_GET["finish_at"]){
                                        if($_GET["status_id"]!=""||$_GET["project_id"]!="" ||$_GET["priority_id"]!="" ||$_GET["kind_id"]!="" ){
                                            $sql .= " and ";
                                        }

                                            $sql .= " ( date_at >= \"".$_GET["start_at"]."\" and date_at <= \"".$_GET["finish_at"]."\" ) ";
                                        }

                                                $users = mysqli_query($con, $sql);

                                        }else{
                                                $users = mysqli_query($con, "select * from ticket order by created_at desc");

                                        }

                            if(@mysqli_num_rows($users)>0){
                                // si hay reportes
                                $_SESSION["report_data"] = $users;
                            ?>
        <div class="x_content">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead>
                        <th>Asunto</th>
                        <th>Proyecto</th>
                        <th>Tipo</th>
                        <th>Categoria</th>
                        <th>Prioridad</th>
                        <th>Estado</th>
                        <th>Fecha</th>
                        <th>Ultima Actualizacion</th>
                    </thead>
            <?php
            $total = 0;
            foreach($users as $user){
                $project_id=$user['project_id'];
                $priority_id=$user['priority_id'];
                $kind_id=$user['kind_id'];
                $category_id=$user['category_id'];
                $status_id=$user['status_id'];

                $status=mysqli_query($con, "select * from status where id=$status_id");
                $category=mysqli_query($con, "select * from category where id=$category_id");
                $kinds = mysqli_query($con,"select * from kind where id=$kind_id");
                $project  = mysqli_query($con, "select * from project where id=$project_id");
                $medic = mysqli_query($con,"select * from priority where id=$priority_id");

                
                ?>
                <tr>
                <td><?php echo $user['title'] ?></td>
                <?php foreach($project as $pro){?>
                <td><?php echo $pro['name'] ?></td>
                <?php } ?>
                <?php foreach($kinds as $kind){?>
                <td><?php echo $kind['name'] ?></td>
                <?php } ?>
                <?php foreach($category as $cat){?>
                <td><?php echo $cat['name']; ?></td>
                <?php } ?>
                 <?php foreach($medic as $medics){?>
                <td><?php echo $medics['name']; ?></td>
                <?php } ?>
                <?php foreach($status as $stat){?>
                <td><?php echo $stat['name']; ?></td>
                 <?php } ?>
                <td><?php echo $user['created_at']; ?></td>
                <td><?php echo $user['updated_at']; ?></td>
                </tr>
             <?php  
                
                }

              ?>   
       <?php

        }else{
            echo "<p class='alert alert-danger'>No hay tickets</p>";
        }


        ?>
     </table>
    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- /page content -->

<?php include "footer.php" ?>
