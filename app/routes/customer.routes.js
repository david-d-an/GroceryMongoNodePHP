// var config = require("../../config/database.config");
var customer = require("../controllers/customer.controller.js");

module.exports = app => {
  app.get("/customer", customer.getall);

  app.get("/customer/:_id", customer.get);

  app.post("/customer", customer.post);

  app.put("/customer/:_id", customer.put);

  app.delete("/customer/:_id", customer.delete);
};
