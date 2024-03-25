<x-app-layout>
    <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Dashboard v1</li>
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
              <div class="col-12">
                  <div class="card">
                    <div class="btn-add-trash d-grid gap-2 d-md-block">
                      <a class="btn btn-primary" href="/manageproducts" type="button">Return</a>
                    </div>
                    <table id="trash_table" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Image</th>
                                <th>Price</th>
                                <th>CategoryID</th>
                                <th>Created At</th>
                                <th>Updated At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                  </div>
                </div>
            </div>
          <!-- /.row -->
          <!-- Main row -->
          <!-- /.row (main row) -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
    <!-- Modal Image -->
    <div id="imgModel" class="imgModel">
        <span class="close">&times;</span>
        <img class="imgModel-content" alt="Image Product" id="img01">
    </div>
    <!-- /.content-wrapper -->
</x-app-layout>
