<div class="container-fluid text-center">
          <div class="row content">
            <div class="col-sm-2 sidenav">

            </div>
            <div class="col-sm-8 text-left">

              <h2>Form</h2>
              <?php echo validation_errors(); ?>
              <?php echo form_open('contact/index') ?>
              <form class="form-horizontal" role="form">

                <div class="form-group">
                  <label for="c_name" class="col-sm-2 control-label">Name : </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" name="c_name" placeholder="請輸入姓名" required />
                  </div>
                </div>
                <div class="form-group">
                  <label for="c_email" class="col-sm-2 control-label">E-mail : </label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control" name="c_email" placeholder="請輸入電子信箱" required/>
                  </div>
                </div>
                <div class="form-group">
                  <label for="c_content" class="col-sm-2 control-label">Content : </label>
                  <div class="col-sm-10">
                    <textarea rows="5" class="form-control" name="c_content" placeholder="請輸入內容" required/></textarea>
                  </div>
                </div>
                <div class="form-group">
                  <label for="validate" class="col-sm-2 control-label"></label>
                  <div class="col-sm-10">
                    <?php echo $this->recaptcha->render();?>
                  </div>
                </div>
                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary" value="submit" />Submit</button>
                  </div>
                </div>
              </form>
            </div>
            <div class="col-sm-2 sidenav">

            </div>
          </div>
        </div>
