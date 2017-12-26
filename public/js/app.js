var Icp = {
    token: function(token){
        if(token === undefined){
            return $('meta[name=csrf_token]').attr('content');
        }else {
            $('meta[name=csrf_token]').attr('content', token);
        }
    },

    iCheck: function (selector) {
        $(selector).iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' // optional
        });
    },
    //assign primary checkbox to check/uncheck all slaves
    assignCheckAll: function(primary, slaves){
        this.iCheck(primary);
        $(primary).on('ifChecked', function(event) {
            $(slaves).iCheck('check');
        });
        $(primary).on('ifUnchecked', function(event) {
            $(slaves).iCheck('uncheck');
        });
    },

    alert: function(message, type){
        if(!type){
            type = 'default';
        }

        var types = ['default', 'info', 'success', 'warning', 'danger'];

        if(types.indexOf(type) != -1) {
            for (var i = 0; i < types.length; i++) {
                $('#modal-alert').removeClass('modal-'+types[i]);
            }

            $('#modal-alert').addClass('modal-' + type);
        }

        $('#modal-alert .modal-body').html(message);
        $('#modal-alert').modal();
    },

    /*confirm: function(message, yesCallback, noCallback){
        $('#modal-alert').removeClass('modal-default').addClass('modal-warning');
        $('#modal-alert .modal-body').html(message);
        $('#modal-alert').modal();

        $('#modal-alert .btn-yes').click(function(){
            $('#modal-alert').modal('hide');
            yesCallback();
        });

        $('#modal-alert .btn-no').click(function(){
            $('#modal-alert').modal('hide');
            noCallback();
        });
    }*/

};