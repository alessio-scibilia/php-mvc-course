jQuery('.ml-textbox-button')
    .off('click')
    .on('click', function() {
        let target = $(this).data('target');
        let code = $(this).data('code');
        $(`.ml-textbox.ml-textbox-${target}`).hide();
        $(`.ml-textbox.ml-textbox-${target}.ml-textbox-${code}`).fadeIn();
    });