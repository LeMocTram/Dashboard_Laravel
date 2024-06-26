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
                        <table id="order_details_table" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>OrderID</th>
                                    <th>Product Name</th>
                                    <th>Quantity</th>
                                    <th>Unit Price</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                    @foreach ($orderDetail as $item)
                                    <tr>
                                    <td>{{$item->order_id}}</td>
                                    <td>{{$item->product->name}}</td>
                                    <td>{{$item->quantity}}</td>
                                    <td>{{$item->unit_price}}</td>
                                    <td>{{$item->created_at}}</td>
                                    </tr>
                              @endforeach
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
  
    <!-- /.content-wrapper -->
</x-app-layout>
