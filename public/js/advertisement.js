function rejectAd(id) {
    let p = prompt("Enter reason for rejection", "Not suitable for our platform");
    if (p != null) {
        window.location.href = "http://localhost/internease/public/companyad/reject?id=" + id + "&reason=" + p;
    }
}