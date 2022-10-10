let url;
let produk = $("#history").DataTable({});

function print(id) {
    window.open(`transaksi/cetak/${id}`,'_blank'),'_blank';
}

produk.on("order.dt search.dt", () => {
    produk.column(0, {
        search: "applied",
        order: "applied"
    }).nodes().each((el, val) => {
        el.innerHTML = val + 1
    });
});