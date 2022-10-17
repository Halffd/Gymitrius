const express = require('express');
const router = express.Router();
const mysql = require('mysql');
const util = require('util');
const puppeteer = require("puppeteer")
const fs = require('fs')
//const session = require('express-session');

var con = mysql.createConnection({
  host: "localhost",
  user: "root",
  password: "root",
  port : 3306,
  database: "academias"
});
const query = util.promisify(con.query).bind(con);
router.get('/register',(req, res)=>{
  res.render('register',{data : ''});
});
/*
con.query("select * from login where email ='abc@gmail.com'", (err, result)=>{
  if(err) throw err;
  console.log(result[0].name)
});
*/

router.post('/register', (req, res)=>{
  let name = req.body.name;
  let email = req.body.email;
  let password1 = req.body.password1;
  let password2 = req.body.password2;

  if(!name || !email || !password1 || !password2)
  {
     res.render('register',{data : 'fill all fields carefully!'});
  }
  else
  {
    if(password1 === password2 && password1.length >= 6)
    {
      let q = "select email from login where email = '"+email+"'";
      con.query(q, (err, result)=>{
         if(err) throw err;
         if(result.length == 0)
         {
           con.query("insert into login(name , email, password) values('"+name+"','"+email+"','"+password1+"')",(err, result)=>{
             if(err) throw err;
             res.render('register',{data : 'successfully registered!'});
           });
         }

         else
         {
            res.render('register',{data : 'email already exists!'});
         }
      });

   }
   else
   {
     res.render('register',{data : 'password length should be at least 6 digits/number'})
   }
  }
});
router.get('/academia',(req, res)=>{
  res.render('academia',{data : ''});
});
router.get('/personal',(req, res)=>{
  res.render('personal',{data : ''});
});
router.get('/login',(req, res)=>{
  res.render('login',{data : ''});
});

/*con.query('SELECT * FROM usuario', function(err, rows, fields) {
  if (err) {
    console.log('Encountered an error:', err.message);
    return response.send(500, err.message);
  }
  thedata = ({'nome' : rows});
  console.log(thedata);
});*/
router.get('/academia',(req, res)=>{
  if(req.session.loggedIn){
    res.render('academia',{data : req.session.name});
  }else{
    res.render('academia',{data : 'please login!'});
  }
});
router.get('/gymitrius',(req, res)=>{
  if(!req.session.loggedIn){
    (async () => {
        var academias, dados, b64, img;
        try {
          console.log("Querying");
          academias = await query('select count(*) as count from academia');
          dados = await query('select id, nome, email, telefone, endereco, cnpj, preco, cupom, imagem as dados from academia');
          console.log(academias[0].count);
          console.log(dados);
          img = await query('select imagem as imagem from academia where id=1');
          b64 = Buffer.from(img[0].imagem).toString('base64');
          console.log(b64);
        } catch (error) {
          console.error(error);
        } finally {
          res.render('gymitrius', {data : dados, quant: academias, image: b64});

        }
    })()
}else{
  console.log("Error: Please Login")
  res.render('gymitrius',{data : 'please login!'});
}

});

router.get('/logout', (req, res)=>{
  req.session.loggedIn = false;
  res.redirect('/pages/login');
});
//<!--<%=JSON.stringify(data[i].dados)%>
//<img src=<%= data[i].dados %>;base64,${Buffer.from(<%= data[i].dados %>).toString('base64')}`}/>-->
module.exports = router;
