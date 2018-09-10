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

let continueToken = null;

router.get('/', function(req, res, next) {
    checkObjectExist('/', res);
});

router.get('/:path*', function(req, res, next) {
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
            getObjectList(path, res);
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

function getObjectList(path, res) {
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

        let folders = [];
        let objects = [];

        data.CommonPrefixes.forEach(function(element) {
            let name = element.Prefix.replace(path, '');
            folders.push(name)
        });

        data.Contents.forEach(function(element) {
            let name = element.Key.replace(path, '');
            objects.push(name)
        });

        processObjectList(path, res, folders, objects);
    });
}

function processObjectList(path, res, folders, objects) {
    if (objects.length > folders.length) {
        showObjectThumbnails(path, res, folders, objects)
    } else {
        showObjectList(path, res, folders, objects)
    }
}

function showObjectList(path, res, folders, objects) {
    let items = [];

    folders.forEach(function(name) {
        let link = '/archive/' + path + name;
        items.push({
            link: link,
            name: name
        })
    });

    objects.forEach(function(name) {
        let link = '/archive/' + path + name;
        items.push({
            link: link,
            name: name
        })
    });

    if(path !== '/') {
        items.unshift({
            link: '../',
            name: '../'
        });
    }

    res.render('archive', { path: path, objects: items });
}

function showObjectThumbnails(path, res, folders, objects) {
    let items = [];

    folders.forEach(function(name) {
        let link = '/archive/' + path + name;
        let src = '';
        items.push({
            link: link,
            src: src
        })
    });

    objects.forEach(function(name) {
        let link = '/archive/' + path + name;
        let url = ""

        var re = /(?:\.([^.]+))?$/;
        var ext = re.exec(name)[1];
        if (ext === "txt") {
            url = "/images/icons8-txt-96.png";
        } else if (ext === 'gif') {
            url = "/images/icons8-gif-96.png";
        } else {
            const params = {
                Bucket: thumbnailBucket,
                Key: path + name,
                Expires: 60
            };

            url = s3.getSignedUrl('getObject', params);
        }

        items.push({
            link: link,
            src: url
        })
    });

    if(path !== '/') {
        items.unshift({
            link: '../',
            src: '/images/icons8-folder-tree-96.png'
        });
    }

    res.render('archive-thumbnail', { path: path, objects: items });
}

module.exports = router;
