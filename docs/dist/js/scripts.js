jQuery(function ($) {
    function searchItems() {
        var input, filter, ul, li, a, i, itemValue, found, item;
        var c = 0;
        input = document.getElementById("search");
        filter = input.value.toUpperCase();
        ul = document.getElementById("lista-items");
        li = ul.getElementsByClassName("lista-li");
        found = document.getElementById("not-found");
        for (i = 0; i < li.length; i++) {
            item = li[i].getElementsByClassName("item-content")[0];
            itemValue = item.textContent || item.innerText;
            if (filter === "" || filter === undefined || filter === null) {
                li[i].style.display = "block";
                found.style.display = "none";
            } else {
                if (itemValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "flex";
                    found.style.display = "none";
                    c++;
                } else {
                    li[i].style.display = "none";
                    if (c === 0) {
                        found.style.display = "block";
                    }
                }
            }
        }
    }
    $(document).on('change input', '#search', function () {
        searchItems();
        $('#search-close').removeClass('hide');
        $('#search-button').addClass('hide');
    });
});