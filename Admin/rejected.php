<?php
include_once 'header.php';
$t_record=$classAdmin->totalRecord('count(id) as ids','fund_request',' where status="2"');
?>
<style>
 .btn{
  margin:2px;
 } 
 .td-img {
    width: 100px;
}
</style>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Rejected Request</h1>
          </div>
         <!--  <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">DataTable</li>
            </ol>
          </div> -->
        </div>
      </div><!-- /.container-fluid -->
    </section>
      <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Total Rejected (<?php echo $t_record?>)</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="table-responsive">
                <table id="example2" class="table table-bordered table-hover" >
                  <thead>
                  <tr>
                    <th>Id</th>
                    <th>User Id</th>
                    <th>Amount Method</th>
                    <th>Amount</th>
                    <th>Image</th>
                    <th>Created At</th>
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
                    $data=$classAdmin->page_Record('* ',' fund_request ', $offset, $limit,' where status="2"');
                    foreach($data as $keys => $value){
                     extract ($value);
                      echo '<tr>
                              <td>'.$i.'</td>
                              <td>'.$user_id.'</td>
                              <td>'.$amount_method.'</td>
                              <td>'.$amount.'</td>
                              <td><img src="'.base_url('Dashboard/Image/'.$image).'" alt="image" class="img-fluid td-img"></td>
                              <td>'.$created_at.'</td>';
                              echo '<td><button class="btn btn-danger">Rejected</button></td>';
                            //   if($status == 0){
                            //   echo'<td><a href="'.api_url('Approved_request&user_id='.$user_id.'&id='.$id).'" class="btn btn-success"> Approve</a>  <a href="'.api_url('Rejected_request&user_id='.$user_id.'&id='.$id).'" class="btn btn-primary btn" > Reject</a></td>';
                            // }
                            //   if($status == 1){
                            //     echo '<td><a href="" class="btn btn-primary btn">Approved</a></td>';
                            //   }
                            //   if($status == 2){
                            //     echo '<td><button class="btn btn-danger"> Rejected</button></td>';
                            //   }

                            
                     echo '</tr>';

                  $i++;
                  }
                  ?>
                  </tbody>  
                 
                </table>
                 <?php  
                  $a=ceil($t_record/10);
                  $b=$a-1;
                  for($i=0;$i<=$b;$i++){
                    echo '<a href="rejected.php?page='.($i*10).'">'.$i.'</a>';
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

