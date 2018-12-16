const Customer = require('../models/customer.model');
const dbConfig = require("../../config/database.config.js");
const mongoose = require("mongoose");

/***********/
var options = {
  useFindAndModify: dbConfig.useFindAndModify,
  useNewUrlParser: dbConfig.useNewUrlParser
};
mongoose
.connect(dbConfig.url, options)
.then(console.log("Successfully connected to the Grocery database from Customer Controller"))
.catch(err => {
  console.log("Could not connect to the database. Exiting now...", err);
  process.exit();
});
/***********/

exports.getall = (req,res) => {
  Customer.find()
    .then(c => res.send(c))
    .catch(err => {
      res.status(500).send({ message: err.message });
    });
};

exports.get = (req,res) => {
  // Customer.findById(req.params.CustomerID)
  Customer.find(
    {
      CustomerID: req.params.userid,
      // PostalCode: req.params.password
      // CustomerID: "BLONP",
      // PostalCode: "12209"
      // Country: "Germany"
    }, 
    (err, user) => {
      // if there is an error retrieving, send the error. nothing after res.send(err) will execute
      if (err) {
        console.log(err.message);
        res.status(500).send({ message: err.message });
      }

      console.log(user);
      res.send(user); 
    }
  );
  // )
  //   .then(c => {
  //     console.log(c);
  //     res.send(c);
  //   })
  //   .catch(err => {
  //     console.log(err.message);
  //     res.status(500).send({ message: err.message });
  //   });
};

exports.post = (req,res) => {
  if (!req.body.sku)
    res.status(400).send({message: "SKU is missing."});
    
  var customer = new Customer({
    CustomerID: req.body.CustomerID,
    CompanyName: req.body.CompanyName,
    ContactName: req.body.ContactName,
    ContactTitle: req.body.ContactTitle,
    Address: req.body.Address,
    City: req.body.City,
    Region: req.body.Region,
    PostalCode: req.body.PostalCode,
    Country: req.body.Country,
    Phone: req.body.Phone,
    Fax: req.bod.Faxy
  });

  customer
  .save()
  .then(c => {
    res.status(200).send({message:"Successfully created", customer:c})
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

    Customer.findByIdAndUpdate(req.params.id,
    {
      CustomerID: req.body.CustomerID,
      CompanyName: req.body.CompanyName,
      ContactName: req.body.ContactName,
      ContactTitle: req.body.ContactTitle,
      Address: req.body.Address,
      City: req.body.City,
      Region: req.body.Region,
      PostalCode: req.body.PostalCode,
      Country: req.body.Country,
      Phone: req.body.Phone,
      Fax: req.bod.Faxy
    },
    { new: true }
  )
  .then(c => {
    if (!c)
      return res.status(400).send({
        message: "Customer couldn't be found"
      });
    else
      res.status(200).send({message:"Successfully updated", customer:c});
  })
  .catch(err => res.send({message: err.message}));
};

exports.delete = (req,res) => {
  Customer.findByIdAndRemove(req.params.id)
    .then(c => {
      if (!c)
        res.status(400).send({
          message: "Customer couldn't be found"
        });
      else
        res.status(200).send({message:"Successfully deleted",customer:c});
    })
    .catch(err => res.status(500).send(err.message));
};
