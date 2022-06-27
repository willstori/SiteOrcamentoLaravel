/**
 * Valid Mail - jQuery Plugin
 * Manages the validation of fields in forms
 * 
 * Copyright (c) 2015 Reinaldo "Ramon" JosÃ© Nunes
 * 
 * Version: 2.0 (02/03/2017)
 * Requires: jQuery v1.12+
 * 
 * Dual licensed under GPL and MIT:
 *   http://www.gnu.org/licenses/gpl.html
 *   http://www.opensource.org/licenses/mit-license.php
 */
(function ($) {
    $('body').prepend('<div class="alert_content_full"><section class="alert_content_box"><div class="alert_data"><figure class="alert_icon"></figure><div class="alert_loader"></div><p class="alert_response"></p></div><button class="alert_close"></button></section></div>');
    $(".alert_close").click(function(){
        $(".alert_content_full").removeClass("show");
        //$(".alert_icon").removeClass("error");
        //$(".alert_icon").removeClass("success");
        $(".focus").focus();
    });
    $(document).keyup(function(e) {
        if (e.keyCode == 27) { // escape key maps to keycode `27`
            $(".alert_content_full").removeClass("show");
            $(".focus").focus();
        }
    });
    $.fn.validMail = function (options) {
        // DefiniÃ§Ã£o dos valores padrÃµes
        var defaults = {
            'form': 'form-login', /* Form send data */
            'action': 'form_post.php', // To send the form data
            'attribute': 'placeholder', // Attribute Validation
            'check': '', // Whether or not to validate checkbox
            'checkMessage': 'Concorde com os Temos para prosseguir.', // Checkbox default message.
            'display': '.alert_response', // Display default message
            'fileType': '', // type of File
            'input': '.input-panel', // Field ID
        };

        // Plugin Settings
        var settings = $.extend({}, defaults, options);

        $(this).on("click", function () {
            var vazio = 0;
            var filtro = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;


            //Analyzes each of the input received
            $(settings.input).each(function () {
                var idCampo = $(this).attr(settings.attribute);
                var valueCampo = $(this).val();
                
                if (valueCampo == "") {	//if the field is empty
                    // Standart message field
                    $(settings.display).html("O campo <strong>" + idCampo + "</strong> está vazio.");
                    $(".alert_icon").addClass("warning");
                    $(".alert_content_full").addClass("show");
                    $(this).addClass("focus");
                    $("#loading_page").addClass("show");
                    vazio++;
                    return false;
                }

                /* E-mail validation */
                if(this.hasAttribute('valid-mail')){
                    if (!filtro.test($(this).val())) {
                        $(settings.display).html("O campo <strong>" + idCampo + "</strong> está vazio.");
                        $(".alert_icon").addClass("warning");
                        $(".alert_content_full").addClass("show");
                        vazio++;
                        return false;
                    }
                }

/*
                if(this.hasAttribute('valid-phone')){
                    if($(this).val() != ''){
                        $(settings.display).html("O campo <strong>" + idCampo + "</strong> está vazio.");
                        $(".alert_icon").addClass("warning");
                        $(".alert_content_full").addClass("show");
                        vazio++;
                        return false;
                    }
                }
                */

                // if the field is of type File
                if (idCampo == 'Arquivo') { //Change the value of this field to match the placeholder of your form
                    if (settings.fileType != '') {
                        var arquivo = $("#arquivo").val();

                        if ((arquivo.split(".")[1].toLowerCase() != settings.fileType)) {
                            $(settings.display).html("Anexe somente formatos de arquivos do tipo <strong>." + settings.fileType + "</strong>.");
                            $(".alert_icon").addClass("warning");
                            $(".alert_content_full").addClass("show");
                            vazio++;
                            return false;
                        }
                    }
                }

                // If you have password field and Confirm Password
                if (idCampo == 'Confirme a senha:') {
                    var campo_senha = $("#password").val();
                    var campo_confirma = $("#repassword").val();
                    if (campo_confirma != campo_senha) {
                        console.info(campo_confirma + ' - ' + campo_senha);
                        $(settings.display).html("O campo <strong>" + idCampo + "</strong> não é igual ao campo <strong>Senha</strong>.");
                        $(".alert_icon").addClass("warning");
                        $(".alert_content_full").addClass("show");
                        vazio++;
                        return false;
                    }
                }



                // CPF Validation
                if (idCampo == 'CPF:') {
                    var c = $(this).val();
                    c = c.replace(/[^\d]+/g, '');
                    var cpf = c;
                    var i;
                    var s;
                    s = c;
                    c = s.substr(0, 9);
                    var dv = s.substr(9, 2);
                    var d1 = 0;
                    var v = false;

                    if (cpf == '11111111111' || cpf == '22222222222' || cpf == '33333333333' || cpf == '44444444444' || cpf == '55555555555' || cpf == '66666666666' || cpf == '77777777777' || cpf == '88888888888' || cpf == '99999999999' || cpf == '00000000000') {
                        '11111111111'

                        $(settings.display).html("Número <strong>CPF</strong> inválido.");
                        $(".alert_icon").addClass("warning");
                        $(".alert_content_full").addClass("show");

                        vazio++;
                        v = true;
                        return false;
                    } else {
                        for (i = 0; i < 9; i++) {
                            d1 += c.charAt(i) * (10 - i);
                        }

                        if (d1 == 0) {
                            $(settings.display).html("Número <strong>CPF</strong> inválido.");
                            $(".alert_icon").addClass("warning");
                            $(".alert_content_full").addClass("show");
                            vazio++;
                            v = true;
                            return false;
                        }
                        d1 = 11 - (d1 % 11);
                        if (d1 > 9)
                            d1 = 0;
                        if (dv.charAt(0) != d1) {
                            $(settings.display).html("Número <strong>CPF</strong> inválido.");
                            $(".alert_icon").addClass("warning");
                            $(".alert_content_full").addClass("show");
                            v = true;
                            vazio++;
                            $(this).focus();
                            return false;
                        }

                        d1 *= 2;
                        for (i = 0; i < 9; i++) {
                            d1 += c.charAt(i) * (11 - i);
                        }
                        d1 = 11 - (d1 % 11);
                        if (d1 > 9)
                            d1 = 0;
                        if (dv.charAt(1) != d1) {
                            vazio = 0;
                            v = true;
                            return true;
                        }
                    }
                    return true;
                } // end cpf validation
            });

            // If you have no errors in key fields, check if there are any checkbox to mark
            if (vazio == 0) {
                if (settings.check != "") {
                    var checkbox = settings.check;
                    if ($(checkbox).is(':checked')) {
                        vazio = 0;
                    } else {
                        $(settings.display).html(settings.checkMessage);
                        $(settings.display).html("O campo <strong>" + idCampo + "</strong> está vazio.");
                        $(".alert_icon").addClass("warning");
                        $(".alert_content_full").addClass("show");
                        vazio++;
                        return false;
                    }
                }
            }

            // if there is no error in the validation, run the submit form
            if (vazio == 0) {
                $(".alert_content_full").addClass("show");
                $(".alert_close").hide();
                $(".alert_response").html("Aguarde um momento...");
                $(".alert_icon").css("display", "none");
                $(".alert_loader").html('<div class="spinner"><div class="bounce1"></div><div class="bounce2"></div><div class="bounce3"></div></div>');

                setTimeout(function () {

                    //$(settings.form).attr("action", settings.action).submit();
                    var dados = new FormData($(settings.form)[0]);
                    $.ajax({
                        url: settings.action,
                        data: dados,
                        type: 'POST',
                        dataType: 'HTML',
                        processData: false,
                        contentType: false,
                        success: function (resposta) {
                            
                            if (resposta != 'xxx1xxx') {
                                $(".alert_loader").html("");
                                $(".alert_icon").css("display", "table");
                                $(".alert_icon").addClass("error");
                                $(".alert_close").show();
                                $(settings.display).html("Sua mensagem não pode ser enviada. Tente novamente.");
                            } else {
                                $(".alert_loader").html("");
                                $(".alert_icon").css("display", "table");
                                $(".alert_icon").addClass("success");
                                $(".alert_close").show();
                                $(settings.display).html("Mensagem enviada com sucesso. Em breve entraremos em contato!");
                                $(settings.form).trigger('reset');
                                
                                //se tiver fancybox modal 
                                //$('.fancybox-close-small').click();
                            }
                        }
                    });
                }, 3000);
            }
        });
    }
})(jQuery);