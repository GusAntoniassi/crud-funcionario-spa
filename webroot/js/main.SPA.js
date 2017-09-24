function ajaxError(jqXHR, textStatus, errorThrown) {
    alert('Erro ao realizar a solicitação AJAX');
    if (typeof jqXHR !== 'undefined' && typeof textStatus !== 'undefined' && typeof errorThrown !== 'undefined') {
        console.error('jqXHR: ');
        console.error(jqXHR);
        console.error('textStatus: ');
        console.error(textStatus);
        console.error('errorThrown: ');
        console.error(errorThrown);
    }
    loading(false);
}

function loading(status) {
    $('.content-wrapper').toggleClass('loading', status);
}

function navegarPara(url) {
    var deferred = new $.Deferred();
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'html'
    })
    .done(function(html) {
        if (html) {
            $('#content-wrapper').html(html);
            // Se encontrar um menu com aquele link, deixar ele ativo
            var menuAtivar = $('ul.sidebar-menu a[href="' + url + '"]');
            if (menuAtivar.length) {
                $('.sidebar-menu li.active').removeClass('active');
                menuAtivar.closest('li').addClass('active');
            }
            window.history.pushState(document.title, document.title, this.url);
            deferred.resolve();
        } else {
            ajaxError();
            deferred.reject();
        }
    })
    .fail(function(jqXHR, textStatus, errorThrown) {
        ajaxError(jqXHR, textStatus, errorThrown);
        deferred.reject();
    });

    return deferred.promise();
}

function enviarForm($form) {
    var deferred = new $.Deferred();

    var action = $form.attr('action') || window.location.href;
    var method = $form.attr('method') || 'GET';

    loading(true);

    $.ajax({
        url: action,
        method: method,
        data: $form.serialize()
    }).done(function(data) {
        // Tenta converter os dados em JSON, se não conseguir então a resposta deve ser HTML
        try {
            var json = JSON.parse(data);
            var $alert = $('<section class="content-alert"><div class="alert alert-dismissible">' +
                '<button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>' +
                '<h4></h4></div></section>');

            switch (json.type) {
                case 'success':
                    $alert.find('.alert').addClass('alert-success').find('h4').html('<i class="icon fa fa-check"></i> ' + json.message);
                    break;
                case 'error':
                    $alert.find('.alert').addClass('alert-danger').find('h4').html('<i class="icon fa fa-times"></i> ' + json.message)
            }

            if (json.redirect) {
                navegarPara(json.redirect).done(function() {
                    $('#content-wrapper').prepend($alert);
                    loading(false);
                    deferred.resolve();
                });
            } else {
                $('#content-wrapper').prepend($alert);
                loading(false);
                deferred.resolve();
            }
            // Action vai retornar HTML direto no caso do formulário dos filtros
        } catch (e) {
            // Pegar a URL + parâmetros que não estiverem vazios
            var url = action;
            var params = '';
            $.each($form.serializeArray(), function(i, campo) {
                if (campo.value && !campo.name.startsWith('_')) {
                    params += encodeURIComponent(campo.name) + '=' + encodeURIComponent(campo.value);
                }
            });
            if (params) {
                url += '?' + params;
            }
            window.history.pushState(document.title, document.title, url);
            $('#content-wrapper').html(data);
            loading(false);
            deferred.resolve();
        }
    }).fail(function(jqXHR, textStatus, errorThrown) {
        ajaxError(jqXHR, textStatus, errorThrown);
        deferred.reject();
    });

    return deferred.promise();
}

$(function() {
    // Gerenciar cliques em links e divs com links
    $(document).on('click', 'a, [data-ajax]', function(e) {
        var $target = $(this);
        var href = '';
        // Pega o atributo href se for um link, o data-href se não for
        if ($target.is('a')) {
            href = $target.attr('href');
            // Se for uma página externa, deixar o link passar
            if ($target.attr('target') == '_blank') {
                return;
            } else {
                e.preventDefault();
                e.stopPropagation();
            }
        } else {
            href = $target.attr('data-href');
        }

        // Evitar dar loading em links de hash
        if (href == '#') {
            return false;
        }

        loading(true);
        navegarPara(href).always(function() {
            loading(false);
        });
    });

    // Gerenciar submissão de formulários
    $(document).on('submit', 'form', function(e) {
        var $form = $(this);

        enviarForm($form);

        e.preventDefault();
        e.stopPropagation();
        return false;
    });

    // Excluir o evento onclick padrão do cake -- o postLink do CakePHP não permite adicionar callback personalizado
    $(document).on('focusin', 'a:contains("Excluir")', function() {
        if ($(this).attr('onclick')) {
            $(this).removeAttr('onclick');
        }
    });

    // Gerenciar excluir
    $(document).on('click', 'a:contains("Excluir")', function(e) {
        var $form = $(this).siblings('form');
        enviarForm($form);
        e.preventDefault();
        e.stopPropagation();
        return false;
    })
});
