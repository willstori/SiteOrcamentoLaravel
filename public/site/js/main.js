/* MENU RESPONSIVO */
$(".mb-menu").click(function() {
    $(".hamburger").toggleClass("is-active");
    $("#full-menu").toggleClass('act');
    $(this).toggleClass('act');
});

/* CARREGAMENTO IMAGENS */
$(document).ready(function() {
    $('.lazy-img').each(function() {
        let item = $(this);
        if (isOnScreen(item)) {
            let foto = item.find('img');
            if (foto.attr('src') == undefined) {
                let url = foto.data('url');
                foto.attr('src', url);
            }
        }
    });

    $(document).on("scroll", function() {
        $('.lazy-img').each(function() {
            let item = $(this);
            if (isOnScreen(item)) {
                let foto = item.find('img');
                if (foto.attr('src') == undefined) {
                    let url = foto.data('url');
                    foto.attr('src', url);
                }
            }
        });
    });
});

function isOnScreen(element) {

    let win = $(window);
    let screenTop = win.scrollTop();
    let screenBottom = screenTop + window.innerHeight;
    let elementTop = element.offset().top;
    let elementBottom = elementTop + element.height();

    return elementBottom > screenTop && elementTop < screenBottom;
}

/* FIM CARREGAMENTO IMAGENS */

/* MAPA */

function criar_mapa(latitude, longitude, zoom) {

    var map = L.map('map').setView([latitude, longitude], zoom);

    map.scrollWheelZoom.disable();

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        // scrollWheelZoom: false,
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    return map;

}

function adicionar_marcador(mapa, latitude, longitude, texto) {

    var LeafIcon = L.Icon.extend({
        options: {
            iconSize: [32, 39]
        }
    });

    var greenIcon = new LeafIcon({
        iconUrl: 'assets/site/img/icon_map.png'
    });

    L.marker([latitude, longitude], {
        icon: greenIcon
    }).bindPopup(texto).addTo(mapa);

}
/* FIM MAPA */

/* MAIL SEND */

$(document).on('submit', '.form-mail', function() {
    var Form = $(this);
    var data = new FormData(Form[0]);
    $.ajax({
        url: Form.data('controller'),
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: 'POST',
        dataType: "JSON",
        processData: false,
        contentType: false,
        beforeSend: function(xhr) {
            Form.find('button').attr('disabled', true);
        },
        success: function(retorno) {

            Form.find('button').attr('disabled', false);

            Swal.fire(
                retorno.titulo,
                retorno.mensagem,
                retorno.tipo
            );

        }
    });
});

/* FIM MAIL SEND */