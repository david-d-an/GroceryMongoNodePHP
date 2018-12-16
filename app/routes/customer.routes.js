// var config = require("../../config/database.config");
var customer = require("../controllers/customer.controller.js");

module.exports = app => {
  app.get("/customer", customer.getall);

  app.get("/customer/:userid/:password", customer.get);

  app.post("/customer", customer.post);

  app.put("/customer/:id", customer.put);

  app.delete("/customer/:id", customer.delete);
};
