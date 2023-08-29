$(document).on('blur', '*[form="search"]', function () {
    if($(this).val() !== ''){
        $('#search').submit();
    }
});

$(document).ready(function() {
    const clearButtons = $(".titleClear, .descriptionClear, .priceClear, .categoryClear, .authorClear");

    clearButtons.on("click", function() {
        const input = $(this).closest('div').find('input');
        input.val('');
        $('#search').submit();
    });
});
