const dotenv = require('dotenv');
const { spawn, exec } = require('child_process');
const gulp = require('gulp');
const callbackLog = (cb) => {
  return async (err, stdout, stderr) => {
    console.log(`${stdout}`);
    if(err) {
      console.error(`${stderr}`);
    }
    cb(err);
  }
};
const serverCb = (cb) => {
  const phpProcess = spawn('php', ['-S', `${process.env.HOST}:${process.env.PORT}`, '-t', 'public'], {
    cwd: __dirname,
    stdio: ['ipc'],
  });
  phpProcess.stdout.on('data', (data) => {
    console.log(`${data}`);
  });
  phpProcess.stderr.on('data', (data) => {
    console.log(`${data}`);
  });
  phpProcess.on('close', (code) => {
    if (code !== 0) {
      cb(new Error(`php exited with code ${code}`));
    } else {
      cb();
    }
  });
};
const webpackCb = (cb) => {
  const webpackProcess = spawn(/^win/.test(process.platform) ? 'npm.cmd' : 'npm', ['run', 'webpack'], {
    cwd: __dirname,
    stdio: ['ipc'],
  });
  webpackProcess.stdout.on('data', (data) => {
    console.log(`${data}`);
  });
  webpackProcess.stderr.on('data', (data) => {
    console.log(`${data}`);
  });
  webpackProcess.on('close', (code) => {
    if (code !== 0) {
      cb(new Error(`webpack exited with code ${code}`));
    } else {
      cb();
    }
  });
};
dotenv.config();
// This task will run the `php -S localhost:8080 -t public` command once when it is started
gulp.task('server', serverCb);
// This task will run `tsc` on any .ts, .tsx, or .js file that is changed inside the Server/Views/Pages directory
gulp.task('typescript', (cb) => {
  exec('npm run tsc', callbackLog(cb));
  return gulp.watch('Server/Views/Pages/**/*.{ts,tsx,js}', gulp.series('typescript'));
});

// This task will run `npm run sass` on any .sass, .scss, or .css file that is changed inside the Server/Views/Pages directory
gulp.task('sass', (cb) => {
  exec('npm run sass', callbackLog(cb));
  return gulp.watch('Server/Views/Pages/**/*.{sass,scss,css}', gulp.series('sass'));
});
gulp.task('sassBundle', (cb) => {
  exec('npm run sassBundle', callbackLog(cb));
  return gulp.watch('Server/Views/Templates/Stylesheets/**/*.{sass,scss,css}', gulp.series('sassBundle'));
});

// This task will run `webpack` on any .ts, .tsx, or .js file that is changed inside the Client directory
gulp.task('webpack', webpackCb);

// This is the default task that will run all of the above tasks
gulp.task('default', gulp.parallel('server', 'typescript', 'sass', 'sassBundle', 'webpack'));