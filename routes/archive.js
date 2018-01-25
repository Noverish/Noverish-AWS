"use strict";
const express = require('express');
const router = express.Router();
const AWS = require('aws-sdk');
const credentials = new AWS.SharedIniFileCredentials({profile: 'noverish'});
AWS.config.credentials = credentials;
const s3 = new AWS.S3();

const bucketName = 'noverish';

router.get('/', function(req, res, next) {
    checkObjectExist('/', req, res);
});

router.get('/:path*', function(req, res, next) {
    const path = req.params.path + req.params['0'];
    checkObjectExist(path, req, res);
});

function checkObjectExist(path, req, res) {
    const params = {
        Bucket: bucketName,
        Key: path
    };

    s3.headObject(params, function(err, data) {
        if(err) {
            showObjectList(path, req, res);
        } else {
            showObject(path, req, res);
        }
    });
}

function showObject(path, req, res) {
    const params = {
        Bucket: bucketName,
        Key: path
    };

    s3.getObject(params, function(err, data) {
        if (err) {
            res.end(JSON.stringify(err));
        } else {
            res.end(data.Body);
        }
    });
}

function showObjectList(path, req, res) {
    if(path === '/')
        path = '';
    else
        path += '/';

    const params = {
        Bucket: bucketName,
        Prefix: path,
        Delimiter: '/'
    };

    s3.listObjects(params, function (err, data) {
        if (err) {
            res.end(JSON.stringify(err));
            return;
        }

        let objects = [];

        data.CommonPrefixes.forEach(function(element) {
            let link = '/archive/' + element.Prefix;
            let name = element.Prefix.replace(path, '');
            objects.push({
                link: link,
                name: name
            })
        });

        data.Contents.forEach(function(element) {
            let link = '/archive/' + element.Key;
            let name = element.Key.replace(path, '');
            objects.push({
                link: link,
                name: name
            })
        });

        if(path !== '/') {
            objects.unshift({
                link: '../',
                name: '../'
            });
        }

        res.render('archive', { path: path, objects: objects });
    });
}

module.exports = router;
