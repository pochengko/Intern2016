<!--Admin Contact Index -->


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

        <div class="table-resoponsive">

        <table class="table table-hover">
          <tr>
            <th>編號</th>
            <th>標題</th>
            <th>時間</th>
            <th>刪除</th>
          </tr>
      <?php foreach ($admin_contact as $contact_item): ?>
          <tr>
            <td><?php echo $contact_item['c_id']?></td>
            <td><a href="/admin/contact/view/<?php echo $contact_item['c_id'] ?>"><?php echo $contact_item['c_name']?></a></td>
            <td><?php echo $contact_item['c_date_time']?></td>
            <td><a href="/admin/contact/del/<?php echo $contact_item['c_id'] ?>">Delete</a></td>

          </tr>
      <?php endforeach ?>
        </table>
      </div>
        <div>
          <?php echo $link ?>
        </div>


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
