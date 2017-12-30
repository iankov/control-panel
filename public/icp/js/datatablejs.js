var DataTableJs = function(selector)
{
    var initCompleteCallback = false;

    this.selector = function(){
        return selector;
    };

    this.setInitCompleteCallback = function(callback){
        initCompleteCallback = callback;
    };

    var postReload = this.postReload = function (url, data, completeCallback) {
        $('#icp-loader').show();
        $.post(url, data)
            //success
            .done(function(data){
                if(data.message) {
                    Icp.alert(data.message, 'success');
                }
            })
            //error
            .fail(function(xhr, status, error) {
                var data = xhr.responseJSON;
                if(data.message) {
                    Icp.alert(data.message, 'danger');
                }
            })
            .always(function(){
                $(selector).DataTable().ajax.reload(completeCallback, false);
                $('#icp-loader').hide();
            });
    };

    var initComplete = this.initComplete = function (settings, json) {
        initCompleteCallback();

        $(selector + ' [data-action]').each(function () {
            $(this).unbind('click');
            $(this).click(function () {
                var method = $(this).data('method');
                var action = $(this).data('action');
                var token = Icp.token();
                switch (method) {
                    case 'PUT':
                        postReload(action, {
                            _method: method,
                            _token: token
                        }, initComplete);
                        break;
                    case 'DELETE':
                        if (confirm('Are you sure to DELETE this item?')) {
                            postReload(action, {
                                _method: method,
                                _token: token
                            }, initComplete);
                        }
                        break;

                    case 'GET':
                    default:
                        document.location.href = action;
                        break;
                }
            });
        })
    };
};