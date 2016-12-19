$(document).ready(function() {
    //submit logout
	$('#logout-submit').on('click', function(event) {
		event.preventDefault();
		$("#form-logout").submit();
	});

    //submit delete user
    $('#delete-user').on('click', function(event) {
        event.preventDefault();
        $("#form-delete-user").submit();
    });

    //submit form edit
    $('.container').on('click', '.action-edit-words', function () {
        $('.ctz-form').submit();
    });

    //handle relation ship user
    $('.section-user').on('click', '.action-relationship-user', function () {
        var $this = $(this);
        var urlAjax = $this.parent().data('url-user');

        var textRepalce = $this.attr('data-trans').trim();
        var textCurrent = $this.text().trim();

        $.ajax({
            url: urlAjax,
            type: "get",
            datatype: "json",
            success : function (data) {
                if (data.status) {
                    if (data.option == 'add') {
                        $this.removeClass('btn-default')
                            .addClass('btn btn-success')
                            .attr('data-trans', textCurrent)
                            .text(textRepalce);
                    } else {
                        $this.removeClass('btn-success')
                            .addClass('btn btn-default')
                            .attr('data-trans', textCurrent)
                            .text(textRepalce);
                    }
                }
            },
        })
    });

    //Show model Edit Word + Answer
    $('.edit-word').click(function () {
        $this = $(this);
        var urlAjaxEditWord = $this.data('url-ajax');
        $.ajax({
            url: urlAjaxEditWord,
            type: "get",
            datatype: "html",
            success : function (data) {
               $('#wrapper-model').text('').append(data);
               $('#word-edit-model').modal('show');
            },
        })
    });
    //uncheck-other-checkbox-on-one-checked
    $('.container').on('change', 'input[type=checkbox]', function () {
        $('input[type=checkbox]').not(this).prop('checked', false);
    });

    //Apend New Answer For Word
    var indexAnswer = 1;
    $('.container').on('click', '#add-answer', function () {
        var formAddAnswer  = '<div class="form-group">'
            + '<label for="word" class="col-sm-2 control-label">'
            + 'Answer </label> <div class="col-sm-10">'
            + '<input type="text" name="answer[add_new' + indexAnswer + '][content]" class="form-control">'
            + '<span class="glyphicon glyphicon-trash form-control-feedback delete-answer"></span>'
            + '<input type="checkbox" name="answer[add_new' + indexAnswer + '][is_correct]" value="1">'
            + '</div></div>';
        $(".group-answer").append(formAddAnswer);
        indexAnswer++;
    });

    //remove answer
    $('.container').on('click', '.delete-answer', function () {
        $(this).closest('.form-group').remove();
    });

    //infine for page colletion users
    var page = 2; //int page next
    $(window).scroll(fetchUser);

    function fetchUser() {
        //clear time out
        clearTimeout($.data(this, 'scrollCheck'));

        //set data for scrollCheck
        $.data(this, 'scrollCheck', setTimeout(function () {
            var scrollPositionForFetch = $(window).height() + $(window).scrollTop();

            //trigger when scroll with condition
            if (scrollPositionForFetch >= $(document).height()) {
                $.ajax({
                    url: '?page=' + page,
                    type: "get",
                    datatype: "json",
                    beforeSend: function () {
                        $('.loading').show();
                    },
                    success : function (data) {
                        page++;
                        $('.loading').hide(); //hide loading animation once data is received
                        $('.section-user').append(data.users); //append data into .section-user
                    },
                })
            }
        }), 300);
    }

});

