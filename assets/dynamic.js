document.addEventListener("DOMContentLoaded", (event) => {
    const container = lbb_vars.container;
    const target = document.querySelector(container);
    let waitTime = Date.now();

    if (typeof target !== 'undefined') {
        // Create an observer instance.
        const observer = new MutationObserver(function (mutations) {

            // Only update every 2.5 seconds
            if ( Date.now() < waitTime ) {
                return;
            }

            let price_container = document.getElementById('lbb-price');
            let amount_container = document.getElementById('lbb-amount');
            let button = document.getElementById('lease-boot-button');
            let url = button.href;
            let amount = target.innerText;
            amount = amount.split(',')[0]; // remove cents
            amount = amount.replace(/[^0-9]/g, ''); // remove all non-numeric characters

            wp.ajax.post("lease_boot_button_get_price", {
                amount: amount
            }).done(function (response) {
                if ( price_container !== null ) {
                    if ( typeof response.price === 'string' || response.price instanceof String ) {
                        price_container.innerText = response.price;
                    }
                }

                if ( amount_container !== null ) {
                    if ( typeof response.amount_formatted === 'string' || response.amount_formatted instanceof String ) {
                        amount_container.innerText = response.amount_formatted;
                    }
                }

                if ( button !== null ) {
                    if ( typeof response.amount === 'string' || response.amount instanceof String ) {
                        button.href = updateURLParameter(url, 'amount', response.amount);
                    }
                }
            });

            // Wait 2.5 seconds before updating again
            waitTime = Date.now() + 2500;
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

function updateURLParameter(url, param, paramVal){
    let newAdditionalURL = "";
    let tempArray = url.split("?");
    const baseURL = tempArray[0];
    const additionalURL = tempArray[1];
    let temp = "";
    if (additionalURL) {
        tempArray = additionalURL.split("&");
        for (let i=0; i<tempArray.length; i++){
            if(tempArray[i].split('=')[0] !== param){
                newAdditionalURL += temp + tempArray[i];
                temp = "&";
            }
        }
    }

    const rows_txt = temp + "" + param + "=" + paramVal;
    return baseURL + "?" + newAdditionalURL + rows_txt;
}
