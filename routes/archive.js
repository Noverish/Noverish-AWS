"use strict";
const express = require('express');
const router = express.Router();
const AWS = require('aws-sdk');
const credentials = new AWS.SharedIniFileCredentials({profile: 'noverish'});
AWS.config.credentials = credentials;
const s3 = new AWS.S3();

const bucketName = 'noverish';

function getObjectList(path) {
    return new Promise(function (resolve, reject) {
        const params = {
            Bucket: bucketName,
            Prefix: path,
            Delimiter: '/'
        };

        s3.listObjects(params, function (err, data) {
            if (err) {
                reject(err);
                return
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

            resolve(objects);
        });
    });
}

function getObjectData(key) {
    return new Promise(function (resolve, reject) {
        const params = {
            Bucket: bucketName,
            Key: key
        };

        s3.getObject(params, function(err, data) {
            if (err) {
                reject(err);
                return
            }

            resolve(data);
        });
    });
}

/* GET home page. */
router.get('/', function(req, res, next) {
    const path = '';

    getObjectList(path)
        .then((objects) => {
            res.render('archive', { path: path, objects: objects });
        })
        .catch((err) => {
            res.json(err);
        });
});

/* GET home page. */
router.get('/:path*', function(req, res, next) {
    const path = req.param('path') + req.param(0);

    getObjectData(path)
        .then(data => {
            res.end(data.Body);
        })
        .catch(err => {
            getObjectList(path + '/')
                .then(objects => {
                    objects.unshift({
                        link: '../',
                        name: '../'
                    });

                    res.render('archive', { path: path, objects: objects });
                })
                .catch(err => {
                    res.json(err);
                })
        });
});

module.exports = router;
