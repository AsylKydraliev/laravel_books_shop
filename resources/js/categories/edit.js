$(document).ready(function () {
    function addBookRow() {
        let title = $("#book_title").val();
        let description = $("#book_description").val();
        let price = $("#book_price").val();
        let author = $("#book_author").val();

        if (!title || !description || !price || !author) {
            return alert('Заполните все обязательные поля!');
        }
        const optionData = [];
        $('#book_author option').each(function() {
            let value = $(this).val();
            let text = $(this).text();

            let option = '<option value="'+ value +'">'+ text +'</option>';
            optionData.push(option);
        });

        let newRow = '<tr class="book-row">' +
            '<th scope="row"></th>' +
            `<td><input class="form-control" type="text" name="book_title[]"></td>` +
            `<td><textarea class="form-control" name="book_description[]" cols="70" rows="3"></textarea></td>` +
            '<td><input class="form-control" type="number" name="book_price[]"></td>' +
            '<td>' +
            '<select class="form-select" name="book_author[]" aria-label="author">' +
            '<option value="" disabled selected>Select author</option>' +
            optionData +
            '</select>' +
            '</td>' +
            '<td>' +
            '<input type="hidden" name="book_ids[]"' +
            '<button class="btn btn-light delete-book">' +
            '<i class="bi bi-trash fs-5"></i>' +
            '</button>' +
            '</td>' +
            '</tr>';

        $('tbody').append(newRow);

        let currentRow = $('tbody tr:last');

        currentRow.find('input[name="book_ids[]"]').val(0);
        currentRow.find('input[name="book_title[]"]').val(title);
        currentRow.find('textarea[name="book_description[]"]').val(description);
        currentRow.find('input[name="book_price[]"]').val(price);
        currentRow.find('select[name="book_author[]"]').val(author);

        $("#book_title").val('');
        $("#book_description").val('');
        $("#book_price").val('');
        $("#book_author").val('');
    }

    $('.add-book').click(function () {
        addBookRow();
    });

    $(document).on('click', '.delete-book', function () {
        let rowToDelete = $(this).closest(".book-row");
        rowToDelete.remove();
    });
});
