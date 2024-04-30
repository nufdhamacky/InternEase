function rejectAd(id) {
    let p = prompt("Enter reason for rejection", "Not suitable for our platform");
    if (p != null) {
        window.location.href = "http://localhost/internease/public/companyad/reject?id=" + id + "&reason=" + p;
    }
}

function search(e) {
    const form = document.getElementById("searchForm");
    const searchInput = document.getElementById("searchField");
    if (searchInput.value === "") {
        e.preventDefault();
    } else {
        form.submit();
    }
}