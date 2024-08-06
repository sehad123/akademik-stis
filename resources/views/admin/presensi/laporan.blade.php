@extends('layouts.app')

@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Laporan Presensi Mahasiswa ({{ $getRecord->total() }})</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    @include('_message')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card ">
                        {{-- <div class="card-header">
                        <h3 class="card-title">Search Presensi </h3>
                        </div> --}}
                        <form method="get" action="">
                            <div class="card-body">
                                <div class="row">
   <div class="form-group col-md-3">
                                      <label>Nama Mahasiswa</label>
                                      <input type="text" name="student_name" value="{{ Request::get('student_name') }}" class="form-control" placeholder="Nama Mahasiswa">
                                  </div>
                                    <div class="form-group col-md-3">
                                        <label>Kelas</label>
                                        <select name="class_id" id="getClass" class="form-control">
                                            <option value="">Select</option>
                                            @foreach ($getClass as $class)
                                            <option {{ (Request::get('class_id') == $class->id)?'selected':'' }} value="{{ $class->id }}">{{ $class->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Mata Kuliah</label>
                                        <select id="getMatkul" name="matkul_id" class="form-control getSubject">
                                            <option value="">Select</option>
                                            @if (!empty($getSubject))
                                            @foreach ($getSubject as $matkul)
                                            <option {{ (Request::get('matkul_id') == $matkul->id) ? 'selected':'' }} value="{{ $matkul->id }}">{{ $matkul->name }}</option>
                                            @endforeach
                                            @endif
                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>Tanggal Presensi</label>
                                        <input type="date" id="getPresensiDate" value="{{ Request::get('tgl_presensi') }}" name="tgl_presensi" class="form-control">
                                    </div>
                                    {{-- <div class="form-group col-md-3">
                                        <label>Presensi Type</label>
                                        <select name="presensi_type" id="getClass" class="form-control">
                                            <option value="">Select</option>
                                            <option value="1" {{ (Request::get('presensi_type') == 1)?'selected':'' }}>Hadir</option>
                                            <option value="2" {{ (Request::get('presensi_type') == 2)?'selected':'' }}>Terlambat A</option>
                                            <option value="3" {{ (Request::get('presensi_type') == 3)?'selected':'' }}>Terlambat B</option>
                                            <option value="4" {{ (Request::get('presensi_type') == 4)?'selected':'' }}>Sakit</option>
                                            <option value="5" {{ (Request::get('presensi_type') == 5)?'selected':'' }}>Izin</option>
                                            <option value="6" {{ (Request::get('presensi_type') == 6)?'selected':'' }}>Tidak Hadir</option>
                                        </select>
                                    </div> --}}

                                 

                                    <div class="form-group col-md-3">
                                        <button class="btn btn-primary mt-4" type="submit">Search</button>
                                        <a href="{{ url('admin/presensi/report') }}" class="btn btn-success mt-4" type="submit">Clear</a>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            {{-- <h3 class="card-title">Presensi Mahasiswa List</h3> --}}
                            <form method="post" action="{{ url('admin/presensi/report_excel') }}" style="float: right;">
                                {{ csrf_field() }}
                                <input type="hidden" name="class_id" value="{{ Request::get('class_id') }}">
                                <input type="hidden" name="matkul_id" value="{{ Request::get('matkul_id') }}">
                                <input type="hidden" name="tgl_presensi" value="{{ Request::get('tgl_presensi') }}">
                                <input type="hidden" name="presensi_type" value="{{ Request::get('presensi_type') }}">
                                {{-- <button class="btn btn-primary">Export Excel</button>    --}}
                            </form>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Nama Mahasiswa</th>
                                            <th>Kelas</th>
                                            <th>Mata Kuliah</th>
                                            <th>Presensi</th>
                                            <th>Tgl Presensi</th>
                                            <th>Bobot Kehadiran</th>
                                            @if ($getRecord->firstWhere('presensi_type', 4) || $getRecord->firstWhere('presensi_type', 5))
                                            <th>Action</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                        $i = 1;
                                        @endphp
                                        @forelse($getRecord as $value)
                                        <tr data-id="{{ $value->id }}">
                                            <td>{{ $i++ }}</td>
                                            <td>{{ $value->student_name }} {{ $value->student_last_name }}</td>
                                            <td>{{ $value->class_name }}</td>
                                            <td>{{ $value->matkul_name }}</td>
                                            <td>
                                                @if ($value->presensi_type == 1)
                                                Hadir
                                                @elseif ($value->presensi_type == 2)
                                                Terlambat A
                                                @elseif ($value->presensi_type == 3)
                                                Terlambat B
                                                @elseif ($value->presensi_type == 4)
                                                Sakit
                                                @elseif ($value->presensi_type == 5)
                                                Izin
                                                @elseif ($value->presensi_type == 6)
                                                Tidak Hadir
                                                @endif
                                            </td>
                                            <td>{{ date('d-m-Y',strtotime($value->tgl_presensi)) }}</td>
                                            <td class="editable-bobot" data-value="{{ $value->bobot }}">
                                                <span class="bobot-text">{{ $value->bobot }} %</span>
                                                <i class="fas fa-edit edit-icon" style="cursor: pointer;"></i>
                                            </td>

                                            @if ($value->presensi_type == 4 || $value->presensi_type == 5)
                                            <td>
                                                <a href="{{ url('admin/perizinan/'.$value->id.'/'. $value->class_id.'/'.$value->matkul_id ) }}" class="btn btn-primary">Detail Izin</a>
                                            </td>
                                            @endif
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="100%">Record not Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <div style="padding: 10px; float:right;">
                                {!! $getRecord->appends(Illuminate\Support\Facades\Request::except('page'))->links() !!}
                            </div>
                        </div>
                        <div class="card-footer">
                            <h5>Ringkasan Bobot Kehadiran</h5>
                            @php
                            $totalBobot = $getRecord->sum('bobot');
                            $jumlahRecord = $getRecord->count();
                            $averageBobot = $jumlahRecord ? round($totalBobot / $jumlahRecord, 2) : 0;
                            @endphp
                            <p>Rata-rata Bobot Kehadiran: {{ $averageBobot }} %</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!-- Add jQuery if not already included -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        $(document).on('click', '.edit-icon', function() {
            var currentElement = $(this).closest('.editable-bobot');
            var currentValue = currentElement.data('value');
            var input = $('<input>', {
                type: 'number',
                value: currentValue,
                min: 0,
                max: 100,
                css: {
                    width: '60px'
                }
            });

            input.on('blur', function() {
                updateBobot(currentElement, input.val());
            });

            input.on('keypress', function(e) {
                if (e.which === 13) { // Enter key pressed
                    updateBobot(currentElement, input.val());
                }
            });

            currentElement.find('.bobot-text').hide();
            currentElement.find('.edit-icon').hide();
            currentElement.append(input);
            input.focus();
        });

        function updateBobot(element, newValue) {
            if (newValue >= 0 && newValue <= 100) {
                var rowId = element.closest('tr').data('id');
                $.ajax({
                    url: "{{ url('admin/presensi/update-bobot') }}/" + rowId,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        bobot: newValue
                    },
                    success: function(response) {
                        if (response.success) {
                            element.data('value', newValue);
                            element.find('.bobot-text').text(newValue + ' %');
                            location.reload(); // Reload the page
                        } else {
                            alert('Gagal memperbarui bobot.');
                        }
                    }
                });
            } else {
                alert('Nilai harus antara 0 hingga 100.');
            }
            element.find('input').remove();
            element.find('.bobot-text').show();
            element.find('.edit-icon').show();
        }
    });
</script>
@endsection
