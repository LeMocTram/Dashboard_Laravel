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
                      <button class="btn btn-primary" type="button"
                      data-toggle="modal" data-target="#modal-add-new-product">Add <i class="fa fa-plus" aria-hidden="true"></i></button>
                      <a class="btn btn-primary" href="/managetrash" type="button">Trash <i class="fas fa-trash-alt"></i></a>
                    </div>
                    <table id="products_table" class="table table-bordered table-striped">
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
  <!-- Modal add new products -->
      <div class="modal fade" id="modal-add-new-product" style="display: none;" aria-hidden="true">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add Product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span>
              </button>
            </div>
            <form method="post" action='/manage/add' enctype="multipart/form-data">
                <div class="modal-body">
                    <div class="card-body">
                      @csrf
                        <div class="form-group">
                            <label for="inputNameProduct">Product Name</label>
                            <input type="text" id="inputNameProduct" name="name" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="uploadImage">Product Image</label>
                            <input type="file" id="uploadImage" name="image" class="form-control-file" required>
                        </div>
                      <div class="form-group">
                            <label for="selectCategory">Category</label>
                            <select id="selectCategory" name="category_id" class="form-control custom-select" required>
                                <option selected disabled>Category</option>
                                <option value="1">Shirt</option>
                                <option value="2">Pants</option>
                                <option value="3">Shose</option>
                                <option value="4">Accessory</option>
                            </select>
                        </div>
                      <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="number" class="form-control" id="price" name="price" required>
                      </div>
                    </div>
                </div>
                <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <input type="submit" value="Submit" class="btn btn-success float-right">
                </div>
            </form>
          </div>
        <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

<!-- Modal edit products -->
<div class="modal fade" id="modal-edit-product" style="display: none;" aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Edit Product</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <form id="editForm" method="post" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="modal-body">
                <div class="card-body">
                    <div class="form-group">
                        <input type="hidden" id="idProduct" name="idProduct" class="form-control" required>
                    </div>

                    <div class="form-group">
                        <label for="productName">Product Name</label>
                        <input type="text" id="productName" name="name" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="uploadImage">Product Image</label>
                          <div id="divImg"  style="max-width: 60px; max-height: 80px;">
                            <img id="imgproduct" src="" alt="">
                          </div>
                        <input type="file" id="uploadImage" name="image" class="form-control-file">
                    </div>
                   <div class="form-group">
                        <label for="chooseCategory">Category</label>
                        <select id="chooseCategory" name="category_id" class="form-control custom-select" required>
                            <option value="1">Shirt</option>
                            <option value="2">Pants</option>
                            <option value="3">Shoes</option>
                            <option value="4">Accessory</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="productPrice">Price</label>
                        <input type="number" id="productPrice" name="price" class="form-control" min='1' required>
                    </div>
                </div>
            </div>
            <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            <input type="submit" value="Submit" class="btn btn-success float-right">
            </div>
        </form>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
    <!-- /.content-wrapper -->
</x-app-layout>
