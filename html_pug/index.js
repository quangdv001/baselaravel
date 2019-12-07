require('dotenv').config();
const publicFolder = process.env.PUBLICFOLDER ? ('/' + process.env.PUBLICFOLDER) : '/public'
var settings = {
    webserver: { port: process.env.PORT }
},
    http = require('http'),
    express = require('express'),
    path = require('path'),
    port = process.env.PORT || settings.webserver.port,
    app = express();
    
var bodyParser = require('body-parser');
// app.use(bodyParser.json()); // support json encoded bodies
app.use(bodyParser.urlencoded({ extended: true })); // support encoded bodies
app.use(bodyParser.json());

// CONFIG THE APP
//================================================== 
// site resource
app.use(express.static(__dirname + publicFolder));

// set template engine to pug
app.engine('pug', require('pug').__express);
app.set('view engine', 'pug');
app.set('views', path.join(__dirname, './app/views'));

// set router
require('./app/routes.js')(app); 

// start server
if (!module.parent) {
    app.listen(port);
    console.log('SERRVER STATED. '+process.env.LOCAL_IP+':' + port);
}