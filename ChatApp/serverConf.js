const moment = require('moment');
let app={};

const SSL=false;     // true if ssl active and protocol HTTPS
app.ID_LOGIN=false;

// set the base url otherwise will be auto set when register with client
app.baseUrl = null;
app.setHost = (serverHost) => {
    app.baseUrl = serverHost;
};
app.getHost= ()=>{return app.baseUrl};

app.createServer=function (app) {
    let server=null;
    if(SSL){
        const fs=require("fs");
        // certificate paths
        const opt={
            key: fs.readFileSync('/etc/privkey.pem'), //location of private key file.required. extension can be .key
            cert: fs.readFileSync('/etc/cert.pem'), //location of certificate file.required. extension can be .cert
            ca: fs.readFileSync('/etc/chain.pem') // optional
        };
        server = require("https").createServer(opt,app); // https port 8443
    }else{
        server = require("http").createServer(app, {
            pingTimeout: 60000,
        });  // else http port 8080
    }
    return server;
};

app.startServer=function (server) {
    // https port 8443
    if(SSL){
        server.listen(process.env.PORT || 8443, function () {
            let host = server.address().address;
            let port = server.address().port;
            console.log("\n\n---------------------------- " + moment().format('MMMM Do YYYY, hh:mm:ss') + " ----------------------------\n");
            console.log("[ " + moment().format('MMMM Do YYYY, hh:mm:ss') + " ] " + "Im server running at https://" + host + ':' + port);

        });

    }
    // else http port 8080
    else{
        server.listen(process.env.PORT || 8080, function () {
            let host = server.address().address;
            let port = server.address().port;
            console.log("\n\n---------------------------- " + moment().format('MMMM Do YYYY, hh:mm:ss') + " ----------------------------\n");
            console.log("[ " + moment().format('MMMM Do YYYY, hh:mm:ss') + " ] " + "Im server running at http://" + host + ':' + port);

        });

    }
};

module.exports = app;