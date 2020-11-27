$(function () {
    const newInput = $('input[name="new_todo"]');
    const newUrl = '/api/new/';
    const listUrl = '/api/list/';

    // hide toolbar
    setTimeout(scrollTo, 0, 0, 1);

    function getNewContent() {
        return newInput.val();
    }

    function refreshList() {
        fetch(listUrl, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json'
            },
        }).then((response) => {
            response.json().then((result) => {
                console.log(todoListTpl(result.data));
            });
        });
    }

    function todoListTpl(list) {
        let ret = "<ul>";
        for (const item of list) {
            let li = "<li>";
            li += '<a class="todo-number" href="javascript:void(0);">' + item['id'] + '</a>';
            li += item['content'];
            li += "</li>";
            ret += li;
        }
        ret += "</ul>";
        return ret;
    }

    // auto-focus the input field
    newInput.focus();

    $('button[name="submit"]').on('click', () => {
        fetch(newUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                'content': getNewContent()
            }),
        }).then((response) => {
            response.json().then((result) => {
                if (result.success === true) {
                    newInput.val('');
                    location.reload();
                }
            }).catch(() => {
            });
        });
    });

    // for todo-tag links
    $('a.todo-tag').click(function (event) {
        var str = $(event.target).text();
        str = "ls " + str + " ";
        $("input#cmd").val(str).focus();
    });

    // for todo-number links
    $('a.todo-number').click(function (event) {
        var str = $(event.target).text();
        $("input#cmd").val(str).focus(function () {
            $(this).setCursorPosition(0);
        }).focus();
    });

    // prevent double submit
    $('form#todo').submit(function () {
        $(':submit', this).attr('disabled', 'disabled').val('Loading...');
    });
});

// setCursorPosition function for todo-number, from:
// http://stackoverflow.com/questions/499126/jquery-set-cursor-position-in-text-area
new function ($) {
    $.fn.setCursorPosition = function (pos) {
        if ($(this).get(0).setSelectionRange) {
            $(this).get(0).setSelectionRange(pos, pos);
        } else if ($(this).get(0).createTextRange) {
            var range = $(this).get(0).createTextRange();
            range.collapse(true);
            range.moveEnd('character', pos);
            range.moveStart('character', pos);
            range.select();
        }
    }
}(jQuery);

