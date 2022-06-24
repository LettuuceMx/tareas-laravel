@extends('app')

@section('content')

<style>
    .color-container {
        width: 15px;
        height: 15px;
        border-radius: 5px;
    }
</style>

<div class="container w-25 border p-4 my-4">
    <div class="row mx-auto">
        <form action="{{route('categories.store') }}" method="POST">
            @csrf

            @if (session('success'))
            <h6 class="alert alert-success">{{ session('success') }}</h6>
            @endif

            @error('name')
            <h6 class="alert alert-danger">{{ $message }}</h6>
            @enderror

            <div class="mb-3">
                <label for="name" class="form-label">Nombre de la categoria</label>
                <input type="text" class="form-control" name="name">
            </div>

            <div class="mb-3">
                <label for="color" class="form-label">Color de la categoria</label>
                <input type="color" class="form-control" name="color">
            </div>

            <button type="submit" class="btn btn-primary">Crear nueva categoria</button>
        </form>

        <div>
            @foreach ($categories as $category)
            <div class="row py-1">
                <div class="col-md-9 d-flex align-items-center">
                    <a class="d-flex align-items-center gap-2" href="{{ route('categories.show',['category' => $category->id]) }}">
                        <span class="color-container" style="background-color: {{$category->color}};"></span>
                        {{ $category->name}}</a>
                </div>

                <div class="col-md-3 d-flex justify-content-end">
                    <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#modal-{{ $category->id }}">
                        Eliminar
                    </button>
                </div>
            </div>

            <!-- Modal -->
            <div class="modal fade" id="modal-{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            ¿Deseas eliminar la categoria <strong>{{$category->name}}</strong> ?
                            Al eliminar la categoria eliminaras las tareas que este relacionadas con <strong>{{$category->name}}</strong>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <form action="{{route('categories.destroy',['category' => $category->id])}}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>

@endsection