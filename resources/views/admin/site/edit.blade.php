@extends('admin.layout.base')

@section('titulo', 'Site')

@section('caminho')

    <li class="breadcrumb-item"><a href="{{ route('admin.inicio') }}"><i class="fa fa-home fa-lg"></i> Início</a></li>
    <li class="breadcrumb-item"><a href="javascript:;">Site</a></li>
    <li class="breadcrumb-item active">Editar</li>

@endsection

@section('conteudo')

    <div class="col-12">

        <div class="tile">

            <h3>Editar</h3>

            <hr />

            <ul class="nav nav-tabs mb-3">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="javascript:;">Dados</a>
                </li>
            </ul>

            <form class="row g-3" action="{{ route('admin.site.update', $site->id) }}" method="post">

                @csrf

                @method("PUT")

                <div class="form-group col-md-6">
                    <label for="keywords" class="form-label">Keywords</label>
                    <textarea id="keywords" name="keywords" class="form-control @error('keywords') is-invalid @enderror" rows="10">{{ $site->keywords }}</textarea>
                    @error('keywords')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6">
                    <label for="description" class="form-label">Description</label>
                    <textarea id="description" name="description" class="form-control @error('description') is-invalid @enderror" rows="10">{{ $site->description }}</textarea>
                    @error('description')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6 @error('facebook') has-danger @enderror">
                    <label for="facebook" class="form-label">Facebook</label>
                    <input id="facebook" class="form-control @error('facebook') is-invalid @enderror" type="text" name="facebook"
                        value="{{ $site->facebook }}">
                    @error('facebook')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6 @error('instagram') has-danger @enderror">
                    <label for="instagram" class="form-label">Instagram</label>
                    <input id="instagram" class="form-control @error('instagram') is-invalid @enderror" type="text" name="instagram"
                        value="{{ $site->instagram }}">
                    @error('instagram')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-6 @error('email') has-danger @enderror">
                    <label for="email" class="form-label">E-mail</label>
                    <input id="email" class="form-control @error('email') is-invalid @enderror" type="text" name="email"
                        value="{{ $site->email }}">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-3 @error('whatsapp') has-danger @enderror">
                    <label for="whatsapp" class="form-label">Whatsapp</label>
                    <input id="whatsapp" class="form-control @error('whatsapp') is-invalid @enderror" type="text" name="whatsapp"
                        value="{{ $site->whatsapp }}">
                    @error('whatsapp')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-3 @error('telefone') has-danger @enderror">
                    <label for="telefone" class="form-label">Telefone</label>
                    <input id="telefone" class="form-control @error('telefone') is-invalid @enderror" type="text" name="telefone"
                        value="{{ $site->telefone }}">
                    @error('telefone')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="endereco" class="form-label">Endereço</label>
                    <textarea id="endereco" name="endereco" class="form-control @error('endereco') is-invalid @enderror" rows="5">{{ $site->endereco }}</textarea>
                    @error('endereco')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-12 @error('mapa') has-danger @enderror">
                    <label for="mapa" class="form-label">Mapa</label>
                    <input id="mapa" class="form-control @error('mapa') is-invalid @enderror" type="text" name="mapa"
                        value="{{ $site->mapa }}">
                    @error('mapa')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group col-md-12">
                    <label for="codigos_terceiros" class="form-label">Códigos de Terceiros</label>
                    <textarea id="codigos_terceiros" name="codigos_terceiros" class="form-control @error('codigos_terceiros') is-invalid @enderror" rows="5">{{ $site->codigos_terceiros }}</textarea>
                    @error('codigos_terceiros')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="col-12"><hr></div>

                <div class="col-12 d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary btn-lg mx-1">Alterar</button>
                    <button type="button" class="btn btn-secondary btn-lg mx-1"
                        onclick="javascript:history.back()">Voltar</button>
                </div>

            </form>

        </div>

    </div>
@endsection

@section('pageScripts')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                title: "Sucesso!",
                text: "{{ session('success') }}",
                timer: 3000
            });
        </script>
    @endif
@endsection
