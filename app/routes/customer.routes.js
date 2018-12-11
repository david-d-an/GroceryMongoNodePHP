// var config = require("../../config/database.config");
var cusomer = require("../controllers/customer.controller.js");

module.exports = app => {
  app.get("/customer");

  app.get("/customer/:id");

  app.post("/customer");

  app.put("/customer/:id");

  app.delete("/customer/:id");
};
