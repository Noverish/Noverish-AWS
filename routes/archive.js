"use strict";
const express = require('express');
const router = express.Router();
const AWS = require('aws-sdk');
const credentials = new AWS.SharedIniFileCredentials({profile: 'noverish'});
AWS.config.credentials = credentials;
AWS.config.region = 'ap-northeast-2';
AWS.config.signatureVersion = 'v4';
const s3 = new AWS.S3();

const bucketName = 'noverish';
const thumbnailBucket = 'noverish-thumbnail';
const LOAD_NUM = 1000;

let isThumbnail = false;
let continueToken = null;

router.get('/', function(req, res, next) {
    checkObjectExist('/', res);
});

router.get('/:path*', function(req, res, next) {
    if(req.query.hasOwnProperty('thumbnail')) {
        isThumbnail = (req.query['thumbnail'] === 'true');
    }

    if(req.query.hasOwnProperty('continueToken')) {
        continueToken = parseInt(req.query['continueToken']);
    }

    const path = req.params.path + req.params['0'];
    checkObjectExist(path, res);
});

function checkObjectExist(path, res) {
    const params = {
        Bucket: bucketName,
        Key: path
    };

    s3.headObject(params, function(err, data) {
        if(err) {
            if(isThumbnail) {
                showObjectThumbnails(path, res);
            } else {
                showObjectList(path, res);
            }
        } else {
            showObject(path, res);
        }
    });
}

function showObject(path, res) {
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

function showObjectList(path, res) {
    if(path === '/')
        path = '';
    else
        path += '/';

    const params = {
        Bucket: bucketName,
        Prefix: path,
        Delimiter: '/'
    };

    s3.listObjectsV2(params, function (err, data) {
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

function showObjectThumbnails(path, res) {
    if(path === '/')
        path = '';
    else
        path += '/';

    const params = {
        Bucket: bucketName,
        Prefix: path,
        Delimiter: '/',
        MaxKeys: LOAD_NUM
    };

    if(continueToken) {
        params.ContinueToken = continueToken
    }

    s3.listObjectsV2(params, function (err, data) {
        if (err) {
            res.end(JSON.stringify(err));
            return;
        }

        let objects = [];

        data.CommonPrefixes.forEach(function(element) {
            let link = '/archive/' + element.Prefix;
            let src = '';
            objects.push({
                link: link,
                src: src
            })
        });

        data.Contents.forEach(function(element) {
            let link = '/archive/' + element.Key;

            const params = {
                Bucket: thumbnailBucket,
                Key: element.Key,
                Expires: 60
            };

            const url = s3.getSignedUrl('getObject', params);

            objects.push({
                link: link,
                src: url
            })
        });

        if(path !== '/') {
            objects.unshift({
                link: '../',
                src: ''
            });
        }

        res.render('archive-thumbnail', { path: path, objects: objects });
    });
}

module.exports = router;
