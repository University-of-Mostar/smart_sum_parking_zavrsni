require('dotenv').config()

var io = require('socket.io-client');
var socket = io.connect('https://demo.smart.sum.ba/parking-events', {reconnect: true});
var mysql = require('mysql2');
var counter = 0;
var counter2 = 0;

var con = mysql.createConnection({
    host: process.env.DB_HOST,
    port: process.env.DB_PORT,
    user: process.env.DB_USERNAME,
    password: process.env.DB_PASSWORD,
    database: process.env.DB_DATABASE,
  });

con.connect(function(err) {
    if (err) throw err;
    console.log("Connected to database!");
  });

// SOCKET CONNECT
socket.on('connect', function (socket) {
    console.log('Connected to socket server!');
});



//SOCKET RAMP CHANGE
socket.on('parking-lot-ramp-state-change', function(data){
    console.log(data);
    var sql = "UPDATE lots SET occupied = '"+ data.occupied +"' WHERE '"+ data.id_parking_space +"' = id";
    counter++;

    var sql3 = "UPDATE lots SET updated_at = '"+ data.created_at +"' WHERE '"+ data.id_parking_space +"' = id";
    counter++;

    con.query(sql, function (err, result) {
    if (err) throw err;
    });

    con.query(sql3, function (err, result) {
        if (err) throw err;
        console.log("Updated " + counter + " records." );
        });


    var sql2 = "INSERT INTO events (id_parking_space, id_parking_lot, id_parking_lot_type, name, type, occupied, created_at, normal_available, normal_occupied, handicap_available, handicap_occupied, parking_space_name) VALUES ('"+data.id_parking_space+"', '"+data.id_parking_lot+"', '"+data.id_parking_lot_type+"', '"+data.name+"', '"+data.type+"', '"+data.occupied+"', '"+data.created_at+"', '"+data.normal_available+"', '"+data.normal_occupied+"', '"+data.handicap_available+"', '"+data.handicap_occupied+"', '"+data.parking_space_name+"')";
    counter2++;

    con.query(sql2, function (err, result) {
    if (err) throw err;
    console.log("Inserted " + counter2 + " records." );
    });

    //SOCKET DISCONNECT
    socket.on("disconnect", (reason) => {
        if (reason === "ping timeout") {
          // the disconnection was initiated by the server, you need to reconnect manually
          socket.connect();
        }
        // else the socket will automatically try to reconnect
      });

});
