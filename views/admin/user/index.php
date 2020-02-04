<!--Admin User Index -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title ?>
      <small>Control panel</small>
    </h1>

    <ul class="breadcrumb">
        <li>
          <a href="<?php echo site_url("login"); ?>">
            <?php echo ucfirst($this->uri->segment(1));?>
          </a>
        </li>
        <li class="active">
          <?php echo ucfirst($this->uri->segment(2));?>
        </li>
      </ul>

  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->
        <div class="table-responsive">

        <table class="table table-hover">
          <tr>
            <th width="10%">編號</th>
            <th width="35%">帳號</th>
            <th width="35%">密碼</th>
            <th width="10%">修改</th>
            <th width="10%">刪除</th>
          </tr>
      <?php foreach ($admin_user as $user_item): ?>
          <tr>
            <td><?php echo $user_item['u_id']?></td>
            <td><a href="/admin/user/view/<?php echo $user_item['username'] ?>"><?php echo $user_item['username']?></a></td>
            <td><?php echo $user_item['password']?></td>
            <td><a href="/admin/user/edit/<?php echo $user_item['username'] ?>">Edit</a></td>
            <td><a href="/admin/user/del/<?php echo $user_item['u_id'] ?>">Delete</a></td>

          </tr>
      <?php endforeach ?>
        </table>
      </div>
        <div>
          <?php echo $link ?>
        </div>
        <input type="button" value="新增" class="btn btn-primary" onclick="window.location.href='/admin/user/create'">

      </section>
      <!-- /.Left col -->
      <!-- right col (We are only adding the ID to make the widgets sortable)-->
      <section class="col-lg-5 connectedSortable">

      </section>
      <!-- right col -->
    </div>
    <!-- /.row (main row) -->

  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
<footer class="main-footer">
  <div class="pull-right hidden-xs">
    <b>Version</b> 2.3.6
  </div>
  <strong>Copyright &copy; 2014-2016 <a href="http://almsaeedstudio.com">Almsaeed Studio</a>.</strong> All rights
  reserved.
</footer>

<!-- Add the sidebar's background. This div must be placed
     immediately after the control sidebar -->
<div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

</body>
</html>
