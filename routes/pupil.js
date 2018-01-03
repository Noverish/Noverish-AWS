"use strict";
const express = require('express');
const request = require('request');
const router = express.Router();

router.get('/', function(req, res, next) {

    var headers = {
        'Cookies': 'ipb_member_id=1872686; ipb_pass_hash=82211e477c4681b4fa2ff9060e6619cb;'
    };

    var options = {
        url : 'https://exhentai.org/s/c11b3ee060/1126544-1',
        method:'GET',
        headers: headers,
        jar: true
    };

    request(options, function(error, response, body) {
        if(error) {
            res.send('error');
            return;
        }

        res.send(body);
    });
});

router.post('/gallery', function(req, res, next) {
    res.send('pupil post');
});

module.exports = router;
