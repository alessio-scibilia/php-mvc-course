jQuery('.multilanguage-textbox-button')
    .off('click')
    .on('click', function() {
        let target = $(this).data('target');
        let code = $(this).data('code');
        $(`.multilanguage-textbox.multilanguage-textbox-${target}`).hide();
        $(`.multilanguage-textbox.multilanguage-textbox-${target}.multilanguage-textbox-${code}`).fadeIn();
    });