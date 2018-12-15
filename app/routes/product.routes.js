// var config = require("../../config/database.config");
var product = require("../controllers/product.controller");

module.exports = app => {
  app.get("/product", product.getall);

  app.get("/product/:_id", product.get);

  app.post("/product", product.post);

  app.put("/product/:_id", product.put);

  app.delete("/product/:_id", product.delete);
};
