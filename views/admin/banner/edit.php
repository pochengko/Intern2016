<!--Admin Edit -->

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <h1>
      <?php echo $title ?>
      <small>Control panel</small>
    </h1>

    <ul class="breadcrumb">
      <li><a href="<?php echo site_url("login"); ?>"><?php echo ucfirst($this->uri->segment(1));?></a></li>
      <li><a href="<?php echo site_url("admin/banner"); ?>"><?php echo ucfirst($this->uri->segment(2));?></a></li>
      <li class="active"><?php echo ucfirst($this->uri->segment(3));?></li>
      <li class="active"><?php echo $banner_item['bannerName'];?></li>
    </ul>

  </section>

  <!-- Main content -->
  <section class="content">
    <!-- Main row -->
    <div class="row">
      <!-- Left col -->
      <section class="col-lg-7 connectedSortable">
        <!-- Custom tabs (Charts with tabs)-->

        <?php //echo $error ?>
        <?php echo var_dump($error); ?>
        <?php echo validation_errors(); ?>
        <?php echo form_open_multipart('admin/banner/edit/'.$this->uri->segment(4).''); ?>

          <div class="form-group">
            <label for="img" class="col-sm-2 control-label">Image</label>
            <div class="col-sm-10">
              <img src="/<?php echo $banner_item['bannerPath']; ?>" style="width:20%" class="img-thumbnail">
              <input type="file" class="form-control" name="userfile" size="20" required/>
              <span class="text-danger"><?php if (isset($error)) { echo $error; } ?></span>
              <div>
                <img class="preview" style="max-width: 1349px; max-height: 449.66px;">
                <div class="size"></div>
              </div>
            </div>
          </div>
          <div class="form-group">
            <input type="text" name="bannerID" value="<?php echo $banner_item['bannerID']; ?>" hidden />
            <label for="bannerPath" class="col-sm-2 control-label">Path</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="bannerPath" placeholder="圖片路徑" required/>
            </div>
          </div>
          <div class="form-group">
            <label for="bannerName" class="col-sm-2 control-label">Name</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="bannerName" placeholder="橫幅名稱" required/>
            </div>
          </div>

          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <button type="submit" class="btn btn-primary" name="submit" />Create</button>
            </div>
          </div>
        </form>

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
