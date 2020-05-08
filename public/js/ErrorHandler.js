let ErrorHandler = function () {
    let root = this;

    let error;

    this.handle = (error) => {
        root.error = error;

        switch (error.status) {
            case 401:
                handler401();
                break;
            case 422:
                handler422();
                break;
            case 403:
                handler403();
                break;
            case 404:
                handler404();
                break;
            case 500:
                handler500();
                break;
            default:
                handler500();
                break;
        }
    };
    let handler401 = function () {
        if (root.error.data.message) {
            swal('Unauthorized', root.error.data.message, 'error');
        } else {
            swal('Unauthorized', "Request unauthorized.", 'error');
        }
    };

    let handler422 = function () {
        $.each(root.error.data.errors, (field, message) => {
            setTimeout(() => {
                ElementUI.Notification.error({
                    message: message[0],
                    showClose: false
                });
            }, 300);
        });
    };

    let handler403 = function () {
        ElementUI.Notification.error({
            title: 'Forbidden',
            message: 'Request unauthorized.'
        });
    };


    let handler404 = function () {
        if (root.error.data.message) {
            swal('Not Found!', root.error.data.message, 'error');
        } else {
            swal('Not Found!', "We couldn't find the requested resource.", 'error');
        }

    };

    let handler500 = function () {

        swal('Error', root.error.data.message, 'error');

    }
};