const express = require('express');
const bodyParser = require('body-parser');
const path = require('path');
const routes = require('./routes/router');
const session = require('express-session');
const mysql = require('mysql');
const md5 = require('md5');
const util = require('util');
const app = express();
const puppeteer = require("puppeteer")

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "root",
  port : 3306,
  database: "academias"
});
con.connect();
app.use (
  session ({
     secret: "secret",
     saveUninitialized: true,
     resave: true,
     cookie: {
        expires: 55 * 1000
     }
  })
);
app.use(express.static('public'));
app.use(express.static('build'));
app.use('/css', express.static(__dirname + '/node_modules/bootstrap/dist/css'));
app.use('/js', express.static(__dirname + '/node_modules/bootstrap/dist/js'));
app.use('/js', express.static(__dirname + '/node_modules/jquery/dist/js'));

app.engine('html', require('ejs').renderFile);
app.set('views', path.join(__dirname, 'views'));
app.set('view engine', 'html');
app.use(bodyParser.urlencoded({ extended: false }))
app.use('/pages', routes);


app.get('/',(req, res)=>{
   res.render('home');
});
app.post('/pages/login',(req,res)=>{
  let email = req.body.email;
  let password = md5(req.body.senha);
  
  if(!email || !password)
  {
    console.log(req.body, "Incorreto")
  }
  else{
    con.query("select * from usuario where email='"+email+"' and senha='"+password+"'",(err, result)=>{
      //console.log(result)
      if(result.length > 0){
         req.session.loggedIn = true;
         req.session.name = result[0];
         console.log(req.session.loggedIn);
         console.log(result.name);
         res.redirect('/pages/gymitrius');
      } else {
        console.log(req.body, "Incorreto ");
      }
    }).on('error', function(err) {
        console.log(req.body, "Incorreto ", err);
    });
  }

});

function exitHandler(options, err) {
  connection.end();
  if (options.cleanup)
      console.log('clean');
  if (err)
      console.log(err.stack);
  if (options.exit)
      process.exit();
}
process.on('exit', exitHandler.bind(null, {cleanup: true}));
app.listen(3001, console.log('server is running'));
