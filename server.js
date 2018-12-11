const express = require("express");
const bodyParser = require("body-parser");

// create express app
const app = express();

// parse requests of content-type - application/x-www-form-urlencoded
app.use(bodyParser.urlencoded({ extended: true }));

// parse requests of content-type - application/json
app.use(bodyParser.json());


// define a simple route
app.get("/", (req, res) => {
  return res.send(
    "Welcome to Grocery application!"
  );
});

// Require Notes routes
require("./app/routes/customer.routes")(app);
require("./app/routes/product.routes")(app);

// listen for requests
app.listen(3000, () => {
  console.log("Server is listening on port 3000");
});
