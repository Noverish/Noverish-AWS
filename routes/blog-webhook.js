"use strict";
const express = require('express');
const { exec } = require('child_process');
const router = express.Router();

router.post('/', function(req, res, next) {
    let cmmd = 'cd ~/Noverish-Jekyll; ';
    cmmd += 'git pull origin master; ';
    cmmd += 'jekyll build; ';
    cmmd += 'mv _site blog; ';
    cmmd += 'cp -r blog ../node-project/noverish/; ';
    cmmd += 'mv blog _site; ';

    exec(cmmd, (err, stdout, stderr) => {
        if (err) {
            res.end('failed');
            return;
        }

        // the *entire* stdout and stderr (buffered)
        console.log(`stdout: ${stdout}`);
        console.log(`stderr: ${stderr}`);
    });

    res.end('success');
});

module.exports = router;
