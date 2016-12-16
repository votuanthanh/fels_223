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

