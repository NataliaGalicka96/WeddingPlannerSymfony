
window.onload = validateTask();

function validateTask() {
    $(document).ready(function () {

        $('#checkListForm').validate({
            rules: {
                category: {
                    required: true,
                    //  minlength: 3,
                    //  maxlength: 100,


                },
                title: {
                    required: true,
                    minlength: 10,
                    maxlength: 100,

                }
            },
            messages: {

                title: {
                    required: 'Proszę wybrać kategorię.',
                    // minlength: "Nazwa kategorii musi składać się z conajmniej 3 znaków.",
                    // maxlength: "Nazwa kategorii może składać się z maksymalnie 100 znaków",
                },
                content: {
                    required: 'Proszę wpisać treść zadania.',
                    minlength: "Treść zadania musi składać się z conajmniej 10 znaków.",
                    maxlength: "Treść zadania może składać się z maksymalnie 100 znaków",
                },

            },

            errorPlacement: function (error, element) {

                if (element.attr('name') == 'category') {
                    error.appendTo('.categoryError');
                }

                if (element.attr('name') == 'title') {
                    error.appendTo('.titleError');
                }


            }
        });

    });

}

