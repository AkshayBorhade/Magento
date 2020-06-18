var config = {
    paths: {
        "owl.carousel.min": "Magento_Theme/js/owl.carousel.min",
        "custom": "Magento_Theme/js/custom"
    },
    shim: {
        "owl.carousel.min": {
            deps: ["jquery"]
        },
        "custom": {
            deps: ["jquery"]
        }
    }
}