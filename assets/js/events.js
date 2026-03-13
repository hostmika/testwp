jQuery(function ($) {

    $(document).on('click', '.events-loadmore', function () {
        
        var $btn   = $(this);
        var $list  = $('.events-list');
        var page   = parseInt($list.data('page')) + 1;
        var genre  = $list.data('genre');

        $btn.text('Chargement...').prop('disabled', true);

        $.post(testwpAjax.url, {
            action: 'testwp_loadmore',
            nonce:  testwpAjax.nonce,
            page:   page,
            genre:  genre,
        })
        .done(function (res) {
            if (res.success) {
                $list.append(res.data.html);
                $list.data('page', page);

                if (!res.has_more) {
                    $btn.closest('.events-loadmore-wrap').remove();
                } else {
                    $btn.text('Voir plus').prop('disabled', false);
                }
            }
        })
        .fail(function () {
            $btn.text('Erreur, réessayer').prop('disabled', false);
        });
    });

});