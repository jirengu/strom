var process = require('child_process');


process.exec(' git add .; git commit -am "modify"; git push', function (error, stdout, stderr) {
	console.log('exec:  upload');
    if (error !== null) {
      console.log('exec error: ' + error);
    }
});

