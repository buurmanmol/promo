const path = require('path');

module.exports = {
    devServer: {
        proxy: 'https://testcheckout.buckaroo.nl/json/DataRequest',
    },
    resolve: {
        alias: {
            '@': path.resolve('resources/js'),
        },
    },
};
