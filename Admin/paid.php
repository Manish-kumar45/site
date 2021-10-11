<?php
include_once 'header.php';
$t_record=$classAdmin->totalRecord('count(id) as ids','users','where paid_status="1"');

?>
<style >
  .btn{
    margin:2px;
  }
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>DataTable</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Paid Users</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Paid Users (<?php echo $t_record?>)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover" >
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>User Id</th>
                    <th>Password </th>
                    <th>Email</th>
                    <th>Mobile No.</th>
                    <th>Sponser Id</th>
                    <th>Paid Status</th>
                    <th>Package Id</th>
                    <th>Package Price</th>
                    <th>Topup Date</th>
                    <th>Action</th>



                  </tr>
                  </thead>
                  <tbody>
                    <?php
                    if(!empty($_GET['page'])){
                       $offset=$_GET['page'];
                       $limit=10;
                    }else{
                      $offset=0;
                      $limit=10;
                    }
                    $i=$offset+1;
                    $data=$classAdmin->page_Record('*',' users ',$offset,$limit, ' where paid_status = "1"');
                    foreach($data as $keys => $value){
                     extract ($value);
                      echo '<tr>
                              <td>'.$i.'</td>
                              <td>'.$name.'</td>
                              <td>'.$user_id.'</td>
                              <td>'.$password.'</td>
                              <td>'.$email.'</td>
                              <td>'.$mob_no.'</td>
                              <td>'.$sponser_id.'</td>
                              <td>'.$paid_status.'</td>
                              <td>'.$package_id.'</td>
                              <td>'.$package_price.'</td>
                              <td>'.$topup_date.'</td>
                              <td><a href="'.api_url('userLogin&&user_id='.$user_id).'" class="btn btn-success"> Login</a> | <a href="form.php?id='.$id.'" class="btn btn-primary btn"> Edit</a></td>

                      </tr>';

                  $i++;
                  }
                  ?>
                  </tbody>  
                </table>
                <?php
                $a=ceil($t_record/10);
                $b=$t_record-1;
                  for($i=0;$i<=$b;$i++){
                    echo '<a href="paid.php?page='.($i*10).'">'.$i.'</a>';
                  }
                ?>
              </div>
              </div>
            </div>
          </div>
        </div>
       </div>
      </section> 
      </div>

 <?php
 include_once 'footer.php';
 ?>   

