function search(e) {
    const form = document.getElementById("searchForm");
    const searchInput = document.getElementById("searchField");
    if (searchInput.value === "") {
        e.preventDefault();
    } else {
        form.submit();
    }
}
