@extends('layouts.app')

@section('content')
<div class="page page-dashboard">

    <div class="container">

        @include('partials.alert')

        <div class="page-header">
            <h3>Listagem de produtos</h3>
            <span>Gerencie os produtos cadastrados</span>
        </div>

        <div class="card">

            <div class="card-header">

                @php
                    $search = Request::get("search");
                    $filter = Request::get("filter");
                @endphp

                <form method="get" action="">

                    <div class="row">
                        <div class="col-sm-8 col-xs-12">
                            <div class="form-group search-wrapper">
                                <input type="text" name="search" class="form-control" placeholder="Pesquise por produtos..." value="{{ $search }}" />
                            </div>
                        </div>
                        <div class="col-sm-4 col-xs-12">
                            <div class="form-group">
                                <select name="filter" class="form-control">
                                    <option value="">Exibir todos</option>
                                    <option value="1" {{ $filter == 1 ? 'selected' : ''}}>Exibir qtde > min</option>
                                    <option value="2" {{ $filter == 2 ? 'selected' : ''}}>Exibir qtde < min</option>
                                </select>
                            </div>
                        </div>
                    </div>

                </form>

            </div>

            <div class="card-body">

                @if (count($products) > 0)

                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Estoque</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($products as $p)
                                <tr class="{{ $p->min && $p->stock <= $p->min ? 'danger' : '' }}">
                                    <td class="name-td">{{ $p->name }}</td>
                                    <td class="stock-td"><span class="stock">{{ $p->stock }}</span>@if ($p->min)<small> / {{ $p->min }}</small>@endif</td>
                                    <td>
                                        {{--<button type="button" class="btn btn-sm btn-icon btn-stock" title="Alterar estoque"><i class="fas fa-shopping-cart"></i></button>--}}
                                        <a href="{{ url('product/'.$p->id.'/edit') }}" class="btn btn-sm btn-icon"><i class="fas fa-pen" title="Alterar produto"></i></a>
                                        <button type="button" data-id="{{ $p->id }}" data-url="{{ url('product') }}" class="btn btn-sm btn-icon btn-delete" title="Remover produto"><i class="fas fa-trash"></i></button>
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                        </table>
                    </div>

                @else
                    <div class="obs">Nenhum produto foi encontrado.</div>
                @endif

            </div>

            <div class="card-footer">

                @php
                    $pagination = $products->appends(Request::except('page'))->links();
                @endphp

                @if ($pagination)
                    <div class="pagination-wrapper">{{ $pagination }}</div>
                @endif

                <div class="controls">
                    <a href="" class="btn btn-primary">Novo produto</a>
                </div>

            </div>

        </div>

    </div>

</div>
@endsection