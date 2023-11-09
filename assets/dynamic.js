document.addEventListener("DOMContentLoaded", (event) => {
    const container = lbb_vars.container;
    const target = document.querySelector(container);

    if (typeof target !== 'undefined') {
        // Create an observer instance.
        const observer = new MutationObserver(function (mutations) {
            let price_container = document.getElementById('lbb-price');
            let amount_container = document.getElementById('lbb-amount');
            let button = document.getElementById('lease-boot-button');
            let url = button.href.split('?amount=')[0];
            let amount = target.innerText;
            amount = amount.split(',')[0]; // remove cents
            amount = amount.replace(/[^0-9]/g, ''); // remove all non-numeric characters

            console.log(url);
            wp.ajax.post("lease_boot_button_get_price", {
                amount: amount
            }).done(function (response) {
                if (typeof response.price === 'string' || response.price instanceof String) {
                    price_container.innerText = response.price;
                    amount_container.innerText = response.amount_formatted;
                    button.href = url + '?amount=' + response.amount;
                }
            });
        });

        // Pass in the target node, as well as the observer options.
        observer.observe(target, {
            attributes: true,
            childList: true,
            subtree: true,
            characterData: true
        });
    }
});