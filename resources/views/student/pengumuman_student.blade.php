@extends('layouts.app')

@section('content')

<div class="content-wrapper">
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-12">
          <h1>Pengumuman </h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <div class="col-md-12">

    <!-- general form elements -->
    <div class="card ">
        <div class="card-header">
            <h3 class="card-title">Search Class </h3>
        </div>
        <form method="get" action="">
            <div class="card-body">
                <div class="row">

                    <div class="form-group col-md-3">
                        <label>judul</label>
                        <input type="text" class="form-control" value="{{ Request::get('judul') }}"
                            name="judul" placeholder="Enter judul">
                    </div>
                   
                    <div class="form-group col-md-3">
                      <label> Tanggal Dari</label>
                      <input type="date" class="form-control" value="{{ Request::get('pengumuman_from') }}"
                          name="pengumuman_from" placeholder="Enter Date">
                  </div>
                  
                    <div class="form-group col-md-3">
                        <label> Tanggal To</label>
                        <input type="date" class="form-control" value="{{ Request::get('pengumuman_to') }}"
                            name="pengumuman_to" placeholder="Enter Date">
                    </div>
                    
                  
                    <div class="form-group col-md-3">
                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                        <a href="{{ url('student/pengumuman') }}" class="btn btn-success mt-4"
                            type="submit">clear</a>
                    </div>
                  
                </div>

            </div>
        </form>
    </div>

</div>


  <!-- Main content -->
  <section class="content">
    <div class="container-fluid">
      <div class="row">
      
        @foreach ($getRecord as $item)
            
      <div class="col-md-12">
        <div class="card card-primary card-outline">
          <div class="card-body p-0">
            <div class="mailbox-read-info">
              <h5>{{ $item->judul }}</h5>
              <h6>
                <span class="mailbox-read-time float-right" style="font-weight: bold; color:#000;font-size:16px;">{{ date('d-m-Y',strtotime($item->tgl_pengumuman)) }}</span></h6>
            </div>
            <div class="mailbox-read-message">
              {!! $item->pesan !!}
            
            </div>
            <!-- /.mailbox-read-message -->
          </div>
          <!-- /.card-footer -->
        </div>
        <!-- /.card -->
      </div>
      @endforeach
      <div class="col-md-12">
        <div style="padding: 10px; float:right;">
          {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
      </div>
      </div>

      <!-- /.col -->
    </div>
    <!-- /.row -->
    </div><!-- /.container-fluid -->
  </section>
</div>
    
@endsection