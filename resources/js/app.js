import "./bootstrap";

document.addEventListener("DOMContentLoaded", function () {
    // Check for authentication
    const token = localStorage.getItem("token");
    if (!token && window.location.pathname !== "/login") {
        window.location.href = "/login";
    }

    // Logout functionality
    const logoutBtn = document.getElementById("logout-btn");
    if (logoutBtn) {
        logoutBtn.addEventListener("click", function () {
            localStorage.removeItem("token");
            window.location.href = "/login";
        });
    }
});

// API helper functions
const api = {
    get: async (url) => {
        const response = await fetch(url, {
            headers: {
                Authorization: "Bearer " + localStorage.getItem("token"),
                "Content-Type": "application/json",
            },
        });
        return response.json();
    },

    post: async (url, data) => {
        const response = await fetch(url, {
            method: "POST",
            headers: {
                Authorization: "Bearer " + localStorage.getItem("token"),
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        });
        return response.json();
    },

    put: async (url, data) => {
        const response = await fetch(url, {
            method: "PUT",
            headers: {
                Authorization: "Bearer " + localStorage.getItem("token"),
                "Content-Type": "application/json",
            },
            body: JSON.stringify(data),
        });
        return response.json();
    },

    delete: async (url) => {
        const response = await fetch(url, {
            method: "DELETE",
            headers: {
                Authorization: "Bearer " + localStorage.getItem("token"),
            },
        });
        return response;
    },
};

// POS functionality
class POS {
    constructor() {
        this.currentOrder = {
            items: [],
            subtotal: 0,
            tax: 0,
            total: 0,
        };
    }

    addItem(product, quantity = 1) {
        const existingItem = this.currentOrder.items.find(
            (item) => item.product.id === product.id
        );

        if (existingItem) {
            existingItem.quantity += quantity;
        } else {
            this.currentOrder.items.push({
                product: product,
                quantity: quantity,
                price: product.price,
            });
        }

        this.calculateTotals();
        this.updateUI();
    }

    removeItem(productId) {
        this.currentOrder.items = this.currentOrder.items.filter(
            (item) => item.product.id !== productId
        );
        this.calculateTotals();
        this.updateUI();
    }

    calculateTotals() {
        this.currentOrder.subtotal = this.currentOrder.items.reduce(
            (sum, item) => {
                return sum + item.price * item.quantity;
            },
            0
        );

        this.currentOrder.tax = this.currentOrder.subtotal * 0.1; // 10% tax
        this.currentOrder.total =
            this.currentOrder.subtotal + this.currentOrder.tax;
    }

    updateUI() {
        // Update order items list
        const itemsList = document.getElementById("order-items");
        if (itemsList) {
            itemsList.innerHTML = this.currentOrder.items
                .map(
                    (item) => `
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    ${item.product.name} (${
                        item.quantity
                    } x Rp. ${item.price.toLocaleString()})
                    <span class="badge bg-primary rounded-pill">Rp. ${(
                        item.price * item.quantity
                    ).toLocaleString()}</span>
                    <button class="btn btn-sm btn-danger remove-item" data-id="${
                        item.product.id
                    }">
                        <i class="bi bi-trash"></i>
                    </button>
                </li>
            `
                )
                .join("");

            // Add event listeners to remove buttons
            document.querySelectorAll(".remove-item").forEach((button) => {
                button.addEventListener("click", (e) => {
                    this.removeItem(
                        parseInt(e.target.closest("button").dataset.id)
                    );
                });
            });
        }

        // Update totals
        const subtotalEl = document.getElementById("subtotal");
        const taxEl = document.getElementById("tax");
        const totalEl = document.getElementById("total");

        if (subtotalEl)
            subtotalEl.textContent =
                "Rp. " + this.currentOrder.subtotal.toLocaleString();
        if (taxEl)
            taxEl.textContent = "Rp. " + this.currentOrder.tax.toLocaleString();
        if (totalEl)
            totalEl.textContent =
                "Rp. " + this.currentOrder.total.toLocaleString();
    }

    async completeOrder(cashierId) {
        if (this.currentOrder.items.length === 0) {
            alert("Please add items to the order");
            return;
        }

        const orderData = {
            user_id: cashierId,
            items: this.currentOrder.items.map((item) => ({
                product_id: item.product.id,
                quantity: item.quantity,
            })),
        };

        try {
            const response = await api.post("/api/orders", orderData);
            alert(`Order #${response.order_number} completed successfully!`);

            // Reset current order
            this.currentOrder = {
                items: [],
                subtotal: 0,
                tax: 0,
                total: 0,
            };

            this.updateUI();
        } catch (error) {
            console.error("Error completing order:", error);
            alert("Failed to complete order");
        }
    }
}

// Initialize POS system
window.pos = new POS();

// Load products for POS
async function loadProducts() {
    try {
        const products = await api.get("/api/products");
        const productsContainer = document.getElementById("products-container");

        if (productsContainer) {
            productsContainer.innerHTML = products
                .map(
                    (product) => `
                <div class="col-md-3 mb-3">
                    <div class="card product-card" data-id="${product.id}">
                        <div class="card-body">
                            <h5 class="card-title">${product.name}</h5>
                            <p class="card-text">${
                                product.category
                                    ? product.category.name
                                    : "No category"
                            }</p>
                            <p class="card-text text-success">Rp. ${product.price.toLocaleString()}</p>
                            <button class="btn btn-primary add-to-order">Add to Order</button>
                        </div>
                    </div>
                </div>
            `
                )
                .join("");

            // Add event listeners to product cards
            document.querySelectorAll(".add-to-order").forEach((button) => {
                button.addEventListener("click", (e) => {
                    const productId = parseInt(
                        e.target.closest(".product-card").dataset.id
                    );
                    const product = products.find((p) => p.id === productId);
                    pos.addItem(product);
                });
            });
        }
    } catch (error) {
        console.error("Error loading products:", error);
    }
}

// Initialize POS page
if (document.getElementById("pos-page")) {
    loadProducts();

    // Complete order button
    const completeOrderBtn = document.getElementById("complete-order");
    if (completeOrderBtn) {
        completeOrderBtn.addEventListener("click", () => {
            const cashierId = localStorage.getItem("cashier_id");
            if (cashierId) {
                pos.completeOrder(parseInt(cashierId));
            } else {
                alert("Cashier not identified");
            }
        });
    }
}
