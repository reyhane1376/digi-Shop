document.addEventListener("DOMContentLoaded", function () {
    const getProducts = async () => {
        try {
            const productsContainer = document.getElementById("products");
            let col = "";
            const res = await fetch("http://localhost:8000/api/products", {
                method: "GET",
                headers: {
                    "Content-Type": "application/json",
                },
            });
            const result = await res.json();
            if (
                result.status.type === "success" &&
                result.status.code === 200
            ) {
                result.data.map((product) => {
                    col = ` <div class="col">
                    <div class="card shadow-sm">
                        <img src="${product.image.indexArray.medium}" />
                        <div class="card-body">
                            <p class="card-text">${product.name}</p>
                            <div class="d-flex justify-content-between align-items-center">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-outline-danger">حذف</button>
                                    <button type="button" class="btn btn-sm btn-outline-success">اضافه به سبد خرید</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>`;
                    productsContainer.innerHTML += col;
                });
            }
        } catch (error) {
            console.log(error);
        }
    };
    getProducts();
});
