@foreach ($categorias as $categoria)

    <li {!! isset($id_categoria) && $id_categoria == $categoria->id ? 'class="act"' : '' !!}>

       @if($categoria->subcategorias->isEmpty())
        <a href="{{route('produtos.categoria', ['categoria'=> $categoria->id, 'nome' => $categoria->slug])}}" class="second-color">{{ $categoria->nome }}</a>
       @else
        <a href="javascript:;" class="second-color dropdown">{{ $categoria->nome }}</a>

        <ul class="dl-submenu" {!! isset($id_categoria) && $id_categoria == $categoria->id ? 'style="display: block"' : '' !!}>

            @foreach ($categoria->subcategorias as $subcategoria)
            <li {!! isset($id_subcategoria) && $id_subcategoria == $subcategoria->id ? 'class="act"' : '' !!}>
                <a href="{{route('produtos.subcategoria', ['subcategoria' => $subcategoria->id, 'nome' => $subcategoria->slug])}}">
                    {{ $subcategoria->nome }}
                </a>
            </li>
            @endforeach

        </ul>

        @endif

    </li>

@endforeach
