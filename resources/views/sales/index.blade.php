@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Productos</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Crear anuncio
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    @if($sales->isEmpty())
    <div class="alert alert-warning text-center">
        <i class="fas fa-info-circle"></i> No hay productos registrados. Disculpen las molestias.
    </div>
    @else
        <div class="row g-4">
            @foreach($sales as $sale)
                <div class="col-md-4">
                    <div class="card h-100 shadow-sm">
                    <div class="position-relative">
                        @if($sale->images->isNotEmpty())
                            <img src="{{ asset('storage/' . $sale->images->first()->route) }}" 
                                class="card-img-top" 
                                style="height: 200px; object-fit: cover;" 
                                alt="{{ $sale->product }}">
                        @else
                            <img src="{{ asset('images/default-thumbnail.jpg') }}" 
                                class="card-img-top" 
                                style="height: 200px; object-fit: cover;" 
                                alt="Sin imagen">
                        @endif
                        
                        <span class="position-absolute top-0 end-0 badge bg-primary m-2">
                            {{ $sale->category->name }}
                        </span>

                        @if($sale->isSold)
                            <div class="position-absolute top-0 start-0 w-100 h-100 d-flex align-items-center justify-content-center" 
                                style="background-color: rgba(0,0,0,0.5);">
                                @if($sale->purchases->where('user_id', Auth::id())->count() > 0)
                                    <span class="badge bg-success fs-4 p-2">COMPRADO</span>
                                @else
                                    <span class="badge bg-success fs-4 p-2">VENDIDO</span>
                                @endif
                            </div>
                        @endif
                    </div>
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{ $sale->product }}</h5>
                            <p class="card-text text-truncate">{{ $sale->description }}</p>
                            <h6 class="text-primary">€{{ number_format($sale->price, 2, ',', '.') }}</h6>
                        </div>
                        <div class="card-footer bg-transparent border-top-0">
                            <div class="d-grid">
                                <a href="{{ route('sales.show', $sale->id) }}" 
                                   class="btn btn-outline-primary">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection