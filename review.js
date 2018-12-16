
// Use the createServer() method to create an HTTP server:

var http = require('http');

//create a server object:
http.createServer(function (req, res) {
  res.write('Hello World!'); //write a response to the client
  res.end(); //end the response
}).listen(8080); //the server object listens on port 8080 


// To include the File System module, use the require() method:
// Common use for the File System module:

    Read files
    Create files
    Update files
    Delete files
    Rename files
//

var http = require('http');
var fs = require('fs');
http.createServer(function (req, res) {
  fs.readFile('demofile1.html', function(err, data) {
    res.writeHead(200, {'Content-Type': 'text/html'});
    res.write(data);
    res.end();
  });
}).listen(8080); 



// The URL module splits up a web address into readable parts.
// To include the URL module, use the require() method:
var url = require('url');
var adr = 'http://localhost:8080/default.htm?year=2017&month=february';
var q = url.parse(adr, true);

console.log(q.host); //returns 'localhost:8080'
console.log(q.pathname); //returns '/default.htm'
console.log(q.search); //returns '?year=2017&month=february'

var qdata = q.query; //returns an object: { year: 2017, month: 'february' }
console.log(qdata.month); //returns 'february'


// What is a Package?
// A package in Node.js contains all the files you need for a module.
// Download a Package
// C:\Users\Your Name>npm install upper-case 

var http = require('http');
var uc = require('upper-case');
http.createServer(function (req, res) {
    res.writeHead(200, {'Content-Type': 'text/html'});
    res.write(uc("Hello World!"));
    res.end();
}).listen(8080); 


// Events in Node.js
// Every action on a computer is an event. Like when a connection is made or a file is opened.
// Objects in Node.js can fire events, like the readStream object fires events when opening and closing a file:
var fs = require('fs');

var readStream = fs.createReadStream('./demofile.txt');

/*Write to the console when the file is opened:*/
readStream.on('open', function () {
  console.log('The file is open');
});


// The Raspberry Pi is a small, affordable, and amazingly capable, credit card size computer.
// It is developed by the Raspberry Pi Foundation, and it might be the most versatile tech ever created.
// Creator Eben Upton's goal was to create a low-cost device that would improve programming skills and hardware understanding.
// Due to the small size and price of the device, it has become the center of a wide range of projects by tinkerers, makers, and electronics enthusiasts.
// we can write a script to turn the LED on and off.

var Gpio = require('onoff').Gpio; //include onoff to interact with the GPIO
var LED = new Gpio(4, 'out'); //use GPIO pin 4, and specify that it is output
var blinkInterval = setInterval(blinkLED, 250); //run the blinkLED function every 250ms

function blinkLED() { //function to start blinking
  if (LED.readSync() === 0) { //check the pin state, if the state is 0 (or off)
    LED.writeSync(1); //set pin state to 1 (turn LED on)
  } else {
    LED.writeSync(0); //set pin state to 0 (turn LED off)
  }
}

function endBlink() { //function to stop blinking
  clearInterval(blinkInterval); // Stop blink intervals
  LED.writeSync(0); // Turn LED off
  LED.unexport(); // Unexport GPIO to free resources
}

setTimeout(endBlink, 5000); //stop blinking after 5 seconds




