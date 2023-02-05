$('.category-list_item').on('click', function() {
    $('.category-list_item').removeClass('active');
    $(this).addClass('active');

    $.ajax({
        type: 'POST',
        url: '/wp-admin/admin-ajax.php',
        dataType: 'html',
        data: {
            action: 'filter_posts',
            category: $(this).data('slug'),
            type: $(this).data('type'),
        },
        success: function(res) {
            $('.container').html(res);
        },
        error: function(res) {
            console.warn(res);
        }
    });
});
