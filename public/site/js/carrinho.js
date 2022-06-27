/*


################             Atenção!           #########################

Para utilizar esta classe devem ser adicionados os seguintes atributos no html do seu carrinho:

    - data-id="id" Atributo que representará o produto do seu carrinho
    - subtotal Atributo para identificar onde deve ser renderizado o Subtotal calculado
    - total Atributo Atributo para identificar onde deve ser renderizado o Total calculado

Um exemplo fictício da estrutura do seu html com os atributos:

    <div>
        <!-- Primeira linha do carrinho -->
        <div  data-id="1" >  <-- Aqui vai o data-id
            <img src="img_do_seu_produto" />

            <h6>Nome do produto</h6>

            <div>
                <button onclick="carrinho.Incrementar(this)">+</button>
                <input type="text" value="1">
                <button onclick="carrinho.Decrementar(this)">-</button>
            </div>

            <div>
                <p subtotal >R$ 1000,00</p> <-- Aqui vai o subtotal
            </div>

            <div>
                <a href="javascript:;" onclick="carrinho.Remover(this)">X</a>
            </div>
        </div>

        <!-- Segunda linha do carrinho -->
        <div  data-id="1" >  <-- Aqui vai o data-id
            <img src="img_do_seu_produto" />

            <h6>Nome do produto</h6>

            <div>
                <button onclick="carrinho.Incrementar(this)">+</button>
                <input type="text" value="1">
                <button onclick="carrinho.Decrementar(this)">-</button>
            </div>

            <div>
                <p subtotal >R$ 1000,00</p> <-- Aqui vai o subtotal
            </div>

            <div>
                <a href="javascript:;" onclick="carrinho.Remover(this)">X</a>
            </div>
        </div>

        <!-- Outras linhas -->
        .
        .
        .
    </div>
    .
    .
    .
    <div total>
        R$ 5000,00
    </div>

*/

class Carrinho {

    constructor(corBotaoContinuarComprando = "#000", corBotaoIrParaCarrinho = "#d20c11") {
        this.corBotaoContinuarComprando = corBotaoContinuarComprando;
        this.corBotaoIrParaCarrinho = corBotaoIrParaCarrinho;
    }

    Adicionar(el) {

        const confirmButtonColor = this.corBotaoContinuarComprando;
        const cancelButtonColor = this.corBotaoIrParaCarrinho;

        $.ajax({
            type: "POST",
            url: "carrinho/adicionar",
            data: { id: $(el).data('id') },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "html",
            success: function() {

                Swal.fire({
                    width: '600px',
                    html: '<p>Você adicionou este produto ao carrinho.<br>O que deseja fazer agora?</p>',
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonColor: confirmButtonColor,
                    cancelButtonColor: cancelButtonColor,
                    confirmButtonText: 'Continuar comprando!',
                    cancelButtonText: 'Ir para o carrinho!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        location.reload();
                    } else {
                        window.location.href = "carrinho";
                    }
                });
            }
        });
    }

    Incrementar(el) {

        const linha = $(el).parents('[data-id]');

        const inputVal = linha.find('input').val();

        if (isNaN(inputVal)) {

            var quantidade = 1;

        } else {

            var quantidade = parseInt(inputVal) + 1;
        }

        this.Enviar(linha, quantidade);
    }

    Decrementar(el) {

        const linha = $(el).parents('[data-id]');

        const inputVal = linha.find('input').val();

        if (isNaN(inputVal)) {

            var quantidade = 1;

        } else {

            var quantidade = parseInt(inputVal) - 1;
        }

        this.Enviar(linha, quantidade);
    }

    Editar(el) {

        const linha = $(el).parents('[data-id]');

        const inputVal = linha.find('input').val();

        if (isNaN(inputVal)) {

            var quantidade = 1;

        } else {

            var quantidade = parseInt(inputVal);
        }

        this.Enviar(linha, quantidade);
    }

    Remover(el) {

        const linha = $(el).parents('[data-id]');

        $.ajax({
            type: "DELETE",
            url: "carrinho/remover",
            data: { id: linha.data('id') },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function() {
                location.reload();
            }
        });
    }

    Enviar(linha, quantidade) {

        $.ajax({
            type: "PATCH",
            url: "carrinho/alterar",
            data: { id: linha.data('id'), quantidade: quantidade },
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function(response) {

                linha.find('input').val(response.quantidade);

                if (response.numeroItens > 1) {

                    $('[numeroItens]').text(response.numeroItens + " itens");

                } else {

                    $('[numeroItens]').text(response.numeroItens + " item");

                }

            },
            error: function() {
                linha.find('input').val(1);
            }
        });

    }
}