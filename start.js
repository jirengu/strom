var process = require('child_process');

process.exec(' git add .; git commit -am "modify"; git pull; git push -u origin master; git push -u sae master:1; git push -u github master;', function (error, stdout, stderr) {
	console.log('exec:  upload');
    if (error !== null) {
      console.log('exec error: ' + error);
    }
});

