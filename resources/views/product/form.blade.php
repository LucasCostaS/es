@extends('layouts.app')

@section('content')
<div class="page page-product page-form">

    <div class="container">
        
        @include('partials.alert')

        <form method="post" action="{{ url('product') }}" data-parsley-validate>

            @csrf
            @method($product->id ? 'PUT' : 'POST')

            <input type="hidden" name="id" value="{{ old('id', $product->id) }}" />
        
            <div class="card">
        
                <div class="card-header">
                    <div class="card-header-title">Formulário de produto</div>
                </div>

                <div class="card-body">
                    
                    <div class="md-form">
                        <input id="name" type="text" name="name" class="form-control" value="{{ old('name', $product->name) }}" required />
                        <label for="name">Nome</label>
                    </div>
    
                    <div class="row">
                        <div class="col-sm-6 col-xs-12">
                            <div class="md-form">
                                <input id="stock" type="number" name="stock" class="form-control" min="0" max="999" value="{{ old('stock', $product->stock) }}" required />
                                <label for="stock">Estoque</label>
                            </div>
                        </div>
                        <div class="col-sm-6 col-xs-12">
                            <div class="md-form">
                                <input id="min" type="number" name="min" class="form-control" min="0" max="999" value="{{ old('min', $product->min) }}" />
                                <label for="min">Quantidade mínima</label>
                            </div>
                        </div>
                    </div>
    
                </div>

                <div class="card-footer">
                    <a href="{{ url('/') }}" class="btn btn-light">Voltar</a>
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
        
            </div>

        </form>
        
    </div>

</div>
@endsection