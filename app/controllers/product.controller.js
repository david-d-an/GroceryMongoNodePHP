const Product = require('../models/product.model');
const dbConfig = require("../../config/database.config");
const mongoose = require("mongoose");

/***********/
var options = {
  useFindAndModify: dbConfig.useFindAndModify,
  useNewUrlParser: dbConfig.useNewUrlParser
};
mongoose
.connect(dbConfig.url, options)
.then(console.log("Successfully connected to the Grocery database from Product Controller"))
.catch(err => {
  console.log("Could not connect to the database. Exiting now...", err);
  process.exit();
});
/***********/

exports.getall = (req,res) => {
  Product.find()
    .then(p => res.send(p))
    .catch(err => {
      res.status(500).send({ message: err.message });
    });
};

exports.get = (req,res) => {
  Product.findById(req.params.id)
    .then(p => res.send(p))
    .catch(err => {
      res.status(500).send({ message: err.message });
    });
};

exports.post = (req,res) => {
  if (!req.body.ProductID)
    res.status(400).send({message: "ProductID is missing."});
    
  var product = new Product({
    ProductID: req.body.ProductID,
    ProductName: req.body.ProductName,
    SupplierID: req.body.SupplierID,
    CategoryID: req.body.CategoryID,
    QuantityPerUnit: req.body.QuantityPerUnit,
    UnitPrice: req.body.UnitPrice,
    UnitsInStock: req.body.UnitsInStock,
    UnitsOnOrder: req.body.UnitsOnOrder,
    ReorderLevel: req.body.ReorderLevel,
    Discontinued: req.body.Discontinued
  });

  product
  .save()
  .then(p => {
    res.status(200).send({message:"Successfully created", product:p})
  })
  .catch(err=> res.status(500).send({message: err.message}));
};

exports.put = (req,res) => {
  if (!req.body.sku)
    return res.send({message: "SKU is missing"});
  else if (!req.body.name)
    return res.send({message: "Name is missing"});
  else if (!req.body.description)
    return res.send({message: "Description is missing"});

  Product.findByIdAndUpdate(req.params.id,
    {
      ProductID: req.body.ProductID,
      ProductName: req.body.ProductName,
      SupplierID: req.body.SupplierID,
      CategoryID: req.body.CategoryID,
      QuantityPerUnit: req.body.QuantityPerUnit,
      UnitPrice: req.body.UnitPrice,
      UnitsInStock: req.body.UnitsInStock,
      UnitsOnOrder: req.body.UnitsOnOrder,
      ReorderLevel: req.body.ReorderLevel,
      Discontinued: req.bod.Discontinued
    },
    { new: true }
  )
  .then(p => {
    if (!p)
      return res.status(400).send({
        message: "Product couldn't be found"
      });
    else
      res.status(200).send({message:"Successfully updated", product:p});
  })
  .catch(err => res.send({message: err.message}));
};

exports.delete = (req,res) => {
  Product.findByIdAndRemove(req.params.id)
    .then(p => {
      if (!p)
        res.status(400).send({
          message: "Product couldn't be found"
        });
      else
        res.status(200).send({message:"Successfully deleted",product:p});
    })
    .catch(err => res.status(500).send(err.message));
};
