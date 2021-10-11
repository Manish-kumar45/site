<?php

include_once 'header.php'; 
$u_info=$classAdmin->singleRecord('*','users',  '  where user_id="'.$_SESSION['user_id'].'"');
$total_amount=$classAdmin->singleRecord('ifnull(sum(amount),0.00) as total ',' user_wallet  ','  where user_id= "'.$_SESSION['user_id'].'" ');
$level_income=$classAdmin->singleRecord('ifnull(sum(amount),0.00) as total ',' user_wallet  ','  where user_id= "'.$_SESSION['user_id'].'"  && type="level-income"');
$direct_income=$classAdmin->singleRecord('ifnull(sum(amount),0.00) as total ',' user_wallet  ','  where user_id= "'.$_SESSION['user_id'].'"  && type="direct-income"');
$t_income=$classAdmin->total_income();
$t_direct=$classAdmin->total_direct();


// print_r($total_income);

?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item active">Dashboard </li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>User Id</h3>

                <p><?php echo $u_info['user_id'];?></p>
              </div>
              <div class="icon">
                <i class="fa fa-user"></i>
              </div>
             <!--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Name</h3>

                <p><?php echo $u_info['name']?></p>
              </div>
              <div class="icon">
                <i class="ion ion-person"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Paid Status</h3>

                <p><?php echo $u_info['paid_status']?> </p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Topup Date</h3>

                <p> <?php echo $u_info['topup_date']?></p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div> -->
             <!--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
            </div>
            
          
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>Wallet</h3>

                <p><i class="fa fa-inr" aria-hidden="true"></i>  <?php  echo $total_amount['total']?></p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-bag"></i>
              </div> -->
              <!-- <a href="order.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
            </div>
             <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>Direct Income</h3>

                <p><i class="fa fa-inr" aria-hidden="true">  <?php echo $direct_income['total'];
// print_r($direct_income);
                ?></i></p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div> -->
             <!--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>Level Income</h3>

                <p><i class="fa fa-inr" aria-hidden="true">  </i>   <?php echo $level_income['total'];?></p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <!-- <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
           <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Total Income</h3>

                <p><i class="fa fa-inr" aria-hidden="true">  <?php echo $t_income;
// print_r($total_income);
                ?></i></p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div> -->
             <!--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>Total Direct</h3>

                <p>  <?php echo $t_direct;
// print_r($total_income);
                ?></p>
              </div>
              <!-- <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div> -->
             <!--  <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a> -->
            </div>
          </div>
          

          <!-- ./col -->
        </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

    <!-- /.content-wrapper -->
    <?php
    include_once 'footer.php'; 
    ?>