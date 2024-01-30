@extends('layouts.main.index')
@section('container')
<style>
  ::-webkit-scrollbar {
    display: none;
  }

  @media screen and (min-width: 1320px) {
    #search {
      width: 250px;
    }
  }

  .required-label::after {
    content: " *";
    color: red;
  }

  @media screen and (max-width: 575px) {
    .pagination-mobile {
      display: flex;
      justify-content: end;
    }
  }
</style>
<div class="flash-message" data-flash-message-antrian="@if(session()->has('notificationMessage')) {{ session('notificationMessage') }} @endif" data-confirm-patient="@if(session()->has('confirmPatientSuccess')) {{ session('confirmPatientSuccess') }} @endif" data-skip-patient="@if(session()->has('skipPatientSuccess')) {{ session('skipPatientSuccess') }} @endif" data-close-time="@if(session()->has('closeTime')) {{ session('closeTime') }} @endif"></div>
<div class="error-validate" data-error-name="@error('name') {{ $message }} @enderror" data-error-address="@error('address') {{ $message }} @enderror" data-error-old="@error('old') {{ $message }} @enderror" data-error-gender="@error('gender') {{ $message }} @enderror"></div>
<div class="row">
  <div class="col-md-12 col-lg-12 order-2 mb-4">
    <div class="card h-100">
      <div class="card-header d-flex align-items-center justify-content-between" style="margin-bottom: -0.7rem;">
        <div class="justify-content-start">
          <button type="button" class="btn btn-xs btn-dark fw-bold p-2 buttonAddPatientQueue" data-bs-toggle="modal" data-bs-target="#formModalAdminAddPatientQueue">
            <i class='bx bx-receipt fs-6'></i>&nbsp;INGRESAR PACIENTE A LA COLA
          </button>
        </div>
        <div class="justify-content-end">
          <!-- Search -->
          <form action="/admin/antrian/search">
            <div class="input-group">
              <input type="search" class="form-control" name="q" id="search" style="border: 1px solid #d9dee3;" value="{{ request('q') }}" placeholder="BUSQUEDA DE PACIENTE" autocomplete="off" />
            </div>
          </form>
          <!-- /Search -->
        </div>
      </div>
      <div class="card-body">
        <ul class="p-0 m-0">
          <div class="table-responsive text-nowrap" style="border-radius: 3px;">
            <table class="table table-striped">
              <thead class="table-dark">
                <tr>
                  <th class="text-white">NOMBRE Y APELLIDO</th>
                  <th class="text-white">NUMERO DE COLA</th>
                  <th class="text-white">DIRECCIÓN</th>
                  <th class="text-white text-center">EDAD</th>
                  <th class="text-white">GENERO</th>
                  <th class="text-white">FECHA DE REGISTRO</th>
                  <th class="text-white">ESTADO DE INSPECCIÓN</th>
                  <th class="text-white text-center">ACCIÓN</th>
                </tr>
              </thead>
              <tbody class="table-border-bottom-0">
                @foreach($patients as $index => $patient)
                <tr>
                  <td>{{ $patient->name }}</td>
                  <td class="text-center"><span class="badge badge-center bg-info rounded-pill">{{ $patient->queueNumber->number }}</span></td>
                  <td>{{ $patient->address }}</td>
                  <td class="text-center"><span class="badge badge-center bg-dark rounded-pill">{{ $patient->old }}</span></td>
                  <td>@if($patient->gender == 'Masculino')<span class="badge bg-label-primary fw-bold">Masculino</span>@else<span class="badge fw-bold" style="color: #ff6384 !important; background-color: #ffe5eb !important;">Femenino</span>@endif</td>
                  <td>{{ $patient->created_at->locale('id')->isoFormat('D MMMM YYYY | H:mm') }}</td>
                  <td><span class="badge bg-label-info fw-bold">{{ $patient->status_pemeriksaan }}</span>&nbsp;<i class="bx bx-info-circle bx-tada text-info" style="font-size: 20px;"></i></td>
                  <td class="text-center">
                    <button type="button" class="btn btn-icon btn-primary btn-sm buttonConfirmQueuePatient" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="auto" title="Konfirmasi Pasien" data-code="{{ encrypt($patient->id) }}" data-name="{{ $patient->name }}">
                      <span class="tf-icons bx bx-check" style="font-size: 15px;"></span>
                    </button>
                    <button type="button" class="btn btn-icon btn-warning btn-sm buttonSkipQueuePatient" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="auto" title="Lewati Pasien" data-code="{{ encrypt($patient->id) }}" data-name="{{ $patient->name }}">
                      <span class="tf-icons bx bx-archive-in" style="font-size: 16px;"></span>
                    </button>
                  </td>
                </tr>
                @endforeach
                @if($patients->isEmpty())
                <tr>
                  <td colspan="100" class="text-center">Hoy todavía no hay colas</td>
                </tr>
                @endif
              </tbody>
            </table>
          </div>
        </ul>

        @if(!$patients->isEmpty())
        <div class="mt-3 pagination-mobile">{{ $patients->withQueryString()->onEachSide(1)->links() }}</div>
        @endif
      </div>
    </div>
  </div>
</div>


<!-- Modal take Antrian-->
<div class="modal fade" id="formModalAdminAddPatientQueue" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="" method="post" class="modalAdminAddPatientQueue">
      @csrf
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title text-primary fw-bold">INGRESE DATOS DEL PACIENTE&nbsp;<i class='bx bx-receipt fs-5' style="margin-bottom: 1px;"></i></h5>
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow cancelModalTakePatientQueue" data-bs-dismiss="modal"><i class="bx bx-x-circle text-danger fs-4" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="auto" title="Tutup"></i></button>
        </div>
        <div class="modal-body">
        <div class="row g-2">
            <div class="col">
              <label for="ci" class="form-label required-label">CEDULA DE IDENTIDAD</label>
              <input type="text" id="ci" ci="ci" value="{{ old('ci') }}" class="form-control @error('name') is-invalid @enderror" placeholder="INGRESE CEDULA INDENTIDAD" autocomplete="off" required>
              @error('ci')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col"></div>
          </div>
          <div class="row">
            <div class="col mb-2 mb-lg-3">
              <label for="nama_lengkap_patient" class="form-label required-label">NOMBRE Y APELLIDO</label>
              <input type="text" id="nama_lengkap_patient" name="name" value="{{ old('name') }}" class="form-control @error('name') is-invalid @enderror" placeholder="INGRESA NOMBRES Y APELLIDOS" autocomplete="off" required>
              @error('name')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="row">
            <div class="col mb-2 mb-lg-3">
              <label for="address" class="form-label required-label">DIRECCIÓN</label>
              <textarea class="form-control @error('address') is-invalid @enderror" id="address" name="address" autocomplete="off" placeholder="INGRESE DIRRECIÓN DEL PACIENTE (max 255 CARACTERES)" rows="4" required>{{ old('address') }}</textarea>
              @error('address')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
          <div class="row g-2">
            <div class="col">
              <label for="gender_patient" class="form-label required-label">GENERO</label>
              <select class="form-select @error('gender') is-invalid @enderror" name="gender" id="gender_patient" style="cursor: pointer;" required>
                <option value="" disabled selected>SELECCIONAR SEXO</option>
                <option id="laki-laki" @if(old('gender')=='Laki-Laki' ) selected @endif value="Laki-Laki">MASCULINO</option>
                <option id="perempuan" @if(old('gender')=='Perempuan' ) selected @endif value="Perempuan">FEMENINO</option>
              </select>
              @error('gender')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
            </div>
            <div class="col">
              <label for="old" class="form-label required-label">EDAD</label>
              <input type="text" id="old" name="old" value="{{ old('old') }}" class="form-control @error('old') is-invalid @enderror" autocomplete="off" placeholder="INGRESE EDAD DEL PACIENTE" required>
              @error('old')
              <div class="invalid-feedback" style="margin-bottom: -3px;">
                {{ $message }}
              </div>
              @enderror
            </div>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-danger cancelModalTakePatientQueue" data-bs-dismiss="modal"><i class='bx bx-share fs-6' style="margin-bottom: 3px;"></i>&nbsp;CANCELAR</button>
          <button type="submit" class="btn btn-primary"><i class='bx bx-receipt fs-6' style="margin-bottom: 3px;"></i>&nbsp;AGREGAR</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal confirm patient -->
<div class="modal fade" id="confirmQueuePatient" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="/admin/antrian/confirm" method="post" id="formConfirmQueuePatient">
      <input type="hidden" name="codePatient" id="codePatient">
      @csrf
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title text-primary fw-bold">CONFIRMACION&nbsp;<i class='bx bx-check-shield fs-5' style="margin-bottom: 3px;"></i></h5>
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-dismiss="modal"><i class="bx bx-x-circle text-danger fs-4" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="auto" title="Tutup"></i></button>
        </div>
        <div class="modal-body" style="margin-top: -10px;">
          <div class="col-sm fs-6 namaPatientConfirm"></div>
        </div>
        <div class="modal-footer" style="margin-top: -5px;">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class='bx bx-share fs-6' style="margin-bottom: 3px;"></i>&nbsp;NO</button>
          <button type="submit" class="btn btn-primary"><i class='bx bx-user-check' style="margin-bottom: 3px;"></i>&nbsp;CONFIRMAR</button>
        </div>
      </div>
    </form>
  </div>
</div>

<!-- Modal Skip patient -->
<div class="modal fade" id="skipQueuePatient" data-bs-backdrop="static" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <form action="/admin/antrian/skip" method="post" id="formSkipQueuePatient">
      <input type="hidden" name="codePatient" id="codeSkipPatient">
      @csrf
      <div class="modal-content">
        <div class="modal-header d-flex justify-content-between">
          <h5 class="modal-title text-primary fw-bold">CONFIRMACION&nbsp;<i class='bx bx-check-shield fs-5' style="margin-bottom: 3px;"></i></h5>
          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-dismiss="modal"><i class="bx bx-x-circle text-danger fs-4" data-bs-toggle="tooltip" data-popup="tooltip-custom" data-bs-placement="auto" title="Tutup"></i></button>
        </div>
        <div class="modal-body" style="margin-top: -10px;">
          <div class="col-sm fs-6 namaPatientSkip"></div>
        </div>
        <div class="modal-footer" style="margin-top: -5px;">
          <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal"><i class='bx bx-share fs-6' style="margin-bottom: 3px;"></i>&nbsp;NO</button>
          <button type="submit" class="btn btn-primary"><i class='bx bx-archive-in fs-6' style="margin-bottom: 3px;"></i>&nbsp;IR A</button>
        </div>
      </div>
    </form>
  </div>
</div>


@section('script')
<script src="{{ asset('assets/js/queuePatient.js') }}"></script>
@endsection
@endsection