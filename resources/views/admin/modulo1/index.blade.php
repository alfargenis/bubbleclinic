@extends('layouts.main.index')
@section('container')

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/apexcharts@3.29.0/dist/apexcharts.min.css">
  <script src="https://cdn.jsdelivr.net/npm/apexcharts@3.29.0/dist/apexcharts.min.js"></script>
</head>

<style>
  .apexcharts-legend-series {
    display: none;
  }

  .apexcharts-title-text {
    font-size: 1rem;
    font-weight: 700 !important;
  }
</style>

<div class="row">
<div class="col-md-6 mb-4">
  <div class="card h-100">
    <div class="card-header">
      <h5 class="card-title m-0 me-2 fw-bold mb-2">
        <i class="bx bx-line-chart"></i>  Reportes de Cuentas
      </h5>
    </div>
    <div class="card-body">
      <p>Este módulo proporciona informes detallados sobre las cuentas y su rendimiento financiero.</p>
    </div>
  </div>
</div>

  <div class="col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="card-title m-0 me-2 fw-bold mb-2"><i class="bx bx-user"></i>  Reportes de Clientes</h5>
      </div>
      <div class="card-body">
        <p>Accede a reportes específicos sobre tus clientes, su comportamiento y preferencias.</p>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="card-title m-0 me-2 fw-bold mb-2"><i class="bx bx-shopping-bag"></i>  Compras y Ventas</h5>
      </div>
      <div class="card-body">
        <p>Visualiza resúmenes detallados de tus transacciones de compras y ventas.</p>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="card-title m-0 me-2 fw-bold mb-2"><i class="bx bx-bar-chart-alt"></i>  Analytic Events</h5>
      </div>
      <div class="card-body">
        <p>Analiza eventos analíticos para tomar decisiones informadas sobre tu negocio.</p>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="card-title m-0 me-2 fw-bold mb-2"><i class="bx bx-box"></i>  Productos</h5>
      </div>
      <div class="card-body">
        <p>Gestiona y analiza información relacionada con tus productos y su rendimiento.</p>
      </div>
    </div>
  </div>

  <div class="col-md-6 mb-4">
    <div class="card h-100">
      <div class="card-header">
        <h5 class="card-title m-0 me-2 fw-bold mb-2"><i class="bx bx-globe"></i>  Estadísticas del Mundo</h5>
      </div>
      <div class="card-body">
        <p>Explora estadísticas globales y obtén una visión general del estado del mundo.</p>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts@3.29.0/dist/apexcharts.min.js"></script>

{{-- Script de gráficos (si es necesario) --}}
<script>
  // Código para inicializar y configurar los gráficos (si es necesario)
  // ...
</script>

@endsection
