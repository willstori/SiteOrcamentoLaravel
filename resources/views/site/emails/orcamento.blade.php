<meta charset="utf-8" />
<table cellspading="0" cellspacing="0" border="0" width="100%" style="font-family:Verdana,Arial,sans-serif;font-size:14px;color:#555;max-width:800px;">
    <tr>
        <td>
            <span style="text-align:center;width:100%;display:table;">{{$Assunto}}</span>
            <ul style="list-style:none;width:100%;display:flex;flex-wrap:wrap;justify-content:space-between;margin:0px;padding:0px;margin-top:15px;margin-bottom:15px">
                @foreach ($Formulario as $key => $value)
                @if(!empty($value))
                    <li style="width:46.5%;background:#eee;border:2px solid #fff;display:table;padding:10px;"><span><strong>{{$key}}:</strong> {{$value}}</span></li>
                @endif
                @endforeach
            </ul>
            @if(isset($Formulario['mensagem']) && !empty($Formulario['mensagem']))
            <span style="text-align:center;width:100%;display:table;">Mensagem:</span>
            <ul style="list-style:none;width:100%;display:flex;flex-wrap:wrap;justify-content:space-between;margin:0px;padding:0px;margin-top:15px;margin-bottom:15px">
                <li style="width:100%;background:#eee;border:2px solid #fff;display:table;padding:20px;"> <span>{!! nl2br($Formulario['mensagem'])!!}</span></li>
            </ul>
            @endif
        </td>
    </tr>
</table>
<span style="text-align:center;width:100%;display:table; font-family:Verdana,Arial,sans-serif;font-size:14px;color:#555;max-width:800px;margin: 30px 0px">Itens do orçamento:</span>

<table cellspading="0" cellspacing="0" border="0" width="100%" style="font-family:Verdana,Arial,sans-serif;font-size:14px;color:#555;max-width:800px;">
    <tr>
        <th>Código</th>
        <th>Nome</th>
        <th>Quantidade</th>
        <th>Valor</th>
    </th>
    @foreach ($Carrinho as $item)
    <tr>
        <td style="background:#eee;border:2px solid #fff;padding:10px;">{{$item['produto']->codigo}}</td>
        <td style="background:#eee;border:2px solid #fff;padding:10px;">{{$item['produto']->nome}}</td>
        <td style="background:#eee;border:2px solid #fff;padding:10px;">{{$item['quantidade']}}</td>
        <td style="background:#eee;border:2px solid #fff;padding:10px;">{{$item['produto']->valor > 0 ? "R$ " . moedaBr($item['produto']->valor) : "Consulte"}}</td>
    </tr>
    @endforeach
</table>
