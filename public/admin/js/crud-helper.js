class CrudHelper {

    Remover(el) {
        Swal.fire({
            icon: 'info',
            title: 'Atenção',
            text: 'Você realmente deseja Excluir este Item?',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.isConfirmed) {
                const button = $(el);
                $.ajax({
                    type: "delete",
                    url: button.data('rota'),
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: {
                        id: button.data('id')
                    },
                    dataType: "json",
                    success: function(response) {
                        location.reload();
                    },
                    error: function(reject) {
                        var errors = JSON.parse(reject.responseText);
                        Swal.fire(errors.titulo, errors.mensagem, errors.tipo);
                    }
                });
            }
        });
    }

    Legenda(el) {
        const form = $(el).parents('form');
        $.ajax({
            type: "PATCH",
            url: form.data('rota'),
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: form.serialize(),
            dataType: "json",
            success: function(response) {
                if (response.tipo == "success") {
                    location.reload();
                }
            }
        });
    }

}

const crudHelper = new CrudHelper();

var lista = document.getElementsByClassName('ordenavel');

for (let i = 0; i < lista.length; i++) {
    Sortable.create(lista[i], {
        handle: '.handle',
        animation: 150,
        store: {
            set: function(sortable) {
                var order = sortable.toArray();
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url: lista[i].dataset.rota,
                    data: {
                        ordem: order
                    },
                    type: 'patch',
                    dataType: 'json'
                });
            }
        }
    });
}